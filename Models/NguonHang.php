<?php
class NguonHang{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function GetData($item,$offset)
    {
        $sql = "SELECT * FROM nguonhang LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongNguonHang() {
        $sql = "SELECT * FROM nguonhang";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TongNguonHangTim($tennguonhang) {
        $sql = "SELECT * FROM nguonhang WHERE TenNguonHang LIKE '%$tennguonhang%'";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    public function TimKiem($id)
    {
        $sql = "SELECT * FROM nguonhang
        WHERE ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi($tennguonhang, $sodienthoai, $email, $diachi, $nguoidaidien)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO nguonhang (TenNguonHang,SoDienThoai,Email,DiaChi,created_at,NguoiDaiDien)
                VALUES ('$tennguonhang', '$sodienthoai', '$email', '$diachi', '$now', '$nguoidaidien')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function LocTest($keyword,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *
        FROM nguonhang as nh
        WHERE ('$keyword' = '' OR nh.TenNguonHang LIKE '%$keyword%' OR nh.SoDienThoai LIKE '%$keyword%' OR nh.Email LIKE '%$keyword%' OR nh.NguoiDaiDien LIKE '%$keyword%')
        AND ('$from_date' = '' OR nh.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR nh.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (nh.created_at BETWEEN '$from_date' AND '$to_date')) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function CapNhat($id,$tennguonhang, $sodienthoai, $email, $diachi, $nguoidaidien)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE nguonhang SET
        TenNguonHang = '$tennguonhang',
        SoDienThoai = '$sodienthoai',
        Email = '$email',
        DiaChi = '$diachi',
        updated_at = '$now',
        NguoiDaiDien = '$nguoidaidien'
        WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function Xoa($id)
    {
        $sql = "DELETE FROM nguonhang WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}