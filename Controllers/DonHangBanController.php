<?php
// include_once("Models/DonHangBan.php");

// include_once("Models/SanPham.php");
// include_once("Models/ChiTietDonHangBan.php");
// include_once("Models/KhachHang.php");
// include_once("Models/NhanVien.php");
// include_once("Models/ThongBao.php");
// include_once("Assets/tfpdf/tfpdf.php");

require_once 'Assets/__init__/__include__.php';

/** Include PHPExcel */



class DonHangBanController{
    private $model;
    private $db;
    private $sanpham;
    private $chitietdonhangban;
    private $khachhang;
    private $nhanvienlap;
    private $thongbao;
    private $chamcong;
    private $trangthaiban;

    public function __construct(){
        $this->model = new DonHangBan();
        $this->db = new Database();
        $this->sanpham = new SanPham();
        $this->chitietdonhangban = new ChiTietDonHangBan();
        $this->khachhang = new KhachHang();
        $this->nhanvienlap = new NhanVien();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();
        $this->trangthaiban = new TrangThai();
    }
    
    
    public function DanhSach()
    {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $trangthaiban = $this->trangthaiban->TrangThaiBan();
        // $ten2 = $this->model->tentrangthai(5);
        // $ten3 = $this->model->tentrangthai(3);
        // $ten1 = $this->model->tentrangthai(1);
        $result1 = $this->model->DanhSachTrangThai();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 3;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        $tongsp = $this->model->TongDonHangBanTT();
            if($tongsp > 0) {
                $_SESSION['tongdonhangban'] = $tongsp;
            } else {
                unset($_SESSION['tongdonhangban']);
            }
        $totalPage = ceil($tongsp / $item1);
        $result = $this->model->DanhSach($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_dhtt = $this->model->LocTest($_GET['keyword'],$_GET['id_TTHD'],$_GET['price_min'],$_GET['price_max'], $_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_dhtt)) {
                $tongdhb_tt = count($loc_dhtt);
                $totalPage = ceil($tongdhb_tt / $item1);
                $result = $this->model->LocTest($_GET['keyword'],$_GET['id_TTHD'],$_GET['price_min'],$_GET['price_max'], $_GET['from_date'],$_GET['to_date'],$item1,$offset);
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

        if (isset($_POST['duyet_nhanh']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->CapNhatTrangThaiHoanThanhDonHang($checkbox);
            }
            header("Location: DanhSach");
        }

        if (isset($_POST['huy_nhanh']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->CapNhatTrangThaiHuyDonHang($checkbox);
            }
            header("Location: DanhSach");
        }

        if(isset($_GET['id']) && isset($_GET['change'])) {
            $update = $this->model->CapNhatTenTrangThai($_GET['id'],$_GET['change']);
            $idkh = $this->model->IDKH($_GET['id']);
            $tentrangthai = $this->model->tentrangthai($_GET['change']);
            $content = "Đơn hàng của bạn đang trong trạng thái ".$tentrangthai[0]['TenTrangThai'];
            $currentDateTime = date("Y-m-d H:i:s");
            if($update) {
                $this->thongbao->ThemMoi($_GET['id'], $idkh[0]['idKhachHang'], $content, $currentDateTime, 0);
                echo "<script>alert('Cập nhật trạng thái đơn hàng thành công.');
                window.location.href='../DonHangBan/DanhSach';
                </script>";
            }

        }
        //gọi và show dữ liệu ra view
        include 'Views/DonHangBan/DanhSach.php';
        return array($result,$result1);
    }
    // public function Chon() {
    //     $list_nv = $this->nhanvienlap->GetData();
    //     if (isset($_POST['name_nv'])) {
    //         $_SESSION['id_nv'] = $_POST['name_nv'];
    //         header('Location: ./ThemMoi'); 
    //     }
    //     include("Views/DonHangBan/Chon.php");
    // }
    public function DanhSachTQ() {
        $thongbaoadmin = $this->thongbao->DanhSach1();
        $trangthaiban = $this->trangthaiban->TrangThaiBan();

        $result1 = $this->model->DanhSachTrangThai();
        $item1 = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
        $current = !empty($_GET['page']) ? $_GET['page'] : 1; // trang hien tai
        $offset = ($current - 1) * $item1;
        // $this->model->DanhSachID();
        $tongsp = $this->model->TongDonHangBanTQ();
        if($tongsp > 0) {
            $_SESSION['tongdonhangban'] = $tongsp;
        } else {
            unset($_SESSION['tongdonhangban']);
        }
        $totalPage = ceil($tongsp / $item1);
        $result = $this->model->DanhSachTQ($item1,$offset);
        if (isset($_GET['keyword'])) {
            $loc_dhtq = $this->model->LocTest1($_GET['keyword'],$_GET['id_TTHD'],$_GET['price_min'],$_GET['price_max'], $_GET['from_date'],$_GET['to_date'],$tongsp,0);
            if (!empty($loc_dhtq)) {
                $tongdhb_tq = count($loc_dhtq);
                $totalPage = ceil($tongdhb_tq / $item1);
                $result = $this->model->LocTest1($_GET['keyword'],$_GET['id_TTHD'],$_GET['price_min'],$_GET['price_max'], $_GET['from_date'],$_GET['to_date'],$item1,$offset);
            } else {
                $result = null;
                $totalPage = 0;
            }
        }  

        if(isset($_POST['delete']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->Xoa($checkbox);
            }
            header("Location: DanhSachTQ");
        }

        if (isset($_POST['duyet_nhanh']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->CapNhatTrangThaiHoanThanhDonHang($checkbox);
            }
            header("Location: DanhSachTQ");
        }

        if (isset($_POST['huy_nhanh']) && isset($_POST['checkboxID'])) {
            foreach($_POST['checkboxID'] as $checkbox) {
                $this->model->CapNhatTrangThaiHuyDonHang($checkbox);
            }
            header("Location: DanhSachTQ");
        }

        if(isset($_GET['id']) && isset($_GET['change'])) {
            $update = $this->model->CapNhatTenTrangThai($_GET['id'],$_GET['change']);
            $idkh = $this->model->IDKH($_GET['id']);
            $tentrangthai = $this->model->tentrangthai($_GET['change']);
            $content = "Đơn hàng của bạn đang trong trạng thái ".$tentrangthai[0]['TenTrangThai'];
            $currentDateTime = date("Y-m-d H:i:s");
            if($update) {
                $this->thongbao->ThemMoi($_GET['id'], $idkh[0]['idKhachHang'], $content, $currentDateTime, 0);
                echo "<script>alert('Cập nhật trạng thái đơn hàng thành công.');
                window.location.href='../DonHangBan/DanhSachTQ';
                </script>";
            }

        }
        //gọi và show dữ liệu ra view
        include 'Views/DonHangBan/DanhSachTQ.php';
        return array($result,$result1);
    }

    public function ThemMoi(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        $ListKhachHang = $this->khachhang->GetData(100,0);
        $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
        $list_sp = $this->sanpham->DanhSach(100,0);
        
        // if (isset($_POST['submit'])) {
        //     $create = $this->model->ThemMoi($_POST['idnhanvienlap'], $_POST['idkhachhang'], 5,$_POST['ngaylap'],$_POST['tongtien']);
        // $alert = "";
        // $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
        // $ListKhachHang = $this->khachhang->GetData(100,0);
        // if (isset($_POST['submit'])) {
        //     if(empty($_POST['idkhachhang']) || empty($_POST['idnhanvienlap'])){
        //         $alert="<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống id nhân viên lập và khách hàng!</span>";
        //     }else if(!is_numeric($_POST['idkhachhang']) || !is_numeric($_POST['idnhanvienlap'])){
        //         $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>id nhân viên và khách hàng bắt buộc phải là số!</span>";
        //     }else{
        //         $create = $this->model->ThemMoi($_POST['idnhanvienlap'], $_POST['idkhachhang'],  $_POST['idtrangthai'],$_POST['ngaylap'],$_POST['tongtien']);
        //     if ($create) {
        //         // $this->sanpham->DS();
        //         header('Location: ./DanhSach');
        //     }
        //     }
        // }}
        if (!isset($_SESSION['items'])) {
            $_SESSION['items'] = array();
        }

        
        // Kiểm tra nếu người dùng nhấn nút thêm
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_them'])) {
            // Lấy thông tin từ form
            $array_temp = null;
            if (empty($_POST['sp'])) {
                echo "<script>alert('Bạn chưa chọn sản phẩm để thêm.');</script>";
            } elseif (empty($_POST['sl'])) {
                echo "<script>alert('Bạn chưa điền số lượng sản phẩm để thêm.');</script>";
            } else {
                $thongtinsanpham = $this->sanpham->ChiTiet($_POST['sp']);
                if ($_POST['sl'] > $thongtinsanpham[0]['SoLuong']) {
                    echo "<script>alert('Số lượng thêm không hợp lệ.');</script>"; 
                } else {
                    // $product_exists = false;
                    // foreach ($_SESSION['items'] as &$item) {
                    //     if ((int)$item['tensp'] == (int)$_POST['sp']) {
                    //         // Nếu đã có, cộng thêm vào số lượng
                    //         $item['sl'] += (int)$_POST['sl'];
                    //         $product_exists = true;
                    //         break;
                    //     }
                    // }
                    $flag = 0;
                    $foundIndex = -1;
                    foreach($_SESSION['items'] as $index => $item   ) {
                        if ($item['id'] == $_POST['sp']) {
                            $flag = 1;
                            $foundIndex = $index;
                            break;
                        }
                    }

                    if ($flag == 0 ) {
                        $_SESSION['items'][] = array(
                            'id' => $_POST['sp'],
                            'tensp' => $thongtinsanpham[0]['TenSanPham'],
                            'sl' => $_POST['sl'],
                            'dongia' => $thongtinsanpham[0]['Gia']
                        );
                    } else {
                        $_SESSION['items'][$foundIndex]['sl'] += $_POST['sl'];
                    }
                }
            }
        }
        foreach($_SESSION['items'] as $data) {
            print_r($data['sl']);
        }
        if (isset($_POST['create_order'])) {
            $name = $_POST['name_kh'];
            $sdt = $_POST['sdt'];
            $dc = $_POST['dc'];
            $_SESSION['items_temp'] = $_SESSION['items'];
            if ($name == "" || $sdt == "" || $dc == "" || !isset($_SESSION['items'])) {
                echo "<script>alert('Bạn không nhập đủ dữ liệu. Kiểm tra lại đã!');</script>";
            } else {
                $phantramgiam = $_POST['phantram'];
                $this->chitietdonhangban->TaoDonHang($name,$sdt,'',$dc,$this->model->Max_ID()[0]['max']+1,$phantramgiam);
                foreach($_SESSION['items'] as $item) {
                    $this->chitietdonhangban->hihi($item['id'],(int)$item['sl']);
                }
                unset($_SESSION['items']);
                unset($_SESSION['items_temp']);

                header("Location: ../ChiTietDonHangBan/DanhSachTQ?id=".$this->model->Max_ID()[0]['max']);
            }
        }
        
        if(isset($_POST['reset'])) {
            unset($_SESSION['items']);
        }
        include 'Views/DonHangBan/ThemMoi.php';
    }

