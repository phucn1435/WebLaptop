<?php
// include_once("Models/NhanVien.php");
// include_once("Models/ChamCong.php");
require_once 'Assets/__init__/__include__.php';


class NhanVienController{
    private $model;
    private $db;
    private $chamcong;
    private $thongbao;
    
    public function __construct(){
        $this->model = new NhanVien();
        $this->db = new Database();
        $this->chamcong = new ChamCong();
        $this->thongbao = new ThongBao();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongNhanVien();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $result  = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_nv  = $this->model->LocTest($_GET['keyword'], $_GET['gioitinh'], $_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_nv)) {
                $tongnv = count($loc_nv);
                $totalPage = ceil($tongnv / $item1);
                $result  = $this->model->LocTest($_GET['keyword'], $_GET['gioitinh'], $_GET['from_date'],$_GET['to_date'],$item1,$offset);
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
        include 'Views/NhanVien/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        // $danhsachvaitro = $this->vaitro->DanhSachVaiTro();

        if (isset($_POST['submit'])) {
            $create = $this->model->ThemMoi($_POST['tennhanvien'], $_POST['gioitinh']
            ,$_POST['ngaysinh'],$_POST['sodienthoai'],$_POST['email'],$_POST['diachi'],$_POST['luong']);
            if ($create) {
                header('Location: ./DanhSach');
            }
        }
        include 'Views/NhanVien/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'nhanvien';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->find($id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat(
                $id,$_POST['tennhanvien'],
                $_POST['gioitinh'],
                $_POST['ngaysinh'],
                $_POST['sodienthoai'],
                $_POST['email'],
                $_POST['diachi'],
                $_POST['luong']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
            
        }
        include 'Views/NhanVien/CapNhat.php';
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

    public function ChamCong() {
        if (isset($_POST['id_user'])) {
            $this->chamcong->ThemChamCong($_POST['id_user']);
        }
    }
}