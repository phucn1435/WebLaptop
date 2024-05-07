<?php

require_once 'Assets/__init__/__include__.php';
class ProfileController{
    private $model;
    private $db;
    private $tennhanvien;
    private $forgot;
    private $chamcong;
    private $thongbao;
    
    public function __construct(){
        $this->model = new TaiKhoanNhanVien();
        $this->db = new Database();
        $this->tennhanvien = new NhanVien;
        $this->forgot = new changePassword; 
        $this->chamcong = new ChamCong();
        $this->thongbao = new ThongBao();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $result = $this->model->DanhSach1();
        include 'Views/Profile/MyProfile.php';
        return $result;
    }

    public function MyProfile() {
        $this->DanhSach();
    }

    public function DoiMatKhau() {
        $alert = "";
        $current_pass = $this->model->GetPassword($_SESSION['dangnhap']);
        $get_current_pass = $current_pass[0]['MatKhau'];
        $old_password = null;
        $confirm_password = null;
        $new_password = null;

        if(isset($_POST['submit'])) {
            $old_password = $_POST['old-password'];
            $confirm_password = $_POST['confirm-password'];
            $new_password = $_POST['new-password'];

            if (empty($old_password) || empty($confirm_password) || empty($new_password)) {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống.</span>";
            } else {
                if (!password_verify($old_password, $get_current_pass)) {
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Mật khẩu hiện tại không đúng.</span>";
                } elseif ($confirm_password != $new_password) {
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Xác nhận mật khẩu thất bại.</span>";
                } elseif (strlen($new_password) < 8) {
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được đặt mật khẩu nhỏ hơn 8 kí tự.</span>";
                } elseif (password_verify($new_password, $get_current_pass)) {
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được đặt lại mật khẩu cũ.</span>";
                } else {
                    $this->forgot->CapNhatMatKhau1($_SESSION['dangnhap'],password_hash($new_password, PASSWORD_BCRYPT));
                    $alert = "<span style='color: green; padding-bottom: 10px;'>Đổi mật khẩu thành công.</span>";
                }
            }
            
            // if($_POST['old-password'] == $_SESSION['pass'] && $_POST['confirm-password'] == $_POST['new-password'] ) {
            //    $this->forgot->CapNhatMatKhau1($_SESSION['dangnhap'],password_hash($_POST['new-password'], PASSWORD_BCRYPT));
            //    $alert = "<span style='color: green; padding-bottom: 10px;'>Đổi mật khẩu thành công.</span>";
            // } elseif(empty($_POST['old-password']) || empty($_POST['confirm-password']) || empty($_POST['new-password']))  {
            //     $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống.</span>";
            // } elseif($_POST['confirm-password'] != $_POST['new-password']) {
            //    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Xác nhận mật khẩu thất bại.</span>";
            // } elseif (strlen($_POST['new-password']) < 8) {
            //     $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được nhỏ hơn 8 kí tự.</span>";
            // }else {
            //     $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Sai mật khẩu hiện tại.</span>";
            // } 
        }
        include("Views/Profile/DoiMatKhau.php");

        // if (isset($_POST['submitChangePw'])) {
        //     $password = $_POST['newPassword'];
        //     $rePassword = $_POST['reNewPassword'];
        //     if (empty($password) || empty($rePassword)) {
        //         $output = "Không được để trống.";
        //     } elseif ($password === $rePassword) {
        //         if (strlen(trim($password)) < 8) {
        //             unset($_SESSION['success']);
        //             $output = "Mật khẩu phải từ 8 kí tự trở lên.";
        //         } elseif (password_verify($password, $matkhau[0]['MatKhau'])) {
        //             $output = "Đặt lại mật khẩu phải khác với mật khẩu gần nhất";
        //         } else {
        //             $this->taikhoan->updateMatKhau($getID[0]['ID'], password_hash($password, PASSWORD_BCRYPT));
        //             $output = "Đổi mật khẩu thành công.";
        //             $color = "#3be135";
        //         }
        //     } else {
        //         $output = "Đổi mật khẩu không thành công.";
        //     }
        // }
    }
    
}