    public function CheckSDT() {
        // $thongbaoadmin = $this->thongbao->DanhSach1();

        $sdt = null;
        $output = '';
        if(isset($_POST['sdt']) && isset($_POST['tongtien'])) {
            $sdt = $_POST['sdt'];
            $tamtinh = $_POST['tongtien'];
            $getSdt = $this->model->TongTienSDT($sdt);
            $tongtien_sdt = $getSdt[0]['tongtien'];
            if ($tongtien_sdt < 10000000){ // 8
                $phantramgiam = 0; // 9
            } elseif ($tongtien_sdt > 10000000 && $tongtien_sdt < 20000000) { // 10
                $phantramgiam = 10; // 11 
            } elseif ($tongtien_sdt > 20000000 && $tongtien_sdt < 100000000) { // 12
                $phantramgiam = 20; // 13
            } else { // 14
                $phantramgiam = 30; // 15
            }

            $tongtien = $tamtinh - ($tamtinh * $phantramgiam / 100);
        }

        $output .= "<div style='text-align: right; color: red; font-weight: bold;'>Giảm giá: -$phantramgiam%</div>";
        $output .= "<div style='text-align: right; color: red; font-weight: bold;'>Tổng tiền: $tongtien </div>";
        $output .= "<input type='hidden' name='phantram' value='$phantramgiam'>";
        echo $output;
    }

