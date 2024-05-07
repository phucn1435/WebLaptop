<?php
// include_once("Models/LoaiTinTuc.php");
require_once 'Assets/__init__/__include__.php';   


class LoaiTinTucController{
    private $model;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new LoaiTinTuc();
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
        $tongsp = $this->model->TongLoaiTinTuc();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $result  = $this->model->DanhSach($item1, $offset);
        if (isset($_GET['keyword'])) {
            $loc_ltt  = $this->model->LocTest($_GET['keyword'],$tongsp,0);
            if (!empty($loc_ltt)) {
                $tong_ltt = count($loc_ltt);
                $totalPage = ceil($tong_ltt / $item1);
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
        include 'Views/LoaiTinTuc/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['submit'])) {
            $create = $this->model->ThemMoi($_POST['tentintuc']);
            if ($create) {
                header('Location: ./DanhSach');
            }
        }
        include 'Views/LoaiTinTuc/ThemMoi.php';
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'loaitintuc';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat($id,$_POST['tentintuc']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/LoaiTinTuc/CapNhat.php';
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