<?php
// include_once("Models/TaiKhoanNhanVien.php");
// include_once("Models/NhanVien.php");
// include_once("Models/Quyen.php");
// include_once("Models/LoaiQuyen.php");
// include_once("Models/PhanQuyen.php");
// include_once("Models/VaiTroTaiKhoan.php");

require_once 'Assets/__init__/__include__.php';

class TaiKhoanNhanVienController{
    private $model;
    private $db;
    private $tennhanvien;
    private $quyen;
    private $loaiquyen;
    private $phanquyen;
    private $vaitro;
    private $thongbao;
    private $chamcong;

    public function __construct(){
        $this->model = new TaiKhoanNhanVien();
        $this->db = new Database();
        $this->tennhanvien = new NhanVien;
        $this->quyen = new Quyen;
        $this->loaiquyen = new LoaiQuyen;
        $this->phanquyen = new PhanQuyen();  
        $this->vaitro = new VaiTroTaiKhoan();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {   
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // $danhsachvaitro = $this->vaitro->DanhSachVaiTro(100,0);

        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongTaiKhoan();
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $result = $this->model->DanhSach($item1,$offset);
        if(isset($_GET['keyword'])) {
            $loc_tk = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_tk)) {
                $tongtk = count($loc_tk);
                $totalPage = ceil($tongtk / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
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
        include 'Views/TaiKhoanNhanVien/DanhSach.php';
        return $result;
    }

    
    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        $result = $this->tennhanvien->DanhSach(100,0);
        $danhsach = $this->model->DanhSach2();
        // print_r($danhsach[0]['TenDangNhap']);
        $check = 0;
        $danhsachvaitro = $this->vaitro->DanhSachVaiTro();
        if (isset($_POST['submit'])) {
        $chain_vt = "";
        if (is_array($_POST['vaitro'])) {
            if (count($_POST['vaitro']) == 1) {
                $chain_vt = $_POST['vaitro'][0];
            } else {
                foreach ($_POST['vaitro'] as $item) {
                    $chain_vt .= $item . ", ";
                }
            }
        }
        $chain_vt = rtrim($chain_vt, ", ");
        // Check if tendangnhap already exists in the database
            // $existingUser = $this->model->TimKiemTheoTenDangNhap($tendangnhap);
            $tendangnhap = $_POST['tendangnhap'];
            for ($i = 0; $i < count($danhsach); $i++) {
                if ($danhsach[$i]['TenDangNhap'] === $tendangnhap) {
                    $check = 1;
                    break;
                }
            }

        $taikhoan_nv_active = $this->model->DanhSachActive($_POST['idnhanvien']);
        if (is_array($taikhoan_nv_active)) {
            $count = count($taikhoan_nv_active);
        } else {
            $count = 0;
        }

            if(empty($_POST['tendangnhap']) || empty($_POST['matkhau'])){
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống tên đăng nhập hoặc mật khẩu!</span>";
            }  elseif (($chain_vt == "")) {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Bạn chưa set quyền cho tài khoản này!</span>";
            } 
            elseif ($count > 0) {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Nhân viên này đã có tài khoản.</span>";
            }
            elseif ($check === 1) {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Tên đăng nhập này đã được đặt.</span>";
            } 
            else{
                $file_name = $_FILES['anhdaidien']['name'];
                $file_tmp = $_FILES['anhdaidien']['tmp_name'];
                move_uploaded_file($file_tmp,"Assets/AvatarNhanVien/".$file_name);
                
                $create = $this->model->ThemMoi($_POST['tendangnhap'],$_POST['idnhanvien'], password_hash($_POST['matkhau'], PASSWORD_BCRYPT)
                ,$_POST['trangthai'],$file_name,$chain_vt);
                if ($create) {
                    header('Location: ./DanhSach');
                }
                // print_r($_POST['vaitro']);
                
            }
            
        }
        include 'Views/TaiKhoanNhanVien/ThemMoi.php';
        return $result;
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $danhsachvaitro = $this->vaitro->DanhSachVaiTro(100,0);

        $alert="";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'taikhoannhanvien';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->find1($id);
            $result = $this->tennhanvien->find($id);
            if (isset($_POST['submit'])) {
                $chain_vt = "";
                if (is_array($_POST['vaitro'])) {
                    if (count($_POST['vaitro']) == 1) {
                        $chain_vt = $_POST['vaitro'][0];
                    } else {
                        foreach ($_POST['vaitro'] as $item) {
                            $chain_vt .= $item . ", ";
                        }
                    }
                }
                $chain_vt = rtrim($chain_vt, ", ") ;
                if(empty($_POST['tendangnhap']) || empty($_POST['matkhau'])){
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống mật khẩu!</span>";
                }else{
                    $file_name = $_FILES['anhdaidien']['name'];
                $file_tmp = $_FILES['anhdaidien']['tmp_name'];
                move_uploaded_file($file_tmp,"Assets/AvatarNhanVien/".$file_name);
                $update = $this->model->CapNhat(
                $id, $_POST['tendangnhap'],
                $_POST['matkhau'],
                $chain_vt,
                $_POST['trangthai'],
                $file_name);
                if ($update) {
                    header('Location: ./DanhSach');
                }
                }
            }
            
        }
        include 'Views/TaiKhoanNhanVien/CapNhat.php';
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

    public function PhanQuyen() {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $result = $this->loaiquyen->DanhSach($this->loaiquyen->TongLoaiQuyen(),0);
        $result1 = $this->quyen->DanhSachQuyen();
        include("Views/TaiKhoanNhanVien/PhanQuyen.php");
        return array($result,$result1);
    }

    public function LuuQuyen() {
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_POST['Luuquyen'])) {
            $data = $_POST;
            $insertString = "";
            
            // Xóa quyển trước khi phân quyền cho tài khoản 
            $this->phanquyen->Xoa($data['user_id']);
            foreach($data['privilege'] as $privilege) {
                $insertString .= !empty($insertString) ? "," : "";
                $insertString .= "(NULL, ".$data['user_id'].", ".$privilege.")";
            }

            // Thêm quyền cho tài khoản 
            $insert = $this->phanquyen->Them($insertString);

            if(!$insert) {
                $_SESSION['error'] = "Cấp quyền cho tài khoản nhân viên không thành công.";
                unset($_SESSION['success']);
            } else {
                $_SESSION['success'] = "Cấp quyền cho tài khoản nhân viên thành công.";
                unset($_SESSION['error']);
            }
         
        }
        include("Views/TaiKhoanNhanVien/TrangThongBao.php");
    }  
}