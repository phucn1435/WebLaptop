<?php
// include_once("Models/Quyen.php");
// include_once("Models/LoaiQuyen.php");//
require_once 'Assets/__init__/__include__.php';

class QuyenController{
    private $model;
    private $loaiquyen;
    private $db;
    private $chamcong;
    private $thongbao;
    
    public function __construct(){
        $this->model = new Quyen();
        $this->loaiquyen = new LoaiQuyen;
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $list_LoaiQuyen = $this->loaiquyen->DanhSach(100, 0);
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongQuyen();
        $totalPage = ceil($tongsp / $item1);
            //gọi method DanhSach bên Models
        $result = $this->model->DanhSach($item1, $offset);
        if(isset($_GET['keyword'])) {
            $tong_q = $this->model->LocTest($_GET['keyword'],$_GET['id_nq'],$tongsp,0);
            if (!empty($tong_q)) {
                $tong_q = count($tong_q);
                $totalPage = ceil($tong_q / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['id_nq'],$item1,$offset);
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
        include 'Views/Quyen/DanhSach.php';
        return $result;
    }
    
    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        $limit = $this->loaiquyen->TongLoaiQuyen();
        $result = $this->loaiquyen->DanhSach($limit, 0);
        if (isset($_POST['submit'])) {
            $ten = $_POST['ten'];

            $existingQuyen = $this->model->TimKiemTheoTenQuyen($ten);
            if(empty($_POST['ten'])){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống tên quyền!</span>";
            }else if($existingQuyen){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Tên quyền này đã tồn tại!</span>";
            }
            else{
                    $create = $this->model->ThemMoi($_POST['idloaiquyen'],
                                                $_POST['ten'],
                                                $_POST['duongdan']);
                if ($create) {
                    header('Location: ./DanhSach');
                }   
            }
        }
        require_once('Views/Quyen/ThemMoi.php');
        return $result;
    }
 
    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        $limit = $this->loaiquyen->TongLoaiQuyen();
        $result = $this->loaiquyen->DanhSach($limit,0);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {
                $ten = $_POST['ten'];

                $existingQuyen = $this->model->TimKiemTheoTenQuyen($ten);
                if(empty($_POST['ten'])){
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống tên quyền!</span>";
                }else if($existingQuyen){
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Tên quyền này đã tồn tại!</span>";
                }else{
                        $update = $this->model->CapNhat($id,$_POST['idloaiquyen'],
                                                        $_POST['ten'],
                                                        $_POST['duongdan']);

                    if ($update) {
                        header('Location: ./DanhSach');
                    }
                }
            }             
        }
        include 'Views/Quyen/CapNhat.php';
        return array($result,$dataUpdate);
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
