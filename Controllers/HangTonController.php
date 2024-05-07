<?php
// include_once("Models/SanPham.php");
include_once("Models/HangTon.php");
include_once("Models/LoaiSanPham.php");
// include_once("Assets/Spreadsheet/Spreadsheet.php");
// include_once("Assets/Spreadsheet/Writer/Xlsx.php");
// include_once("Assets/Spreadsheet/Writer/BaseWriter.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

    require_once dirname(__FILE__) . '/../Assets/Classes/PHPExcel.php';


class HangTonController{
    private $model;
    private $loaisanpham;
    private $db;
    
    public function __construct(){
        $this->model = new HangTon();
        $this->loaisanpham = new LoaiSanPham();
        $this->db = new Database();
    }
    
    public function DanhSach()
    {
        $item = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item;
        
        if(isset($_GET['tensanpham'])) {
            $tensanpham = $_GET['tensanpham'];
            //gọi method TimKiem bên Models
            $tongsp = $this->model->TongSanPhamTim($tensanpham);
            $totalPage = ceil($tongsp / $item);
            $result  = $this->model->TimKiem($tensanpham);
            
            if($_GET['tensanpham']==null){
                header('Location: ./DanhSach');
            }
        }
        else{
            $tongsp = $this->model->TongSanPham();
            $totalPage = ceil($tongsp / $item);
            //gọi method DanhSach bên Models
            $result  = $this->model->DanhSach($item,$offset);
            
        }

        if (isset($_POST['excel'])) {
            $test_sanpham = $this->model->DanhSachMoi();
            include("Views/SanPham/xuli.php");
            // Create new PHPExcel object
            // $objPHPExcel = new PHPExcel;
            // $objPHPExcel->setActiveSheetIndex(0);
            // $sheet = $objPHPExcel->getActiveSheet()->setTitle('Simple');
            // $i = 1;
            // $sheet->setCellValue('A'.$i,'TenSanPham');
            // $sheet->setCellValue('B'.$i,'SoLuong');
            // $sheet->setCellValue('C'.$i,'Gia');
            
            // foreach($test_sanpham as $item) {
            //     $i++;
            //     $sheet->setCellValue('A'.$i, $item['TenSanPham']);
            //     $sheet->setCellValue('B'.$i, $item['SoLuong']);
            //     $sheet->setCellValue('C'.$i, $item['Gia']);
            // }

            // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            // $file_name = 'export.Xlsx';
            // $objWriter->save($file_name);

            // header('Content-Disposition: attachment; filename="' . $file_name . '"');
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Length: ' . filesize($file_name));
            // header('Content-Transfer-Encoding: binary');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: no-cache');
            // header('Cache-Control: max-age=0'); 
            // readfile($file_name);
            // return;
        }

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
        include("Views/HangTon/DanhSach.php");
        return $result; 
    }

    public function ChiTiet(){
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $detail = $this->model->ChiTiet($id);
        }
        require_once('Views/SanPham/ChiTiet.php');
        return $detail;
    }

    public function ThemMoi(){
        $result = $this->loaisanpham->DanhSach(100,0);
        $error = null;
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
                                            $date, $file_name,$_POST['trangthai']);
                if ($create) {
                    header('Location: ./DanhSach');
                }
            }
            
        }
        require_once('Views/SanPham/ThemMoi.php');
        return $result;
       
    }
    
    
    public function CapNhat(){
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
                                                    $_POST['ngaysanxuat'],
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
        include 'Views/SanPham/InSanPham.php';
    }
}


