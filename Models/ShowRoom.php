<?php
class ShowRoom{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach() {
        $sql = "SELECT * FROM showroom as sr, province as pr, district as dt WHERE sr.province = pr.province_id
        AND sr.district = dt.district_id";
        $result = $this->db->select($sql);
        return $result;
    }
    // ddbacabaab
    public function DanhSachTheoTinh($province)
    {
        $sql = "SELECT * FROM showroom as sr, province as pr, district as dt WHERE sr.province = pr.province_id
        AND sr.district = dt.district_id AND sr.province = $province";
       
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachTheoTinhQuan($province, $district)
    {
        $sql = "SELECT * FROM showroom as sr, province as pr, district as dt WHERE sr.province = pr.province_id
        AND sr.district = dt.district_id AND sr.district = $district AND pr.province = $province AND pr.district = $district";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function CapNhatHinhAnh($id,$hinhanh)
    // {
    //     $sql = "UPDATE loaisanpham SET
    //     HinhAnh = '$hinhanh'
    //     WHERE ID = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function DanhSach1()
    // {
    //     $sql = "SELECT * FROM loaisanpham";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    // public function DanhSach2($id) {
    //     $sql = "SELECT * FROM loaisanpham where ID=$id";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    // public function TongLoaiSanPham() {
    //     $sql = "SELECT * FROM loaisanpham";
    //     $result = mysqli_query($this->db->conn, $sql);
    //     $result = $result->num_rows;
    //     return $result;
    // }

    // public function TongLoaiSanPhamTim($tenloaisanpham) {
    //     $sql = "SELECT * FROM loaisanpham WHERE tenloaisanpham LIKE '%$tenloaisanpham%'";
    //     $result = mysqli_query($this->db->conn, $sql);
    //     $result = $result->num_rows;
    //     return $result;
    // }
    // public function TimKiem($tenloaisanpham)
    // {
    //     $sql = "SELECT * FROM loaisanpham
    //     WHERE TenLoaiSanPham LIKE '%$tenloaisanpham%'";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    // public function ThemMoi($tenloaisanpham, $hinhanh)
    // {
    //     $sql = "INSERT INTO loaisanpham (tenloaisanpham, hinhanh)
    //             VALUES ('$tenloaisanpham', '$hinhanh')";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // public function CapNhat($id,$tenloaisanpham)
    // {
    //     $sql = "UPDATE loaisanpham SET tenloaisanpham = '$tenloaisanpham' WHERE id = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // public function Xoa($id)
    // {
    //     $sql = "DELETE FROM loaisanpham WHERE id = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function TenLoaiSanPham($id)
    // {
    //     $sql = "SELECT TenLoaiSanPham FROM loaisanpham,sanpham
    //     WHERE loaisanpham.ID = sanpham.idLoaiSanPham and sanpham.ID = $id" ;
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    
    
}