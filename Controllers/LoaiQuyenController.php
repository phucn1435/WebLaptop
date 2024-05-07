<?php
// include_once("Models/LoaiQuyen.php");
require_once 'Assets/__init__/__include__.php';


class LoaiQuyenController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new LoaiQuyen();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $item1= !empty($_GET['per_page']) ? $_GET['per_page'] : 7;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongLoaiQuyen();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $result  = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_lq  = $this->model->LocTest($_GET['keyword'],$tongsp,0);
            if (!empty($loc_lq)) {
                $tong_lq = count($loc_lq);
                $totalPage = ceil($tong_lq / $item1);
                $result  = $this->model->LocTest($_GET['keyword'],$item1,$offset);
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
        include 'Views/LoaiQuyen/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        if (isset($_POST['submit'])) {
            $tenquyen = $_POST['tenquyen'];

            $existingQuyen = $this->model->TimKiemTheoTenLoaiQuyen($tenquyen);
            if(empty($_POST['tenquyen'])){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống tên quyền!</span>";
            }else if($existingQuyen){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Tên quyền này đã tồn tại!</span>";
            }else{
                $create = $this->model->ThemMoi($_POST['tenquyen']);
                if ($create) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/LoaiQuyen/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'nhomquyen';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $tenquyen = $_POST['tenquyen'];

            $existingQuyen = $this->model->TimKiemTheoTenLoaiQuyen($tenquyen);
            if(empty($_POST['tenquyen'])){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống tên quyền!</span>";
            }else if($existingQuyen){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Tên quyền này đã tồn tại!</span>";
            }else{
                $update = $this->model->CapNhat($id,$_POST['tenquyen']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
            }
        }
        include 'Views/LoaiQuyen/CapNhat.php';
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