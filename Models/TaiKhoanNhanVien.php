<?php
class TaiKhoanNhanVien{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT *
        FROM taikhoannhanvien as tknv,nhanvien as nv WHERE tknv.IDNhanVien = nv.ID
        LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword, $trangthai, $from_date, $to_date,$item,$offset) {
        $sql = "SELECT * FROM taikhoannhanvien as tknv,nhanvien as nv WHERE tknv.IDNhanVien = nv.ID 
        AND ('$keyword' = '' OR tknv.TenDangNhap LIKE '%$keyword%' OR tknv.IDNhanVien = '$keyword')
        AND ('$trangthai' = ''  OR tknv.TrangThai = '$trangthai')
        AND ('$from_date' = '' OR tknv.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR tknv.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (tknv.created_at BETWEEN '$from_date' AND '$to_date')) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach1()
    {
         $sql = "SELECT * FROM taikhoannhanvien as tknv,nhanvien as nv
        WHERE tknv.IDNhanVien = nv.ID";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSach2() {
        $sql = "SELECT * FROM taikhoannhanvien";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function DanhSach()
    // {
    //     $sql = "SELECT *
    //     FROM taikhoannhanvien as tk,nhanvien as nv
    //     WHERE tk.IDNhanVien = nv.ID"; 
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    
    public function TongTaiKhoan() {
        $sql = "SELECT * FROM taikhoannhanvien";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }


    public function TimKiemTheoTenDangNhap($tendangnhap)
{
    // Thực hiện truy vấn SQL để tìm kiếm nhân viên dựa trên tên đăng nhập
    $query = "SELECT * FROM taikhoannhanvien WHERE TenDangNhap LIKE '%$tendangnhap%'";

    // Tiếp tục xử lý truy vấn và trả về kết quả
    $result = $this->db->select($query);
    return $result;
}
    public function find($id)
    {
        $sql = "SELECT tknv.IDNhanVien,TenNhanVien,TenDangNhap,MatKhau, TrangThai, AnhDaiDien, role
        FROM taikhoannhanvien as tknv,nhanvien as nv
        WHERE tknv.IDNhanVien = nv.ID
        AND tknv.IDNhanVien = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function find1($tendangnhap) 
    {
        $sql = "SELECT tknv.IDNhanVien,TenNhanVien,TenDangNhap,MatKhau, TrangThai, AnhDaiDien, role
        FROM taikhoannhanvien as tknv,nhanvien as nv
        WHERE tknv.IDNhanVien = nv.ID
        AND tknv.TenDangNhap = '$tendangnhap'";
        $result = $this->db->select($sql);
        return $result;
    }
    // public function TimKiem($tennhanvien)
    // {
    //     $sql = "SELECT tknv.TenDangNhap,nv.TenNhanVien ,tknv.IDNhanVien, MatKhau, TrangThai, AnhDaiDien
    //     FROM taikhoannhanvien as tknv, nhanvien as nv
    //     WHERE nv.TenNhanVien LIKE '%$tennhanvien%'
    //     AND tknv.idNhanVien = nv.ID";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    public function TimKiem($id)
    {
        $sql = "SELECT tknv.TenDangNhap,nv.TenNhanVien ,tknv.IDNhanVien, MatKhau, TrangThai, AnhDaiDien
        FROM taikhoannhanvien as tknv, nhanvien as nv
        WHERE tknv.IDNhanVien = $id
        AND tknv.IDNhanVien = nv.ID";
        $result = $this->db->select($sql);
        return $result;
    }
    

    
    public function GetData()
    {
        $sql = "SELECT * FROM taikhoannhanvien";
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi( $tendangnhap,$idnhanvien, $matkhau, $trangthai, $anhdaidien, $vaitro)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO taikhoannhanvien (TenDangNhap,IDNhanVien,MatKhau,TrangThai,AnhDaiDien,role,created_at)
                VALUES ('$tendangnhap','$idnhanvien', '$matkhau', '$trangthai', '$anhdaidien', '$vaitro', '$now')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhat($id, $tendangnhap, $matkhau, $role, $trangthai, $anhdaidien)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE taikhoannhanvien as tknv SET
        TenDangNhap = '$tendangnhap',
        MatKhau = '$matkhau',
        TrangThai = '$trangthai',
        AnhDaiDien = '$anhdaidien',
        role = '$role',
        updated_at = '$now'
        WHERE tknv.TenDangNhap = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function Xoa($idnhanvien)
    {
        $sql = "DELETE FROM taikhoannhanvien WHERE IDNhanVien = '$idnhanvien'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function GetPassword($username) {
        $sql = "SELECT MatKhau from taikhoannhanvien where TenDangNhap = '$username'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachActive($id) {
        $sql = "SELECT * FROM taikhoannhanvien WHERE TrangThai = 1 AND IDNhanVien = $id";
        $result = $this->db->select($sql);
        return $result;
    }

}