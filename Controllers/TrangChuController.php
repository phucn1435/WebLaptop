<?php
include_once("Models/SanPham.php");
include_once("Models/LoaiSanPham.php"); //
include_once("Models/TaiKhoanKhachHang.php"); //
include_once("Models/loginKhachHang.php"); //
include_once("Models/KhachHang.php"); //
include_once("Models/ThanhToan.php");
include_once("Models/ChiTietDonHangBan.php");
include_once("Models/DonHangBan.php");
include_once("Models/Tintuc.php");
include_once("Models/GioHang.php");
include_once("Models/ThongBao.php");
include_once("Models/ThongTinThanhToan.php");
include_once("Models/Slide.php");
include_once("General.php");
include_once("Models/CongThanhToan.php");
include_once("Models/NhuCauNguoiDung.php");
include_once("Models/MauSac.php");
include_once("Models/ShowRoom.php");
include_once("Models/MaGiamGia.php");
include_once("Models/PhiShip.php");
include_once("Models/TrangThai.php");
include_once("Models/WhistList.php");


// include_once("Assets/mail/PHPMailer/PHPMailer-master/sendmail.php");

class TrangChuController
{
    private $mail;
    private $model;
    private $loaisanpham;
    private $db;
    private $taikhoan;
    private $login;
    private $khachhang;
    private $thanhtoan;
    private $ctdh;
    private $donhangban;
    private $tintuc;
    private $giohang;
    private $thongbao;
    private $tttt;
    private $slide;
    private $general;
    private $ctt;
    private $nhucau;
    private $mausac;
    private $showroom;
    private $magiam;
    private $kd;
    private $phiship;
    private $trangthai_sp;
    private $whistlist;

    public function __construct()
    {
        $this->login = new loginKhachHang();
        $this->khachhang = new KhachHang();
        $this->model = new SanPham();
        $this->loaisanpham = new LoaiSanPham();
        $this->db = new Database();
        $this->taikhoan = new TaiKhoanKhachHang();
        $this->thanhtoan = new ThanhToan();
        $this->ctdh = new ChiTietDonHangBan();
        $this->donhangban = new DonHangBan();
        $this->giohang = new GioHang();
        $this->thongbao = new ThongBao();
        $this->tttt = new ThongTinThanhToan();
        $this->tintuc = new TinTuc();
        $this->slide = new Slide();
        $this->general = new General();
        // print_r($this->general->General());
        $this->ctt = new CongThanhToan();
        $this->nhucau = new NhuCauNguoiDung();
        $this->mausac = new MauSac();
        $this->showroom = new ShowRoom();
        $this->magiam = new MaGiamGia();
        $this->phiship = new PhiShip();
        $this->trangthai_sp = new TrangThai();
        $this->whistlist = new WhistList();
    }

    public function DanhMuc()
    {
        $danhmuc  = $this->loaisanpham->DanhSach(100, 0);
        return $danhmuc;
    }

    public function test() {
        return 1;
    }
    public function general() {
        if(isset($_POST['submitSearch'])) {
            $input_search = $_POST['search-product'];
            header("Location: ../TrangChu/AllSanPham?query=listing&search=" .$input_search);
        }
        $thongbao1 = null;
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        } else {
            $test = $this->giohang->DanhSach();
        }

