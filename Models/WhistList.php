<?php

class WhistList{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new Database();
    }
    public function ThemMoi($id_user, $id_product)
    {
        $date_time_now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO whistlist(ID_user,ID_product,create_at) 
        VALUES ('$id_user','$id_product', '$date_time_now' )";
        $result = $this->db->execute($sql);
        if ($result) {  
            return true;
        } else {
            return false;
        }
    }

    public function Xoa($id_user, $id_product)
    {
        $sql = "DELETE FROM whistlist WHERE ID_user = $id_user AND ID_product = $id_product";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function Get_ID_Product($id_user) {
        $sql = "SELECT ID_product FROM whistlist WHERE ID_user = $id_user";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach()
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

    public function ThongKe() {
        $sql = "SELECT sp.TenSanPham, ws.ID_product, COUNT(ID_product) as count from whistlist ws, sanpham sp WHERE ws.ID_product = sp.ID GROUP BY ID_product";
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

   

