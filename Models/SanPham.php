<?php

class SanPham{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new Database();
    }

    // public function DanhSachMoi(){
    //     $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, MoTa, SoLuong, sp.HinhAnh, sp.upsells
    //     FROM sanpham as sp,loaisanpham as lsp
    //     WHERE sp.idLoaiSanPham = lsp.ID";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    public function UpdateTT($id,$tt) {
        $sql = "UPDATE sanpham SET thuoctinh = '$tt' WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        return $result;
    }
    public function DanhSachMoi(){
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, NgayBatDau_KM as nbd, NgayHetHan_KM as nhh, MoTa, SoLuong, sp.HinhAnh, sp.upsells, sp.trangthai
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID";
        $result = $this->db->select($sql);
        return $result;
    }

  
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT tt.ID as ID_TT, tt.TenTrangThai, tt.trangthai as trangthai_tt, tt.hinhanh as hinhanh_tt, sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, MoTa, SoLuong, sp.HinhAnh, sp.upsells, sp.trangthai
        FROM sanpham as sp,loaisanpham as lsp, trangthaisanpham as tt
        WHERE sp.idLoaiSanPham = lsp.ID AND sp.idTrangThaiSanPham = tt.ID LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachActive()
    {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, NgayBatDau_KM as nbd, NgayHetHan_KM as nhh, MoTa, SoLuong, sp.HinhAnh, sp.upsells, sp.trangthai
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID AND sp.trangthai = 1";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachTang($item,$offset)
    {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, MoTa, SoLuong, sp.HinhAnh 
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID ORDER BY Gia ASC LIMIT ".$item." OFFSET ".$offset ;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocSanPham($tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon) {
        $sql = "SELECT * FROM sanpham as sp, loaisanpham as lsp, trangthaisanpham as ttsp
        WHERE sp.idLoaiSanPham = lsp.ID AND sp.idTrangThaiSanPham = ttsp.ID
        AND (sp.TenSanPham IS NULL OR sp.TenSanPham LIKE '%$tensanpham%') 
        AND (sp.trangthai IS NULL OR sp.trangthai = '$trangthai')
        AND (sp.idLoaiSanPham IS NULL OR sp.idLoaiSanPham = $idloaisanpham)
        AND (sp.idTrangThaiSanPham IS NULL OR sp.idTrangThaiSanPham = $idTrangThaiSanPham)
        AND (sp.Gia BETWEEN '$gianho' AND '$gialon')";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT tt.ID as ID_TT, tt.TenTrangThai, tt.trangthai as trangthai_tt, tt.hinhanh as hinhanh_tt, sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, MoTa, SoLuong, sp.HinhAnh, sp.upsells, sp.trangthai,sp.created_at
        FROM sanpham as sp,loaisanpham as lsp, trangthaisanpham as tt WHERE sp.idLoaiSanPham = lsp.ID AND sp.idTrangThaiSanPham = tt.ID
        AND ('$tensanpham' = '' OR sp.TenSanPham LIKE '%$tensanpham%' OR sp.ID = '$tensanpham')
        AND ('$trangthai' = ''  OR sp.trangthai = '$trangthai')
        AND ('$idloaisanpham' = '' OR sp.idLoaiSanPham = '$idloaisanpham')
        AND ('$idTrangThaiSanPham' = '' OR sp.idTrangThaiSanPham = '$idTrangThaiSanPham')
        AND ('$from_date' = '' OR sp.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR sp.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (sp.created_at BETWEEN '$from_date' AND '$to_date'))
        AND (sp.Gia BETWEEN $gianho AND $gialon) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaCaoNhat() {
        $sql = "SELECT Max(Gia) as GiaCaoNhat FROM sanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaThapNhat() {
        $sql = "SELECT Min(Gia) as GiaThapNhat FROM sanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachTheoHang($brand, $demands, $price_min, $price_max, $mausac) {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, sp.Gia, MoTa, SoLuong, sp.HinhAnh, nc.name, ms.name   
        FROM sanpham as sp,loaisanpham as lsp, nhucaunguoidung as nc, mausac as ms
        WHERE sp.idLoaiSanPham = lsp.ID AND sp.idNhuCau = nc.ID AND sp.idMauSac = ms.ID AND ";
        if (empty($demands) && empty($brand) && empty($mausac)) {
            // echo 3;
            $sql .= "sp.Gia BETWEEN $price_min AND $price_max";
        } elseif (empty($brand) && empty($mausac) && empty($price_min) && empty($price_max)) {
            // echo 4;
            $sql .= "(nc.name IN ('$demands'))";
        } elseif (empty($demands) && empty($mausac) && !empty($price_min) && !empty($price_max) ) {
            // echo 5;
            $sql .= "(TenLoaiSanPham IN ('$brand')) AND sp.Gia BETWEEN $price_min AND $price_max";
        } elseif (empty($demands) && empty($mausac) && empty($price_min) && empty($price_max) ) {
            // echo 5;
            $sql .= "(TenLoaiSanPham IN ('$brand'))";
        } elseif (empty($brand) && empty($demands) && empty($price_min) && empty($price_max)) {
            // echo 6;
            $sql .= "(ms.name IN ('$mausac'))";
        } elseif (empty($demands) && empty($brand) && !empty($price_min) && !empty($price_max) ) {
            // echo 7;
            $sql .= "(ms.name IN ('$mausac')) AND sp.Gia BETWEEN $price_min AND $price_max";
        } elseif (empty($brand) && empty($price_min) && empty($price_max)) {
            // echo 8;
            $sql .= "(ms.name IN ('$mausac')) AND (nc.name IN ('$demands'))";
        } else {
            // echo 1;
            $sql .= "(TenLoaiSanPham IN ('$brand')) AND (nc.name IN ('$demands')) AND (ms.name IN ('$mausac'))";
        }
        
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachGiam($item,$offset)
    {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, MoTa, SoLuong, sp.HinhAnh 
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID ORDER BY Gia DESC LIMIT ".$item." OFFSET ".$offset ;
        $result = $this->db->select($sql);
        return $result;
    }
    public function DanhSachSanPham($id) {
        $sql = "SELECT * FROM sanpham where ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachSanPhamTheoGia($min, $max) {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, MoTa, SoLuong, sp.HinhAnh 
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID AND Gia BETWEEN $min AND $max";
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function TongSanPham() {
        $sql = "SELECT * FROM sanpham";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function SanPhamNoiBat() {
        $sql = "SELECT * FROM sanpham as sp, trangthaisanpham as tt
        WHERE sp.idTrangThai = tt.ID
        AND tt.TenTrangThai = N'Nổi bật' ";
        // AND tt.ID = 1 ";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TongSanPhamTim($tensanpham) {
        $sql = "SELECT * FROM sanpham WHERE tensanpham LIKE '%$tensanpham%'";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    
    public function ChiTiet($id)
    {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,sp.TenSanPham,Gia, GiaKhuyenMai, MoTa, SoLuong, sp.HinhAnh,
        sp.NgayBatDau_KM, sp.NgayHetHan_KM, tt.TenTrangThai
        FROM sanpham as sp,loaisanpham as lsp,trangthaisanpham as tt
        WHERE sp.idLoaiSanPham = lsp.ID AND sp.idTrangThaiSanPham = tt.ID
        AND sp.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTiet10($id)
    {
        $sql = "SELECT *,sp.ID, tt.TenTrangThai
        FROM sanpham as sp, loaisanpham as lsp, trangthaisanpham as tt where 
        sp.idLoaiSanPham = lsp.ID and sp.idTrangThaiSanPham = tt.ID AND sp.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTiet11($id)  
    {
        $sql = "SELECT *, sp.ID
        FROM sanpham as sp, loaisanpham as lsp where 
        sp.idLoaiSanPham = lsp.ID and sp.idLoaiSanPham=$id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LayIDLoaiSanPham($id){
        $sql = "SELECT idLoaiSanPham from sanpham where sanpham.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTietSPNB($idTrangThaiSanPham, $index)
{
    $sql = "SELECT sp.ID, sp.idLoaiSanPham, lsp.TenLoaiSanPham, sp.TenSanPham, sp.Gia, sp.MoTa, sp.SoLuong, s, sp.HinhAnh 
            FROM sanpham AS sp
            JOIN loaisanpham AS lsp ON sp.idLoaiSanPham = lsp.ID
            WHERE sp.idTrangThaiSanPham = '$idTrangThaiSanPham'";
    $result = $this->db->select($sql);
    
    $det = array();
    if ($index >= 0 && $index < count($result)) {
        $det[] = $result[$index];
    }
    
    return $det;
}

    public function TimKiem($tensanpham)
    {
        $sql = "SELECT sp.ID,sp.idLoaiSanPham,TenLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, MoTa, SoLuong, sp.HinhAnh 
        FROM sanpham as sp,loaisanpham as lsp
        WHERE sp.idLoaiSanPham = lsp.ID 
        AND TenSanPham LIKE '%$tensanpham%'";
       
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi($idloaisanpham, $tensanpham, $gia, $giakhuyenmai, $ngaybatdau,$ngayhethankm, $mota, $soluong, $hinhanh, $idtt,$trangthai)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO sanpham(idLoaiSanPham,TenSanPham, Gia, GiaKhuyenMai, NgayBatDau_KM, NgayHetHan_KM, MoTa, SoLuong, created_at, HinhAnh, idTrangThaiSanPham, trangthai) 
        VALUES ('$idloaisanpham','$tensanpham', '$gia', '$giakhuyenmai', '$ngaybatdau', '$ngayhethankm','$mota', '$soluong','$now' , '$hinhanh','$idtt', '$trangthai')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhat($id,$idLoaiSanPham,$tensanpham,$gia,$giakhuyenmai,$mota,$soluong,$idtt,$trangthai)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE sanpham SET
        idLoaiSanPham = '$idLoaiSanPham',
        TenSanPham = '$tensanpham',
        Gia = '$gia',
        GiaKhuyenMai = '$giakhuyenmai',
        MoTa = '$mota',
        SoLuong = '$soluong',
        updated_at = '$now',
        idTrangThaiSanPham = '$idtt',
        trangthai = '$trangthai'
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function CapNhatGiaKhuyenMai()
    {
        $sql = "UPDATE sanpham SET
        GiaKhuyenMai = 0
        WHERE CURDATE() > NgayHetHan_KM";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function CapNhatHinhAnh($id,$hinhanh)
    {
        $sql = "UPDATE sanpham SET
        HinhAnh = '$hinhanh'
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function Xoa($id)
    {
        $sql = "DELETE FROM sanpham WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DanhSachSanPhamNoiBat() {
        $sql = "SELECT * from sanpham as sp, trangthaisanpham as tt WHERE sp.idTrangThaiSanPham = tt.ID AND sp.idTrangThaiSanPham = 2";
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function DanhSachSanPhamMoiNhat() {
        $sql = "SELECT * from sanpham as sp, trangthaisanpham as tt WHERE sp.idTrangThaiSanPham = tt.ID AND sp.idTrangThaiSanPham  = 1";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TenSanPhamTheoLoai($idloaisanpham) {
        $sql = "SELECT * FROM sanpham as sp, loaisanpham as lsp where lsp.ID = sp.idLoaiSanPham and lsp.ID = '$idloaisanpham'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LaySanPham($idloaisanpham) {
        $sql = "SELECT sp.ID, lsp.TenLoaiSanPham,sp.HinhAnh,sp.Gia,sp.GiaKhuyenMai,sp.MoTa,sp.TenSanPham,sp.idLoaiSanPham, sp.HinhAnh
        FROM sanpham as sp, loaisanpham as lsp 
        WHERE lsp.ID = sp.idLoaiSanPham AND lsp.ID = '$idloaisanpham'";
        $result = $this->db->select($sql);
        return $result;
    }


    public function TongTienMuaConLai() {
        $sql = "SELECT SUM(SoLuong * Gia) as SL FROM sanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TatCaSanPham() {
        $sql = "SELECT * FROM sanpham";
        $result = $this->db->select($sql);
        return $result;
    }
}
   
   