    public function add_orders() {
        // $thongbaoadmin = $this->thongbao->DanhSach1();

        if (!isset($_SESSION['items'])) {
            $_SESSION['items'] = array();
        }
        $output = '';
            if (empty($_POST['id_sp'])) {
                echo "<script>alert('Bạn chưa chọn sản phẩm để thêm');</script>";
            } elseif (empty($_POST['sl'])) {
                echo "<script>alert('Bạn chưa điền số lượng sản phẩm để thêm');</script>";
            } else {
                $thongtinsanpham = $this->sanpham->ChiTiet($_POST['id_sp']);
                if ($_POST['sl'] > $thongtinsanpham[0]['SoLuong']) {
                    echo "<script>alert('Số lượng thêm không hợp lệ.');</script>"; 
                } else {
                $flag = 0;
                $foundIndex = -1;
                foreach($_SESSION['items'] as $index => $item) {
                    if ($item['id'] == $_POST['id_sp']) {
                        $flag = 1;
                        $foundIndex = $index;
                        break;
                    }
                }
    
                if ($flag == 0 ) {
                    $_SESSION['items'][] = array(
                        'id' => $_POST['id_sp'],
                        'tensp' => $thongtinsanpham[0]['TenSanPham'],
                        'sl' => $_POST['sl'],
                        'dongia' => $thongtinsanpham[0]['Gia']
                    );
                } else {
                    $items = $this->sanpham->ChiTiet($_SESSION['items'][$foundIndex]['id']);
                    $soluong_sp = $thongtinsanpham[0]['SoLuong'];
                    $test = $_SESSION['items'][$foundIndex]['sl'] + $_POST['sl'];
                    if ($test <= $soluong_sp) {
                        $_SESSION['items'][$foundIndex]['sl'] += $_POST['sl'];
                    }
                }

                $i = 0;
        
        $tongtien = 0;
         if(!empty($_SESSION['items'])) {  
            foreach($_SESSION['items'] as $item) { 
                
            ++$i;
            $tensp = $item['tensp'];
            $sl = $item['sl'];
            $dongia = $item['dongia'];
            $thanhtien = $sl * $dongia;
            $tongtien += $thanhtien;
            $output .= "<tr>";
                $output .= "<th scope='row'>$i</th>";
                $output .= "<td>$tensp</td>";
                $output .= "<td>$sl</td>";
                $output .= "<td>$dongia</td>";
                $output .= "<td>$thanhtien</td>";
        }}
        $output .= "</tr>";
        $output .= "<tr>";
            $output .= "<td colspan='4'>Tạm tính</td>";
            $output .= "<td id='tongtien'>$tongtien</td>";
        $output .= "</tr>";
            }

           

        }
        unset($_SESSION['items_temp']);
        echo $output;
    }

