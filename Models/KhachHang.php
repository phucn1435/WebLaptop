<?php
class KhachHang{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    
    public function KhachHangThang() {
        $sql = "SELECT * 
        FROM khachhang
        WHERE EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM CURRENT_DATE)
          AND EXTRACT(YEAR FROM created_at) = EXTRACT(YEAR FROM CURRENT_DATE);";
          $result = $this->db->select($sql);
          return $result;
    }

    public function GetData($item,$offset)
    {
        $sql = "SELECT * FROM khachhang LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword,$gioitinh,$item,$offset) {
        $sql = "SELECT *
        FROM khachhang as kh
        WHERE ('$keyword' = '' OR kh.ID = '$keyword' OR kh.TenKhachHang LIKE '%$keyword%' OR kh.SoDienThoai LIKE '%$keyword%' OR kh.Email LIKE '%$keyword%')
        AND ('$gioitinh' = '' OR kh.GioiTinh = '$gioitinh') LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
   
    

    public function getID($email) {
        $sql = "SELECT ID FROM khachhang WHERE Email = '$email'";
        $result = $this->db->select($sql);
        return $result;
    } 


    public function GetSDT($sdt) {
        $sql = "SELECT * FROM khachhang WHERE SoDienThoai = $sdt";
        $result = $this->db->select($sql);
        return $result;
    } 

    public function GetData1($id)
    {
        $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM diachinhanhang as dc, 
        ward as w, province as p, district as d WHERE dc.thanhpho = p.province_id AND dc.quan = d.district_id AND dc.xa = w.ward_id  
        AND dc.ID_KH = $id AND macdinh = 0";
        $result = $this->db->select($sql);
        return $result;
    }

    public function getEmail($id) {
        $sql = "SELECT Email from diachinhanhang where ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function GetData2($id)
    {
        $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM diachinhanhang as dc, 
        ward as w, province as p, district as d WHERE dc.thanhpho = p.province_id AND dc.quan = d.district_id AND dc.xa = w.ward_id  
        AND dc.ID_KH = $id ORDER BY macdinh ASC ";
        $result = $this->db->select($sql);
        return $result;
    }

    public function GetData3($id)       
    {
        $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM diachinhanhang as dc, 
        ward as w, province as p, district as d WHERE dc.thanhpho = p.province_id AND dc.quan = d.district_id AND dc.xa = w.ward_id AND ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongKhachHang() {
        $sql = "SELECT * FROM khachhang";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TimKiem($id)
    {
        $sql = "SELECT * FROM khachhang
        WHERE ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function ThemMoi($tenkhachhang, $gioitinh, $ngaysinh, $sodienthoai, $email, $diachi)
    {
        $sql = "INSERT INTO khachhang (TenKhachHang,GioiTinh,NgaySinh,SoDienThoai,Email,DiaChi,created_at)
                VALUES ('$tenkhachhang', '$gioitinh', '$ngaysinh', '$sodienthoai', '$email', '$diachi')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ThemDiaChi($idkh, $hoten, $sdt, $email, $tp, $quan, $xa, $cuthe, $macdinh) {
        $sql = "INSERT INTO diachinhanhang (ID_KH,hoten,SDT,Email,thanhpho,quan,xa,cuthe,macdinh)
                VALUES ('$idkh', '$hoten', '$sdt', '$email', '$tp', '$quan', '$xa', '$cuthe', '$macdinh')";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function UpdateDiaChi($id, $hoten, $sdt, $email,$tp,$quan,$xa,$cuthe)
    {
        $sql = "UPDATE diachinhanhang SET hoten = '$hoten', SDT = '$sdt', Email = '$email', thanhpho = '$tp', quan = '$quan', xa = '$xa',
        cuthe = '$cuthe' where ID_KH='$id' and macdinh = 0";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateDiaChi1($id, $hoten, $sdt, $email,$tp,$quan,$xa,$cuthe)
    {
        $sql = "UPDATE diachinhanhang SET hoten = '$hoten', SDT = $sdt, Email = '$email', thanhpho = '$tp', quan = '$quan', xa = '$xa',
        cuthe = '$cuthe', macdinh = 1 where ID = $id ";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ChecknumberAD($id){
        $sql = "SELECT * FROM diachinhanhang WHERE ID_KH = '$id'";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    

    public function CheckAD($id){
        $sql = "SELECT * FROM diachinhanhang WHERE ID_KH = '$id' and macdinh = 0";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function CapNhat($id,$tenkhachhang,$gioitinh,$ngaysinh,$sodienthoai,$email)
    {
        $sql = "UPDATE khachhang SET
        tenkhachhang = '$tenkhachhang',
        gioitinh = '$gioitinh',
        ngaysinh = '$ngaysinh',
        sodienthoai = '$sodienthoai',
        email = '$email' 
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function XoaDCNH($id) {
        $sql = "DELETE FROM diachinhanhang WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function Xoa($id)
    {
        $sql = "DELETE FROM khachhang WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}