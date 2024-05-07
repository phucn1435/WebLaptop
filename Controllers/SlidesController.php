<?php
// include_once("Models/SanPham.php");
// include_once("Models/LoaiSanPham.php");
// include_once("Models/Slide.php");
// include_once("Models/LoaiSlide.php");
// include_once("Models/ThongBao.php");
// include_once("General.php");

require_once 'Assets/__init__/__include__.php';


class SlidesController{
    private $model;
    private $loaisanpham;
    private $loaiSlide;
    private $db;
    private $thongbao;
    private $chamcong;
    private $general;


    public function __construct(){
        $this->model = new Slide();
        $this->loaisanpham = new LoaiSanPham();
        $this->db = new Database();
        $this->loaiSlide = new LoaiSlide();
        $this->thongbao = new ThongBao();
        $this->general = new General();
        $this->chamcong = new ChamCong();
    }
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $result = $this->model->DanhSach(); 
        $result1 = $this->model->DanhSachSlideTC();
        // $result2 = $this->model->DanhSachBanner();
        $loai_slide = $this->loaiSlide->DanhSach();
        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $data = $this->model->ChiTiet($checkbox);
                unlink("Assets/data/Slides/".$data[0]['hinhanh']);
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSach");
        }
        // //gọi và show dữ liệu ra view
        // include("Views/SanPham/DanhSach.php");
        // return $result; 
        include("Views/Slides/DanhSach.php");
    }

    public function ChiTiet(){
        $thongbaoadmin = $this->thongbao->DanhSach1();
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $detail = $this->model->ChiTiet($id);
        }
        require_once('Views/Slides/ChiTiet.php');
    }

    public function ThemMoi(){
        $result = $this->loaisanpham->DanhSach(100,0);
        $error = null;
        $loai_slide = $this->loaiSlide->DanhSach();
        if (isset($_POST['submit'])) {
        

   
    $allowedExtensions = array("jpg", "jpeg", "png");
    $count = 0;
    $message = null;
    $type = null;
    $maxFileSize = 2097152; // 2 mb
    $error = [];
    foreach ($_FILES['hinhanh']['name'] as $key => $filename) {
        $tempname = $_FILES['hinhanh']['tmp_name'][$key];
        $count = $count + 1;
        $file_parts = explode('.',$filename);
        $file_ext = strtolower(end($file_parts));
        $targetPath = "Assets/data/Slides/" . $filename;
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $fileSize = $_FILES['hinhanh']['size'][$key];
        if (!in_array($fileExtension, $allowedExtensions)) {
            $type = "red";
            $phuc = "Tệp $filename có đuôi mở rộng không hợp lệ. Chỉ được phép tải lên các tệp có đuôi mở rộng: " . implode(", ", $allowedExtensions) . "<br>";
            $error[] = [
                'message' => $phuc,
                'type' => 'red'
            ];
            continue; // Bỏ qua tệp tin không hợp lệ và tiếp tục với tệp tin tiếp theo
        }

        if ($fileSize > $maxFileSize) {
            echo "Tệp $filename vượt quá dung lượng tối đa cho phép (2Mb).<br>";
            continue; // Bỏ qua tệp tin vượt quá dung lượng và tiếp tục với tệp tin tiếp theo
        }

        $newFileName = time() .$count . '-slides.' .  $fileExtension;
        $targetPath = "Assets/data/Slides/" . $newFileName;
        // Kiểm tra xem tệp đã tồn tại chưa
        if (file_exists($targetPath)) {
            echo "Tệp $file_name đã tồn tại. Vui lòng đổi tên tệp hoặc chọn tệp khác.<br>";
        } else {
            if (move_uploaded_file($tempname, $targetPath)) {
                $this->model->ThemMoi($_POST['loaiSlide'], $_POST['idloaisanpham'], $newFileName);
                $type = "green";
                // $error[] = "Tệp $newFileName đã được tải lên thành công";
                $error[] = [
                    'message' => "Tệp $newFileName đã được tải lên thành công",
                    'type' => 'green'
                ];
            } else {
                $type = "red";
                $error[] = "Upload Error";
            }
        }
    }
            
            
        }
        require_once('Views/Slides/ThemMoi.php');
    }
    
    
    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $result  = $this->loaisanpham->DanhSach(100,0);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->model->ChiTiet($id);
            if (isset($_POST['submit'])) {

                $update = $this->model->CapNhat($id,$_POST['idloaisanpham'],
                                                    $_POST['tensanpham'],
                                                    $_POST['gia'],
                                                    $_POST['mota'],
                                                    $_POST['soluong'],
                                                    $_POST['ngaysanxuat']);

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


