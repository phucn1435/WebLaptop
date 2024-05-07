<?php

class TrangThai{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new Database();
    }
    public function ThemMoi($ten, $hinhanh, $trangthai)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO trangthaisanpham(TenTrangThai,hinhanh,trangthai,created_at) 
        VALUES ('$ten','$hinhanh','$trangthai','$now')";
        $result = $this->db->execute($sql);
        if ($result) {  
            return true;
        } else {
            return false;
        }
    }

    public function DanhSach($item,$offset)
    {
        $sql = "SELECT * from trangthaisanpham LIMIT $item OFFSET $offset";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach1()
    {
        $sql = "SELECT * from trangthaisanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachTTActive()
    {
        $sql = "SELECT * from trangthaisanpham where trangthai = 1";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TrangThaiBan() {
        $sql = "SELECT * FROM trangthaiban";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TrangThaiMua() {
        $sql = "SELECT * FROM trangthaimua";
        $result = $this->db->select($sql);
        return $result;
    }

    public function find($id)
    {
        $sql = "SELECT *
        FROM trangthaisanpham as tt
        WHERE tt.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    

    public function CapNhat($id, $tentrangthai,$id_tt)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE trangthaisanpham SET
        TenTrangThai = '$tentrangthai',
        trangthai = '$id_tt',
        updated_at = '$now'
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
        $sql = "DELETE FROM trangthaisanpham WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function LocTest($tentrangthai,$trangthai,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *
        FROM trangthaisanpham as tt
        WHERE ('$tentrangthai' = '' OR tt.TenTrangThai LIKE '%$tentrangthai%' OR tt.ID = '$tentrangthai')
        AND ('$trangthai' = ''  OR tt.trangthai = '$trangthai')
        AND ('$from_date' = '' OR tt.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR tt.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (tt.created_at BETWEEN '$from_date' AND '$to_date')) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    // public function DanhSachLoai($id)
    // {
    //     $sql = "SELECT tt.hinhanh, tt.ID,tt.IDLoaiTinTuc,TenLoaiTinTuc,TenTinTuc, NoiDung, NgayDang
    //     FROM tintuc as tt,loaitintuc as ltt
    //     WHERE tt.IDLoaiTinTuc = ltt.ID AND tt.IDLoaiTinTuc = $id";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    // public function DanhSachPB($limit) {
    //     $sql = "SELECT tt.hinhanh, tt.ID,tt.IDLoaiTinTuc,TenLoaiTinTuc,TenTinTuc, NoiDung, NgayDang
    //     FROM tintuc as tt,loaitintuc as ltt
    //     WHERE tt.IDLoaiTinTuc = ltt.ID ORDER BY luottruycap DESC LIMIT $limit";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    // public function updateView($id) {
    //     $sql = "UPDATE tintuc 
    //     SET luottruycap = luottruycap + 1
    //     WHERE ID = $id";
    //     $result = $this->db->execute($sql);
    //     return $result;
    // }   

    // public function TongTinTuc() {
    //     $sql = "SELECT * FROM tintuc";
    //     $result = mysqli_query($this->db->conn, $sql);
    //     $result = $result->num_rows;
    //     return $result;
    // }

    // public function TongTinTucTim($tentintuc) {
    //     $sql = "SELECT * FROM tintuc WHERE tentintuc LIKE '%$tentintuc%'";
    //     $result = mysqli_query($this->db->conn, $sql);
    //     $result = $result->num_rows;
    //     return $result;
    // }
    // public function ChiTiet($id)
    // {
    //     $sql = "SELECT tt.hinhanh, tt.ID,tt.IDLoaiTinTuc,TenLoaiTinTuc,TenTinTuc, NoiDung, NgayDang
    //     FROM tintuc as tt,loaitintuc as ltt
    //     WHERE tt.IDLoaiTinTuc = ltt.ID
    //     AND tt.ID = '$id'";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

  
    // public function TimKiem($tentintuc)
    // {
    //     $sql = "SELECT tt.hinhanh,tt.ID,tt.IDLoaiTinTuc,TenLoaiTinTuc,TenTinTuc, NoiDung, NgayDang
    //     FROM tintuc as tt,loaitintuc as ltt
    //     WHERE tt.IDLoaiTinTuc = ltt.ID
    //     AND TenTinTuc LIKE '%$tentintuc%'";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
   
    // public function CapNhat($id,$idLoaiTinTuc,$tentintuc,$noidung,$ngaydang)
    // {
    //     $sql = "UPDATE tintuc SET
    //     IDLoaiTinTuc = '$idLoaiTinTuc',
    //     TenTinTuc = '$tentintuc',
    //     NoiDung = '$noidung',
    //     NgayDang = '$ngaydang'
    //     WHERE ID = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // public function CapNhatHinhAnh($id,$hinhanh)
    // {
    //     $sql = "UPDATE tintuc SET
    //     HinhAnh = '$hinhanh'
    //     WHERE ID = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function Xoa($id)
    // {
    //     $sql = "DELETE FROM tintuc WHERE id = '$id'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    
}
// Gọi lớp TinTuc trong file TrangChuControllers.php

   

