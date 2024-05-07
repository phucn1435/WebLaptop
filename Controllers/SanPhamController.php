<?php
require_once 'Assets/__init__/__include__.php';

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

    require_once dirname(__FILE__) . '/../Assets/Classes/PHPExcel.php';

class SanPhamController{
    private $model;
    private $loaisanpham;
    private $db;
    private $trangthai;
    private $thongbao;
    private $nhanvien;
    private $chamcong;
    private $general;
    private $thuoctinhsanpham;
    private $functions;
    
    public function __construct() {
        $this->model        = new SanPham();
        $this->loaisanpham  = new LoaiSanPham();
        $this->trangthai    = new TrangThai();
        $this->thongbao     = new ThongBao();
        $this->nhanvien     = new NhanVien();
        $this->chamcong     = new ChamCong();
        $this->ctdh         = new ChiTietDonHangBan();
        $this->general      = new General();
        $this->thuoctinh    = new ThuocTinhSanPham(); 
        $this->functions    = new Functions();
    }
    
    public function DanhSach()
    {
        $tongsp = $this->model->TongSanPham();
        if (isset($_POST['export_excel'])) {
            $now = time();
            $filePath = 'D:\Download\list_product_export-' . $now . ".xlsx";
            $columnNames = ["Product_ID","Product_Name","Product_Brand","Product_Price","Product_PriceDiscount","Product_Quantity"]; // Tên các cột dữ liệu
            if (!isset($_GET['keyword'])) {
                // $filePath = "php://output";
                $data = $this->model->DanhSach(100, 0); // Lấy dữ liệu từ database
                // $filename = "danh_sach_san_pham";
                foreach($data as $item) {
                    $array_data[] = [
                         $item['ID'], 
                         $item['TenSanPham'],
                         $item['TenLoaiSanPham'],
                         $item['Gia'],
                         $item['GiaKhuyenMai'],
                         $item['SoLuong']
                    ];
                }
                $this->functions->exportExcel($array_data, $filePath, $columnNames);
            } else {
                $loc_sp = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['id_danhmuc'],$_GET['id_TTLSP'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$tong_sp,0);
                foreach($loc_sp as $item) {
                    $array_data[] = [
                        $item['ID'], 
                        $item['TenSanPham'],
                        $item['TenLoaiSanPham'],
                        $item['Gia'],
                        $item['GiaKhuyenMai'],
                        $item['SoLuong']
                    ];
                }
                $this->functions->exportExcel($array_data, $filePath, $columnNames);  
            }
        }

        $i = 0;
        $data = [
            [
                "ID"            => ++$i,
                "color"         => "bạc",
                "core"          => "i5",
                "ram"           => "8GB",
                "rom"           => "256GB",
                "price_ori"     => 21000000,
                "price_dis"     => 20000000
            ],
            [
                "ID"            => ++$i,
                "color"         => "bạc",
                "core"          => "i7",
                "ram"           => "8GB",
                "rom"           => "256GB",
                "price_ori"     => 22000000,
                "price_dis"     => 21000000
            ],
            [
                "ID"            => ++$i,
                "color"         => "bạc",
                "core"          => "i3",
                "ram"           => "8GB",
                "rom"           => "256GB",
                "price_ori"     => 22500000,
                "price_dis"     => 21000000
            ]
        ];
        $json_data = json_encode($data);
       
        // foreach($json_decode as $item) {
        //     print_r($item['color']);
        // }

        $this->model->UpdateTT(39,$json_data);
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // print_r($this->general->Test());
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 5;
        // $item1 = 6;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $loaisanpham = $this->loaisanpham->DanhSach(100,0);
        $trangthaisanpham = $this->trangthai->DanhSach(100,0);
        $totalPage = ceil($tongsp / $item1);
        //gọi method DanhSach bên Models
        $result  = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_sp = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['id_danhmuc'],$_GET['id_TTLSP'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_sp)) {
                $tong_sp = count($loc_sp);
                $totalPage = ceil($tong_sp / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['trangthai'],$_GET['id_danhmuc'],$_GET['id_TTLSP'],$_GET['price_min'],$_GET['price_max'],$_GET['from_date'],$_GET['to_date'],$item1,$offset);
            } else {
                $result = null;
                $totalPage = 0;
            } 

            
            //gọi method DanhSach bên Models
        }


        // if (isset($_POST['excel'])) {
        //     $test_sanpham = $this->model->DanhSachMoi();
        //     include("Views/SanPham/xuli.php");
        //     // Create new PHPExcel object
        //     // $objPHPExcel = new PHPExcel;
        //     // $objPHPExcel->setActiveSheetIndex(0);
        //     // $sheet = $objPHPExcel->getActiveSheet()->setTitle('Simple');
        //     // $i = 1;
        //     // $sheet->setCellValue('A'.$i,'TenSanPham');
        //     // $sheet->setCellValue('B'.$i,'SoLuong');
        //     // $sheet->setCellValue('C'.$i,'Gia');
            
        //     // foreach($test_sanpham as $item) {
        //     //     $i++;
        //     //     $sheet->setCellValue('A'.$i, $item['TenSanPham']);
        //     //     $sheet->setCellValue('B'.$i, $item['SoLuong']);
        //     //     $sheet->setCellValue('C'.$i, $item['Gia']);
        //     // }

        //     // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //     // $file_name = 'export.Xlsx';
        //     // $objWriter->save($file_name);

        //     // header('Content-Disposition: attachment; filename="' . $file_name . '"');
        //     // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //     // header('Content-Length: ' . filesize($file_name));
        //     // header('Content-Transfer-Encoding: binary');
        //     // header('Cache-Control: must-revalidate');
        //     // header('Pragma: no-cache');
        //     // header('Cache-Control: max-age=0'); 
        //     // readfile($file_name);
        //     // return;
            
            
        // }

        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        // $danhsach_test = $this->model->DanhSachMoi();
        // if (isset($_POST['export'])) {
        //     print_r($danhsach_test);
        // }
        //gọi và show dữ liệu ra view
        include("Views/SanPham/DanhSach.php");
        return $result; 
    }

    public function ChiTiet(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $detail = $this->model->ChiTiet($id);
        }
        require_once('Views/SanPham/ChiTiet.php');
        return $detail;
    }

    public function process_option_id() {
        if (isset($_POST['optionId'])) {
            $selectedId = $_POST['optionId'];
        
            // Replace with your actual logic to fetch and process data based on $selectedId
            // This could involve database access, calculations, etc.
            $attributeData = [
            "Thuộc tính 1" => "Giá trị 1",
            "Thuộc tính 2" => "Giá trị 2",
            "Thuộc tính 3" => "Giá trị 3",
            // Add more attributes and values as needed
            ];
        
            // Convert attribute data to HTML format
            $attributeHTML = "<ul>";
            foreach ($attributeData as $key => $value) {
            $attributeHTML .= "<li>" . $key . ": " . $value . "</li>";
            }
            $attributeHTML .= "</ul>";
        
            echo $selectedId; // Send the HTML-formatted attribute data back to the JavaScript
        } else {
            echo "Error: No option ID received";
        }
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        // if (isset($_POST['Luu'])) {
        //     print_r($_POST['tenthuoctinh']);
        // }
        $att = [];
        $val = [];
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     $attributes = $_POST["attribute"];
        //     $values = $_POST["value"];
        
        //     // Lưu các thuộc tính và giá trị vào cơ sở dữ liệu hoặc thực hiện các hành động khác ở đây.
        //     // Ví dụ:
        //     foreach ($attributes as $index => $attribute) {
        //         $value = $values[$index];
        //         // Thực hiện lưu dữ liệu vào cơ sở dữ liệu
        //         // echo "Attribute: $attribute, Value: $value<br>";
        //         $att[] = $attribute;
        //         $val[] = $value;
        //     }
        // }

        $combined = [];
        $id = 1; // Bắt đầu ID từ 1

        foreach ($att as $size) {
            foreach ($val as $color) {
                $combined[] = ['id' => $id, 'size' => $size, 'color' => $color];
                $id++; // Tăng ID sau khi thêm một phần tử vào mảng
            }
        }

        // Chuyển đổi mảng thành chuỗi JSON
        $json_string = json_encode($combined);

        // Hiển thị chuỗi JSON
        // echo $json_string;


        $result = $this->loaisanpham->DanhSach(100,0);
        $error = null;
        $trangthaisanpham = $this->trangthai->DanhSach(100,0);
        $list_ttsp = $this->thuoctinh->DanhSach();
        if (isset($_POST['submit'])) {

            // $file_name = $_FILES['hinhanh']['name'];
            $file_tmp = $_FILES['hinhanh']['tmp_name'];
            $file_parts =explode('.',$_FILES['hinhanh']['name']);
            $file_ext = strtolower(end($file_parts));
            $file_name = time(). "-product." .$file_ext;
            $expensions= array("jpeg","jpg","png");
            $file_size = $_FILES['hinhanh']['size'];

            if(in_array($file_ext,$expensions) === false) {
                $error = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
            }else if($file_size > 2097152) {
                $error='Kích thước file không được lớn hơn 2MB';
            } else {
                move_uploaded_file($file_tmp,"Assets/data/Hinhanhsanpham/".$file_name);
                $date = date("Y-m-d H:i:s");
                $create = $this->model->ThemMoi($_POST['idloaisanpham'],
                                            $_POST['tensanpham'],
                                            $_POST['gia'],
                                            $_POST['giakhuyenmai'],
                                            $_POST['ngaybatdau'],
                                            $_POST['ngayketthuc'],
                                            $_POST['mota'],
                                            $_POST['soluong'],
                                            $file_name, $_POST['trangthaisp'],$_POST['trangthai']);
                if ($create) {
                    header('Location: ./DanhSach');
                }
            }
            
        }
        require_once('Views/SanPham/ThemMoi.php');
        return $result;
       
    }
    
    
    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $trangthaisanpham = $this->trangthai->DanhSach(100,0);
        $result  = $this->loaisanpham->DanhSach(100,0);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {

                $update = $this->model->CapNhat($id,$_POST['idloaisanpham'],
                                                    $_POST['tensanpham'],
                                                    $_POST['gia'],
                                                    $_POST['giakhuyenmai'],
                                                    $_POST['mota'],
                                                    $_POST['soluong'],
                                                    $_POST['trangthaisp'],
                                                    $_POST['trangthai']);

                if ($update) {
                    header('Location: ./DanhSach');
                }
            }            
        }
        include 'Views/SanPham/CapNhat.php';
        return array($result,$dataUpdate);
    }
    
    public function CapNhatHinhAnh(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {
                $file_name = $_FILES['hinhanh']['name'];
                $file_tmp = $_FILES['hinhanh']['tmp_name'];
               
                move_uploaded_file($file_tmp,"Assets/data/HinhAnhSanPham/".$file_name);
                $update = $this->model->CapNhatHinhAnh($id,$_FILES['hinhanh']['name']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
            }            
        }
        include 'Views/SanPham/CapNhatHinhAnh.php';
        return array($dataUpdate);
    }

    public function Xoa(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $chitiet = $this->model->ChiTiet($id)[0]['HinhAnh'];
            unlink("Assets/data/Hinhanhsanpham/".$chitiet);
            $delete = $this->model->Xoa($id);
            if ($delete) {
                header('Location: ./DanhSach');
            }
        }
    }
    public function InSanPham(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        include 'Views/SanPham/InSanPham.php';
    }
}


