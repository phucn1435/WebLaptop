<?php
class GioHang{
    private $db;
    private $sp;
    public function __construct(){
        $this->db = new Database();
        $this->sp = new SanPham();
    }
   
    public function Tong(){
        $sql = "SELECT * FROM giohang WHERE ID_KH=0";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function Tong1($id){
        $sql = "SELECT * FROM giohang WHERE ID_KH=$id";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function Them($idkh,$id,$id_loaisp,$soluong,$dongia,$thanhtien){
        $sql = "INSERT INTO giohang (ID_KH,ID_sanpham,ID_loaisp, SoLuong1,dongia,ThanhTien)
        VALUES ($idkh,$id, $id_loaisp, $soluong,$dongia,$thanhtien)";
       
        $result = $this->db->execute($sql);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function LayDonGia($id) {
        $sql = "SELECT GiaKhuyenMai,Gia from sanpham WHERE ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LaySoLuong($id) {
        $sql = "SELECT SoLuong1 from giohang WHERE ID_sanpham = $id and ID_KH=0";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LaySoLuong1($id,$idkh) {
        $sql = "SELECT SoLuong1 from giohang WHERE ID_sanpham = $id and ID_KH=$idkh";
        $result = $this->db->select($sql);
       return $result;
    }


    public function LaySoLuongSanPham($id) {
        $sql = "SELECT SoLuong from sanpham WHERE ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach() {
        $sql = "SELECT *, gh.ID from giohang as gh,sanpham as sp WHERE sp.ID = gh.ID_sanpham and gh.ID_KH=0";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach3($id) {
        $sql = "SELECT *, gh.ID from giohang as gh,sanpham as sp WHERE sp.ID = gh.ID_sanpham and gh.ID_KH=$id";
        $result = $this->db->select($sql);
        return $result;
    }


    public function DanhSach2($id) {
        $sql = "SELECT *, gh.ID from giohang as gh,sanpham as sp WHERE sp.ID = gh.ID_sanpham and gh.ID_KH=$id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach1() {
        $sql = "SELECT * from giohang";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach4($id) {
        $sql = "SELECT * from giohang WHERE ID_KH=$id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatTT($id,$thanhtien) {
        $sql = "UPDATE giohang SET ThanhTien = $thanhtien WHERE ID_sanpham = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    // public function DanhSach1() {
    //     $sql = "SELECT * from giohang";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
        
    public function CapNhatSoLuong($id,$soluong,$dongia){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 + 1,ThanhTien = $soluong * $dongia WHERE ID_sanpham = $id and ID_KH=0";
        $result = $this->db->execute($sql);
        return $result;
    }
    public function CapNhatSoLuong10($id,$soluong){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 + $soluong,ThanhTien = SoLuong1 * dongia WHERE ID_sanpham = $id and ID_KH=0";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatSoLuong7($id_kh, $id,$soluong){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 + $soluong,ThanhTien = SoLuong1 * dongia WHERE ID_sanpham = $id and ID_KH=$id_kh";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatSoLuong2($id_kh,$id,$soluong,$dongia){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 + 1,ThanhTien = $soluong * $dongia WHERE ID_sanpham = $id and ID_KH=$id_kh";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatSoLuong3($id_kh,$id,$soluong,$dongia){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 - 1,ThanhTien = $soluong * $dongia WHERE ID_sanpham = $id and ID_KH=$id_kh";
        $result = $this->db->execute($sql);
        return $result;
    }

    // public function CapNhatSoLuong4($id_kh,$id,$soluong,$dongia){
    //     $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 + 1,ThanhTien = $soluong * $dongia WHERE ID_sanpham = $id and ID_KH=$id_kh";
    //     $result = $this->db->execute($sql);
    //     return $result;
    // }

    public function CapNhatSoLuong1($id){
        $sql = "UPDATE giohang SET SoLuong1 = SoLuong1 - 1 WHERE ID_sanpham = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatThanhTien($id,$soluong,$dongia){
        $sql = "UPDATE giohang SET ThanhTien = $soluong * $dongia WHERE ID_sanpham = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatUser($idkh){
        $sql = "UPDATE giohang SET ID_KH = $idkh WHERE ID_KH=0";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function Xoa($id) {
        $sql = "DELETE FROM giohang WHERE id = '$id' and ID_KH=0";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function XoaAll() {
        $sql = "DELETE FROM giohang where ID_KH=0";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function Xoa1($id,$id_kh) {
        $sql = "DELETE FROM giohang WHERE id = '$id' and ID_KH=$id_kh";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function XoaAll1($id_kh) {
        $sql = "DELETE FROM giohang where ID_KH=$id_kh";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function SoLuongMot($id) {
        $sql = "UPDATE giohang SET SoLuong1 = 1 WHERE ID_sanpham = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function SoLuongMax1($id,$max) {
        $sql = "UPDATE giohang SET SoLuong1 = $max WHERE ID_sanpham = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatTT14($id_sp,$macode,$thanhtien) {
        $sql = "UPDATE giohang SET code_giam = '$macode', ThanhTienCoMaGiam = $thanhtien WHERE ID_sanpham = $id_sp AND ID_KH = 0";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatTT10($id,$id_sp,$macode,$thanhtien) {
        $sql = "UPDATE giohang SET code_giam = '$macode', ThanhTienCoMaGiam = $thanhtien WHERE ID_sanpham = $id_sp AND ID_KH = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatTT11($id,$id_sp,$macode,$thanhtien) {
        $sql = "UPDATE giohang SET code_giam = '$macode', ThanhTienCoMaGiam = $thanhtien WHERE ID_KH = $id AND ID_sanpham = $id_sp";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function CapNhatTT12($id, $id_loaisp, $macode, $thanhtien) {
        $sql = "UPDATE giohang SET code_giam = '$macode', ThanhTienCoMaGiam = $thanhtien WHERE ID_KH = $id AND ID_loaisp = $id_loaisp";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function SoLuongMax($id) {
        $sql = "SELECT SoLuong from sanpham where ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function KhachHang($id) {
        $sql = "SELECT * from khachhang where ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LayID0(){
        $sql = "SELECT ID_KH FROM giohang WHERE ID_KH=0";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatRong($id){
        $sql = "UPDATE giohang SET code_giam = '', ThanhTienCoMaGiam = 0 WHERE ID_KH = $id";
        $result = $this->db->execute($sql);
        return $result;
    }

    
  
}