<?php
// include_once("Models/DonHangMua.php");
// include_once("Models/NguonHang.php");
// include_once("Models/NhanVien.php");
require_once 'Assets/__init__/__include__.php';   

class DonHangMuaController{
    private $model;
    private $db;
    private $nguonhang;
    private $nhanvienlap;
    private $thongbao;
    private $chamcong;
    private $trangthai;
    public function __construct(){
        $this->model = new DonHangMua();
        $this->db = new Database();
        $this->nguonhang = new NguonHang();
        $this->nhanvienlap = new NhanVien();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
        $this->trangthai = new TrangThai();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $ListNguonHang = $this->nguonhang->GetData(100,0);
        $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
        $ListTrangThai = $this->trangthai->TrangThaiMua();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 5;
        $current =!empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongDonHangMua();
        // if (isset($_POST['export_excel'])) {
        //     $now = time();
        //     $filePath = 'D:\Download\list_importOrders_export-' . $now . ".xlsx";
        //     $columnNames = ["importOrder_ID","Supplier_Name","Product_Brand","Product_Price","Product_PriceDiscount","Product_Quantity"]; // Tên các cột dữ liệu
        //     if (!isset($_GET['keyword'])) {
        //         // $filePath = "php://output";
        //         $data = $this->model->DanhSach(100, 0); // Lấy dữ liệu từ database
        //         // $filename = "danh_sach_san_pham";
        //         foreach($data as $item) {
        //             $array_data[] = [
        //                  $item['ID'], 
        //                  $item['TenSanPham'],
        //                  $item['TenLoaiSanPham'],
        //                  $item['Gia'],
        //                  $item['GiaKhuyenMai'],
        //                  $item['SoLuong']
        //             ];
        //         }
        //         $this->functions->exportExcel($array_data, $filePath, $columnNames);
        //     } else {
        //         $loc_sp = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['id_danhmuc'],$_GET['id_TTLSP'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$tong_sp,0);
        //         foreach($loc_sp as $item) {
        //             $array_data[] = [
        //                 $item['ID'], 
        //                 $item['TenSanPham'],
        //                 $item['TenLoaiSanPham'],
        //                 $item['Gia'],
        //                 $item['GiaKhuyenMai'],
        //                 $item['SoLuong']
        //             ];
        //         }
        //         $this->functions->exportExcel($array_data, $filePath, $columnNames);  
        //     }
        // }
        if($tongsp > 0) {
            $_SESSION['tongdonhangmua'] = $tongsp;
        } else {
            unset($_SESSION['tongdonhangmua']);
        }            
        $totalPage = ceil($tongsp / $item1);
        //gọi method GetData mở Models DonHangMua.php
        $result = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_dhm = $this->model->LocTest($_GET['keyword'],$_GET['id_nguonhang'],$_GET['id_TTHD'],$_GET['id_NVL'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            // $loc_sp = $this->model->LocTest($_GET['keyword'], $_GET['trangthai'], $_GET['from_date'], $_GET['to_date'], $tonglsp,0);
            if (!empty($loc_dhm)) {
                $tongdhm = count($loc_dhm);
                $totalPage = ceil($tongdhm / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['id_nguonhang'],$_GET['id_TTHD'],$_GET['id_NVL'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
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
        include 'Views/DonHangMua/DanhSach.php';
        return $result;
    }
    
    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert = "";
        $ListNguonHang = $this->nguonhang->GetData(100,0);
        $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
        if (isset($_POST['submit'])) {
            if(empty($_POST['idnguonhang']) || empty($_POST['idnhanvienlap'])){
                $alert="<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống id nhân viên lập hoặc nguồn hàng!</span>";
            }else {
                $create = $this->model->ThemMoi($_POST['idnhanvienlap'], $_POST['idnguonhang']);
                if ($create) {
                    header('Location: ./DanhSach');
                }
            }
        }
        include 'Views/DonHangMua/ThemMoi.php';
        return Array($ListNguonHang,$ListNhanVien);
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert = "";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'donhangmua';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            $ListNguonHang = $this->nguonhang->GetData(100,0);
            $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
            if (isset($_POST['submit'])) {
                if(empty($_POST['idnguonhang']) || empty($_POST['idnhanvienlap'])){
                    $alert="<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống id nhân viên lập và nguồn hàng!</span>";
                }else if(!is_numeric($_POST['idnguonhang']) || !is_numeric($_POST['idnhanvienlap'])){
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>id nhân viên và nguồn hàng bắt buộc phải là số!</span>";
                }else{
                $update = $this->model->CapNhat($id,$_POST['idnhanvienlap'],
                                                    $_POST['idnguonhang']
                                                   );
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }
            }
        }
        include 'Views/DonHangMua/CapNhat.php';
        return Array($dataUpdate,$ListNguonHang,$ListNhanVien);
    }

    public function Xoa(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }
}