        return $thongbao1;  
    }

    public function Index()
    {
        // print_r($this->test());
        $this->general();
        $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item;
        $slide = $this->slide->DanhSach();
        $tongsp = $this->model->TongSanPham();
        $totalPage = ceil($tongsp / $item);
        //gọi method DanhSach bên Models
        $result2  = $this->model->DanhSach($item,$offset);
        $result5  = $this->model->DanhSach(100,0);
        $list_tt = $this->trangthai_sp->DanhSachTTActive();
        if (isset($_COOKIE['myCookie'])) {
            $cookieValue = $_COOKIE['myCookie'];

            // Tách chuỗi cookie thành mảng các phần tử
            $arrayFromCookie = explode(',', $cookieValue);

            $arrayFromCookie = array_filter($arrayFromCookie, function($element) {
                return $element != 0;
            });
        }
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $list_whistlist = $this->whistlist->Get_ID_Product($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        $slideTrangChu = $this->slide->DanhSachSlideTC();

        // $sanphamnoibat = $this->model->SanPhamNoiBat();
        

        // Lấy thông tin tin tức
        $tinTucModel = new TinTuc();
        $tintucs = $tinTucModel->DanhSach(3, 0);

        include("Views/Home/index.php");
        // return array($result, $loaisanpham, $tintucs,$result2,$result3);
    }

    public function QuenMatKhau() {
        $title = "Đừng chia sẻ mã xác nhận này cho bất kì ai. Mã xác nhận của bạn là: ";
        $content = (rand(100000,999999));
        $_SESSION['Token'] = $content;
        $mail = new Mailer();
        $listCustomer = $this->khachhang->getData(100,0);
        $output = null;
        $email = null;
        if (isset($_POST['submitForgot'])) {
            $inputEmail = $_POST['email1'];
            if (empty($inputEmail)) {
                $output = "Email not empty";
            } else {
                $flag = 0;
                foreach($listCustomer as $data) {
                    if ($inputEmail == $data['Email']) {
                        $flag = 1;
                        $_SESSION['email_changePass'] = $data['Email'];
                        $email = $data['Email'];
                        break;
                    }
                }

                if ($flag == 1) {
                    $mail->mailToken($title, $content, $email);
                    header("Location: ./confirmToken");
                } else {
                    $output = "Email not found in the system";
                }
            }
        }
        
        include("Views/Home/QuenMatKhau.php");
    }

    public function confirmToken() {
        $output = "";
        if (isset($_POST['submitToken'])) {
            if (empty($_POST['confirmToken'])) {
                $output = "Hãy nhập mã xác nhận";
            } elseif ((int)$_SESSION['Token'] === (int)$_POST['confirmToken']) {
                header("Location: ./DoiMatKhau1");
            } else {
                $output = "Sai mã xác nhận.";
            }
        }
        include("Views/Home/confirmToken.php");
    }

    public function DoiMatKhau1() {
        $output = null;
        $getID = $this->khachhang->getID($_SESSION['email_changePass']);
        $matkhau = $this->taikhoan->MatKhau($getID[0]['ID']);
        $color = "red";
        if (isset($_POST['submitChangePw'])) {
            $password = $_POST['newPassword'];
            $rePassword = $_POST['reNewPassword'];
            if (empty($password) || empty($rePassword)) {
                $output = "Không được để trống.";
            } elseif ($password === $rePassword) {
                if (strlen(trim($password)) < 8) {
                    unset($_SESSION['success']);
                    $output = "Mật khẩu phải từ 8 kí tự trở lên.";
                } elseif (password_verify($password, $matkhau[0]['MatKhau'])) {
                    $output = "Đặt lại mật khẩu phải khác với mật khẩu gần nhất";
                } else {
                    $this->taikhoan->updateMatKhau($getID[0]['ID'], password_hash($password, PASSWORD_BCRYPT));
                    $output = "Đổi mật khẩu thành công.";
                    $color = "#3be135";
                }
            } else {
                $output = "Đổi mật khẩu không thành công.";
            }
        }

        if (isset($_POST['submitReturn'])) {
            header("Location: ./DangNhap");
        }
        include("Views/Home/DoiMatKhau.php");
    }

    public function p(){
        $this->general();

        $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item;

        $tongsp = $this->model->TongSanPham();
        $banner = null;
        $totalPage = ceil($tongsp / $item);
        //gọi method DanhSach bên Models
        if(isset($_GET['loaisp'])) {
            $id = $_GET['loaisp'];
            $result2 = $this->model->ChiTiet11($id);
            $banner = $this->slide->DanhSachBanner($id);
        }
        $result5  = $this->model->DanhSach(100,0);
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }

        

        if (isset($_COOKIE['myCookie'])) {
            $cookieValue = $_COOKIE['myCookie'];

            // Tách chuỗi cookie thành mảng các phần tử
            $arrayFromCookie = explode(',', $cookieValue);
           
        }
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
    
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }

        //$sanphamnoibat = $this->model->SanPhamNoiBat();
        

        // Lấy thông tin tin tức
        $tinTucModel = new TinTuc();
        $tintucs = $tinTucModel->DanhSach(3, 0);

        // include("Views/Home/index.php");
        // return array($result, $loaisanpham, $tintucs,$result2,$result3);
        include("Views/Home/p.php");
    }
    
    public function ChiTietSanPhamTheoTrangThai()
    {
        if (isset($_GET['id']) && isset($_GET['index'])) {
            $id = $_GET['id'];
            $index = $_GET['index'];
            $det = $this->model->ChiTietSPNB($id, $index);
        }
        require_once('Views/Home/ChiTietSanPhamTheoTrangThai.php');
        return $det;
    }


    public function ChiTietSanPham()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  
            $detail = $this->model->ChiTiet($id);
        }
        require_once('Views/Home/ChiTietSanPham.php');
        return $detail;
    }

    public function AllSanPhamNoiBat()
    {
        $result = $this->model->DanhSachSanPhamNoiBat();
        require_once('Views/Home/AllSanPhamNoiBat.php');
        return $result;
    }
    public function AllSanPham()
    {
        $test = "";
        $array = [];
        $array1 = 0;
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_GET['action1'])) {
            $test = $_GET['action1'];
            $array = explode("%", $test);
            // for($i = 0; $i < count($array); $i++) {

            // }
            $array1 = end($array);
           
            for($i=0;$i<count($array);$i++) {
                if($array1 == $array[$i]) {
                    array_pop($array);  
                }
            }
        }
        $mess1 = [];
        if (isset($_GET['array_brands'])) {
            $mess1['array_brands'] = 'Hãng sản xuất: ' .$_GET['array_brands'];
        }

        if (isset($_GET['mausac'])) {
            $mess1['mausac'] = 'Mau: ' .$_GET['mausac'];
        }
        // print_r($_SERVER['REQUEST_URI']);    
        $giaca = 1;
        if(isset($_POST['lplp'])) {
            $giaca = $_POST['lplp'];
        }

        if (isset($_POST['xoa_nay'])) {
            unset($mess1['mausac']);
        }
        $gia = null;
        // Mảng các hãng bạn quan tâm

        // Chuyển mảng thành chuỗi được phân tách bởi dấu ',' để sử dụng trong câu lệnh SQL
       
        $giacaonhat = $this->model->GiaCaoNhat();
        $giathapnhat = $this->model->GiaThapNhat();
        $message = null;
        $init = [];
        if(isset($_GET['sort']) && $_GET['sort'] == "SORT_BY_PRICE" && isset($_GET['order']) && $_GET['order'] == "ASC") {
            $result2 = $this->model->DanhSachTang(100,0);
        } elseif (isset($_GET['sort']) && $_GET['sort'] == "SORT_BY_PRICE" && isset($_GET['order']) && $_GET['order'] == "DESC") {
            $result2 = $this->model->DanhSachGiam(100,0);
        } elseif (isset($_GET['idloaisp'])) {
            $id10 = $_GET['idloaisp'];
            $result2 = $this->model->ChiTiet11($id10);
        } elseif (isset($_GET['query']) && $_GET['query'] == "listing" && isset($_GET['search'])) {
            $result2 = $this->model->TimKiem($_GET['search']);
        } elseif(isset($_GET['price'])) {
            $gia = $_GET['price'];
            $arrPrice = explode("-", $gia);
            $message = "Giá từ " .$arrPrice[0]."đ"." - " .$arrPrice[1]."đ";
            
            $result2 = $this->model->DanhSachSanPhamTheoGia($arrPrice[0], $arrPrice[1]);
        } elseif(isset($_GET['array_brands']) ||  isset($_GET['nhucau']) || isset($_GET['mausac']) || isset($_GET['price_gte']) || isset($_GET['price_lte']) ) {
                $array4 = null;
                $array2 = null;
                $array6 = null;

                $min = null;
                $max = null;
                if (isset($_GET['array_brands'])) {
                    $array1 = explode(",",$_GET['array_brands']);
                    $array2 = implode("','", $array1);
                }
               
                if (isset($_GET['nhucau'])) {
                    $array3 = explode(",",$_GET['nhucau']);
                    $array4 = implode("','", $array3);    
                }

                if (isset($_GET['mausac'])) {
                    $array5 = explode(",",$_GET['mausac']);
                    $array6 = implode("','", $array5);    
                }

                if (isset($_GET['price_gte'])) {
                    $min = $_GET['price_gte'];
                }

                if (isset($_GET['price_lte'])) {
                    $max = $_GET['price_lte'];
                }
                // print_r($_GET['price_lte']);
                // print_r($_GET['price_gte']);

                // $array3 = explode(",",$_GET['nhucau']);
                // $array4 = implode(",", $array3);
                // $unwantedChars = "' ";
                $cleanString = str_replace("'", '', $array2);
                $message = "Hãng sản xuất: " .$cleanString;
                
                $result2 = $this->model->DanhSachTheoHang($array2, $array4, $min, $max, $array6);
        } else {
            $result2 = $this->model->DanhSach(100,0);
        }

        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $nhucaunguoidung = $this->nhucau->DanhSach(100,0);
        $mausac = $this->mausac->DanhSach(100,0);


        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        }
        $this->general();
        $result = $this->model->TatCaSanPham();
        require_once('Views/Home/AllSanPham.php');
        return $result;
    }

    public function DanhSachSanPham()
    {
        if (isset($_GET['loaisp'])) {
            $tensanpham = $_GET['loaisp'];
            //gọi method TimKiem bên Models
            $result = $this->model->TenSanPhamTheoLoai($tensanpham);
        }
        //gọi và show dữ liệu ra view
        require_once('Views/Home/SanPhamTheoLoai.php');
        // return $result;
        return $result;
    }
    public function DanhSachSanPhamm() {
        if (isset($_GET['loaisp'])) {
          $idloaisanpham = $_GET['loaisp'];
          $result = $this->model->LaySanPham($idloaisanpham);
        } else {
          $result = array(); // Mặc định là một mảng rỗng nếu không có tham số loaisp
        }
        require_once('Views/Home/SanPhamTheoThuongHieu.php');
        return $result;
    }
    public function DangNhap(){
        // print_r($this->login->TaiKhoanActive('admin2','123123123'));
        if(isset($_POST['submitValue'])) {
            $test = $this->giohang->LayID0();
            $khachhangUsername = $_POST['username'];
            $khachhangPassword = $_POST['password'];
            $mahoaUser = base64_encode($khachhangUsername);
            $mahoaPass = base64_encode($khachhangPassword);
            $login_check = $this->login->loginAdmin($khachhangUsername, $khachhangPassword, 'phucn1435');
            if (isset($_POST['remember']) && $_POST['remember']) {
                setcookie("userKH", $mahoaUser, time() + (86400 * 7), '/', '', false, true);
                setcookie("passKH", $mahoaPass, time() + (86400 * 7), '/', '', false, true);
            }   
            if (isset($_SESSION['id_user'])) {
                $this->giohang->CapNhatUser($_SESSION['id_user']);
            }    
        }

        if (isset($_POST['submitForgot'])) {
            $adminEmail = $_POST['email1'];
            $_SESSION['email'] = $adminEmail;
            $login_check1 = $this->login->forgotAdmin($adminEmail);
        }
        require_once('Views/Home/DangNhap.php');
    }
    public function DangXuat()
    {
        $_SESSION['user'] = null;
        $_SESSION['id_user'] = null;
        setcookie("userKH", null, time() - 1, '/', '', false, true);
        setcookie("passKH", null, time() - 1, '/', '', false, true);
        // include('Views/Home/Index.php');
        header("Location: ./Index");
    }
    public function TaoTaiKhoan()
    {
        $mess = null;
        // $submit = $_POST['submit'];
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
                    $create = $this->taikhoan->TaoTaiKhoan($tenkhachhang, $tendangnhap, password_hash($matkhau, PASSWORD_BCRYPT));
                    $_SESSION['success'] = 'Đăng kí tài khoản thành công. Hãy đăng nhập để mua hàng.'; 
                    header('Location: ./DangNhap');
                }
            }
        }
        require_once('Views/Home/TaoTaiKhoan.php');
    }
    public function ThongTinTaiKhoan()
    {
        $province = $this->donhangban->province(); // 1->2->F->35->36
             

        $test = $this->giohang->DanhSach(); 

        if(isset($_GET['xemthongbao'])) {
            $this->thongbao->update($_GET['xemthongbao']);
            header("Location: ThongTinTaiKhoan");
        }

        if (isset($_SESSION['user'])) { 
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $getData = $this->khachhang->GetData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);

            $alert = "";
            $user = $_SESSION['user'];
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($user); 
            
            if (isset($_POST['submitCapNhat'])) { 
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_parts = explode('.',$_FILES['image']['name']);
                    $file_ext = strtolower(end($file_parts));
                  
                    $file_name = time(). "-avatar." .$file_ext;
                 
                    $expensions= array("jpeg","jpg","png");
                    $file_size = $_FILES['image']['size']; 
                if (preg_match('/^\s*$/', $_POST['nameCustomer']) !== 0) { 
                    $alert = "Không được chứa kí tự đặc biệt"; 
                } elseif(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email']) !== 1) { 
                    $alert = "Định dạng email không hợp lệ."; 
                } elseif(preg_match('/^\d{10}$/', $_POST['numberPhone']) !== 1) { 
                    $alert = "Số điện thoại phải đủ 10 số"; 
                } elseif(strtotime($_POST['birthday']) > strtotime(date("Y-m-d"))) { 
                    $alert = "Ngày tháng năm sinh không được lớn hơn hiện tại."; 
                } elseif(in_array($file_ext,$expensions) === false) {
                    $alert = "Chỉ hỗ trợ upload file JPEG hoặc PNG."; 
                } else if($file_size > 2097152) { 
                    $alert='Kích thước file không được lớn hơn 2MB'; 
                } else {
                    move_uploaded_file($file_tmp,"Assets/data/AvatarKhachHang/".$file_name);
                    $updateImage = $this->taikhoan->updateImage($_SESSION['id_user'], $file_name);
                    $update = $this->khachhang->CapNhat(
                        $_SESSION['id_user'],
                        $_POST['nameCustomer'],
                        $_POST['gender'],
                        $_POST['birthday'],
                        $_POST['numberPhone'],
                        $_POST['email'] 
                    ); 
                    if($update) {  
                        $alert = "Cập nhật thành công"; 
                    } 
                    header("Location: ./ThongTinTaiKhoan"); 
                }   
            } 

            // if(isset($_POST['saveAddress2'])) { // 25
            //     $hoten = $_POST['hoten3'];
            //     $sdt = $_POST['sdt3'];
            //     $email = $_POST['email3'];
            //     $tinh = $_POST['tinh3'];
            //     $quan = $_POST['quan3'];
            //     $xa = $_POST['xa3'];
            //     $cuthe = $_POST['cuthe3']; // 26
                
            //     $nameCity = $this->donhangban->nameCity($tinh);
            //     $nameDistrict = $this->donhangban->nameDistrict($quan);
            //     $nameWards = $this->donhangban->nameWards($xa); 
              
            //     if($this->khachhang->CheckAD($_SESSION['id_user']) > 0) { 
            //         $this->khachhang->UpdateDiaChi($_SESSION['id_user'], $hoten,$sdt,$email, $nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'],$cuthe); // 29
            //     } else { 
            //         $this->khachhang->ThemDiaChi($_SESSION['id_user'],$hoten,$sdt,$email,$tinh, $quan,  $nameWards[0]['name'],$cuthe,0); // 31
            //     } 
            //     header("Location: ./ThongTinTaiKhoan"); 
            // } 
        }
        include('Views/Home/ThongTinTaiKhoan.php'); 
    }
    public function GioHang()
    {
        include('Views/GioHang/giohang.php');
    }
    public function ThanhToan()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($user);
            if(isset($_POST['submit'])){
                $idkhachhang = $_POST['idkhachhang'];
                $ngaylap = $_POST['ngaylap'];

                $idSanPhamArray = $_POST['idsanpham'];
                $donGiaArray = $_POST['dongia'];
                $soLuongArray = $_POST['soluong'];

                $dataList = array();
                foreach ((array)$idSanPhamArray as $key => $idSanPham) {
                    $donGia = $donGiaArray[$key];
                    $soLuong = $soLuongArray[$key];
                    $dataList[] = array(
                        'idSanPham' => $idSanPham,
                        'donGia' => $donGia,
                        'soLuong' => $soLuong
                    );
                }
                $create = $this->ctdh->TaoDonHangSS($idkhachhang,$ngaylap,$dataList);
                if($create){
                    header('Location: ./Index');
                }
            }
        }
        elseif(isset($_POST['submit'])) {
            $tenkhachhang = $_POST['tenkhachhang'];
            $sodienthoai = $_POST['sodienthoai'];
            $email = $_POST['email'];
            $diachi = $_POST['diachi'];
            $ngaylap = $_POST['ngaylap'];
            //lấy dữ liệu từ LocalStogare
            if (isset($_POST['idsanpham'], $_POST['dongia'], $_POST['soluong'])) {
                $idSanPhamArray = $_POST['idsanpham'];
                $donGiaArray = $_POST['dongia'];
                $soLuongArray = $_POST['soluong'];

                // Gom các mảng lại thành một mảng danh sách
                $dataList = array();
                foreach ((array)$idSanPhamArray as $key => $idSanPham) {
                    $donGia = $donGiaArray[$key];
                    $soLuong = $soLuongArray[$key];
                    $dataList[] = array(
                        'idSanPham' => $idSanPham,
                        'donGia' => $donGia,
                        'soLuong' => $soLuong
                    );
                }
                $create = $this->ctdh->TaoDonHang($tenkhachhang,$sodienthoai,$email,$diachi,$ngaylap,$dataList);
                if($create){
                    header('Location: ./Index');
                }
            } else {
                echo "Không có dữ liệu từ form";
            }
        }

        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        include 'Views/Home/ThanhToan.php';
    }

    public function DoiMatKhau() {
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['id_user']);

        } else {
            $test = $this->giohang->DanhSach();
        }

        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }

        $alert = "";
        if(isset($_POST['submitChangePass'])) {
            $currentPass = $_POST['currentPass'];
            $createPass = $_POST['createPass'];
            $confirmPass = $_POST['confirmPass'];
            $pass = $this->taikhoan->MatKhau($_SESSION['id_user']);
            $pass1 = $pass[0]['MatKhau'];
            if($currentPass == $pass1 && $confirmPass == $createPass ) {
               $this->taikhoan->updateMatKhau($_SESSION['id_user'],$createPass);
               $alert = "<span style='color: green; padding-bottom: 10px;'>Đổi mật khẩu thành công.</span>";
            } elseif(empty($currentPass) || empty($confirmPass) || empty($createPass))  {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống.</span>";
            } elseif($confirmPass != $createPass) {
               $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Xác nhận mật khẩu thất bại.</span>";
            } elseif (strlen($createPass) < 8) {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Không được nhỏ hơn 8 kí tự.</span>";
            }else {
                $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>Sai mật khẩu hiện tại.</span>";
            } 
        }
        include 'Views/Home/DoiMatKhau.php';
    }
    public function LichSuMuaHang(){
        $this->general();

        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['id_user']);

        } else {
            $test = $this->giohang->DanhSach();
        }

        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        $trangthaiban = $this->trangthai_sp->TrangThaiBan();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }

        if(isset($_GET['id']) && isset($_GET['daxem'])) {
            $this->thongbao->update2($_GET['id']);
            header("Location: LichSuMuaHang");
        }

        
        if (isset($_SESSION['user'])) {
            // $idkhachhang = $_GET['id'];
            $idkhachhang = $_SESSION['id_user'];
            
            $list = $this->ctdh->DanhSachDonMua($idkhachhang);
            // Dang xu li
            $list1 = $this->ctdh->DanhSachDonMua1($idkhachhang);
            // Dang van chuyen
            $list2 = $this->ctdh->DanhSachDonMua2($idkhachhang);
            // Da thanh toan
            $list3 = $this->ctdh->DanhSachDonMua3($idkhachhang);
            // Da huy
            $list4 = $this->ctdh->DanhSachDonMua4($idkhachhang);
            // Da nhan
            $list5 = $this->ctdh->DanhSachDonMua5($idkhachhang);
            // Da hoan thanh
            $list6 = $this->ctdh->DanhSachDonMua6($idkhachhang);

            $list_dh = $this->ctdh->DanhSachDonMuaTest($idkhachhang);

            $result = $this->ctdh->DanhSachChiTietDonMua($idkhachhang);

            
        }



        if(isset($_GET['id1']) && isset($_GET['test']) && $_GET['test'] == "mualai") {
            $hi = $_GET['id1'];
            $result1 = $this->ctdh->DanhSachCT($hi);
            for($i = 0; $i < count($result1);$i++) {
                $this->ctdh->hihi($result1[$i]['idSanPham'],$result1[$i]['SoLuong']);
            }
            $this->donhangban->CapNhatTrangThaiBanDauDonHang($hi);
            header('Location: LichSuMuaHang');
        }

       
        if(isset($_GET['id']) && isset($_GET['test']) && $_GET['test'] == "huy") {
            $id = $_GET['id'];
            $result2 = $this->ctdh->DanhSachCT1($id);
            if(is_array($result2)) {
                for($i = 0; $i < count($result2);$i++) {
                    $this->ctdh->hihi1($result2[$i]['idSanPham'],$result2[$i]['SoLuong']);
                }
            }
            $this->donhangban->CapNhatTrangThaiHuyDonHang12($id);
            header("Location: LichSuMuaHang?id=5&tab=dahuy");
        }

        include 'Views/Home/LichSuMuaHang.php';
        return array($result,$list);
    }

    public function LichSuCongThanhToan() {
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        $test2 = null;
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        $lichsu = null;
         if (isset($_GET['id'])) {
            $lichsu = $this->ctt->DanhSachVNPay($_GET['id']);
         }
        include("Views/Home/LichSuCongThanhToan.php");
    }

    public function ChiTietSP() {
        // $this->general();
       
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        $price_this = 0;
        $test2 = null;
        // print_r($result2);
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $test4 = $this->model->ChiTiet($id);
            // print_r($test);
            $idloaisp = $this->model->LayIDLoaiSanPham($id);
           
            // $sanphamtheoloai = $this->model->LaySanPham($idloaisp[0]['idLoaiSanPham']);
            // print_r($sanphamtheoloai);
            $tenloaisanpham = $this->loaisanpham->TenLoaiSanPham($id);
            $test2 = $this->model->ChiTiet10($_GET['id']);
            
            $hehe = $this->giohang->LayDonGia($id);
            
            if ($hehe[0]['GiaKhuyenMai'] != 0) {
                $price_this = $hehe[0]['GiaKhuyenMai'];
            } else {
                $price_this = $hehe[0]['Gia'];
            }

            // Lấy giá trị từ cookie
            if (isset($_COOKIE['myCookie'])) {
                $cookieValue = $_COOKIE['myCookie'];

                // Tách chuỗi cookie thành mảng các phần tử
                $arrayFromCookie = explode(',', $cookieValue);

                // Kiểm tra xem phần tử mới đã tồn tại trong mảng cookie hay chưa
                $newItem = $id;
                if (in_array($newItem, $arrayFromCookie)) {
                    
                } else {
                    // Nếu phần tử mới không tồn tại, thêm nó vào mảng cookie
                    $arrayFromCookie[] = $newItem;

                    // Tạo lại chuỗi cookie từ mảng các phần tử đã thêm
                    $newCookieValue = implode(',', $arrayFromCookie);

                    // Cập nhật lại cookie với giá trị mới
                    setcookie('myCookie', $newCookieValue, time() + (365 * 24 * 60 * 60), '/'); // Thời gian sống 1 năm
                }
            } else {
                // Nếu cookie chưa tồn tại, tạo mới cookie và thêm phần tử đầu tiên
                $newItem = $id;
                $initialItems = [$newItem];

                // Tạo mới cookie
                $newCookieValue = implode(',', $initialItems);
                setcookie('myCookie', $newCookieValue, time() + (365 * 24 * 60 * 60), '/'); // Thời gian sống 1 năm
            }
        }
        $id = null;
        
        if(isset($_POST['submit'])) {
            $id = $_GET['id'];
            $id_loaisp = $this->model->LayIDLoaiSanPham($id);
            if(!isset($_SESSION['id_user'])) {
                $hehe1 = $this->giohang->LaySoLuong($id);
                $hihi = $this->giohang->DanhSach(); // Danh sách khi chưa đăng nhập
                if(!is_array($hihi)) {  
                    $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    $alert = "Đã thêm sản phẩm vào giỏ hàng";
                }
                $index = false;
                if(is_array($hihi)){
                    for ($i = 0; $i < count($hihi); $i++) {
                        if ($id == $hihi[$i]['ID_sanpham']) {
                            $index = true;
                            break;
                        }

                        if($id !== $hihi[$i]['ID_sanpham']) {
                            $index = 0;
                            break;
                        }
                    }
                    if ($index) {
                        $create = $this->giohang->CapNhatSoLuong($id,$hehe1[0]['SoLuong1']+1,$price_this);

                    } elseif($index === 0) {
                        $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                       $alert = "Đã thêm sản phẩm vào giỏ hàng";
                    }
                }
            }

            if(isset($_SESSION['id_user'])) {
                $hehe2 = $this->giohang->LaySoLuong1($id,$_SESSION['id_user']);
                $hihi1 = $this->giohang->DanhSach2($_SESSION['id_user']); 
                $soluongsanpham = $this->giohang->LaySoLuongSanPham($id);
                if(!is_array($hihi1)) {  
                    $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    
                    $alert = "Đã thêm sản phẩm vào giỏ hàng";
                }
                $index = 0;
                if(is_array($hihi1)){
                    for ($i = 0; $i < count($hihi1); $i++) {
                        if ($id == $hihi1[$i]['ID_sanpham'])  {
                            $index = 1;
                            break;
                        } 
                    }
                    if ($index === 1) {
                        if($soluongsanpham[0]['SoLuong'] > $hehe2[0]['SoLuong1']) {
                            $alert = "Đã thêm sản phẩm vào giỏ hàng";
                            $create = $this->giohang->CapNhatSoLuong2($_SESSION['id_user'],$id,$hehe2[0]['SoLuong1']+1,$price_this);

                        } else {
                            $alert = "Sản phẩm này đã hết hàng";
                        }
                    } else {
                        $alert = "Đã thêm sản phẩm vào giỏ hàng";
                        $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    }
                }
            }

        }

        // if(isset($_POST['submitBuyNow'])) {
        //     $id_loaisp = $this->model->LayIDLoaiSanPham($id);

        //     if(!isset($_SESSION['id_user'])) {
        //         $hehe1 = $this->giohang->LaySoLuong($id);
        //         $hihi = $this->giohang->DanhSach(); // Danh sách khi chưa đăng nhập
        //         if(!is_array($hihi)) {  
        //             $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,  $hehe[0]['Gia'],$hehe[0]['Gia'] * 1);
        //             $alert = "Đã thêm sản phẩm vào giỏ hàng";
        //         }
        //         $index = false;
        //         if(is_array($hihi)){
        //             for ($i = 0; $i < count($hihi); $i++) {
        //                 if ($id == $hihi[$i]['ID_sanpham']) {
        //                     $index = true;
        //                     break;
        //                 }

        //                 if($id !== $hihi[$i]['ID_sanpham']) {
        //                     $index = 0;
        //                     break;
        //                 }
        //             }
        //             if ($index) {
        //                 $create = $this->giohang->CapNhatSoLuong($id,$hehe1[0]['SoLuong1']+1,$hehe[0]['Gia']);
        //             } elseif($index === 0) {
        //                $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,$hehe[0]['Gia'],$hehe[0]['Gia'] * 1);
        //                $alert = "Đã thêm sản phẩm vào giỏ hàng";
        //             }
        //         }
        //         header("Location: ./GioHang1");
        //     }

        //     if(isset($_SESSION['id_user'])) {
        //         $hehe2 = $this->giohang->LaySoLuong1($id,$_SESSION['id_user']);
        //         $hihi1 = $this->giohang->DanhSach2($_SESSION['id_user']); 
        //         $soluongsanpham = $this->giohang->LaySoLuongSanPham($id);
        //         if(!is_array($hihi1)) {  
        //             $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$hehe2[0]['Gia'],$hehe[0]['Gia'] * 1);
        //             $alert = "Đã thêm sản phẩm vào giỏ hàng";
        //         }
        //         $index = 0;
        //         if(is_array($hihi1)){
        //             for ($i = 0; $i < count($hihi1); $i++) {
        //                 if ($id == $hihi1[$i]['ID_sanpham'])  {
        //                     $index = 1;
        //                     break;
        //                 } 
        //             }
        //             if ($index === 1) {
        //                 if($soluongsanpham[0]['SoLuong'] > $hehe2[0]['SoLuong1']) {
        //                     $alert = "Đã thêm sản phẩm vào giỏ hàng";
        //                     $create = $this->giohang->CapNhatSoLuong2($_SESSION['id_user'],$id,$hehe2[0]['SoLuong1']+1,$hehe[0]['Gia']);
        //                 } else {
        //                     $alert = "Sản phẩm này đã hết hàng";
        //                 }
        //             } else {
        //                     $alert = "Đã thêm sản phẩm vào giỏ hàng";   
        //                $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$hehe[0]['Gia'],$hehe[0]['Gia'] * 1);
        //             }
        //         }
        //         header("Location: ./GioHang1");
        //     }

        // }
        include("Views/Home/ChiTietSP.php");
    }

    public function lol() {
        $price_this = 0;
        if (isset($_SESSION['id_user'])) {
            $listCart = $this->giohang->DanhSach3($_SESSION['id_user']);
            $array = [];
            foreach($_POST['data'] as $item) {
                $id = $item['productId'];
                $hehe = $this->giohang->LayDonGia($id);
                
                $id_loaisp = $this->model->LayIDLoaiSanPham($id);
                if ($hehe[0]['GiaKhuyenMai'] != 0) {
                    $price_this = $hehe[0]['GiaKhuyenMai'];
                } else {
                    $price_this = $hehe[0]['Gia'];
                }
                $flag = 0; // false
                foreach($listCart as $itemCart) {
                    if ($id === $itemCart['ID_sanpham']) {
                        $flag = 1;
                        // $array[] = $id;
                        break;
                    } 
                }

                if ($flag == 1) {
                    // foreach($array as $item1) {
                        $hehe1 = $this->giohang->LaySoLuong($item);
                        $this->giohang->CapNhatSoLuong10($_SESSION['id_user'],$id,(int)$hehe1[0]['SoLuong1'] + (int)$item['quantity']);
                    // }
                } else {
                    $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],$item['quantity'],$price_this,$price_this * $item['quantity']);
                }
            }
        }
        if (!isset($_SESSION['id_user'])) {
            $listCart = $this->giohang->DanhSach($_SESSION['id_user']);
            $array = [];
            foreach($_POST['data'] as $item) {
                $id = $item['productId'];
                $hehe = $this->giohang->LayDonGia($id);
                
                $id_loaisp = $this->model->LayIDLoaiSanPham($id);
                if ($hehe[0]['GiaKhuyenMai'] != 0) {
                    $price_this = $hehe[0]['GiaKhuyenMai'];
                } else {
                    $price_this = $hehe[0]['Gia'];
                }
                $flag = 0; // false
                foreach($listCart as $itemCart) {
                    if ($id === $itemCart['ID_sanpham']) {
                        $flag = 1;
                        // $array[] = $id;
                        break;
                    } 
                }

                if ($flag == 1) {
                    // foreach($array as $item1) {
                        $hehe1 = $this->giohang->LaySoLuong($item1);
                        $this->giohang->CapNhatSoLuong7($_SESSION['id_user'],$id,(int)$hehe1[0]['SoLuong1'] + (int)$item['quantity']);
                    // }
                } else {
                    $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],$item['quantity'],$price_this,$price_this * $item['quantity']);
                }
            }
        }
    }

    public function buyCompo() {
        $price_this = 0;
        foreach($_POST['data'] as $item) {
            $id = $item;
            $hehe = $this->giohang->LayDonGia($id);
                
            if ($hehe[0]['GiaKhuyenMai'] != 0) {
                $price_this = $hehe[0]['GiaKhuyenMai'];
            } else {
                $price_this = $hehe[0]['Gia'];
            }
            $id_loaisp = $this->model->LayIDLoaiSanPham($id);
            if(!isset($_SESSION['id_user'])) {
                // $hehe1 = $this->giohang->LaySoLuong($id);
                $hihi = $this->giohang->DanhSach(); // Danh sách khi chưa đăng nhập
                if(!is_array($hihi)) {  
                    $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    $alert = "Đã thêm sản phẩm vào giỏ hàng";
                    print_r(1);
                }
                $index = false;
                if(is_array($hihi)){
                    for ($i = 0; $i < count($hihi); $i++) {
                        if ($id == $hihi[$i]['ID_sanpham']) {
                            $index = true;
                            break;
                        }
                        if($id !== $hihi[$i]['ID_sanpham']) {
                            $index = 0;
                            break;
                        }
                    }
                    if ($index) {
                        $create = $this->giohang->CapNhatSoLuong($id,$hehe1[0]['SoLuong1']+1,$price_this);
                    } elseif($index === 0) {
                        $create = $this->giohang->Them(0,$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    $alert = "Đã thêm sản phẩm vào giỏ hàng";
                    }
                }
            } 
            if(isset($_SESSION['id_user'])) {
                $hehe2 = $this->giohang->LaySoLuong1($id,$_SESSION['id_user']);
                $hihi1 = $this->giohang->DanhSach2($_SESSION['id_user']); 
                $soluongsanpham = $this->giohang->LaySoLuongSanPham($id);
                if(!is_array($hihi1)) {  
                    $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    $alert = "Đã thêm sản phẩm vào giỏ hàng";
                }
                $index = 0;
                if(is_array($hihi1)){
                for ($i = 0; $i < count($hihi1); $i++) {
                    if ($id == $hihi1[$i]['ID_sanpham'])  {
                        $index = 1;
                            break;
                        } 
                    }
                    if ($index === 1) {
                        if($soluongsanpham[0]['SoLuong'] > $hehe2[0]['SoLuong1']) {
                            $alert = "Đã thêm sản phẩm vào giỏ hàng";
                            $create = $this->giohang->CapNhatSoLuong2($_SESSION['id_user'],$id,$hehe2[0]['SoLuong1']+1,$price_this);
                        } else {
                            $alert = "Sản phẩm này đã hết hàng";
                        }
                    } else {
                        $alert = "Đã thêm sản phẩm vào giỏ hàng";
                        $create = $this->giohang->Them($_SESSION['id_user'],$id,$id_loaisp[0]['idLoaiSanPham'],1,$price_this,$price_this * 1);
                    }
                }
            }
        }
    }

    public function Tong_compo() {
        $tong_km = 0;
        $tong = 0;
        if (isset($_POST['array'])) {
            foreach ($_POST['array'] as $key => $value) {
                $hehe = $this->giohang->LayDonGia($value['id']);
                $dongia_km = $hehe[0]['GiaKhuyenMai'];
                $dongia = $hehe[0]['Gia'];
                $tong += $value['value'] * $dongia;
                $tong_km += $value['value'] * $dongia_km;
            }
        }

       
        echo "
            <div class='gia'>".number_format($tong_km, 0, '.', '.')." <span style='text-decoration: underline;'>đ</span></div>
            <div class='gia_km'>".number_format($tong, 0, '.', '.')." <span style='text-decoration: underline;'>đ</span></div>
        ";

        
        // print_r($_POST['array'][0]['value']);
        // if (isset($_POST['id']) && isset($_POST['value'])) {
        //     $hehe = $this->giohang->LayDonGia($_POST['id']);
        //     $dongia = $hehe[0]['Gia'];
        //     $tong = $tong + ($_POST['value'] * $dongia);
        // }
        
        
    }

    public function InPage() {

        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        include("Views/Home/InPage.php");
    }
    public function a(){
        include("Views/Home/giohang.php");
    }

    public function WhistList() {
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['id_user']);
            $whistlist = $this->whistlist->Get_ID_Product($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }
        include("Views/Home/WhistList.php");
    }

    public function GioHang1() {
        // $this->general();
        
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        $test2 = $this->giohang->DanhSach1();
        $show = $this->magiam->DanhSach(100,0);
        $message = '';
        $array = null;
        $test_macode = null;
        $tongtamtinh = null;
        $error = null;
        $success = null;
      
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        
      
        if (isset($_POST['tieptuc'])) {
            // $this->giohang->CapNhatTT10($_SESSION['id_user'], $_POST['thanhtien']);
            header("Location: ./DatHang");
        }
        // $test = $this->giohang->DanhSach();
        // $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
            if(!isset($_SESSION['id_user'])) {
                if(isset($_GET['test']) && $_GET['test'] == "tru" && isset($_GET['id'])) {
                    $this->giohang->CapNhatRong($_SESSION['id_user']);

                    $id = $_GET['id'];
                    $hehe = $this->giohang->LayDonGia($id);
                    $hehe1 = $this->giohang->LaySoLuong($id);
                    // $id = $_GET['id'];
                    if ($hehe1[0]['SoLuong1'] > 1) {
                    $this->giohang->CapNhatSoLuong1($id);
                    // $this->giohang->CapNhatThanhTien($id,$hehe1[0]['SoLuong1'] - 1,$hehe[0]['Gia']);
                    $this->giohang->CapNhatThanhTien($id,$hehe1[0]['SoLuong1'] - 1 ,$hehe[0]['GiaKhuyenMai']);
                    }
                    header("Location: GioHang1");
                } 
            
                if(isset($_GET['test']) && $_GET['test'] == "cong" && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $hehe = $this->giohang->LayDonGia($id);
                    $hehe1 = $this->giohang->LaySoLuong($id);
                    $hehe2 = $this->giohang->LaySoLuongSanPham($id);
                    $hehe3 = $this->giohang->LaySoLuong($id);
                    if($hehe1[0]['SoLuong1'] < $hehe2[0]['SoLuong']) {
                    $this->giohang->CapNhatSoLuong($id,$hehe1[0]['SoLuong1']+1,$hehe[0]['GiaKhuyenMai']);
                    }
                    header("Location: GioHang1");
                }
            }

            if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
                foreach($_POST['checkboxID'] as $deleteID) {
                    $this->giohang->Xoa1($deleteID, $_SESSION['id_user']);
                }
                header("Location: GioHang1");
            }

            if(isset($_SESSION['id_user'])) {
                if(isset($_GET['test']) && $_GET['test'] == "tru" && isset($_GET['id'])) {

                    $gia = 0;
                    $this->giohang->CapNhatRong($_SESSION['id_user']);

                    $id = $_GET['id'];
                    $hehe = $this->giohang->LayDonGia($id);
                    if ($hehe[0]['GiaKhuyenMai'] != 0) {
                        $gia = $hehe[0]['GiaKhuyenMai'];
                    } else {
                        $gia = $hehe[0]['Gia'];
                    }
                    $this->giohang->CapNhatRong($_SESSION['id_user']);

                    $id = $_GET['id'];
                    $hehe = $this->giohang->LayDonGia($id);
                    $hehe1 = $this->giohang->LaySoLuong1($id,$_SESSION['id_user']);
                    // $id = $_GET['id'];
                    if ($hehe1[0]['SoLuong1'] > 1) {
                    // $this->giohang->CapNhatSoLuong1($id);
                    // $this->giohang->CapNhatThanhTien($id,$hehe1[0]['SoLuong1'] - 1,$hehe[0]['Gia']);
                    // $this->giohang->CapNhatThanhTien($id,$hehe1[0]['SoLuong1'] - 1 ,$hehe[0]['Gia']);
                    $this->giohang->CapNhatSoLuong3($_SESSION['id_user'],$id,$hehe1[0]['SoLuong1']-1,$gia);
                    }
                    header("Location: GioHang1");
                } 
            
                if(isset($_GET['test']) && $_GET['test'] == "cong" && isset($_GET['id'])) {
                    $gia = 0;
                    $this->giohang->CapNhatRong($_SESSION['id_user']);

                    $id = $_GET['id'];
                    $hehe = $this->giohang->LayDonGia($id);
                    if ($hehe[0]['GiaKhuyenMai'] != 0) {
                        $gia = $hehe[0]['GiaKhuyenMai'];
                    } else {
                        $gia = $hehe[0]['Gia'];
                    }
                    
                    $hehe1 = $this->giohang->LaySoLuong1($id,$_SESSION['id_user']);
                    // print_r($hehe1);
                    $hehe2 = $this->giohang->LaySoLuongSanPham($id);
                    // print_r($hehe2);
                    // $hehe3 = $this->giohang->LaySoLuong($id);

                    if($hehe1[0]['SoLuong1'] < $hehe2[0]['SoLuong']) {
                        $this->giohang->CapNhatSoLuong2($_SESSION['id_user'],$id,$hehe1[0]['SoLuong1']+1,$gia);
                    }
                    header("Location: GioHang1");
                }
            }
           
        include("Views/Home/giohang.php");
    }

    public function Xoa() {
        if(isset($_GET['id']) && isset($_GET['idkh'])){
            $id = $_GET['id'];
            if($_GET['idkh']!=0) {
                $delete = $this->giohang->Xoa1($id,$_SESSION['id_user']);
                if($delete) {
                    header("Location: ./GioHang1");
                }
            } else {
                $delete = $this->giohang->Xoa($id);
                if($delete) {
                    header("Location: ./GioHang1");
                }  
            }
        } 
    }

    public function DatHang(){
        // $this->general();
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_POST['updateTT'])) {
            $hoten = $_POST['hoten1'];
            $sdt = $_POST['sdt1'];
            $email = $_POST['email1'];
            $tinh = $_POST['tinh1'];
            $quan = $_POST['quan1'];
            $xa = $_POST['xa1'];
            $cuthe = $_POST['cuthe1'];
            $nameCity = $this->donhangban->nameCity($tinh);
            $nameDistrict = $this->donhangban->nameDistrict($quan);
            $nameWards = $this->donhangban->nameWards($xa);

            // $this->khachhang->UpdateDiaChi1($_POST['mon'],$hoten,$sdt,$email,$nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'],$cuthe);
            $this->khachhang->UpdateDiaChi1($_POST['mon'],$hoten,$sdt,$email,$tinh, $quan, $xa,$cuthe);

        }
        $thongbao = "";
       
        if(isset($_POST['saveAddress1'])) {
            if($this->khachhang->ChecknumberAD($_SESSION['id_user']) >= 4) {
                $thongbao = "Bạn đã thêm quá nhiều địa chỉ rồi!";
            } else {
                $hoten = $_POST['hoten'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                $tinh = $_POST['tinh'];
                $quan = $_POST['quan'];
                $xa = $_POST['xa'];
                $cuthe = $_POST['cuthe'];
      
                $nameCity = $this->donhangban->nameCity($tinh);
                $nameDistrict = $this->donhangban->nameDistrict($quan);
                $nameWards = $this->donhangban->nameWards($xa);

                // $insert = $this->khachhang->ThemDiaChi($_SESSION['id_user'], $hoten, $sdt, $email, $nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'], $cuthe, 1);
                // $insert = $this->khachhang->ThemDiaChi($_SESSION['id_user'], $hoten, $sdt, $email, $tinh, $quan, $xa, $cuthe, 1);
                // header("Location: DatHang");
                if ($insert) {
                    header("Location: DatHang");
                } else {
                    header("Location: ./GioHang1");
                }
            }
        }
        $fee = 0;
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData2($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $khachhang = $this->giohang->KhachHang($_SESSION['id_user']);
            $giohang = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        if(isset($_POST['submit'])){
            if(empty($_POST['email'])) {
                header("Location: ./DaDatHang");
            } else {
                header("Location: ./GioHang1");
            }
        }
        $province = $this->donhangban->province();
        $thongtinthanhtoan = $this->tttt->GetData();
        $test1 = $this->giohang->DanhSach4($_SESSION['id_user']);
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
      
        $mon = 0;   
        $getEmail = null;
        $phantramgiam = null; // 1                            
        if(isset($_POST['selectAD'])) { // 2    
            $mon = $_POST['selectAD'];
            $fee = 0;
            $_SESSION['cart']['id_dc'] = $mon;
            $getData1 = $this->khachhang->GetData3($mon);
            $getEmail= $this->khachhang->getEmail($mon);
            $fee = $this->phiship->PhiVanChuyen($getData1[0]['thanhpho'],$getData1[0]['quan'],$getData1[0]['xa']);
            if (is_array($fee)) {
                $fee = (int)$fee[0]['fee'];
            } else {
                $fee = 0;
            }
            $_SESSION['cart']['fee'] = $fee;
            $tong = 0; 
            $tongtientusdt = $this->donhangban->TongTienTuSDT($getData1[0]['SDT']); // 3
            if (is_array($tongtientusdt)) { // 4
                foreach ($tongtientusdt as $item) { // 5
                    $tong += $item['TongTien']; // 6
                } 
            } // 7

            if ($tong < 10000000){ // 8
                $phantramgiam = 0; // 9
            } elseif ($tong > 10000000 && $tong < 20000000) { // 10
                $phantramgiam = 10; // 11 
            } elseif ($tong > 20000000 && $tong < 100000000) { // 12
                $phantramgiam = 20; // 13
            } else { // 14
                $phantramgiam = 30; // 15
            }
        } // 16

        $tttt = 0;
        $error = [];
        if(isset($_POST['submitDH'])) { // 17
            $id_dc = $_SESSION['cart']['id_dc'];
            $ghichu = $_POST['ghichu']; 
            $mail = $_POST['email']; // 18

            if (empty($ghichu)) { // 19
                $ghichu = "Không có ghi chú"; // 20
            } else { // 21
                $ghichu = $_POST['ghichu']; // 22
            }
            // $tttt = $_POST['idtt'];
            if (empty($id_dc) || empty($mail)) { // 23
                header("Location: ./DatHang"); // 24
            } else { // 25
                $_SESSION['cart'] = [
                    "id_dc" => $id_dc,
                    "ghi_chu" => $ghichu,
                    "email" => $mail,
                    "fee" => $_SESSION['cart']['fee']
                ];
                header("Location: ./Payment"); // 26
            }
        }

        // if (isset($_GET['partnerCode'])) {
        //     $this->ctt->ThemMoi($_GET['partnerCode'], $_GET['orderId'], $_GET['amount'], $_GET['orderInfo'], $_GET['orderType'], $_GET['transId'], $_GET['payType'], $_SESSION['id_dhb']);
        // }

        // if (isset($_POST['tt_momo_atm'])) {
        //     $this->xulithanhtoanmomo_atm();
        // }


        
        // if(isset($_POST['submitAD'])) {
        //     $id=$_SESSION['id_user'];
        //     $tenkh=$_POST['hoten'];
        //     $sdt=$_POST['sdt'];
        //     $email=$_POST['email'];
        //     $diachi=$_POST['address'];

        //     $diachi = $_POST['address'];
        //     $sqlDonHang = "UPDATE khachhang SET TenKhachHang='$tenkh',SoDienThoai='$sdt',Email='$email',DiaChi='$diachi' WHERE ID=$id";
        //     $this->db->conn->query($sqlDonHang);          
        // }  
        include("Views/Home/DatHang.php"); //27 
    } // 28

    public function Payment() {
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');  
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData2($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        $tongtientusdt = null;
        if (isset($_SESSION['cart'])) {
            $getData1 = $this->khachhang->GetData3($_SESSION['cart']['id_dc']);
            $tongtientusdt = $this->donhangban->TongTienTuSDT($getData1[0]['SDT']);
        }
      
        // $getEmail= $this->khachhang->getEmail($mon);
        
        $tong = 0;
        if (is_array($tongtientusdt)) {
            foreach ($tongtientusdt as $item) {
                $tong += $item['TongTien'];
            } 
        }

        if ($tong < 10000000){
            $phantramgiam = 0;
        } elseif ($tong > 10000000 && $tong < 20000000) {
            $phantramgiam = 10;
        } elseif ($tong > 20000000 && $tong < 100000000) {
            $phantramgiam = 20;
        } else {
            $phantramgiam = 30;
        }

        $test1 = $this->giohang->DanhSach4($_SESSION['id_user']);
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
      
        if(isset($_SESSION['id_user'])) {
            $khachhang = $this->giohang->KhachHang($_SESSION['id_user']);
        }
        if(isset($_SESSION['id_user'])) {
            $giohang = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {    
            $giohang = $this->giohang->DanhSach();
        }  
        $thongtinkhachhang = null; 
        if (isset($_SESSION['cart']))  { 
            $thongtinkhachhang = $this->khachhang->GetData3($_SESSION['cart']['id_dc']);
        }

        // Test thanh toán qua momo qr
        if (isset($_POST['tt_momo_qr'])) {
            $this->xulithanhtoanmomo();
        }

        // Test thanh toán qua onepay
        if (isset($_POST['tt_onepay'])) {
            $this->onepay();
            // header("Location: ../Assets/noidia_php/noidia_php/index.php");
        }
       
        
        $this->mail = new Mailer();
        if (isset($_POST['tt_cash'])) {
            $idkh = $_SESSION['id_user'];
            $id_dc = $_SESSION['cart']['id_dc'];
            $ngaylap = date("Y-m-d");
            $ngay = date('Y-m-d H:i:s');
            $idkhachhang = $_SESSION['id_user'];
            $ghichu = $_SESSION['cart']['ghi_chu'];
            $phivanchuyen = $_SESSION['cart']['fee'];
            // $tttt = $_POST['idtt'];
                    
            $sqlDonHang = "INSERT INTO donhangban (IDKhachHang, idTrangThai, NgayLap, id_diachinhan, ghichu, phivanchuyen ,id_tttt) VALUES ($idkhachhang, 5, '$ngaylap',$id_dc, '$ghichu', '$phivanchuyen', 4)";
                    
            if ($this->db->conn->query($sqlDonHang) === TRUE) {
                $iddonhangban = $this->db->conn->insert_id;
                $tongtien = 0;
                $code = "";
                if(is_array($test1)) {
                    for($i = 0; $i < count($test1); $i++) {
                        $idsp = $test1[$i]['ID_sanpham'];
                        $soluong = $test1[$i]['SoLuong1'];
                        $dongia = $test1[$i]['dongia'];
                        $code = $test1[$i]['code_giam'];
                        if ($test1[$i]['ThanhTienCoMaGiam'] != 0) {
                            $thanhtien = $test1[$i]['ThanhTienCoMaGiam'];
                            $tongtien += $thanhtien;
                        } else {
                            $thanhtien = $test1[$i]['ThanhTien'];
                            $tongtien += $thanhtien;
                        }
                        // $thanhtien = $soluong * $dongia;
                            
                        $sqlChiTiet = "INSERT INTO chitietdonhangban (idDonHangBan, idSanPham, SoLuong, DonGiaApDung, code_giam, ThanhTien) VALUES ($iddonhangban, $idsp,$soluong,$dongia, '$code', $thanhtien)";
                        if ($this->db->conn->query($sqlChiTiet) === TRUE) {
                            $this->donhangban->CapNhatGiamGia($iddonhangban, $phantramgiam);
                            // $capnhattongtien = $this->ctdh->CapNhatTongTien($iddonhangban, $phantramgiam);  
                            $capnhattongtien = $this->ctdh->CapNhatTongTien5($iddonhangban, $tongtien - ($tongtien * $phantramgiam / 100));    
                        }
                        $this->ctdh->hihi($idsp,$soluong);
                    }
                }

                $this->ctdh->capNhatTongTienCoPhiVC($iddonhangban, $_SESSION['cart']['fee']);

                $content = "Bạn vừa đặt đơn hàng và đang chờ xử lí.";
                $sqlThongBao = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, $idkh , 'Bạn vừa đặt đơn hàng và đang chờ xử lí.', '$ngay',0)";
                $this->db->conn->query($sqlThongBao);
                $user = $_SESSION['user'];
                $sqlThongBaoAdmin = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, 0 , 'Tài khoản $user vừa đặt đơn hàng.', '$ngay',0)";
                $this->db->conn->query($sqlThongBaoAdmin);
                // $_SESSION['number_notice_admin']++;
                $test12 = $this->donhangban->ChiTiet($iddonhangban);
                $diachi_mail = $this->khachhang->GetData3($test12[0]['id_diachinhan']);
                $all;
                $danhsach = $this->ctdh->DanhSach1($iddonhangban);
                            
                $content = "<p> Cảm ơn bạn đã tin tưởng khi mua hàng ở HP. </p>";
                $content .= "<p>THÔNG TIN KHÁCH HÀNG</p>";
                $thongtinkhachhang = [
                    'Họ và tên' => $test12[0]['TenKhachHang'],
                    'Số điện thoại' =>  $test12[0]['SoDienThoai'],
                    'Email' =>  $test12[0]['Email'],
                    'Địa chỉ nhận hàng' => $diachi_mail[0]['nameProvince'] .",". $diachi_mail[0]['nameDistrict'] .",". $diachi_mail[0]['nameWard'] .",". $test12[0]['cuthe'],
                    'Hình thức thanh toán' =>  $test12[0]['name'],
                    'Ghi chú' => $test12[0]['ghichu']
                ];
        
                foreach ($thongtinkhachhang as $key => $value) {
                    $content .= "<p>$key: $value</p>";
                }
                        
                $content .= "<p>THÔNG TIN ĐƠN HÀNG CỦA BẠN</p>";
                $content .= "<p>Mã đơn hàng: MDH$iddonhangban </p>";
                $content .= "<table style='border: 1px solid black; width: 100%; text-align: center;'>
                    <tr> 
                        <th style='border:1px solid black;'>Tên sản phẩm</th>
                        <th style='border:1px solid black;'>Số Lượng</th>
                        <th style='border:1px solid black;'>Giá</th>
                        <th style='border:1px solid black;'>Thành tiền</th>
                    </tr>
                ";

                foreach($danhsach as $row) : extract ($row);
                $content .= "
                    <tr>
                        <td style='border:1px solid black;'>".$row['TenSanPham']."</td>
                        <td style='border:1px solid black;'>".number_format($row['SoLuong'], 0, '.', '.')."</td>
                        <td style='border:1px solid black;'>".number_format($row['DonGiaApDung'], 0, '.', '.')."</td>
                        <td style='border:1px solid black;'>".number_format($row['ThanhTien'], 0, '.', '.')."</td>
                    </tr>
                ";
                $all += $row['ThanhTien'];
                endforeach;
                $all = $all - ($all * ($phantramgiam / 100));

                $all1 = 0;
                foreach ($test3 as $item) {
                    if ($item['ThanhTienCoMaGiam'] != 0) {
                        $all1 += $item['ThanhTienCoMaGiam'];
                    } else {
                        $all1 += $item['ThanhTien'];
                    }
                }
                $all2 = $all1;
                $all1 = $all1 - ($all1 * ($phantramgiam / 100));
                $mess = null;
                if ($phantramgiam == 0){
                    $mess = "dưới 10tr";
                } elseif ($_POST['phantram'] == 10) {
                    $mess = "trong khoảng 10tr - 20tr";
                } elseif ($_POST['phantram'] == 20) {
                    $mess = "trong khoảng 20tr - 100tr";
                } else {
                    $mess = "trên 100tr";
                }

                $sogiam = $all2 * $phantramgiam / 100;
                $content .= "<tr> 
                    <td colspan = '3' style='border:1px solid black;text-align: center;'>Giảm giá ".$phantramgiam."% (do tổng tiền từ số điện thoại này $mess.)  </td>
                    <td style='border:1px solid black;text-align: center;'>-".number_format($sogiam, 0, '.', '.')."% (do tổng tiền từ số điện thoại này $mess.)  </td>
                </tr>"; 


                // foreach($test3 as $row){
                //     $content .= ""
                // }
                $content .= "<tr>
                <td colspan = '3' style='border:1px solid black;text-align: center;'>Mã giảm giá</td>
                <td style='border:1px solid black;'> <ul>";
                
                foreach ($test3 as $row) : extract($row);
                    if ($row['code_giam'] != "") {
                        $array_code = explode(",", $row['code_giam']);
                        foreach($array_code as $item) {
                            $luong = $this->magiam->LuongGiam($item);
                            $luonggiam = $luong[0]['luonggiam'];
                            $donvi = $luong[0]['donvigiam'];

                            $content .= "<li>$item -$luonggiam$donvi</li>";
                        }
                    }
                endforeach;
                $content .= "</ul> </td>";
                $content .= "<tr> 
                <td colspan = '3' style='border:1px solid black;text-align: center;'>Phí vận chuyển</td>
                    <td style='border:1px solid black;'>- ".number_format($_SESSION['cart']['fee'], 0, '.', '.')."</td>
                </tr>";
                $content .= "<tr> 
                                <td colspan = '3' style='border:1px solid black;text-align: center;'>Tổng tiền</td>
                                    <td style='border:1px solid black;'>".number_format( isset($_SESSION['cart']) ? $all1 - $_SESSION['cart']['fee'] : $all1, 0, '.', '.')."</td>
                                </tr>";
                $content .= "</table>";
                
                $title = "Cảm ơn bạn đã mua hàng ở HP. Đây là thông tin của bạn";

                $mail = new Mailer();
                $mail->mailToken($title, $content, $_SESSION['cart']['email']);
                        
                $this->giohang->XoaAll1($_SESSION['id_user']);
        
                header("Location: ./DaDatHang");
                // Assets/noidia_php/noidia_php/index.php
            } 
        }

        // Xử lí thanh toán qua VNPAY
        if (isset($_POST['redirect'])) {
            $this->VNPAY();
        }
        if (isset($_GET['vnp_BankCode'])) {
            $idkh = $_SESSION['id_user'];
            $ngaylap = date("Y-m-d");
            $ngay = date('Y-m-d H:i:s');
            $idkhachhang = $_SESSION['id_user'];
            $id_dc = $_SESSION['cart']['id_dc'];
            $ghichu = $_SESSION['cart']['ghi_chu'];

            $sqlDonHang = "INSERT INTO donhangban (IDKhachHang, idTrangThai, NgayLap, id_diachinhan, ghichu, id_tttt) VALUES ($idkhachhang, 6, '$ngaylap',$id_dc, '$ghichu','VNPay')";
                
            if ($this->db->conn->query($sqlDonHang) === TRUE) {
                $iddonhangban = $this->db->conn->insert_id;
                $this->ctt->ThemMoiVNPay($_GET['vnp_Amount'], $_GET['vnp_BankCode'], $_GET['vnp_BankTranNo'], $_GET['vnp_CardType'], $_GET['vnp_OrderInfo'], $_GET['vnp_PayDate'], $_GET['vnp_TmnCode'],$_GET['vnp_TransactionNo'], $iddonhangban);

                if(is_array($test1)) {
                    for($i = 0; $i < count($test1); $i++) {
                        $idsp = $test1[$i]['ID_sanpham'];
                        $soluong = $test1[$i]['SoLuong1'];
                        $dongia = $test1[$i]['dongia'];
                        $thanhtien = $soluong * $dongia;
                        
                        $sqlChiTiet = "INSERT INTO chitietdonhangban (idDonHangBan, idSanPham, SoLuong, DonGiaApDung, ThanhTien) VALUES ($iddonhangban, $idsp,$soluong,$dongia,$thanhtien)";
                        if ($this->db->conn->query($sqlChiTiet) === TRUE) {
                            $this->donhangban->CapNhatGiamGia($iddonhangban, $phantramgiam);
                            $capnhattongtien = $this->ctdh->CapNhatTongTien($iddonhangban, $phantramgiam);
                        }
                        $this->ctdh->hihi($idsp,$soluong);
                    }
                }

                $content = "Bạn vừa đặt đơn hàng và đang chờ xử lí.";
                $sqlThongBao = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, $idkh , 'Bạn vừa đặt đơn hàng và đang chờ xử lí.', '$ngay',0)";
                $this->db->conn->query($sqlThongBao);
                $user = $_SESSION['user'];
                $sqlThongBaoAdmin = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, 0 , 'Tài khoản $user vừa đặt đơn hàng.', '$ngay',0)";
                $this->db->conn->query($sqlThongBaoAdmin);
                        
                $test12 = $this->donhangban->ChiTiet($iddonhangban);
                $all;
                $danhsach = $this->ctdh->DanhSach1($iddonhangban);
                        // $test12 = $this->donhangban->ChiTiet($iddonhangban);
                $content = "<p> Cảm ơn bạn đã tin tưởng khi mua hàng ở HP. </p>";
                $content .= "<p>THÔNG TIN KHÁCH HÀNG</p>";
                $thongtinkhachhang = [
                    'Họ và tên' => $test12[0]['TenKhachHang'],
                    'Số điện thoại' =>  $test12[0]['SoDienThoai'],
                    'Email' =>  $test12[0]['Email'],
                    'Địa chỉ nhận hàng' => $test12[0]['thanhpho'] .",". $test12[0]['quan'] .",". $test12[0]['xa'] .",". $test12[0]['cuthe'],
                    'Hình thức thanh toán' =>  $test12[0]['name'],
                    'Ghi chú' => $test12[0]['ghichu']
                ];
            
                foreach ($thongtinkhachhang as $key => $value) {
                    $content .= "<p>$key: $value</p>";
                }
                            
                $content .= "<p>THÔNG TIN ĐƠN HÀNG CỦA BẠN</p>";
                $content .= "<p>Mã đơn hàng: MDH$iddonhangban </p>";
                $content .= "<table style='border: 1px solid black; width: 100%;'>
                    <tr> 
                        <th style='border:1px solid black;'>Tên sản phẩm</th>
                        <th style='border:1px solid black;'>Số Lượng</th>
                        <th style='border:1px solid black;'>Giá</th>
                        <th style='border:1px solid black;'>Thành tiền</th>
                     </tr>
                    ";
            
                      
                foreach($danhsach as $row) : extract ($row);
                    $content .= "
                        <tr>
                            <td style='border:1px solid black;'>".$row['TenSanPham']."</td>
                            <td style='border:1px solid black;'>".number_format($row['SoLuong'], 0, '.', '.')."</td>
                            <td style='border:1px solid black;'>".number_format($row['DonGiaApDung'], 0, '.', '.')."</td>
                            <td style='border:1px solid black;'>".number_format($row['ThanhTien'], 0, '.', '.')."</td>
                        </tr>
                     ";
                    $all += $row['ThanhTien'];
                    endforeach;
                    $all = $all - ($all * ($phantramgiam / 100));
                    $mess = null;
                    if ($_POST['phantram'] == 0){
                        $mess = "dưới 10tr";
                    } elseif ($_POST['phantram'] == 10) {
                        $mess = "trong khoảng 10tr - 20tr";
                    } elseif ($_POST['phantram'] == 20) {
                        $mess = "trong khoảng 20tr - 100tr";
                    } else {
                        $mess = "trên 100tr";
                    }
                    $content .= "<tr> 
                         <td colspan = '4' style='border:1px solid black;text-align: center;'>Giảm giá ".$phantramgiam."% (do tổng tiền từ số điện thoại này $mess.)</td>
                    </tr>";
                    $content .= "<tr> 
                        <td colspan = '3' style='border:1px solid black;text-align: center;'>Tổng tiền</td>
                        <td style='border:1px solid black;'>".number_format($all, 0, '.', '.')."</td>
                    </tr>";
                    $content .= "</table>";
                    
                    $title = "Cảm ơn bạn đã mua hàng ở HP. Đây là thông tin của bạn";
        
                    $mail = new Mailer();
                    $mail->mailToken($title, $content, $_SESSION['cart']['email']);
                        
                    $this->giohang->XoaAll1($_SESSION['id_user']);
                    header("Location: ./DaDatHang");
                }
        }

        // Xử lí thanh toán qua momo atm
        if (isset($_POST['tt_momo_atm'])) {
            $this->xulithanhtoanmomo_atm();
        }
        if (isset($_GET['partnerCode'])) {
                $idkh = $_SESSION['id_user'];
                $ngaylap = date("Y-m-d");
                $ngay = date('Y-m-d H:i:s');
                $idkhachhang = $_SESSION['id_user'];
                $id_dc = $_SESSION['cart']['id_dc'];
                $ghichu = $_SESSION['cart']['ghi_chu'];

                $sqlDonHang = "INSERT INTO donhangban (IDKhachHang, idTrangThai, NgayLap, id_diachinhan, ghichu, id_tttt) VALUES ($idkhachhang, 6, '$ngaylap',$id_dc, '$ghichu','MoMo By ATM')";
                    
                if ($this->db->conn->query($sqlDonHang) === TRUE) {
                    $iddonhangban = $this->db->conn->insert_id;
                    $this->ctt->ThemMoi($_GET['partnerCode'], $_GET['orderId'], $_GET['amount'], $_GET['orderInfo'], $_GET['orderType'], $_GET['transId'], $_GET['payType'], $iddonhangban);
    
                    if(is_array($test1)) {
                        for($i = 0; $i < count($test1); $i++) {
                            $idsp = $test1[$i]['ID_sanpham'];
                            $soluong = $test1[$i]['SoLuong1'];
                            $dongia = $test1[$i]['dongia'];
                            $thanhtien = $soluong * $dongia;
                            
                            $sqlChiTiet = "INSERT INTO chitietdonhangban (idDonHangBan, idSanPham, SoLuong, DonGiaApDung, ThanhTien) VALUES ($iddonhangban, $idsp,$soluong,$dongia,$thanhtien)";
                            if ($this->db->conn->query($sqlChiTiet) === TRUE) {
                                $this->donhangban->CapNhatGiamGia($iddonhangban, $phantramgiam);
                                $capnhattongtien = $this->ctdh->CapNhatTongTien($iddonhangban, $phantramgiam);
                            }
                            $this->ctdh->hihi($idsp,$soluong);
                        }
                    }
    
                    $content = "Bạn vừa đặt đơn hàng và đang chờ xử lí.";
                    $sqlThongBao = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, $idkh , 'Bạn vừa đặt đơn hàng và đang chờ xử lí.', '$ngay',0)";
                    $this->db->conn->query($sqlThongBao);
                    $user = $_SESSION['user'];
                    $sqlThongBaoAdmin = "INSERT INTO thongbao (ID_DH, ID_KH, content, ngay, action) VALUES ($iddonhangban, 0 , 'Tài khoản $user vừa đặt đơn hàng.', '$ngay',0)";
                    $this->db->conn->query($sqlThongBaoAdmin);
                            
                    $test12 = $this->donhangban->ChiTiet($iddonhangban);
                    $all;
                    $danhsach = $this->ctdh->DanhSach1($iddonhangban);
                            // $test12 = $this->donhangban->ChiTiet($iddonhangban);
                    $content = "<p> Cảm ơn bạn đã tin tưởng khi mua hàng ở HP. </p>";
                    $content .= "<p>THÔNG TIN KHÁCH HÀNG</p>";
                    $thongtinkhachhang = [
                        'Họ và tên' => $test12[0]['TenKhachHang'],
                        'Số điện thoại' =>  $test12[0]['SoDienThoai'],
                        'Email' =>  $test12[0]['Email'],
                        'Địa chỉ nhận hàng' => $test12[0]['thanhpho'] .",". $test12[0]['quan'] .",". $test12[0]['xa'] .",". $test12[0]['cuthe'],
                        'Hình thức thanh toán' =>  $test12[0]['name'],
                        'Ghi chú' => $test12[0]['ghichu']
                    ];
                
                    foreach ($thongtinkhachhang as $key => $value) {
                        $content .= "<p>$key: $value</p>";
                    }
                                
                    $content .= "<p>THÔNG TIN ĐƠN HÀNG CỦA BẠN</p>";
                    $content .= "<p>Mã đơn hàng: MDH$iddonhangban </p>";
                    $content .= "<table style='border: 1px solid black; width: 100%;'>
                        <tr> 
                            <th style='border:1px solid black;'>Tên sản phẩm</th>
                            <th style='border:1px solid black;'>Số Lượng</th>
                            <th style='border:1px solid black;'>Giá</th>
                            <th style='border:1px solid black;'>Thành tiền</th>
                         </tr>
                        ";
                
                          
                    foreach($danhsach as $row) : extract ($row);
                        $content .= "
                            <tr>
                                <td style='border:1px solid black;'>".$row['TenSanPham']."</td>
                                <td style='border:1px solid black;'>".number_format($row['SoLuong'], 0, '.', '.')."</td>
                                <td style='border:1px solid black;'>".number_format($row['DonGiaApDung'], 0, '.', '.')."</td>
                                <td style='border:1px solid black;'>".number_format($row['ThanhTien'], 0, '.', '.')."</td>
                            </tr>
                         ";
                        $all += $row['ThanhTien'];
                        endforeach;
                        $all = $all - ($all * ($phantramgiam / 100));
                        $mess = null;
                        if ($_POST['phantram'] == 0){
                            $mess = "dưới 10tr";
                        } elseif ($_POST['phantram'] == 10) {
                            $mess = "trong khoảng 10tr - 20tr";
                        } elseif ($_POST['phantram'] == 20) {
                            $mess = "trong khoảng 20tr - 100tr";
                        } else {
                            $mess = "trên 100tr";
                        }
                        $content .= "<tr> 
                             <td colspan = '4' style='border:1px solid black;text-align: center;'>Giảm giá ".$phantramgiam."% (do tổng tiền từ số điện thoại này $mess.)</td>
                        </tr>";
                        $content .= "<tr> 
                            <td colspan = '3' style='border:1px solid black;text-align: center;'>Tổng tiền</td>
                            <td style='border:1px solid black;'>".number_format($all, 0, '.', '.')."</td>
                        </tr>";
                        $content .= "</table>";
                        
                        $title = "Cảm ơn bạn đã mua hàng ở HP. Đây là thông tin của bạn";
            
                        $mail = new Mailer();
                        $mail->mailToken($title, $content, $_SESSION['cart']['email']);
                            
                        $this->giohang->XoaAll1($_SESSION['id_user']);
                        header("Location: ./DaDatHang");
                    }
                    
        }

        include("Views/Home/Payment.php");
    }
    public function DaDatHang(){
        $this->general();
        unset($_SESSION['cart']);
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }

      

        // $iddc1 = $_POST['iddc'];
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $khachhang = $this->giohang->KhachHang($_SESSION['id_user']);
        if(isset($_SESSION['id_user'])) {
            $giohang = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $giohang = $this->giohang->DanhSach();
        }
        include("Views/Home/DaDatHang.php");

    }

    public function add_address_form(){
        if(isset($_POST['submitAD'])) {
            $diachi = $_POST['address'];
            $sqlDonHang = "INSERT INTO hihi (diachi) VALUES ('$diachi')";
            $this->db->conn->query($sqlDonHang);          
        }
    }

    public function ThongBao(){
        $this->general();
        
        // if(isset($_GET['xemall']) && $_GET['xemall'] == 1) {
        //     $test = 1;
        // }
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['id_user']);

        } else {
            $test = $this->giohang->DanhSach();
        }
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }

        if(isset($_GET['xemthongbaoall'])) {

            $this->thongbao->update1($_SESSION['id_user']);
            header("Location: ThongBao");
        }


        // if(isset($_GET['id']) && $_GET['hanhdong'] && $_GET['hanhdong'] == "daxem") {
        //     $id = $_GET['id'];
        //    $test2 = $this->thongbao->update($_GET['id'],$_SESSION['id_user']);
        //     if($test2){
        //         header("Location: ThongBao");
        //     }
        // }
        include("Views/Home/ThongBao.php");
    }

    public function TinTuc() {
        $this->general();
       
        //gọi method DanhSach bên Models
        $random_color = ["red", "blue", "violet"];
        $count = count($random_color);
        $count = rand(0, $count-1);
        $test = $random_color[$count];
       
        if(isset($_GET['xemthongbao'])) {
            header("Location: ./ThongBao?id=" .$_GET['xemthongbao']);
        }
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }

        $chitiet = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->tintuc->updateView($id);
            $chitiet = $this->tintuc->ChiTiet($id);
        }

        $searchNew = null;
        if (isset($_GET['searchNew'])) {
            $searchNew = $this->tintuc->TimKiem($_GET['searchNew']);
        }

        $danhsachloai  = null;
        if (isset($_GET['idltt'])) {
            $id = $_GET['idltt'];
            $danhsachloai = $this->tintuc->DanhSachLoai($id);
        }

        $danhsachpb = $this->tintuc->DanhSachPB(5);

        $tintuc = $this->tintuc->DanhSach(100);
        $recent_post = $this->tintuc->DanhSach(5);
        // $result2 = $this->model->DanhSachSanPhamNoiBat();
        $result2 = $this->model->DanhSach(100,0);
        $result3 = $this->model->DanhSachSanPhamMoiNhat();
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $loaisanpham1 = $this->loaisanpham->DanhSach1();
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        }
        include("Views/Home/TinTuc.php");
    }

    public function ajax() {
        include("Views/Home/index3.php");
    }
    public function ajax1() {
        require 'Views/Home/ajaxone.php';
    }
    public function ajax2() {
        require 'Views/Home/ajaxtwo.php';
    }

    public function xulithanhtoanmomo(){
        // require 'Views/Home/xulithanhtoanmomo.php';
        header('Content-type: text/html; charset=utf-8');
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }


        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";

        $amount = $_POST['amount'];
        $orderId = time() ."";
        $redirectUrl = "http://localhost/DemoWeb5/TrangChu/Payment";
        $ipnUrl = "http://localhost/DemoWeb5/TrangChu/Payment";
        $extraData = "";
            

            $requestId = time() . "";
            $requestType = "captureWallet";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            print_r($jsonResult);
            //Just a example, please check more in there

            header('Location: ' . $jsonResult['payUrl']);
    }

    public function Modal() {
        include("Views/Home/Modal.php");
    }

    public function VNPAY() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        unset($_SESSION['id_dhb']);
        $vnp_TmnCode = "INJG166K"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "JJPNICPXQYDCRWVTZMLGHVCJTFZPMFFY"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/DemoWeb5/TrangChu/Payment";
        // $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        // $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
        $vnp_TxnRef = rand(000,99999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thông tin đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $expire;
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
	// vui lòng tham khảo thêm tại code demo
    }

    public function onepay() {
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

// add the start of the vpcURL querystring parameters
// *****************************Lấy giá trị url cổng thanh toán*****************************
$vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";

// Remove the Virtual Payment Client URL from the parameter hash as we 
// do not want to send these fields to the Virtual Payment Client.
// bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
// unset($_POST["virtualPaymentClientURL"]); 
// unset($_POST["SubButL"]);
$vpc_Merchant = 'ONEPAY';
$vpc_AccessCode = 'D67342C2';
$vpc_MerchTxnRef = time();
$vpc_OrderInfo = 'JSECURETEST01';
$vpc_Amount = $_POST['amount'];
$vpc_ReturnURL = 'http://localhost/DemoWeb5/TrangChu/DaDatHang';
$vpc_Command = 'ONEPAY';
$vpc_Locale = 'vn';
$vpc_Currency = 'VND';
$vpc_Version = '2';

$data = array(
    'vpc_Merchant' => $vpc_Merchant,
    'vpc_AccessCode' => $vpc_AccessCode,
    'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
    'vpc_OrderInfo' => $vpc_OrderInfo,
    'vpc_Amount' => $vpc_Amount,
    'vpc_ReturnURL' => $vpc_ReturnURL,
    'vpc_Command' => $vpc_Command,
    'vpc_Locale' => $vpc_Locale,
    'vpc_Currency' => $vpc_Currency,
    'vpc_Version' => $vpc_Version
);
//$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
$stringHashData = "";
// sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
// arrange array data a-z before make a hash
ksort ($data);

// set a parameter to show the first pair in the URL
// đặt tham số đếm = 0
$appendAmp = 0;

foreach($data as $key => $value) {

    // create the md5 input and URL leaving out any fields that have no value
    // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
    if (strlen($value) > 0) {
        // this ensures the first paramter of the URL is preceded by the '?' char
        if ($appendAmp == 0) {
            $vpcURL .= urlencode($key) . '=' . urlencode($value);
            $appendAmp = 1;
        } else {
            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		    $stringHashData .= $key . "=" . $value . "&";
		}
    }
}
//*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
$stringHashData = rtrim($stringHashData, "&");
// Create the secure hash and append it to the Virtual Payment Client Data if
// the merchant secret has been provided.
// thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
if (strlen($SECURE_SECRET) > 0) {
    //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
    // *****************************Thay hàm mã hóa dữ liệu*****************************
    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
}

// FINISH TRANSACTION - Redirect the customers using the Digital Order
// ===================================================================
// chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
header("Location: " .$vpcURL);

// *******************
// END OF MAIN PROGRAM
// *******************


    }

    public function xulithanhtoanmomo_atm(){
        // require 'Views/Home/xulithanhtoanmomo_atm.php';
        header('Content-type: text/html; charset=utf-8');

        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['amount'];
        $orderId = time() ."";
        $redirectUrl = "http://localhost/DemoWeb5/TrangChu/Payment";
        $ipnUrl = "http://localhost/DemoWeb5/TrangChu/Payment";
        $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            header('Location: ' . $jsonResult['payUrl']);

    }

    public function xuli() {
        $output = "";
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];
        $cuthe = $_POST['cuthe'];
        $type = "red";
        $output1 = "";
        if (empty($hoten) || empty($email) || empty($sdt) || empty($province) || empty($district) || empty($wards) || empty($cuthe)) {
            $output = "Nhập không đủ dữ liệu. Vui lòng nhập lại!";
        } elseif (preg_match('/[!@#$%^&*(),.?":{}|<>0-9]/', $hoten)) {
            $output = "Trường họ tên không được ghi kí tự đặc biệt hoặc số!";
        } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
            $output = "Số điện thoại không hợp lệ";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output = "Email không hợp lệ";
        } else {
            $nameCity = $this->donhangban->nameCity($province);
            $nameDistrict = $this->donhangban->nameDistrict($district);
            $nameWards = $this->donhangban->nameWards($wards);
            // $this->khachhang->ThemDiaChi($_SESSION['id_user'], $hoten, $sdt, $email, $nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'], $cuthe, 1);
            $this->khachhang->ThemDiaChi($_SESSION['id_user'], $hoten, $sdt, $email, $province, $district, $wards, $cuthe, 1);
            $output = "Thêm địa chỉ thành công";
            $type = "green";
        }
        $output1 .= "<div style='color: $type'>
            <p style='text-alin: center;'>$output</p>
        ";
            
        echo $output1;
    }

    public function xuli1() {
        $output = "";
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];
        $cuthe = $_POST['cuthe'];
        $type = "red";
        $output1 = "";
        if (empty($hoten) || empty($email) || empty($sdt) || empty($province) || empty($district) || empty($wards) || empty($cuthe)) {
            $output = "Nhập không đủ dữ liệu. Vui lòng nhập lại!";
        } elseif (preg_match('/[!@#$%^&*(),.?":{}|<>0-9]/', $hoten)) {
            $output = "Trường họ tên không được ghi kí tự đặc biệt hoặc số!";
        } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
            $output = "Số điện thoại không hợp lệ";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output = "Email không hợp lệ";
        } else {
            $nameCity = $this->donhangban->nameCity($province);
            $nameDistrict = $this->donhangban->nameDistrict($district);
            $nameWards = $this->donhangban->nameWards($wards);
            $this->khachhang->UpdateDiaChi1($_SESSION['cart']['id_dc'], $hoten, $sdt, $email, $nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'], $cuthe, 1);
            $output = "Cập nhật địa chỉ thành công";
            $type = "green";
        }
        $output1 .= "<div style='color: $type'>
            <p style='text-alin: center;'>$output</p>
        ";
            
        echo $output1;
    }

    public function xuli2() {
        $output = "";
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];
        $cuthe = $_POST['cuthe'];
        $type = "red";
        $output1 = "";
        if (empty($hoten) || empty($email) || empty($sdt) || empty($province) || empty($district) || empty($wards) || empty($cuthe)) {
            $output = "Nhập không đủ dữ liệu. Vui lòng nhập lại!";
        } elseif (preg_match('/[!@#$%^&*(),.?":{}|<>0-9]/', $hoten)) {
            $output = "Trường họ tên không được ghi kí tự đặc biệt hoặc số!";
        } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
            $output = "Số điện thoại không hợp lệ";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output = "Email không hợp lệ";
        } else {
            $nameCity = $this->donhangban->nameCity($province);
            $nameDistrict = $this->donhangban->nameDistrict($district);
            $nameWards = $this->donhangban->nameWards($wards);
            $this->khachhang->ThemDiaChi($_SESSION['id_user'],$hoten,$sdt,$email,$province, $district,$wards,$cuthe,0);            
            $output = "Thêm địa chỉ mặc định thành công";
            $type = "green";
        }
        $output1 .= "<div style='color: $type'>
            <p style='text-alin: center;'>$output</p>
        ";
            
        echo $output1;
    }

    public function xuli3() {
        $output = "";
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];
        $cuthe = $_POST['cuthe'];
        $type = "red";
        $output1 = "";
        if (empty($hoten) || empty($email) || empty($sdt) || empty($province) || empty($district) || empty($wards) || empty($cuthe)) {
            $output = "Nhập không đủ dữ liệu. Vui lòng nhập lại!";
        } elseif (preg_match('/[!@#$%^&*(),.?":{}|<>0-9]/', $hoten)) {
            $output = "Trường họ tên không được ghi kí tự đặc biệt hoặc số!";
        } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
            $output = "Số điện thoại không hợp lệ";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output = "Email không hợp lệ";
        } else {
            $nameCity = $this->donhangban->nameCity($province);
            $nameDistrict = $this->donhangban->nameDistrict($district);
            $nameWards = $this->donhangban->nameWards($wards);
            $this->khachhang->UpdateDiaChi($_SESSION['id_user'], $hoten,$sdt,$email, $nameCity[0]['name'], $nameDistrict[0]['name'], $nameWards[0]['name'],$cuthe);
            $output = "Cập nhật địa chỉ mặc định thành công";
            $type = "green";
        }
        $output1 .= "<div style='color: $type'>
            <p style='text-alin: center;'>$output</p>
        ";
            
        echo $output1;
    }

    public function trash_ad() {
        $id = $_POST['data'];
        $this->khachhang->XoaDCNH($id);
    }

    public function show_showroom() {
        $province = $this->donhangban->province();
        $province_showroom = null;
        $district_showroom = null;
        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }
        $show = null;
        $show = $this->showroom->DanhSach();
        $id1 = 0; 
        $id2 = 0;
        if (isset($_POST['show_kq'])) {
            $province_showroom = $_POST['province_showroom'];
            $district_showroom = $_POST['district_showroom'];
           
            // $nameWards = $this->donhangban->nameWards($xa);
            $nameCity = $this->donhangban->nameCity($province_showroom);
            $nameDistrict = $this->donhangban->nameDistrict($district_showroom);
            if (!empty($province_showroom)) {
                $show = $this->showroom->DanhSachTheoTinh($province_showroom);
            } elseif (empty($province_showroom) && empty($district_showroom)) {
                $show = $this->showroom->DanhSach();
            } else {
                $show = $this->showroom->DanhSachTheoTinhQuan($province_showroom, $district_showroom);
            }
        }
        include("Views/Home/Showroom.php");
    }

    public function xuli10() {
        if (isset($_POST['province_id'])) {
            print_r($_POST['province_id']);
        }
        
    }

    public function KhuyenMai() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        if(isset($_SESSION['id_user'])) {
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
            $getData = $this->khachhang->getData1($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
        } else {
            $test = $this->giohang->DanhSach();
        }

        $show = $this->magiam->DanhSach();
        include('Views/Home/KhuyenMai.php');
    }

    public function xuli_magiam() {
        $macode = $_POST['data'];   
          
        $show = $this->magiam->DanhSach(100,0);
        $output = '';
        $array = null;
        $test_macode = null;
        $tongtamtinh = null;
        $tongtamtinh = $_POST['tongtamtinh'];   
        $error = null;
        $success = null;
        $array_code = null;
        if (isset($_SESSION['id_user'])) {
            $giohang = $this->giohang->DanhSach3($_SESSION['id_user']);

            if (empty($macode)) {
                echo "<script>alert('Bạn chưa nhập mã code!');</script>";
            } else {
                foreach ($show as $item) {
                    if ($macode == $item['code']) {
                        $test_macode = $macode;
                        break;
                    } 
                }
                if (!empty($test_macode)) {
                    $luonggiam = $this->magiam->LuongGiam($test_macode);
                //    0: Không áp dụng code này cho các sản phẩm đang giảm giá, 1: Ngược lại  A: giá_km = 0;
                    $array1 = explode(",", $luonggiam[0]['id_sp']);
                    if ((int)$luonggiam[0]['ID_loai'] == 1) {
                        if ((int)$luonggiam[0]['trangthai'] != 0 && ((int)$tongtamtinh > (int)$luonggiam[0]['dieukientoithieu']) && ((int)$tongtamtinh < (int)$luonggiam[0]['dieukientoida'])) {
                            $output = "Áp dụng thành công";
                            if (isset($_SESSION['magiam_giohang']) && $_SESSION['magiam_giohang']['id_sudungcode'] == 1) {
                                unset($_SESSION['magiam_giohang']);
                            }
                            if ((int)$luonggiam[0]['id_sudungcode'] == 1 && (int)$luonggiam[0]['id_sanphamgiamgia'] == 1) {
                                print_r(0);
                                foreach($giohang as $item) {
                                    if (in_array((int)$item['ID_sanpham'], $array1)) {
                                        $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                        $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $test_macode, $thanhtien);
                                    } else {
                                        $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], "", 0);
                                    }
                                }      
                            } 
                            elseif ((int)$luonggiam[0]['id_sanphamgiamgia'] == 0) {   
                                $count = 0;
                                $count_giohang = count($giohang);
                                foreach($giohang as $item) {
                                    $sanpham = $this->model->ChiTiet($item['ID_sanpham']);
                                    $gia_km = $sanpham[0]['GiaKhuyenMai'];
                                    if ((int)$gia_km == 0) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            if (($item['code_giam']) != "") {
                                                $array = explode(",", $item['code_giam']);
                                                $cohieu = 1;
                                                
                                                foreach($array as $item1) { 
                                                    if ($item1 == $test_macode) {
                                                        $cohieu = 0;        
                                                        break;  
                                                    }   
                                                }
            
                                                if ($cohieu == 0) {
                                                    $output = "Bạn đã sử dụng mã này rồi";
                                                } else {
                                                    $string_code1 = $item['code_giam'] .','. $test_macode;
                                                    $p = explode(",", $string_code1);
                                                    foreach ($p as $item1) {
                                                        $p1 = $this->magiam->LuongGiam($item1);
                                                        if ($p1[0]['ID_loai'] == 1) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTienCoMaGiam'] * $p1[0]['luonggiam'] / 100);
                                                        } elseif ($p1[0]['ID_loai'] == 3) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                        }
                                                    }  
                                                    $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $string_code1, $thanhtien);
                                                }
                                            } else {
                                                $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                                $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $test_macode, $thanhtien);
                                            }
                                        } else {
                                            continue;
                                        }
                                    } else {
                                        $count++;
                                    }
                                }   

                                if ($count == $count_giohang) {
                                    $output = "Mã giảm giá này không đ`ược dùng với sản phẩm đang được chọn";
                                } else {
                                    $output = "Áp dụng thành công";
                                }
                            } 
                            else {
                                foreach($giohang as $item) {    
                                    if (in_array((int)$item['ID_sanpham'], $array1)) {
                                        if (($item['code_giam']) != "") {
                                            $array = explode(",", $item['code_giam']);
                                            $cohieu = 1;
                                            
                                            foreach($array as $item1) { 
                                                if ($item1 == $test_macode) {
                                                    $cohieu = 0;        
                                                    break;  
                                                }   
                                            }
        
                                            if ($cohieu == 0) {
                                                $output = "Bạn đã sử dụng mã này rồi";
                                            } else {
                                                $string_code1 = $item['code_giam'] .','. $test_macode;
                                                $p = explode(",", $string_code1);
                                                foreach ($p as $item1) {
                                                    $p1 = $this->magiam->LuongGiam($item1);
                                                    if ($p1[0]['ID_loai'] == 1) {
                                                        $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTien'] * $p1[0]['luonggiam'] / 100);
                                                    } elseif ($p1[0]['ID_loai'] == 3) {
                                                        $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                    }
                                                }  
                                                $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $string_code1, $thanhtien);
                                            }
                                        } else {
                                            $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                            $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $test_macode, $thanhtien);
                                        }
                                    } else {
                                        continue;
                                    }
                                }      
                            }         
                        } elseif ($luonggiam[0]['trangthai'] == 0) {
                            $output = "Mã này đã hết hạn hoặc đã hết";
                        } else {
                            $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                        }
                    } elseif ($luonggiam[0]['ID_loai'] == 2) {
                        if ((int)$luonggiam[0]['trangthai'] != 0) {
                            $output = "Áp dụng thành công"; 
                            if ((int)$luonggiam[0]['id_sudungcode'] == 1) { //mã code này không được dùng chung mã code khác
                                foreach($giohang as $item) {
                                    $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], "", 0);
                                }      
                            }
                            $flag = 0;
                            foreach ($giohang as $item1) {
                                if (in_array((int)$item['ID_sanpham'], $array1)) {
                                    $flag = 1;
                                    break;
                                }
                            }
                            if ($flag == 1) {
                                $_SESSION['magiam_giohang'] = [
                                    "ID_KH" => $_SESSION['id_user'],
                                    "code_giam" => $test_macode,
                                    "id_sudungcode" => $luonggiam[0]['id_sudungcode'],
                                    "Luonggiam" => $luonggiam[0]['luonggiam']
                                ]; 
                            } else {
                                unset($_SESSION['magiam_giohang']);
                            }
                        } elseif ($luonggiam[0]['trangthai'] == 0) {
                            $output = "Mã này đã hết hạn hoặc đã hết";
                        } else {
                            $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                        }
                    } elseif ($luonggiam[0]['ID_loai'] == 3) {
                            if ((int)$luonggiam[0]['trangthai'] != 0) {
                                $output = "Áp dụng thành công";
                                if (isset($_SESSION['magiam_giohang']) && $_SESSION['magiam_giohang']['id_sudungcode'] == 1) {
                                    unset($_SESSION['magiam_giohang']);
                                }
                                if ((int)$luonggiam[0]['id_sudungcode'] == 1) {
                                    foreach($giohang as $item) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            $thanhtien = $item['ThanhTien'] - $luonggiam[0]['luonggiam'];
                                            $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $test_macode, $thanhtien);
                                        } else {
                                            $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], "", 0);
                                        }
                                    }      
                                } else {
                                    foreach($giohang as $item) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            if (($item['code_giam']) != "") {
                                                $array = explode(",", $item['code_giam']);
                                                $cohieu = 1;
                                                
                                                foreach($array as $item1) { 
                                                    if ($item1 == $test_macode) {
                                                        $cohieu = 0;        
                                                        break;  
                                                    }
                                                }
            
                                                if ($cohieu == 0) {
                                                    $output = "Bạn đã sử dụng mã này rồi";
                                                } else {
                                                    $string_code1 = $item['code_giam'] .','. $test_macode;
                                                    $p = explode(",", $string_code1);
                                                    foreach ($p as $item1) {
                                                        $p1 = $this->magiam->LuongGiam($item1);
                                                        if ($p1[0]['ID_loai'] == 1) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTien'] * $p1[0]['luonggiam'] / 100);
                                                        } elseif ($p1[0]['ID_loai'] == 3) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                        }
                                                    }  
                                                    $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $string_code1, $thanhtien);
                                                }
                                            } else {
                                                $thanhtien = $item['ThanhTien'] - $luonggiam[0]['luonggiam'];
                                                $this->giohang->CapNhatTT10($_SESSION['id_user'], $item['ID_sanpham'], $test_macode, $thanhtien);
                                            }
                                        } else {
                                            continue;
                                        }
                                    }    
                                }   
                            } elseif ($luonggiam[0]['trangthai'] == 0) {
                                $output = "Mã này đã hết hạn hoặc đã hết";
                            } else {
                                $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                            }
                    } else {
                        $output = "Không tồn tại mã giảm giá này hoặc đã hết hạn.";
                    }
                } else {
                    $output = "Không tồn tại mã giảm giá này hoặc đã hết hạn.";
                }
            } 
        } else {
            $giohang1 = $this->giohang->DanhSach();

            if (empty($macode)) {
                echo "<script>alert('Bạn chưa nhập mã code!');</script>";
            } else {
                foreach ($show as $item) {
                    if ($macode == $item['code']) {
                        $test_macode = $macode;
                        break;
                    } 
                }
                if (!empty($test_macode)) {
                    $luonggiam = $this->magiam->LuongGiam($test_macode);
                //    0: Không áp dụng code này cho các sản phẩm đang giảm giá, 1: Ngược lại  A: giá_km = 0;
                    $array1 = explode(",", $luonggiam[0]['id_sp']);
                    if ((int)$luonggiam[0]['ID_loai'] == 1) {
                        if ((int)$luonggiam[0]['trangthai'] != 0 && ((int)$tongtamtinh > (int)$luonggiam[0]['dieukientoithieu']) && ((int)$tongtamtinh < (int)$luonggiam[0]['dieukientoida'])) {
                            $output = "Áp dụng thành công";
                            if (isset($_SESSION['magiam_giohang']) && $_SESSION['magiam_giohang']['id_sudungcode'] == 1) {
                                unset($_SESSION['magiam_giohang']);
                            }
                            if ((int)$luonggiam[0]['id_sudungcode'] == 1 && (int)$luonggiam[0]['id_sanphamgiamgia'] == 1) {
                                foreach($giohang1 as $item) {
                                    if (in_array((int)$item['ID_sanpham'], $array1)) {
                                        $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                        $this->giohang->CapNhatTT14($item['ID_sanpham'], $test_macode, $thanhtien);
                                    } else {
                                        $this->giohang->CapNhatTT14($item['ID_sanpham'], "", 0);
                                    }
                                }      
                            } 
                            elseif ((int)$luonggiam[0]['id_sanphamgiamgia'] == 0) {   
                                $count = 0;
                                $count_giohang = count($giohang1);
                                foreach($giohang1 as $item) {
                                    $sanpham = $this->model->ChiTiet($item['ID_sanpham']);
                                    $gia_km = $sanpham[0]['GiaKhuyenMai'];
                                    if ((int)$gia_km == 0) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            if (($item['code_giam']) != "") {
                                                $array = explode(",", $item['code_giam']);
                                                $cohieu = 1;
                                                
                                                foreach($array as $item1) { 
                                                    if ($item1 == $test_macode) {
                                                        $cohieu = 0;        
                                                        break;  
                                                    }   
                                                }
            
                                                if ($cohieu == 0) {
                                                    $output = "Bạn đã sử dụng mã này rồi";
                                                } else {
                                                    $string_code1 = $item['code_giam'] .','. $test_macode;
                                                    $p = explode(",", $string_code1);
                                                    foreach ($p as $item1) {
                                                        $p1 = $this->magiam->LuongGiam($item1);
                                                        if ($p1[0]['ID_loai'] == 1) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTienCoMaGiam'] * $p1[0]['luonggiam'] / 100);
                                                        } elseif ($p1[0]['ID_loai'] == 3) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                        }
                                                    }  
                                                    $this->giohang->CapNhatTT14($item['ID_sanpham'], $string_code1, $thanhtien);
                                                }
                                            } else {
                                                $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                                $this->giohang->CapNhatTT14($item['ID_sanpham'], $test_macode, $thanhtien);
                                            }
                                        } else {
                                            continue;
                                        }
                                    } else {
                                        $count++;
                                    }
                                }   

                                if ($count == $count_giohang) {
                                    $output = "Mã giảm giá này không đ`ược dùng với sản phẩm đang được chọn";
                                } else {
                                    $output = "Áp dụng thành công";
                                }
                            } 
                            else {
                                foreach($giohang1 as $item) {    
                                    if (in_array((int)$item['ID_sanpham'], $array1)) {
                                        if (($item['code_giam']) != "") {
                                            $array = explode(",", $item['code_giam']);
                                            $cohieu = 1;
                                            
                                            foreach($array as $item1) { 
                                                if ($item1 == $test_macode) {
                                                    $cohieu = 0;        
                                                    break;  
                                                }   
                                            }
        
                                            if ($cohieu == 0) {
                                                $output = "Bạn đã sử dụng mã này rồi";
                                            } else {
                                                $string_code1 = $item['code_giam'] .','. $test_macode;
                                                $p = explode(",", $string_code1);
                                                foreach ($p as $item1) {
                                                    $p1 = $this->magiam->LuongGiam($item1);
                                                    if ($p1[0]['ID_loai'] == 1) {
                                                        $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTien'] * $p1[0]['luonggiam'] / 100);
                                                    } elseif ($p1[0]['ID_loai'] == 3) {
                                                        $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                    }
                                                }  
                                                $this->giohang->CapNhatTT14($item['ID_sanpham'], $string_code1, $thanhtien);
                                            }
                                        } else {
                                            $thanhtien = $item['ThanhTien'] - ($item['ThanhTien'] * $luonggiam[0]['luonggiam'] / 100);
                                            $this->giohang->CapNhatTT14( $item['ID_sanpham'], $test_macode, $thanhtien);
                                        }
                                    } else {
                                        continue;
                                    }
                                }      
                            }         
                        } elseif ($luonggiam[0]['trangthai'] == 0) {
                            $output = "Mã này đã hết hạn hoặc đã hết";
                        } else {
                            $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                        }
                    } elseif ($luonggiam[0]['ID_loai'] == 2) {
                        if ((int)$luonggiam[0]['trangthai'] != 0) {
                            $output = "Áp dụng thành công"; 
                            if ((int)$luonggiam[0]['id_sudungcode'] == 1) { //mã code này không được dùng chung mã code khác
                                foreach($giohang1 as $item) {
                                    $this->giohang->CapNhatTT14( $item['ID_sanpham'], "", 0);
                                }      
                            }
                            $flag = 0;
                            foreach ($giohang1 as $item1) {
                                if (in_array((int)$item['ID_sanpham'], $array1)) {
                                    $flag = 1;
                                    break;
                                }
                            }
                            if ($flag == 1) {
                                $_SESSION['magiam_giohang'] = [
                                    "ID_KH" => $_SESSION['id_user'],
                                    "code_giam" => $test_macode,
                                    "id_sudungcode" => $luonggiam[0]['id_sudungcode'],
                                    "Luonggiam" => $luonggiam[0]['luonggiam']
                                ]; 
                            } else {
                                unset($_SESSION['magiam_giohang']);
                            }
                        } elseif ($luonggiam[0]['trangthai'] == 0) {
                            $output = "Mã này đã hết hạn hoặc đã hết";
                        } else {
                            $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                        }
                    } elseif ($luonggiam[0]['ID_loai'] == 3) {
                            if ((int)$luonggiam[0]['trangthai'] != 0) {
                                $output = "Áp dụng thành công";
                                if (isset($_SESSION['magiam_giohang']) && $_SESSION['magiam_giohang']['id_sudungcode'] == 1) {
                                    unset($_SESSION['magiam_giohang']);
                                }
                                if ((int)$luonggiam[0]['id_sudungcode'] == 1) {
                                    foreach($giohang1 as $item) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            $thanhtien = $item['ThanhTien'] - $luonggiam[0]['luonggiam'];
                                            $this->giohang->CapNhatTT14( $item['ID_sanpham'], $test_macode, $thanhtien);
                                        } else {
                                            $this->giohang->CapNhatTT14( $item['ID_sanpham'], "", 0);
                                        }
                                    }      
                                } else {
                                    foreach($giohang1 as $item) {
                                        if (in_array((int)$item['ID_sanpham'], $array1)) {
                                            if ($item['code_giam'] != "") {
                                                $array = explode(",", $item['code_giam']);
                                                $cohieu = 1;
                                                foreach($array as $item1) { 
                                                    if ($item1 == $test_macode) {
                                                        $cohieu = 0;        
                                                        break;  
                                                    }
                                                }
            
                                                if ($cohieu == 0) {
                                                    $output = "Bạn đã sử dụng mã này rồi";
                                                } else {
                                                    $string_code1 = $item['code_giam'] .','. $test_macode;
                                                    $p = explode(",", $string_code1);
                                                    foreach ($p as $item1) {
                                                        $p1 = $this->magiam->LuongGiam($item1);
                                                        if ($p1[0]['ID_loai'] == 1) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - ($item['ThanhTien'] * $p1[0]['luonggiam'] / 100);
                                                        } elseif ($p1[0]['ID_loai'] == 3) {
                                                            $thanhtien = $item['ThanhTienCoMaGiam'] - $luonggiam[0]['luonggiam'];
                                                        }
                                                    }  
                                                    $this->giohang->CapNhatTT14($item['ID_sanpham'], $string_code1, $thanhtien);
                                                }
                                            } else {
                                                $thanhtien = $item['ThanhTien'] - (int)$luonggiam[0]['luonggiam'];
                                                $this->giohang->CapNhatTT14($item['ID_sanpham'], $test_macode, $thanhtien);
                                            }
                                        } else {
                                            continue;
                                        }
                                    }    
                                }   
                            } elseif ($luonggiam[0]['trangthai'] == 0) {
                                $output = "Mã này đã hết hạn hoặc đã hết";
                            } else {
                                $output = "Không đủ điều kiện áp dụng được mã này cho đơn hàng";
                            }
                    } else {
                        $output = "Không tồn tại mã giảm giá này hoặc đã hết hạn.";
                    }
                } else {
                    $output = "Không tồn tại mã giảm giá này hoặc đã hết hạn.";
                }
            } 
        }
        echo $output;
    }
   
}
