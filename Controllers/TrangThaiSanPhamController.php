<?php
// include_once("Models/TrangThai.php");
// include_once("Models/ThongBao.php");
// include_once("Models/ChamCong.php");
// include_once("Models/SanPham.php");

require_once 'Assets/__init__/__include__.php';   

class TrangThaiSanPhamController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new TrangThai();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        // $item1 = 6;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongtt = count($this->model->DanhSach1());
        $totalPage = ceil($tongtt / $item1);
        $list = $this->model->DanhSach($item1, $offset);
        if (isset($_GET['keyword'])) {
            $tongtt = ($this->model->LocTest($_GET['keyword'], $_GET['trangthai'], $_GET['from_date'], $_GET['to_date'],$tongtt,0));
            if (!empty($tongtt)) {
                $tong_sp = count($tongtt);
                $totalPage = ceil($tong_sp / $item1);
                $list = ($this->model->LocTest($_GET['keyword'], $_GET['trangthai'], $_GET['from_date'], $_GET['to_date'],$item1,$offset));
            } else {
                $list = null;
                $totalPage = 0;
            } 
        }

        
        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        //gọi và show dữ liệu ra view
        include 'Views/TrangThaiSanPham/DanhSach.php';
    }
    // public function ChiTiet(){
        
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $detail = $this->model->ChiTiet($id);
    //     }
    //     require_once('Views/TinTuc/ChiTiet.php');
    //     return $detail;
    // }
    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['submit'])) {
            $file_tmp = $_FILES['hinhanh']['tmp_name'];
            $file_parts = explode('.',$_FILES['hinhanh']['name']);
            $file_ext = strtolower(end($file_parts));
            $file_name = time(). "-typeNews." .$file_ext;
            $expensions= array("jpeg","jpg","png");
            $file_size = $_FILES['hinhanh']['size'];

            if(in_array($file_ext,$expensions) === false) {
                $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
            }else if($file_size > 2097152) {
                $error='Kích thước file không được lớn hơn 2MB';
            } else {
                move_uploaded_file($file_tmp,"Assets/data/HinhAnhTTSP/".$file_name);
              
                $create = $this->model->ThemMoi($_POST['tentrangthai'],
                                            $file_name,
                                            $_POST['trangthai']
                                            );
                if ($create) {
                    header('Location: ./DanhSach');
                } 
            }
        }
        include('Views/TrangThaiSanPham/ThemMoi.php');
    }
    
    
    public function CapNhat(){
        // $result = $this->loaitintuc->DanhSach();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->find($id);
            if (isset($_POST['submit'])) {

                $update = $this->model->CapNhat($id,$_POST['tentrangthai'],
                                                    $_POST['trangthai']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/TrangThaiSanPham/CapNhat.php';
    }
    
    public function Xoa(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }
    
    // public function CapNhatHinhAnh(){
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         //lấy dữ liệu cần cập nhật
    //         $dataUpdate = $this->model->ChiTiet($id);
    //         if (isset($_POST['submit'])) {
    //             $file_name = $_FILES['hinhanh']['name'];
    //             $file_tmp = $_FILES['hinhanh']['tmp_name'];
    //             move_uploaded_file($file_tmp,"Assets/data/HinhAnhTintuc/".$file_name);
    //             $update = $this->model->CapNhatHinhAnh($id,$_FILES['hinhanh']['name']);
    //             if ($update) {
    //                 header('Location: ./DanhSach');
    //             }
    //         }            
    //     }
    //     include 'Views/TinTuc/CapNhatTinTuc.php';
    //     return array($dataUpdate);
    // }

}




