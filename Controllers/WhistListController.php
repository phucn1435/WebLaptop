<?php
include_once("Models/WhistList.php");


class WhistListController{
    private $model;
    private $db;
    
    public function __construct(){
        $this->model = new WhistList();
        $this->db = new Database();
    }

    public function handle_insert_list() {
        $flag = 0;
        $list = $this->model->Get_ID_Product($_POST['id_user']);

        foreach($list as $item) {
            if ($_POST['id_product'] == $item['ID_product']) {
                $flag = 1;
                break;
            }
        }

        if ($flag == 1) {
            $this->model->Xoa($_POST['id_user'], $_POST['id_product']);
        } else {
            $this->model->ThemMoi($_POST['id_user'], $_POST['id_product']);
        }
        
        echo $_POST['id_product'];
    }
    
    public function DanhSach()
    {
        // $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
        // $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        // $offset = ($current - 1) * $item;
        // if(isset($_GET['tentintuc'])) {
        //     $tentintuc = $_GET['tentintuc'];
        //     $tongsp = $this->model->TongTinTucTim($tentintuc);
        //     $totalPage = ceil($tongsp / $item);
        //     //gọi method TimKiem bên Models
        //     $result  = $this->model->TimKiem($tentintuc);
        //     if($_GET['tentintuc']==null){
        //         header('Location: ./DanhSach');
        //     }
        // } else{
        //     $tongsp = $this->model->TongTinTuc();
        //     $totalPage = ceil($tongsp / $item);
        //     //gọi method DanhSach bên Models
        //     $result = $this->model->DanhSach(100,0);
        // }
        $list = $this->model->DanhSach();
    
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
        if (isset($_POST['submit'])) {
            $file_tmp = $_FILES['hinhanh']['tmp_name'];
            $file_parts =explode('.',$_FILES['hinhanh']['name']);
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
                                            $_POST['trangthai'],
                                            );
                if ($create) {
                    header('Location: ./DanhSach');
                } 
            }
        }
        include('Views/TrangThaiSanPham/ThemMoi.php');
    }
    
    
    // public function CapNhat(){
    //     // $result = $this->loaitintuc->DanhSach();
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         //lấy dữ liệu cần cập nhật
    //         $dataUpdate = $this->model->ChiTiet($id);
    //         if (isset($_POST['submit'])) {

    //             $update = $this->model->CapNhat($id,$_POST['idloaitintuc'],
    //                                                 $_POST['tentintuc'],
    //                                                 $_POST['noidung'],
    //                                                 $_POST['ngaydang']);

    //             if ($update) {
    //                 header('Location: ./DanhSach');
    //             }
    //         }            
    //     }
    //     include 'Views/TinTuc/CapNhat.php';
    //     // return array($result,$dataUpdate);
    // }
    
    // public function Xoa(){
    //     if (isset($_GET['id'])){
    //         $id = $_GET['id'];
    //         $delete = $this->model->Xoa($id);
    //         if ($delete) {
    //             header('Location: ./DanhSach');
    //         }
    //     }
    // }
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




