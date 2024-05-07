<?php
// include_once("Models/NhanVien.php");
// include_once("Models/DonHangBan.php");
// include_once("Models/PhiShip.php");
require_once 'Assets/__init__/__include__.php';




class PhiShipController{
    private $model;
    private $db;
    private $donhangban; 
    private $chamcong;
    private $thongbao;
    
    public function __construct(){
        $this->model = new PhiShip();
        $this->db = new Database();
        $this->donhangban = new DonHangBan();
        $this->chamcong = new ChamCong();
        $this->thongbao = new ThongBao();
    }
    
    public function DanhSach()
    {   
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $output = null;
        $province = $this->donhangban->province();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongPhiShip();
        $totalPage = ceil($tongsp / $item1);
       
        $list = $this->model->DanhSach($item1,$offset);

        if (isset($_GET['tinh'])) {
            if (!isset($_GET['xa']) || !is_numeric($_GET['xa'])) {
                $_GET['xa'] = null;
            }
            if (!isset($_GET['quan']) || !is_numeric($_GET['quan'])) {
                $_GET['quan'] = null;
            }
            $loc_p = $this->model->LocTest($_GET['tinh'],$_GET['quan'],$_GET['xa'],$tongsp,0);
            if (!empty($loc_p)) {
                $tong_p = count($loc_p);
                $totalPage = ceil($tong_p / $item1);
                $list = $this->model->LocTest($_GET['tinh'],$_GET['quan'],$_GET['xa'],$item1,0);
            } else {
                $list = null;
            }
        }

        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        include 'Views/PhiShip/DanhSach.php';
        return $result;
    }   

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $province = $this->donhangban->province();
        $notice = null;
        if(isset($_POST['saveFee'])) {
            $tinh = $_POST['tinh'];
            $quan = $_POST['quan'];
            $xa = $_POST['xa'];
            $phi = $_POST['feeShip'];
            $nameCity = $this->donhangban->nameCity($tinh);
            $nameDistrict = $this->donhangban->nameDistrict($quan);
            $nameWards = $this->donhangban->nameWards($xa);
            $them = $this->model->ThemMoi($tinh,$quan,$xa,$phi);
            if ($them) {
                $notice = "Thêm phí ship thành công";
            } else {
                $notice = "Thêm phí ship thất bại";
            }
        }
        include 'Views/PhiShip/ThemMoi.php';
    }

    public function Update() {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['token']) && isset($_POST['fee'])) {
            $this->model->Update($_POST['token'], $_POST['fee']);
        }
    }

    public function Xoa(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }

}