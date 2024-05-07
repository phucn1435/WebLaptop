<?php
public function TaoTaiKhoan()
    {
        $mess = null;
        $submit = $_POST['submit'];
        if (isset($_POST['submit'])) {
            $tenkhachhang = $_POST['tenkhachhang'];
            $tendangnhap = $_POST['tendangnhap'];
            $matkhau = $_POST['matkhau'];
            $matkhau2 = $_POST['matkhau2'];
            if (empty($tenkhachhang) || empty($tendangnhap) || empty($matkhau) || empty($matkhau2)) {
                $mess = "Dữ liệu nhập vào không được rỗng. Vui lòng kiểm tra lại.";
            } elseif ($matkhau2 != $matkhau) {
                $mess = "Mật khẩu nhập lại không trùng khớp";
                // header('Location: ./TaoTaiKhoan');
            } elseif (strlen(trim($tendangnhap)) < 3 || strlen(trim($tendangnhap)) > 30) {
                $mess = "Độ dài tên đăng nhập không hợp lệ (phải từ 3 - 30 kí tự)";
            } elseif (strlen(trim($matkhau)) < 3 || strlen(trim($matkhau)) > 30) {
                $mess = "Độ dài mật khẩu không hợp lệ (phải từ 3 - 30 kí tự)";
            } else { 
                $danhsach = $this->taikhoan->DanhSachKH();
                $flag = 0;
                foreach ($danhsach as $item) {
                    if ($item['TenDangNhap'] === $tendangnhap) {
                        $flag = 1;
                        break;
                    } 
                }
                if ($flag == 1) {
                    $mess = "Tên đăng nhập này đã tồn tại trong hệ thống";
                } else {
                    $create = $this->taikhoan->TaoTaiKhoan($tenkhachhang, $tendangnhap, $matkhau);
                    $_SESSION['success'] = 'Đăng kí tài khoản thành công. Hãy đăng nhập để mua hàng.';
                    header('Location: ./DangNhap');
                }
            }
        }
        require_once('Views/Home/TaoTaiKhoan.php');
    }