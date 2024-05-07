<?php
class DonHangMua{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT dh.ID, dh.idTrangThai, kh.TenNguonHang, dh.created_at, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai
        FROM donhangmua AS dh
        INNER JOIN nguonhang AS kh ON dh.IdNguonHang = kh.ID
        INNER JOIN trangthaimua AS tt ON dh.IdTrangThai = tt.ID
        INNER JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        ORDER BY dh.ID DESC
        LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    public function LocTest($keyword,$ncc,$tthd,$idnv,$gianho,$gialon,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *, dhm.ID FROM donhangmua dhm,nguonhang kh, trangthaimua tt, nhanvien nv
        WHERE dhm.IdNguonHang = kh.ID AND dhm.IdTrangThai = tt.ID AND dhm.IdNhanVienLap = nv.ID
        AND ('$keyword' = '' OR dhm.ID = '$keyword')
        AND ('$ncc' = ''  OR dhm.idNguonHang = '$ncc')
        AND ('$tthd' = '' OR dhm.idTrangThai = '$tthd')
        AND ('$idnv' = '' OR dhm.idNhanVienLap = '$idnv')
        AND ('$from_date' = '' OR dhm.created_at BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR dhm.created_at <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (dhm.created_at BETWEEN '$from_date' AND '$to_date'))
        AND (dhm.TongTien BETWEEN $gianho AND $gialon) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaCaoNhat() {
        $sql = "SELECT Max(TongTien) as TongTienCaoNhat FROM donhangmua";
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaThapNhat() {
        $sql = "SELECT Min(TongTien) as TongTienThapNhat FROM donhangmua";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangMua() {
        $sql = "SELECT * FROM donhangmua";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function ChiTiet($id) {
        $sql = "SELECT dh.ID,kh.TenNguonHang,dh.created_at,nv.TenNhanVien,TongTien,TenTrangThai, idTrangThai
        FROM donhangmua as dh,nguonhang as kh,trangthaimua as tt, nhanvien as nv
        WHERE dh.idNguonHang = kh.ID
        AND dh.idTrangThai = tt.ID
        AND dh.idNhanVienLap = nv.ID
        AND dh.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function CapNhat($id,$idnhanvienlap,$idnguonhang)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE donhangmua SET 
        idnhanvienlap = '$idnhanvienlap',
        idnguonhang = '$idnguonhang',
        updated_at = '$now'
        WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function ThemMoi($idnhanvienlap, $idnguonhang)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO donhangmua (idNhanVienLap,idNguonHang,idTrangThai,created_at,TongTien)
                VALUES ('$idnhanvienlap', '$idnguonhang', 1, '$now', 0)";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function Xoa($id)
    {
        $sql = "DELETE FROM donhangmua WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DanhSachID() {
        $sql = "SELECT ID from donhangmua";
        $result = $this->db->select($sql);
        return $result;
    }

    public function idtrangthai($id){
        $sql = "SELECT idTrangThai from donhangmua WHERE ID='$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function tentrangthai($id){
        $sql = "SELECT TenTrangThai from trangthaimua WHERE ID='$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatTrangThai($id, $idtrangthai) {
        $sql = "UPDATE donhangmua SET 
        idTrangThai = '$idtrangthai'
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhatTrangThaiXacNhan($id) {
        $sql = "UPDATE donhangmua SET 
        idtrangthai = 2
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DoanhThuDonHangMua(){
        $sql = "SELECT SUM(TongTien) from donhangmua WHERE idTrangThai = 2";
        $result = $this->db->select($sql);
        return $result;
    }
}