    public function xuli_chonsp() {
        
        $output = '';
        if (isset($_POST['data'])) {
            $sanpham = $this->sanpham->ChiTiet($_POST['data']);
            $soluong = $sanpham[0]['SoLuong'];
            $output = "Còn lại " .$soluong. " sản phẩm";
        }
        echo $output;
    }

    public function CapNhat(){
        $thongbaoadmin = $this->thongbao->DanhSach1();

        $alert="";
        $ListKhachHang = $this->khachhang->GetData(100,0);
        $ListNhanVien = $this->nhanvienlap->DanhSach(100,0);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = 'donhangban';
            //lấy dữ liệu cần cập nhật
            $dataUpdate = $this->db->find($table,$id);
            
            if (isset($_POST['submit'])) {
                if(empty($_POST['idkhachhang']) || empty($_POST['idnhanvienlap'])){
                    $alert="<span style='color: red; padding-bottom: 10px; display: block;'>Không được bỏ trống id nhân viên lập và khách hàng!</span>";
                }else if(!is_numeric($_POST['idkhachhang']) || !is_numeric($_POST['idnhanvienlap'])){
                    $alert = "<span style='color: red; padding-bottom: 10px; display: block;'>id nhân viên và khách hàng không phải là số!</span>";
                }else{
                    $update = $this->model->CapNhat($id,$_POST['idnhanvienlap'],
                                                    $_POST['idkhachhang'],
                                                    $_POST['idtrangthai'],
                                                    $_POST['ngaylap'],
                                                    $_POST['tongtien']);
                if ($update) {
                    header('Location: ./DanhSach');
                }
                }
                
            }
        }
        include 'Views/DonHangBan/CapNhat.php';

        return Array($dataUpdate,$ListKhachHang,$ListNhanVien);
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

    public function InDonHang() {
        $pdf = new tFPDF();
        $pdf->AddPage("0");
        // $pdf->SetFont('Arial','B',16);
        // $pdf->Cell(40,10,'Hello World!');
        // $pdf->Output();
        // Add a Unicode font (uses UTF-8)
        $pdf->AddFont('DejaVu','','DejaVuSans-Oblique.ttf',true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->setFillColor(193, 229,252);
        $pdf->Write(10,'Đơn hàng của bạn gồm có:');
        $pdf->Ln(10);
        $chitiet = $this->chitietdonhangban->DanhSach($_GET['id'],100,0);
        $width_cell=array(10,30,80,30,40,50);
            $pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
            $pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
            $pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
            $pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
            $pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
            $pdf->Cell($width_cell[5],10,'Tổng tiền',1,1,'C',true); 
            $pdf->SetFillColor(235,236,236); 
            $fill=false;
            $i = 0;
            foreach($chitiet as $row) {
                $pdf->Cell($width_cell[0],10,++$i,1,0,'C',$fill);
                $pdf->Cell($width_cell[1],10,$row['idDonHangBan'],1,0,'C',$fill);
                $pdf->Cell($width_cell[2],10,$row['TenSanPham'],1,0,'C',$fill);
                $pdf->Cell($width_cell[3],10,$row['SoLuong'],1,0,'C',$fill);
                $pdf->Cell($width_cell[4],10,number_format($row['DonGiaApDung']),1,0,'C',$fill);
                $pdf->Cell($width_cell[5],10,number_format($row['ThanhTien']),1,1,'C',$fill);
                $fill = !$fill;
            }
        
        $pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
        $pdf->Ln(10);

        $pdf->Output();
      
    }

    public function create_orders() {
        print_r($_POST);
    }
}