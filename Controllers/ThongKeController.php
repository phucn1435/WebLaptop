<?php
// include_once("Models/SanPham.php");
// include_once("Models/DonHangBan.php");
// include_once("Models/DonHangMua.php");
// include_once("Models/loginKhachHang.php");
// include_once("General.php");
// include_once("Assets/Carbon/autoload.php");
require_once 'Assets/__init__/__include__.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

class ThongKeController{
    private $sanpham;
    private $donhangban;
    private $db;
    private $donhangmua;
    private $login;
    private $general;
    private $thongbao;
    private $chamcong;
    private $whistlist;

    public function __construct(){
        $this->sanpham = new SanPham();
        $this->donhangban = new DonHangBan();
        $this->db = new Database();
        $this->donhangmua = new DonHangMua();
        $this->login = new loginKhachHang();
        $this->general = new General();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
        $this->whistlist = new WhistList();
    }

    // function test10() {
    //     // Thực hiện xử lý dữ liệu và trả về kết quả
    //     // Ví dụ: Query cơ sở dữ liệu, tính toán, ...
    //     $result = $_POST['year1'];
    //     //     echo $test;
    //     return $result;
    // }

    public function testchitiet() {
        if (isset($_POST['selectYear'])) {
            echo "<script>alert(1);</script>";
        }
    }

    public function ChiTiet(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $tongluotnam = null;
        $tongnguoinam = null;
        $tongnguoingay = null;
        $tongluotngay = null;
        $title = null;
        $hi1 = null;
        $hi2 = null;
        $khoangNam = $this->login->khoangNam();
        if (isset($_POST['selectYear'])) {
            $tongluotnam = $this->login->tongluottruycaptheonam($_POST['year']);
            $tongnguoinam = $this->login->tongnguoitruycaptheonam($_POST['year']);
            $tongnguoingay = $this->login->tongnguoitruycaptheongay($_POST['year'],$_POST['year1']);
            $tongluotngay = $this->login->tongluottruycaptheongay($_POST['year'],$_POST['year1']);
            if ($_POST['year1'] != 0 && $_POST['year'] != 0) {
                $title = "vào tháng " .$_POST['year1']. " - " .$_POST['year'];
            } else {
                $title = "vào năm " .$_POST['year'];
            }
        }
        $dataPoints = array();
        $thongke_whistlist = $this->whistlist->ThongKe();
        foreach($thongke_whistlist as $item) {
            $dataPoints[] = array("label"=> $item['TenSanPham'], "y"=> $item['count']);
            
        }
        $tongsanpham= $this->sanpham->TongSanPham();
        $tongdonhangban = $this->donhangban->TongDonHangBan();
        $tongtiendonhangban = $this->donhangban->DoanhThuDonHangBan();

        $thongkedonhangban = $this->donhangban->ThongKeDonHangBan();
       
        $hangtheongay = $this->donhangban->DonHangTheoNgay();
        $tongdonhangbanhuy = $this->donhangban->TongDonHangBanHuy();
        $tongdonhangbantc = $this->donhangban->TongDonHangBanThanhCong();

        $tongtiendonhangmua = $this->donhangmua->DoanhThuDonHangMua();

        // Thống kê truy cập
        $thongketruycap1 = $this->login->TongTruyCap();
        $thongketruycaptheonam = $this->login->TongTruyCapCacNam();

        $luottruycap1 = $this->login->tongluottruycap();
        $nguoitruycap1 = $this->login->tongnguoitruycap(); 

        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $thongke = $this->login->tongluottruycaptheonam($subdays,$now);
        $char_data = array();
        foreach($thongke as $item) {
            $char_data[] = array(
                'date' => $item['ngaytruycap'],
                'nguoitc' => $item['tongnguoi'],
                'luottc' => $item['tongphien']
            );
        }

        include 'Views/ThongKe/testchitiet.php';
        return array($tongsanpham,$tongdonhangban,$tongtiendonhangban,$thongkedonhangban,$tongtiendonhangmua,$thongketruycap1,
        $tongdonhangbanhuy,$tongdonhangbantc,$hangtheongay,$thongketruycaptheonam);
    }

    public function xuli_thongke() {
        if (isset($_POST['thoigian'])) {
            $thoigian = $_POST['thoigian'];
        } else {
            $thoigian = "";
        }


        if ($thoigian == 0) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        } elseif ($thoigian == 1) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
        } else {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $thongke = $this->login->tongluottruycaptheonam($subdays,$now);
        $char_data = array();
        foreach($thongke as $item) {
            $char_data[] = array(
                'date' => $item['ngaytruycap'],
                'nguoitc' => $item['ID'],
                'luottc' => $item['luottruycap']
            );
        }
        
        if (count($char_data) > 0) {
            echo $data = json_encode($char_data);
        } else {
            echo $data = [];
        }  
    }

    public function get_days(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy giá trị tháng từ yêu cầu Ajax
            $selectedMonth = $_POST['month'];
        
            // Tính số ngày trong tháng
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date('Y'));
        
            // Tạo danh sách các ngày
            $options = '';
            $options .= "<option value='0'>Select Day</option>";
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $options .= "<option value='$day'>$day</option>";
            }
        
            // Trả về danh sách ngày dưới dạng HTML
            echo $options;
        }
    }

    public function test10 () {
        $test = $_POST['year1'];
        echo $test;
    }

    
    

    // Thống kê truy cập
    public function ajax(){
        // $thongke truycap = $this->login->koko();
        // $thongketruycap1 = $this->login->koko1();
        // $thongketruycap2 = $this->login->koko2();
        $thongketruycap1 = $this->login->TongTruyCap(); 

        include("Views/ThongKe/get_chart_data.php");
        return array($thongketruycap1);
    }

    public function LuotTruyCapTheoNgay() {
        include("Views/ThongKe/LuotTruyCapTheoNgay.php");
    }
}