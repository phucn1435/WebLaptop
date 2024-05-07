<?php
// include_once("Models/MaGiamGia.php");
// include_once("Models/SanPham.php");
// include_once("Models/LoaiMaGiamGia.php");
require_once 'Assets/__init__/__include__.php';   


class MaGiamGiaController{
    private $model;
    private $db;
    private $sanpham;
    private $loaimagiam;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new MaGiamGia();
        $this->db = new Database();
        $this->sanpham = new SanPham();
        $this->loaimagiam = new LoaiMaGiamGia();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $loaimagiam = $this->loaimagiam->DanhSach();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongMaGiamGia();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $listCodeDiscount = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_mgg = $this->model->LocTest($_GET['keyword'], $_GET['id_magiam'], $_GET['trangthai'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_mgg)) {
                $tong_mgg = count($loc_mgg);
                $totalPage = ceil($tong_mgg / $item1);
                $listCodeDiscount = $this->model->LocTest($_GET['keyword'], $_GET['id_magiam'], $_GET['trangthai'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
            } else {
                $listCodeDiscount = null;
            }
        }
        
        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        include 'Views/MaGiamGia/DanhSach.php';
    }

    

    // public function CapNhatHinhAnh(){
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         //lấy dữ liệu cần cập nhật
    //         $dataUpdate = $this->model->DanhSach2($id);
    //         if (isset($_POST['submit'])) {
    //             $file_tmp = $_FILES['hinhanh']['tmp_name'];
    //             $file_parts =explode('.',$_FILES['hinhanh']['name']);
    //             $file_ext = strtolower(end($file_parts));
    //             $file_name = time(). "-typeProduct." .$file_ext;
    //             $expensions= array("jpeg","jpg","png");
    //             $file_size = $_FILES['hinhanh']['size'];
    //             if(in_array($file_ext,$expensions) === false) {
    //                 $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    //             }else if($file_size > 2097152) {
    //                 $error='Kích thước file không được lớn hơn 2MB';
    //             } else {
    //                 move_uploaded_file($file_tmp,"Assets/data/HinhAnhLoaiSanPham/".$file_name);
    //                 $update = $this->model->CapNhatHinhAnh($id,$file_name);
    //                 if ($update) {
    //                     header('Location: ./DanhSach');
    //                 }
    //             }
    //         }            
    //     }
    //     include 'Views/LoaiSanPham/CapNhatHinhAnh.php';
    //     // return array($dataUpdate);
    // }


    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $listProduct = $this->sanpham->DanhSachMoi();
        $listTypeCodeDiscount = $this->loaimagiam->DanhSach();
         
        $onlyUse = null; 
        if (isset($_POST['submit'])) {
            $loai = $_POST['loaiuudai'];
            $ten = $_POST['tenuudai'];
            $ma = $_POST['mauudai'];
            $mota = $_POST['mota'];
            $luuluong = $_POST['luuluong'];
            $ngaybatdau = date("Y-m-d");
            $ngayketthuc = $_POST['ngayhethan'];
            $dktt = $_POST['toithieu'];
            $dktd = $_POST['toida'];
            if (isset($_POST['onlyUse']) && $_POST['onlyUse'] == "1") {
                $onlyUse = 1;
            } else {
                $onlyUse = 0;
            }
            $string2 = "";
            if (isset($_SESSION['arraySelectProduct'])) {
                $string2 = join(",", $_SESSION['arraySelectProduct']);
            }

            $file_tmp = $_FILES['hinhanh']['tmp_name'];
            $file_parts =explode('.',$_FILES['hinhanh']['name']);
            $file_ext = strtolower(end($file_parts));
            $file_name = time(). "-product." .$file_ext;
            $expensions= array("jpeg","jpg","png");
            $file_size = $_FILES['hinhanh']['size'];

            if(in_array($file_ext,$expensions) === false) {
                $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
            }else if($file_size > 2097152) {
                $error='Kích thước file không được lớn hơn 2MB';
            }else {
                move_uploaded_file($file_tmp,"Assets/data/HinhAnhMaGiamGia/".$file_name);

                $them = $this->model->ThemMoi($loai, $ten,$file_name, $ma, $mota, $luuluong, $ngaybatdau, $ngayketthuc, $dktt, $dktd, $onlyUse, $string2);
                if ($them) {
                    unset($_SESSION['arraySelectProduct']);
                }
            }
            
        }

        include 'Views/MaGiamGia/ThemMoi.php';
    }

    public function xuli() {
        $test = $_POST['data'];
        $_SESSION['arraySelectProduct'][] = $test;
        
        $uniqueArray = array_unique($_SESSION['arraySelectProduct']);
        $output = '';
        foreach($uniqueArray as $item) {
            $detailProduct = $this->sanpham->ChiTiet10($item);
            $nameProduct = $detailProduct[0]['TenSanPham'];
            $output .= "<span style='margin-left: 10px; '>$nameProduct</span>";
            $output .= "<i data-id_sp='".$item."' id='oke' style='color: red; font-size: 12px; margin-left: 5px;' class='fa-regular fa-circle-xmark'></i>" ;     
        }

        // print_r($uniqueArray);
        echo $output;
        
    }

    public function xoa() {
        $test = $_POST['data'];

        $uniqueArray = array_unique($_SESSION['arraySelectProduct']);   
        $_SESSION['arraySelectProduct'] = array_filter($uniqueArray, function($item) use ($test) {
            return $item != $test;
        });
        $output = '';
        foreach($_SESSION['arraySelectProduct'] as $item) {
            $detailProduct = $this->sanpham->ChiTiet10($item);
            $nameProduct = $detailProduct[0]['TenSanPham'];
            $output .= "<span style='margin-left: 10px; '>$nameProduct</span>";
            $output .= "<i data-id_sp='".$item."' id='oke' style='color: red; font-size: 12px; margin-left: 5px;' class='fa-regular fa-circle-xmark'></i>" ;     
        }

        echo $output;
    }

    public function Xoa1(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }

    // public function CapNhat(){
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $table = 'loaisanpham';
    //         //lấy dữ liệu cần cập nhật
    //         $dataUpdate = $this->db->find($table,$id);
            
    //         if (isset($_POST['submit'])) {
    //             $update = $this->model->CapNhat($id,$_POST['tenloaisanpham']);
    //             if ($update) {
    //                 header('Location: ./DanhSach');
    //             }
    //         }
    //     }
    //     include 'Views/LoaiSanPham/CapNhat.php';
    //     return $dataUpdate;
    // }
    // //hàm xóa
    
    
}