<?php
// include_once("Models/Quyen.php");
// include_once("Models/LoaiQuyen.php");
// include_once("Models/VaiTroTaiKhoan.php");
require_once 'Assets/__init__/__include__.php';



class VaiTroTaiKhoanController{
    private $model;
    private $loaitintuc;
    private $db;
    private $thongbao;
    private $chamcong;
    
    public function __construct(){
        $this->model = new VaiTroTaiKhoan();
        $this->quyen = new Quyen();
        $this->loaiquyen = new LoaiQuyen();
        $this->db = new Database();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    // public function DanhSach()
    // {
    //     $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
    //     $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
    //     $offset = ($current - 1) * $item;
    //     if(isset($_GET['tentintuc'])) {
    //         $tentintuc = $_GET['tentintuc'];
    //         $tongsp = $this->model->TongTinTucTim($tentintuc);
    //         $totalPage = ceil($tongsp / $item);
    //         //gọi method TimKiem bên Models
    //         $result  = $this->model->TimKiem($tentintuc);
    //         if($_GET['tentintuc']==null){
    //             header('Location: ./DanhSach');
    //         }
    //     } else{
    //         $tongsp = $this->model->TongTinTuc();
    //         $totalPage = ceil($tongsp / $item);
    //         //gọi method DanhSach bên Models
    //         $result = $this->model->DanhSach(100,0);
    //     }
    
    //     //gọi và show dữ liệu ra view
    //     include 'Views/TinTuc/DanhSach.php';
    //     return $result;
    // }
    // public function ChiTiet(){
        
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $detail = $this->model->ChiTiet($id);
    //     }
    //     require_once('Views/TinTuc/ChiTiet.php');
    //     return $detail;
    // }
    public function DanhSach(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongVaiTro();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $list_role  = $this->model->DanhSachVaiTro($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_role = $this->model->LocTest($_GET['keyword'],$tongsp,0);
            if (!empty($loc_role)) {
                $tong_role = count($loc_role);
                $totalPage = ceil($tong_role / $item1);
                $list_role = $this->model->LocTest($_GET['keyword'],$item1,$offset);
            } else {
                $list_role = null;
                $totalPage = 0;
            }
        }

        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        include('Views/VaiTroTaiKhoan/DanhSach.php');
    }
    
    public function ThemMoi() {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $result = $this->loaiquyen->DanhSach($this->loaiquyen->TongLoaiQuyen(),0);
        $result1 = $this->quyen->DanhSachQuyen();
        $output = null;
        if (isset($_POST['submit'])) {
            if (empty($_POST['tenvaitro'])) {
                $output = "<span style='color: red;'>Bạn chưa đặt tên cho vai trò</span>";
            } elseif (empty($_POST['privilege'])) {
                $output = "<span style='color: red;'>Bạn chưa set quyền cho vai trò này</span>";
            } else {
                $this->model->ThemMoi($_POST['tenvaitro'], $_POST['privilege']);
                $output = "<span style='color: green;'>Thêm thành công</span>";
            }
            
        }
        include('Views/VaiTroTaiKhoan/ThemMoi.php');

    }
    
    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $result = $this->loaiquyen->DanhSach($this->loaiquyen->TongLoaiQuyen(),0);
        $result1 = $this->quyen->DanhSachQuyen();
        // $result = $this->loaitintuc->DanhSach();
        $getName = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            $getName = $this->model->getTen($id)[0]['tenvaitro'];
            if (isset($_POST['submit'])) {
                $this->model->CapNhat($id,$_POST['privilege']);
                header('Location: ./DanhSach');
            }            
        }
        include 'Views/VaiTroTaiKhoan/CapNhat.php';
        // return array($result,$dataUpdate);
    }

    public function view_quyen() {
        $html = "";
        if (isset($_POST['token'])) {
            $id = $_POST['token'];
            $quyen_vaitro = $this->model->ChiTiet($id);
            $tenvaitro = $quyen_vaitro[0]['tenvaitro'];
            $html .= "
            <div class='modal-content1'>
                <span class='close1' onclick='closeModal()'>&times;</span>
                <p style='font-size: 20px; font-weight: bold; text-align: left;'>Quyền của vai trò: <span style='color: red;'>$tenvaitro</span></p>
                <hr>
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='row' style='gap:15px 10%; text-align: center;'>";
                        foreach($quyen_vaitro as $item) {
                            $tenquyen = $item['ten'];
                            $html .= "<div style='color: #fff; padding: 5px; background: black;border-radius: 7px;' class='col-sm-3'>$tenquyen</div>";
                        }
                $html .= "
                        </div>
                    </div>
                </div>
                
            </div>";
            // $quyen_vaitro = $this->model->ChiTiet($id);
        }
        echo $html;
    }
    public function ChiTiet($id) {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $getName = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $detail = $this->model->ChiTiet($id);
            $getName = $this->model->getTen($id)[0]['tenvaitro'];
                    
        }
        include 'Views/VaiTroTaiKhoan/ChiTiet.php';
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




