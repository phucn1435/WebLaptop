<?php

require_once 'Assets/__init__/__include__.php';   

// include_once("Assets/mail/PHPMailer/PHPMailer-master/sendmail.php");

class General
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
    private $chamcong;

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
        $this->chamcong = new ChamCong();
    }

    public function Test() {
        return 1;
    }

    public function General() {
        
        $test = null;
        $test3 = null;
        $thongbao1 = null;
        $thongtin = null;
        if(isset($_SESSION['id_user'])) {
            $test3 = $this->giohang->DanhSach3($_SESSION['id_user']);
            $thongbao1 = $this->thongbao->DanhSach($_SESSION['id_user']);
            $thongtin = $this->taikhoan->ThongTinTaiKhoan($_SESSION['user']);
        } else {
            $test = $this->giohang->DanhSach();
        }

        return [
            'test3' => $test3,
            'thongbao1' => $thongbao1,
            'thongtin' => $thongtin,
            'test' => $test
        ];
    }

    public function Encrypt($title) {
        $options = [
            'cost' => 11
        ];
        $encrypt_pass = password_hash($title, PASSWORD_BCRYPT,$options);
        return $encrypt_pass;
    }   

}
