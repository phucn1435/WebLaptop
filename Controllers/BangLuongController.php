<?php
require_once 'Assets/__init__/__include__.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

class BangLuongController{
    private $model;
    private $db;
    private $nhanvien;
    private $chamcong;
    public function __construct(){
        $this->db = new Database();
        $this->sanpham = new SanPham();
        $this->loaisanpham = new LoaiSanPham();
        $this->trangthai = new TrangThai();

        $this->thongbao = new ThongBao();
        $this->nhanvien = new NhanVien();
        $this->chamcong = new ChamCong();
        $this->ctdh = new ChiTietDonHangBan();  
        $this->taikhoan = new TaiKhoanNhanVien();
    }

    public function ChiTiet() {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->chamcong->TongBangLuong();
        $totalPage = ceil($tongsp / $item1);
        $user_salary = $this->nhanvien->luong($item1,$offset);
        $notice_year = null;
        $notice_month = null;
        $year = $this->chamcong->Get_Year();
        $notice_all = null;
        
        if(isset($_GET['keyword'])) {
            $loc_l = $this->nhanvien->LocTest_Luong($_GET['keyword'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_l)) {
                $tong_l = count($loc_l);
                $totalPage = ceil($tong_l / $item1);
                $user_salary = $this->nhanvien->LocTest_Luong($_GET['keyword'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
            } else {
                $user_salary = null;
                $totalPage = 0;
            }
        }

        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->chamcong->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }

        $bangluong1 = $this->chamcong->test2();
        $bangluong2 = $this->chamcong->test3($_SESSION['dangnhap1']);

       
        // print_r($user_salary);
        
        // if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
        //     foreach($_POST['checkboxID'] as $checkbox) {
        //         $this->model->Xoa($checkbox);
        //     }
        //     header("Location: DanhSach");
        // }
        // $danhsach_test = $this->model->DanhSachMoi();
        // if (isset($_POST['export'])) {
        //     print_r($danhsach_test);
        // }

        
        //gọi và show dữ liệu ra view
        include("Views/BangLuong/ChiTiet.php");
        // return $result;
    }

    public function XemChiTiet() {
        $bangluong1 = $this->chamcong->test2();
        $bl = null;
        if (isset($_GET['BL'])) {
            if (!isset($_GET['id'])) {
                $bl = $_GET['BL'];
                $array_bl = explode("-", $bl);
                // print_r($array_bl);
                $result = array();

                foreach ($bangluong1 as $item) {
                    $key = $item['year'] . '-' . $item['month'];
                    if (!isset($result[$key])) {
                        $result[$key] = array(
                            'year' => $item['year'],
                            'month' => $item['month'],
                            'title' => "BL-" .$item['month'] ."-".$item['year'],
                            'data' => array()
                        );
                    }
                    $result[$key]['data'][] = array(
                        'ID_user' => $item['ID_user'],
                        'work_days' => $item['work_days']
                    );
                }

                // Chuyển kết quả thành mảng liên tục
                $result = array_values($result);

                // Hiển thị kết quả
                // foreach($result as $item1) {
                //     print_r($item1['data']);
                // }
                // print_r($result);
                // Biến để lưu trữ kết quả
                $filteredData = array();

                // Duyệt qua mảng và lọc dữ liệu
                foreach ($result as $item) {
                    if ($item["year"] == $array_bl[1] && $item["month"] == $array_bl[0]) {
                        $filteredData = $item["data"];
                        break; // Dừng vòng lặp khi tìm thấy phần tử phù hợp
                    }
                }

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $array_bl[0], $array_bl[1]);
                // print_r($daysInMonth);
                // In ra dữ liệu đã lọc được
                // print_r($filteredData);
            } else {
                $bl = $_GET['BL'];
                $array_bl = explode("-", $bl);
                // print_r($array_bl);
                $result = array();
                $bangluong2 = $this->chamcong->test3($_GET['id']);

                foreach ($bangluong2 as $item) {
                    $key = $item['year'] . '-' . $item['month'];
                    if (!isset($result1[$key])) {
                        $result1[$key] = array(
                            'year' => $item['year'],
                            'month' => $item['month'],
                            'title' => "BL-" .$item['month'] ."-".$item['year'],
                            'data' => array()
                        );
                    }
                    $result1[$key]['data'][] = array(
                        'ID_user' => $item['ID_user'],
                        'work_days' => $item['work_days']
                    );
                }

                // Chuyển kết quả thành mảng liên tục
                $result1 = array_values($result1);

                // Hiển thị kết quả
                // foreach($result as $item1) {
                //     print_r($item1['data']);
                // }
                // print_r($result);
                // Biến để lưu trữ kết quả
                $filteredData1 = array();

                // Duyệt qua mảng và lọc dữ liệu
                foreach ($result1 as $item) {
                    if ($item["year"] == $array_bl[1] && $item["month"] == $array_bl[0]) {
                        $filteredData1 = $item["data"];
                        break; // Dừng vòng lặp khi tìm thấy phần tử phù hợp
                    }
                }

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $array_bl[0], $array_bl[1]);
                // print_r($daysInMonth);
                // In ra dữ liệu đã lọc được
                // print_r($filteredData);
            }
        }
        include("Views/BangLuong/XemChiTiet.php");
    }

    
    public function DanhSach()
    {
        $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            //gọi method TimKiem bên Models
            $totalPage = 0;
            $result  = $this->model->TimKiem($id);
            if($_GET['id']==null){
                header('Location: ./DanhSach');
            }
        }
        else{
            $tongsp = $this->model->TongKhachHang();
            $totalPage = ceil($tongsp / $item);
            //gọi method DanhSach bên Models
            $result  = $this->model->GetData($item,$offset);
        }
        //gọi và show dữ liệu ra view
        include 'Views/KhachHang/DanhSach.php';
        return $result;
    }

    public function ThemMoi(){
        $create_at = Carbon::now()->toDateString();
        if (isset($_POST['submit'])) {
            $create = $this->model->ThemMoi($_POST['tenkhachhang'], $_POST['gioitinh']
            ,$_POST['ngaysinh'],$_POST['sodienthoai'],$_POST['email'],$_POST['diachi'],$create_at);
            if ($create) {
                header('Location: ./DanhSach');
            }
        }
        include 'Views/KhachHang/ThemMoi.php';
    }

    public function CapNhat(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'khachhang';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                $update = $this->model->CapNhat($id,$_POST['tenkhachhang'],
                                                    $_POST['gioitinh'],
                                                    $_POST['ngaysinh'],
                                                    $_POST['sodienthoai'],
                                                    $_POST['email'],
                                                    $_POST['diachi']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/KhachHang/CapNhat.php';
        return $dataUpdate;
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
}