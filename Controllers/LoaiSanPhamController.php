<?php
// include_once("Models/LoaiSanPham.php");
// include_once("Models/ThongBao.php");
// include_once("Models/ChamCong.php");
require_once 'Assets/__init__/__include__.php';   


class LoaiSanPhamController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new LoaiSanPham();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tonglsp = $this->model->TongLoaiSanPham();
        $totalPage = ceil($tonglsp / $item1);
        //gọi method DanhSach bên Models
        $result = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_sp = $this->model->LocTest($_GET['keyword'], $_GET['trangthai'], $_GET['from_date'], $_GET['to_date'], $tonglsp,0);
            if (!empty($loc_sp)) {
                $tonglsp = count($loc_sp);
                $totalPage = ceil($tonglsp / $item1);
                $result = $this->model->LocTest($_GET['keyword'], $_GET['trangthai'], $_GET['from_date'], $_GET['to_date'],$item1,$offset);
            } else {
                $result = null;
            }
        }

        
        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        //gọi và show dữ liệu ra view
        include 'Views/LoaiSanPham/DanhSach.php';
        return $result;
    }

    public function CapNhatHinhAnh(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->DanhSach2($id);
            if (isset($_POST['submit'])) {
                $file_tmp = $_FILES['hinhanh']['tmp_name'];
                $file_parts =explode('.',$_FILES['hinhanh']['name']);
                $file_ext = strtolower(end($file_parts));
                $file_name = time(). "-typeProduct." .$file_ext;
                $expensions= array("jpeg","jpg","png");
                $file_size = $_FILES['hinhanh']['size'];
                if(in_array($file_ext,$expensions) === false) {
                    $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                }else if($file_size > 2097152) {
                    $error='Kích thước file không được lớn hơn 2MB';
                } else {
                    move_uploaded_file($file_tmp,"Assets/data/HinhAnhLoaiSanPham/".$file_name);
                    $update = $this->model->CapNhatHinhAnh($id,$file_name);
                    if ($update) {
                        header('Location: ./DanhSach');
                    }
                }
            }            
        }
        include 'Views/LoaiSanPham/CapNhatHinhAnh.php';
        // return array($dataUpdate);
    }


    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['submit'])) {
            $file_tmp = $_FILES['hinhanh']['tmp_name'];
            $file_parts =explode('.',$_FILES['hinhanh']['name']);
            $file_ext = strtolower(end($file_parts));
            $file_name = time(). "-typeProduct." .$file_ext;
            $expensions= array("jpeg","jpg","png");
            $file_size = $_FILES['hinhanh']['size'];

            if(in_array($file_ext,$expensions) === false) {
                $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
            }else if($file_size > 2097152) {
                $error='Kích thước file không được lớn hơn 2MB';
            } else {
                move_uploaded_file($file_tmp,"Assets/data/HinhAnhLoaiSanPham/".$file_name);
                $create = $this->model->ThemMoi($_POST['tenloaisanpham'],$file_name,$_POST['trangthai']);
                if ($create) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/LoaiSanPham/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'loaisanpham';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat($id,$_POST['tenloaisanpham']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/LoaiSanPham/CapNhat.php';
        return $dataUpdate;
    }
    //hàm xóa
    public function Xoa(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }
    
}