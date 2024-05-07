<?php
// include_once("Models/NguonHang.php");
require_once 'Assets/__init__/__include__.php';   

class NguonHangController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new NguonHang();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tong_nh = $this->model->TongNguonHang();
        $totalPage = ceil($tong_nh / $item1);
        //gọi method DanhSach bên Models
        $result  = $this->model->GetDaTa($item1,$offset);
        if(isset($_GET['keyword'])) {
            $loc_nh = $this->model->LocTest($_GET['keyword'], $_GET['from_date'],$_GET['to_date'],$tong_nh, 0);
            if (!empty($loc_nh)) {
                $tong_nh = count($loc_nh);
                $totalPage = ceil($tong_nh / $item1);
                $result = $this->model->LocTest($_GET['keyword'], $_GET['from_date'],$_GET['to_date'],$item1, $offset);
            } else {
                $result = null;
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
        include 'Views/NguonHang/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['submit'])) {
            $create = $this->model->ThemMoi($_POST['tennguonhang'], $_POST['sodienthoai']
            ,$_POST['email'],$_POST['diachi'],$_POST['ngaytao'],$_POST['nguoidaidien']);
            if ($create) {
                header('Location: ./DanhSach');
            }
        }
        include 'Views/NguonHang/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'nguonhang';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat($id,$_POST['tennguonhang'],
                                                    $_POST['sodienthoai'],
                                                    $_POST['email'],
                                                    $_POST['diachi'],
                                                    $_POST['nguoidaidien']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/NguonHang/CapNhat.php';
        return $dataUpdate;
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
}