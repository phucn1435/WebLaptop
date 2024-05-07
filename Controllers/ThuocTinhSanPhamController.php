<?php
// include_once("Models/TinTuc.php");
// include_once("Models/LoaiTinTuc.php");
require_once 'Assets/__init__/__include__.php';


class ThuocTinhSanPhamController{
    private $model;
    private $loaitintuc;
    private $db;
    private $thongbao;
    private $chamcong;

    public function __construct(){
        $this->model = new ThuocTinhSanPham();
        $this->loaitintuc = new LoaiTinTuc();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // $list_LoaiTT = $this->loaitintuc->DanhSach(100,0);

        // $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
        // $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        // $offset = ($current - 1) * $item1;
        // $tongsp = $this->model->TongTinTuc();
        // $totalPage = ceil($tongsp / $item1);
            //gọi method DanhSach bên Models
        $result = $this->model->DanhSach(100,0);
        if(isset($_GET['keyword'])) {
            $loc_tt  = $this->model->LocTest($_GET['keyword'],$_GET['id_tt'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_tt)) {
                $tong_tt = count($loc_tt);
                $totalPage = ceil($tong_tt / $item1);
                $result  = $this->model->LocTest($_GET['keyword'],$_GET['id_tt'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
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
        include 'Views/ThuocTinhSanPham/DanhSach.php';
        return $result;
    }
    public function ChiTiet(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $detail = $this->model->ChiTiet($id);
        }
        require_once('Views/TinTuc/ChiTiet.php');
        return $detail;
    }
    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // $list_LoaiTT = $this->loaitintuc->DanhSach(100,0);
        // $limit = $this->loaitintuc->TongLoaiTinTuc();
        // $result = $this->loaitintuc->DanhSach($limit,0);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $output = null;
        if (isset($_POST['submit'])) {
            $tenthuoctinh = $_POST['tenthuoctinh'];
            $giatri = $_POST['giatri'];
            if (empty($tenthuoctinh) || empty($giatri)) {
                $output = "Vui lòng điền đầy đủ thông tin";
            } else {
                $this->model->ThemMoi($tenthuoctinh,$giatri);
            }
        }
        include('Views/ThuocTinhSanPham/ThemMoi.php');
    }
    
    
    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // $list_LoaiTT = $this->loaitintuc->DanhSach(100,0);

        $result = $this->loaitintuc->DanhSach(100,0);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {

                $update = $this->model->CapNhat($id,$_POST['idloaitintuc'],
                                                    $_POST['tentintuc'],
                                                    $_POST['noidung']
                                                    );

                if ($update) {
                    header('Location: ./DanhSach');
                }
            }            
        }
        include 'Views/TinTuc/CapNhat.php';
        // return array($result,$dataUpdate);
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
    public function CapNhatHinhAnh(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {
                $file_name = $_FILES['hinhanh']['name'];
                $file_tmp = $_FILES['hinhanh']['tmp_name'];
                move_uploaded_file($file_tmp,"Assets/data/HinhAnhTintuc/".$file_name);
                $update = $this->model->CapNhatHinhAnh($id,$_FILES['hinhanh']['name']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }            
        }
        include 'Views/TinTuc/CapNhatTinTuc.php';
        return array($dataUpdate);
    }

}




