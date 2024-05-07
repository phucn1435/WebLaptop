<?php

class ThuocTinhSanPham{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new Database();
    }
    public function ThemMoi($tenthuoctinh, $giatri)
    {
        $sql = "INSERT INTO thuoctinhsanpham(tenthuoctinh,giatri) 
        VALUES ('$tenthuoctinh','$giatri')";
        $result = $this->db->execute($sql);
        if ($result) {  
            return true;
        } else {
            return false;
        }
    }

    public function DanhSach()
    {
        $sql = "SELECT * FROM thuoctinhsanpham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword,$idLoaiTinTuc,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT tt.hinhanh, tt.ID,tt.IDLoaiTinTuc,TenLoaiTinTuc,TenTinTuc, NoiDung, NgayDang
        FROM tintuc as tt,loaitintuc as ltt WHERE tt.IDLoaiTinTuc = ltt.ID
        AND ('$keyword' = '' OR tt.TenTinTuc LIKE '%$keyword%' OR tt.ID = '$keyword')
        AND ('$idLoaiTinTuc' = ''  OR tt.IDLoaiTinTuc = '$idLoaiTinTuc')
        AND ('$from_date' = '' OR tt.NgayDang BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR tt.NgayDang <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (tt.NgayDang BETWEEN '$from_date' AND '$to_date')) LIMIT $item OFFSET $offset";
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
   
    // public function CapNhat($id,$idLoaiTinTuc,$tentintuc,$noidung)
    // {
    //     $now=date("Y-m-d");
    //     $sql = "UPDATE tintuc SET
    //     IDLoaiTinTuc = '$idLoaiTinTuc',
    //     TenTinTuc = '$tentintuc',
    //     NoiDung = '$noidung',
    //     updated_at = '$now'
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

   

