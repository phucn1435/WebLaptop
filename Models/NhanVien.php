<?php
class NhanVien{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT * FROM nhanvien LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword,$gioitinh,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *
        FROM nhanvien as nv
        WHERE ('$keyword' = '' OR nv.ID = '$keyword' OR nv.TenNhanVien LIKE '%$keyword%' OR nv.SoDienThoai LIKE '%$keyword%' OR nv.Email LIKE '%$keyword%')
        AND ('$gioitinh' = '' OR nv.GioiTinh = '$gioitinh')
        AND ('$from_date' = '' OR nv.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR nv.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (nv.created_at BETWEEN '$from_date' AND '$to_date')) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
   
    public function TongNhanVien() {
        $sql = "SELECT * FROM nhanvien";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TongNhanVienTim($tennhanvien) {
        $sql = "SELECT * FROM nhanvien WHERE tennhanvien LIKE '%$tennhanvien%'";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    public function find($id)
    {
        $sql = "SELECT nv.ID,TenNhanVien,GioiTinh,NgaySinh,SoDienThoai, Email, DiaChi,luong
        FROM nhanvien as nv,taikhoannhanvien as tknv
        WHERE nv.ID = tknv.idNhanVien
        AND nv.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function TimKiem($tennhanvien)
    {
        $sql = "SELECT * FROM nhanvien
        WHERE ID = '$tennhanvien'";
        $result = $this->db->select($sql);
        return $result;
    }
   
    public function GetData()
    {
        $sql = "SELECT * FROM nhanvien";
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi($tennhanvien, $gioitinh, $ngaysinh, $sodienthoai, $email, $diachi, $luong)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO nhanvien (TenNhanVien,GioiTinh,NgaySinh,SoDienThoai,Email,DiaChi,luong, created_at)
                VALUES ('$tennhanvien', '$gioitinh', '$ngaysinh', '$sodienthoai', '$email', '$diachi', '$luong', '$now')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhat($id,$tennhanvien,$gioitinh,$ngaysinh,$sodienthoai,$email,$diachi, $luong)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE nhanvien SET
        TenNhanVien = '$tennhanvien',
        GioiTinh = '$gioitinh',
        NgaySinh = '$ngaysinh',
        SoDienThoai = '$sodienthoai',
        Email = '$email',
        DiaChi = '$diachi',
        luong = '$luong',
        updated_at = '$now'
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
        $sql = "DELETE FROM nhanvien WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function luong($item, $offset) {
        $sql = "SELECT *, count(cc.ID_user) as countUser FROM chamcong as cc, nhanvien as nv WHERE cc.ID_user = nv.ID 
        GROUP BY cc.ID_user LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest_Luong($keyword, $from_date,$to_date,$item,$offset) {
        $sql = "SELECT *, count(cc.ID_user) as countUser FROM chamcong as cc, nhanvien as nv WHERE cc.ID_user = nv.ID 
        AND ('$keyword' = '' OR cc.ID_user = '$keyword' OR nv.TenNhanVien  LIKE '%$keyword%')
        AND ('$from_date' = '' OR cc.ngaychamcong BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR cc.ngaychamcong <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (cc.ngaychamcong BETWEEN '$from_date' AND '$to_date'))
        GROUP BY cc.ID_user LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function luong_nam($year) {
        $sql = "SELECT *, count(cc.ID_user) as countUser FROM chamcong as cc, nhanvien as nv WHERE cc.ID_user = nv.ID 
        AND YEAR(cc.ngaychamcong) = $year
        GROUP BY cc.ID_user ";
        $result = $this->db->select($sql);
        return $result;
    } 

    public function luong_nam_thang($year,$month) {
        $sql = "SELECT *, count(cc.ID_user) as countUser FROM chamcong as cc, nhanvien as nv WHERE cc.ID_user = nv.ID 
        AND YEAR(cc.ngaychamcong) = $year AND MONTH(cc.ngaychamcong) = $month
        GROUP BY cc.ID_user ";
        $result = $this->db->select($sql);
        return $result;
    }

   
}