<?php
// include_once("Models/KhachHang.php");
// include_once("Assets/Carbon/autoload.php");
require_once 'Assets/__init__/__include__.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

class KhachHangController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new KhachHang();
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
        $tong_kh = $this->model->TongKhachHang();
        $totalPage = ceil($tong_kh / $item1);
            //gọi method DanhSach bên Models
        $result  = $this->model->GetData($item1,$offset);
        if(isset($_GET['keyword'])) {
            $loc_kh = $this->model->LocTest($_GET['keyword'],$_GET['gioitinh'],$tong_kh, 0);
            if (!empty($loc_kh)) {
                $tong_kh = count($loc_kh);
                $totalPage = ceil($tong_kh / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['gioitinh'],$item1, $offset);
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
        include 'Views/KhachHang/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $create_at = Carbon::now()->toDateString();
        if (isset($_POST['submit'])) {
            $create = $this->model->ThemMoi($_POST['tenkhachhang'], $_POST['gioitinh']
            ,$_POST['ngaysinh'],$_POST['sodienthoai'],$_POST['email'],$_POST['diachi'],$create_at);
            if ($create) {
                header('Location: ./DanhSach');
            }
        }
        include 'Views/KhachHang/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'khachhang';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat($id,$_POST['tenkhachhang'],
                                                    $_POST['gioitinh'],
                                                    $_POST['ngaysinh'],
                                                    $_POST['sodienthoai'],
                                                    $_POST['email'],
                                                    $_POST['diachi']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/KhachHang/CapNhat.php';
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