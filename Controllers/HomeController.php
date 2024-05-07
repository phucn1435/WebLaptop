<?php

require_once 'Assets/__init__/__include__.php';   

use Carbon\Carbon;
use Carbon\CarbonInterval;
class HomeController{
    private $model;
    private $donhangban;
    private $sanpham;
    private $db;
    private $khachhang;
    private $login;
    private $thongbao;
    private $chamcong;
    private $whistlist;
    private $functions;

    public function __construct(){
        $this->model        = new ChiTietDonHangBan();
        $this->db           = new Database();
        $this->donhangban   = new DonHangBan();
        $this->sanpham      = new SanPham();
        $this->khachhang    = new KhachHang();
        $this->login        = new loginKhachHang();
        $this->chamcong     = new ChamCong();
        $this->thongbao     = new ThongBao();
        $this->whistlist    = new WhistList();
        $this->functions    = new Functions();
    }

    public function TrangChu()
    {
    
        $sp_dangban = ($this->sanpham->DanhSachActive());
        if (!empty($sp_dangban)) {
            $sp_dangban = count($sp_dangban);
        } else {
            $sp_dangban = 0;
        }

        $donhangthanhcong1 = $this->donhangban->donhangthanhcong1();
        $donhanghuy1 = $this->donhangban->donhanghuy1();

        $doanhthu = $this->donhangban->DoanhThu7Ngay();
        $sodonhangnhan = $this->donhangban->SoDonHangDaNhan()[0]['sum'];
        $sodonhangthanhcong = $this->donhangban->SoDonHangThanhCong()[0]['sum'];
        $sodonhangdangxuli = $this->donhangban->SoDonHangDangXuLi()[0]['sum'];
        $sodonhangdangvanchuyen = $this->donhangban->SoDonHangDangVanChuyen()[0]['sum'];
        $sodonhangdahuy = $this->donhangban->SoDonHangDaHuy()[0]['sum'];
        $donhangmoi = $this->donhangban->DanhSachDonHangMoi(100,0);
        $khachhangthang = $this->khachhang->KhachHangThang();
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // print_r($donhangmoi);
        $dataPoints1 = array();
        $thongke_whistlist = $this->whistlist->ThongKe();
        foreach($thongke_whistlist ?? [] as $item) {
            $dataPoints1[] = array("label"=> $item['TenSanPham'], "y"=> $item['count']); 
        }

        $count_kh = 0;
        $count_donhang = 0;
        $tongtien = 0;
        if (isset($donhangmoi)) {
            $count_donhang = count($donhangmoi);
            foreach($donhangmoi as $item) {
                $tongtien += $item['TongTien'];
            }
        }

        if (isset($khachhangthang)) {
            $count_kh = count($khachhangthang);
        }
        
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $thongke = $this->donhangban->thongkedoanhthu($subdays,$now);
        $char_data = array();
        foreach($thongke as $item) {
            $char_data[] = array(
                'date' => $item['NgayLap'],
                'doanhthu' => $item['doanhthu']
                
            );
        }

        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();


        $thongke_dh = $this->donhangban->ThongKe_DonHang($subdays,$now);
        $count = 0;
      
        if (isset($_POST['export_excel_1'])) {
            $now = time();
            $filePath = 'D:\Download\statistics_export-' . $now . ".xlsx";
            $columnNames = ["Title","Data"];

           
            $array_data = [
                [
                    "Sản phẩm đang bán",
                    $sp_dangban
                ],
                [
                    "Số đơn hàng mới",
                    $count_donhang .'/ngày'
                ],
                [
                    "Số khách hàng mới",
                    $count_kh .'/tháng'
                ],
                [
                    "Doanh thu hôm nay",
                    $tongtien .'/ngày'
                ]
            ];
            
            $this->functions->exportExcel($array_data, $filePath, $columnNames);
        }

        if (isset($_POST['export_excel_2'])) {
            $option = $_POST['koko1'];
            if ($option == 0) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            } elseif ($option == 1) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
            } elseif ($option == 2) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
            } else {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
            }
    
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
            $thongke = $this->donhangban->thongkedoanhthu($subdays,$now);
            foreach($thongke as $item) {
                $array_data[] = array(
                    'date' => $item['NgayLap'],
                    'doanhthu' => $item['doanhthu']
                );
            }
            // print_r($array_data);
            $now = time();
            $filePath = 'D:\Download\statistics_sales_export_' . $now . ".xlsx";
            $columnNames = ["Date","Sales"];
            $this->functions->exportExcel($array_data, $filePath, $columnNames);
        }
        
        if (isset($_POST['export_excel_3'])) {
            $option = $_POST['koko2'];
            if ($option == 0) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            } elseif ($option == 1) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
            } elseif ($option == 2) {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
            } else {
                $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
            }
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

            // $thongke = $this->donhangban->thongkedoanhthu($subdays,$now);
            $thongke = $this->donhangban->ThongKe_DonHang($subdays,$now);

            foreach($thongke as $item) {
                $count_ctt = ($this->donhangban->ThongKe_DonHangChuaThanhToan($item['NgayLap']));    
                $count_dtt = ($this->donhangban->ThongKe_DonHangDaThanhToan($item['NgayLap']));
                $count_dn = ($this->donhangban->ThongKe_DonHangDaNhan($item['NgayLap']));
                $count_ht = ($this->donhangban->ThongKe_DonHangHoanThanh($item['NgayLap']));
                $count_dh = ($this->donhangban->ThongKe_DonHangDaHuy($item['NgayLap']));
                $count_dxl = ($this->donhangban->ThongKe_DonHangDangXuLi($item['NgayLap']));
                $count_dvc = ($this->donhangban->ThongKe_DonHangDangVanChuyen($item['NgayLap']));
    
                if (isset($count_ctt)) {
                    $count_1 = $count_ctt[0]['count'];
                } else {
                    $count_1 = 0;
                }
    
                if (isset($count_dtt)) {
                    $count_2 = $count_dtt[0]['count'];
                } else {
                    $count_2 = 0;
                }
    
                if (isset($count_dn)) {
                    $count_3 = $count_dn[0]['count'];
                } else {
                    $count_3 = 0;
                }
    
                if (isset($count_ht)) {
                    $count_4 = $count_ht[0]['count'];
                } else {
                    $count_4 = 0;
                }
    
                if (isset($count_dh)) {
                    $count_5 = $count_dh[0]['count'];
                } else {
                    $count_5 = 0;
                }
    
                if (isset($count_dxl)) {
                    $count_6 = $count_dxl[0]['count'];
                } else {
                    $count_6 = 0;
                }
    
                if (isset($count_dvc)) {
                    $count_7 = $count_dvc[0]['count'];
                } else {
                    $count_7 = 0;
                }
                $array_data[] = array(
                    'date' => $item['NgayLap'],
                    'count_ctt' => $count_1,
                    'count_dtt' => $count_2,
                    'count_dn' => $count_3,
                    'count_ht' => $count_4,
                    'count_dh' => $count_5,
                    'count_dxl' => $count_6,
                    'count_dvc' => $count_7
                );
            }  
            $now = time();
            $filePath = 'D:\Download\statistics_statusBill_export_' . $now . ".xlsx";
            $columnNames = ["Date","Đơn hàng chưa thanh toán","Đơn hàng đã thanh toán","Đơn hàng đã nhận","Đơn hàng đã hoàn thành",
            "Đơn hàng đã hủy","Đơn hàng đang xử lí","Đơn hàng đang vận chuyển"];
            $this->functions->exportExcel($array_data, $filePath, $columnNames);  
        }


        
        if (isset($_SESSION['dangnhap'])) {
            include("Views/Layout/Dashboard.php"); 
            // include("Views/ThongKe/chitiet.php");
        } else {
            header("Location: ./Login");
        }
    }

    public function xuli_thongkedonhang() {
        if (isset($_POST['thoigian'])) {
            $thoigian = $_POST['thoigian'];
        } else {
            $thoigian = "";
        }

        if ($thoigian == 0) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        } elseif ($thoigian == 1) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
        } elseif ($thoigian == 2) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
        } else {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        // $thongke = $this->donhangban->thongkedoanhthu($subdays,$now);
        $thongke = $this->donhangban->ThongKe_DonHang($subdays,$now);

        
        
        $char_data = array();
        foreach($thongke as $item) {
            $count_ctt = ($this->donhangban->ThongKe_DonHangChuaThanhToan($item['NgayLap']));    
            $count_dtt = ($this->donhangban->ThongKe_DonHangDaThanhToan($item['NgayLap']));
            $count_dn = ($this->donhangban->ThongKe_DonHangDaNhan($item['NgayLap']));
            $count_ht = ($this->donhangban->ThongKe_DonHangHoanThanh($item['NgayLap']));
            $count_dh = ($this->donhangban->ThongKe_DonHangDaHuy($item['NgayLap']));
            $count_dxl = ($this->donhangban->ThongKe_DonHangDangXuLi($item['NgayLap']));
            $count_dvc = ($this->donhangban->ThongKe_DonHangDangVanChuyen($item['NgayLap']));

            if (isset($count_ctt)) {
                $count_1 = $count_ctt[0]['count'];
            } else {
                $count_1 = 0;
            }

            if (isset($count_dtt)) {
                $count_2 = $count_dtt[0]['count'];
            } else {
                $count_2 = 0;
            }

            if (isset($count_dn)) {
                $count_3 = $count_dn[0]['count'];
            } else {
                $count_3 = 0;
            }

            if (isset($count_ht)) {
                $count_4 = $count_ht[0]['count'];
            } else {
                $count_4 = 0;
            }

            if (isset($count_dh)) {
                $count_5 = $count_dh[0]['count'];
            } else {
                $count_5 = 0;
            }

            if (isset($count_dxl)) {
                $count_6 = $count_dxl[0]['count'];
            } else {
                $count_6 = 0;
            }

            if (isset($count_dvc)) {
                $count_7 = $count_dvc[0]['count'];
            } else {
                $count_7 = 0;
            }
            $char_data[] = array(
                'date' => $item['NgayLap'],
                'count_ctt' => $count_1,
                'count_dtt' => $count_2,
                'count_dn' => $count_3,
                'count_ht' => $count_4,
                'count_dh' => $count_5,
                'count_dxl' => $count_6,
                'count_dvc' => $count_7
            );
        }
        
        if (count($char_data) > 0) {
            echo $data = json_encode($char_data);
        } else {
            echo $data = [];
        }  
    }

    public function xuli_doanhthu() {
        if (isset($_POST['thoigian'])) {
            $thoigian = $_POST['thoigian'];
        } else {
            $thoigian = "";
        }

        if ($thoigian == 0) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        } elseif ($thoigian == 1) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
        } elseif ($thoigian == 2) {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
        } else {
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $thongke = $this->donhangban->thongkedoanhthu($subdays,$now);
      
        $char_data = array();
        foreach($thongke as $item) {
            $char_data[] = array(
                'date' => $item['NgayLap'],
                'doanhthu' => $item['doanhthu']
            );
        }
        
        if (count($char_data) > 0) {
            echo $data = json_encode($char_data);
        } else {
            echo $data = [];
        }  
    }

    public function Login() {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        include("Views/Log/login.php");
    } 

    public function returnHome() {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        unset($_SESSION['email']);
        header("Location: ./Login");
    }
    
    public function Logout() {
        unset($_SESSION['dangnhap']);
        header("Location: ./Login");    
    }
  
    public function pageForgot(){
        include("Views/Log/forgotPassword.php");
    }

    public function forgotPassword(){
        header("Location: ./pageForgot");
    }   

    public function pageShowPw(){
        include("Views/Log/showPassword.php");
    }

    public function showPw(){
        header("Location: ./pageShowPw");
    }
    
}
?>