<?php
class LoaiSanPham{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT * FROM loaisanpham LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatHinhAnh($id,$hinhanh)
    {
        $sql = "UPDATE loaisanpham SET
        HinhAnh = '$hinhanh'
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DanhSach1()
    {
        $sql = "SELECT * FROM loaisanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach2($id) {
        $sql = "SELECT * FROM loaisanpham where ID=$id";
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongLoaiSanPham() {
        $sql = "SELECT * FROM loaisanpham";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TongLoaiSanPhamTim($tenloaisanpham) {
        $sql = "SELECT * FROM loaisanpham WHERE tenloaisanpham LIKE '%$tenloaisanpham%'";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    public function TimKiem($tenloaisanpham)
    {
        $sql = "SELECT * FROM loaisanpham
        WHERE TenLoaiSanPham LIKE '%$tenloaisanpham%'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi($tenloaisanpham, $hinhanh, $trangthai)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO loaisanpham (TenLoaiSanPham, hinhanh, trangthai, created_at)
                VALUES ('$tenloaisanpham', '$hinhanh', '$trangthai', '$now')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhat($id,$tenloaisanpham,$trangthai)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE loaisanpham SET tenloaisanpham = '$tenloaisanpham', trangthai = '$trangthai', updated_at = '$now' WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function LocTest($tendanhmuc,$trangthai,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *
        FROM loaisanpham as lsp
        WHERE ('$tendanhmuc' = '' OR lsp.TenLoaiSanPham LIKE '%$tendanhmuc%' OR lsp.ID = '$tendanhmuc')
        AND ('$trangthai' = ''  OR lsp.trangthai = '$trangthai')
        AND ('$from_date' = '' OR lsp.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR lsp.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (lsp.created_at BETWEEN '$from_date' AND '$to_date')) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    

    public function Xoa($id)
    {
        $sql = "DELETE FROM loaisanpham WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function TenLoaiSanPham($id)
    {
        $sql = "SELECT TenLoaiSanPham FROM loaisanpham,sanpham
        WHERE loaisanpham.ID = sanpham.idLoaiSanPham and sanpham.ID = $id" ;
        $result = $this->db->select($sql);
        return $result;
    }

    
    
}