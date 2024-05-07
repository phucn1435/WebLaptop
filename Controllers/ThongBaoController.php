<?php
        require 'Assets/__init__/__include__.php';


class ThongBaoController{
    private $sanpham;
    private $donhangban;
    private $db;
    private $donhangmua;
    private $login;
    private $thongbao;
    private $trangthai;
    private $loaisanpham;
    private $nhanvien;
    private $chamcong;
    private $ctdh;

    public function __construct(){
        $this->sanpham = new SanPham();
        $this->donhangban = new DonHangBan();
        $this->db = new Database();
        $this->donhangmua = new DonHangMua();
        $this->login = new loginKhachHang();
        $this->thongbao = new ThongBao();
        $this->chamcong = new ChamCong();   
        $this->ctdh = new ChiTietDonHangBan();
        // require 'Assets/__construct/__construct.php';
    }
    
    public function DanhSach(){
        $thongbao1 = $this->thongbao->DanhSachAdmin();
        $ctdh = $this->ctdh->DanhSach1(398);
        $thongbaoadmin = $this->thongbao->DanhSach1();

        include("Views/ThongBao/DanhSach.php");
    }

    public function ChiTiet() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $this->thongbao->update2($id);
            $chitiet = $this->thongbao->ChiTiet($id);
            $ID_DH = $chitiet[0]['ID_DH'];
            
            $ctdh = $this->ctdh->DanhSach1($ID_DH);
            $ID_KH = $ctdh[0]['idKhachHang'];
            $output = "";

            $output .= "<div class='modal-content1'>
            <span class='close1' onclick='closeModal()'>&times;</span>
            <p style='font-size: 20px; font-weight: bold; text-align: center; color: red; margin: 0;'>ĐƠN HÀNG BÁN</p>
            <div style='color: red;font-size: 15px; margin: 0; text-align: center;'>Mã đơn hàng: $ID_DH</div>
            <div style='font-weight: bold;' class=''>Mã khách hàng: <a href=''>$ID_KH</a></div>
            <div style='font-weight: bold; margin-top: 5px;' class=''>Chi tiết đơn hàng</div>
            <table class='table text-center'>
                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Tên sản phẩm</th>
                        <th scope='col'>Số lượng</th>
                        <th scope='col'>Đơn giá</th>
                        <th scope='col'>Thành tiền</th>
                    </tr>
                </thead>
                <tbody> ";
                    $i = 0 ;$tongcong = 0; $tt = 0;
                    foreach($ctdh as $row) :extract($row);
                    $i++;
                    $tensp = $row['TenSanPham'];
                    $soluong = $row['SoLuong'];
                    $dongia = $row['DonGiaApDung'];
                    $thanhtien = $row['ThanhTien'];
                    $output .= "<tr>
                        <th scope='row'>$i</th>
                        <td>$tensp</td>
                        <td>$soluong</td>
                        <td>$dongia</td>
                        <td>$thanhtien</td>
                    </tr>";
                    endforeach;
                $output .= "</tbody>
                    </table>
                    <div style='text-align: center;'>
                        <a href='' style='text-align: right;' class='btn btn-primary'>Xem chi tiết</a>
                    </div>
                </div>";

            echo $output;
        }
    }

    // Thống kê truy cập
   
}