<?php
class DonHangBan{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach($item,$offset)
    {
        $sql = "SELECT dh.ID, dh.id_diachinhan, dh.id_tttt, dh.id_diachinhan, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai
        FROM donhangban AS dh
        LEFT JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
        LEFT JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
        LEFT JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
        LEFT JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID

        LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        WHERE dh.id_tttt != 3
        ORDER BY dh.ID DESC LIMIT ".$item." OFFSET ".$offset;

        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword,$tthd,$gianho,$gialon,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT *, dh.ID, dh.id_diachinhan, dh.id_tttt, dh.id_diachinhan, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai 
        FROM donhangban dh,khachhang kh, trangthaiban tt,diachinhanhang dc,thongtinthanhtoan tttt, nhanvien nv
        WHERE dh.IdKhachHang = kh.ID AND dh.IdTrangThai = tt.ID AND dh.id_diachinhan = dc.ID AND dh.id_tttt = tttt.ID AND dh.IdNhanVienLap = nv.ID
        AND ('$keyword' = '' OR dh.ID = '$keyword' OR dh.idKhachHang = '$keyword' OR kh.TenKhachHang LIKE '%$keyword%')
        AND ('$tthd' = '' OR dh.idTrangThai = '$tthd')
        AND ('$from_date' = '' OR dh.NgayLap BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR dh.NgayLap <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (dh.NgayLap BETWEEN '$from_date' AND '$to_date'))
        AND (dh.TongTien BETWEEN $gianho AND $gialon) AND dh.id_tttt != 3  LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaCaoNhat() {
        $sql = "SELECT Max(TongTien) as TongTienCaoNhat FROM donhangban dhb WHERE dhb.id_tttt != 3 ";
        $result = $this->db->select($sql);
        return $result;
    }

    public function GiaThapNhat() {
        $sql = "SELECT Min(TongTien) as TongTienThapNhat FROM donhangban dhb WHERE dhb.id_tttt != 3";
        $result = $this->db->select($sql);
        return $result;
    }

    public function Gia() {
        $sql = "SELECT MAX(TongTien) as TongTienCaoNhat, MIN(TongTien) as TongTienThapNhat FROM donhangban dhb WHERE dhb.id_tttt = 3";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function GiaThapNhat1() {
    //     $sql = "SELECT Min(TongTien) as TongTienThapNhat FROM donhangban dhb WHERE dhb.id_tttt = 3";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    public function DanhSachTQ($item,$offset)
    {
        $sql = "SELECT dh.ID, dh.id_diachinhan, dh.ID_ordersTQ, dh.id_diachinhan, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai
        FROM donhangban AS dh
        LEFT JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
        LEFT JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
        LEFT JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
        LEFT JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID

        LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        WHERE dh.id_tttt = 3
        ORDER BY dh.ID DESC LIMIT ".$item." OFFSET ".$offset;

        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest1($keyword,$tthd,$gianho,$gialon,$from_date,$to_date,$item,$offset) {
        $sql = "SELECT dh.ID, dh.id_diachinhan, dh.ID_ordersTQ, dh.id_diachinhan, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai
        FROM donhangban AS dh
        LEFT JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
        LEFT JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
        LEFT JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
        LEFT JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID
        LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        WHERE dh.id_tttt = 3
        AND ('$keyword' = '' OR dh.ID = '$keyword' OR dh.idKhachHang = '$keyword' OR kh.TenKhachHang LIKE '%$keyword%')
        AND ('$tthd' = '' OR dh.idTrangThai = '$tthd')
        AND ('$from_date' = '' OR dh.NgayLap BEtWEEN '$from_date' AND CURRENT_DATE()) 
        AND ('$to_date' = '' OR dh.NgayLap <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (dh.NgayLap BETWEEN '$from_date' AND '$to_date'))
        AND (dh.TongTien BETWEEN $gianho AND $gialon) LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTietTQ($id)
    {
        $sql = "SELECT dh.ID, dh.ID_ordersTQ, dh.id_diachinhan, dh.id_diachinhan, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang,kh.DiaChi,kh.SoDienThoai, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai, tttt.name
        FROM donhangban AS dh
        LEFT JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
        LEFT JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
        LEFT JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
        LEFT JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID

        LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        WHERE dh.ID_ordersTQ = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachDonHangMoi($item, $offset) {
        $sql = "SELECT dh.ID, dh.idTrangThai, dh.idKhachHang, kh.TenKhachHang, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai, tttt.name
        FROM donhangban AS dh
        LEFT JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
        LEFT JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
        LEFT JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
        LEFT JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID
        LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
        WHERE date(dh.NgayLap) = CURDATE() 
        ORDER BY dh.ID ASC LIMIT ".$item." OFFSET ".$offset;

        $result = $this->db->select($sql);
        return $result;
    }

    public function TongTienTuSDT($sdt) {
        $sql = "SELECT TongTien from donhangban as dhb, diachinhanhang as dc WHERE dhb.id_diachinhan = dc.ID AND dc.SDT = '$sdt'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongTienSDT($sdt) {
        $sql = "SELECT SUM(TongTien) as tongtien from donhangban as dh, khachhang as kh WHERE kh.ID = dh.idKhachHang AND kh.SoDienThoai = $sdt";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangBan() {
        $sql = "SELECT * FROM donhangban";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    public function TongDonHangBanTT() {
        $sql = "SELECT * FROM donhangban dh WHERE dh.id_tttt != 3 ";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function TongDonHangBanTQ() {
        $sql = "SELECT * FROM donhangban dh WHERE dh.id_tttt = 3 ";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function DoanhThuDonHangBan() {
        $sql = "SELECT SUM(TongTien) FROM donhangban WHERE idTrangThai = 6";
        $result = $this->db->select($sql);
        //$result = $this->db->execute($sql);
        return $result;
    }
    

    public function ChiTiet($id)
    {
        $sql = "SELECT tttt.name, p.name as nameProvince, d.name as nameDistrict, w.name as nameWard, dh.ghichu, dh.giamgia, dh.ID, dh.idTrangThai, dh.id_diachinhan, dc.thanhpho,dc.quan,dc.xa,dc.cuthe, kh.TenKhachHang, kh.SoDienThoai, dc.Email, dh.NgayLap, nv.TenNhanVien, dh.TongTien, tt.TenTrangThai
                FROM donhangban AS dh
                INNER JOIN khachhang AS kh ON dh.IdKhachHang = kh.ID
                INNER JOIN trangthaiban AS tt ON dh.IdTrangThai = tt.ID
                INNER JOIN diachinhanhang AS dc ON dh.id_diachinhan = dc.ID
                INNER JOIN thongtinthanhtoan AS tttt ON dh.id_tttt = tttt.ID
                INNER JOIN ward AS w ON dc.xa = w.ward_id  
                INNER JOIN province AS p ON dc.thanhpho = p.province_id
                INNER JOIN district AS d ON dc.quan = d.district_id
                LEFT JOIN nhanvien AS nv ON dh.IdNhanVienLap = nv.ID
                WHERE dh.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
   
    public function ThemMoi($idnhanvienlap, $idkhachhang, $idtrangthai, $tongtien)
    {
        $now = date("Y-m-d");
        $sql = "INSERT INTO donhangban (idNhanVienLap,idKhachHang,idTrangThai,NgayLap,TongTien)
                VALUES ('$idnhanvienlap', '$idkhachhang', 5, '$now', '$tongtien')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function ThongKeDonHangBan(){
        $sql = "SELECT TongTien,NgayLap
        FROM donhangban WHERE idTrangThai = 6";
        $result = $this->db->select($sql);
        return $result;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhat($id,$idnhanvienlap,$idkhachhang,$idtrangthai,$tongtien)
    {
        $now = date("Y-m-d");
        $sql = "UPDATE donhangban SET 
        idnhanvienlap = '$idnhanvienlap',
        idkhachhang = '$idkhachhang',
        idtrangthai = '$idtrangthai',
        updated_at = '$now',
        tongtien = '$tongtien'
        WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function LayID_KH($id) {
        $sql = "SELECT idKhachHang from donhangban WHERE ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatGiamGia($id, $giamgia) {
        $sql = "UPDATE donhangban SET giamgia = $giamgia WHERE ID = $id";
        $result = $this->db->execute($sql);
        return $result;
    } 
    public function CapNhatTrangThaiHoanThanhDonHang($id) {
        $sql = "UPDATE donhangban SET 
        idTrangThai = 6
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhatTrangThaiHuyDonHang($id) {
        $sql = "UPDATE donhangban SET 
        idtrangthai = 4
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function CapNhatTrangThaiHuyDonHang12($id) {
        $sql = "UPDATE donhangban SET 
        idTrangThai = 4
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
   
   
    public function CapNhatTrangThaiBanDauDonHang($id) {
        $sql = "UPDATE donhangban SET 
        idtrangthai = 5
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function TongTienDonHang($id) {
        $sql = "SELECT TongTien from donhangban WHERE ID = '$id'";
        $result = $this->db->select($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DanhSachTrangThai() {
        $sql = "SELECT * from trangthaiban";
        $result = $this->db->select($sql);
        return $result;
    }

    public function tentrangthai($id){
        $sql = "SELECT TenTrangThai from trangthaiban WHERE ID='$id'";
        $result = $this->db->select($sql);
        return $result;
    }
    public function idtrangthai($id){
        $sql = "SELECT idTrangThai from donhangban WHERE ID='$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachID() {
        $sql = "SELECT ID from donhangban";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function DoanhThuDonHangBan() {
    //     $sql = "SELECT SUM(TongTien) FROM donhangban";
    //     $result = mysqli_query($this->db->conn, $sql);
    //     //$result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // public function ThongKeDonHangBan(){
    //     $sql = "SELECT TongTien,NgayLap
    //     FROM donhangban";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }
    public function Xoa($id)
    {
        $sql = "DELETE FROM donhangban WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function TongDonHangBanHuy() {
        $sql = "SELECT NgayLap AS ngay, COUNT(idTrangThai) AS tongdonhuy
        FROM donhangban WHERE idTrangThai = 4
        GROUP BY ngay
        ORDER BY ngay";
        // $sql = "SELECT NgayLap as ngay, count(idTrangThai) FROM donhangban WHERE idTrangThai = 4 GROUP BY ngay";
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongDonHangBanThanhCong() {
        $sql = "SELECT NgayLap AS ngay, COUNT(idTrangThai) AS tongdontc
        FROM donhangban WHERE idTrangThai = 6
        GROUP BY ngay
        ORDER BY ngay";
        // $sql = "SELECT NgayLap as ngay, count(idTrangThai) FROM donhangban WHERE idTrangThai = 6 GROUP BY ngay";

        $result = $this->db->select($sql);
        return $result;
      
    }

    public function DonHangTheoNgay() {
        $sql = "SELECT NgayLap, COUNT(TongTien) FROM donhangban GROUP BY NgayLap";
        $result = $this->db->select($sql);
        return $result;
    }
   
    public function TongDonHangBanHuyTheoThang($nam) {
        $sql = "SELECT MONTH(NgayLap) AS thang, COUNT(idTrangThai) AS tongdonhuy
        FROM donhangban WHERE idTrangThai = 4 and YEAR(NgayLap) = '$nam'
        GROUP BY MONTH(NgayLap)
        ORDER BY MONTH(NgayLap)";
        // $sql = "SELECT NgayLap as ngay, count(idTrangThai) FROM donhangban WHERE idTrangThai = 4 GROUP BY ngay";
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongDonHangBanThanhCongTheoThang($nam) {
        $sql = "SELECT MONTH(NgayLap) AS thang, COUNT(idTrangThai) AS tongdontc
        FROM donhangban WHERE idTrangThai = 6 and YEAR(NgayLap) = '$nam'
        GROUP BY MONTH(NgayLap)
        ORDER BY MONTH(NgayLap)";
        // $sql = "SELECT NgayLap as ngay, count(idTrangThai) FROM donhangban WHERE idTrangThai = 6 GROUP BY ngay";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangBanHuyTheoNgay($month, $year) {
        $sql = "SELECT DAY(NgayLap) AS ngay, COUNT(idTrangThai) AS tongdonhuy
        FROM donhangban
        WHERE YEAR(NgayLap) = '$year' AND MONTH(NgayLap) = '$month' and idTrangThai = 4
        GROUP BY ngay ORDER BY ngay";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangBanThanhCongTheoNgay($month, $year) {
        $sql = "SELECT DAY(NgayLap) AS ngay, COUNT(idTrangThai) AS tongdontc
        FROM donhangban
        WHERE YEAR(NgayLap) = '$year' AND MONTH(NgayLap) = '$month' and idTrangThai = 6
        GROUP BY ngay ORDER BY ngay";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangBanHuyCacNam(){
        $sql = "SELECT YEAR(NgayLap) AS nam,COUNT(*) AS tongdonhuy
        FROM donhangban WHERE idTrangThai = 4
        GROUP BY nam";
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongDonHangBanThanhCongCacNam(){
        $sql = "SELECT YEAR(NgayLap) AS nam,COUNT(*) AS tongdontc
        FROM donhangban WHERE idTrangThai = 6
        GROUP BY nam";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhatTenTrangThai($id,$idtt){
        $sql = "UPDATE donhangban SET idTrangThai='$idtt' WHERE ID='$id'";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function IDKH($id) {
        $sql = "SELECT idKhachHang from donhangban where ID=$id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function province() {
        $sql = "SELECT * from province";
        $result = $this->db->select($sql);
        return $result;
    }

    public function nameCity($id) {
        $sql = "SELECT name from province where province_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function nameDistrict($id) {
        $sql = "SELECT name from district where district_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function nameWards($id) {
        $sql = "SELECT name from ward where ward_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function SoDonHangDaNhan() {
        $sql = "SELECT count(ID) as sum from donhangban where idTrangThai = 5";
        $result = $this->db->select($sql);
        return $result;
    }

    public function SoDonHangThanhCong() {
        $sql = "SELECT count(ID) as sum from donhangban where idTrangThai = 3";
        $result = $this->db->select($sql);
        return $result;
    }
    public function SoDonHangDangXuLi() {
        $sql = "SELECT count(ID) as sum from donhangban where idTrangThai = 7";
        $result = $this->db->select($sql);
        return $result;
    }
    public function SoDonHangDangVanChuyen() {
        $sql = "SELECT count(ID) as sum from donhangban where idTrangThai = 8";
        $result = $this->db->select($sql);
        return $result;
    }
    public function SoDonHangDaHuy() {
        $sql = "SELECT count(ID) as sum from donhangban where idTrangThai = 4";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DoanhThu7Ngay() {
        $sql = "SELECT SUM(TongTien) AS total_revenue
        FROM donhangban
        WHERE NgayLap >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DonHangThanhCong1() {
        $sql = "SELECT count(ID) AS total_revenue
        FROM donhangban
        WHERE idTrangThai = 3 and NgayLap >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DonHangHuy1() {
        $sql = "SELECT count(ID) AS total_revenue1
        FROM donhangban
        WHERE idTrangThai = 4 and NgayLap >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $this->db->select($sql);
        return $result;
    }

    public function thongkedoanhthu($subdays,$now) {
        $sql = "SELECT *, SUM(TongTien) AS doanhthu FROM donhangban 
        WHERE NgayLap BETWEEN '$subdays' AND '$now' GROUP BY NgayLap ORDER BY NgayLap ASC";
        $result = $this->db->select($sql);
        return $result;
    }

    public function Max_ID() {
        $sql = "SELECT MAX(ID_ordersTQ) as max from donhangban";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHang($subdays,$now){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap BETWEEN '$subdays' AND '$now' GROUP BY NgayLap";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangDaNhan($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 2 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangHoanThanh($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 3 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangDaHuy($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 4 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangChuaThanhToan($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 5 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangDaThanhToan($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 6 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangDangXuLi($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 7 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThongKe_DonHangDangVanChuyen($date){
        $sql = "SELECT COUNT(idTrangThai) as count, ttb.ID, dhb.NgayLap from trangthaiban ttb, donhangban dhb 
        WHERE ttb.ID = dhb.idTrangThai AND NgayLap = '$date' AND dhb.idTrangThai = 8 GROUP BY idTrangThai";
        $result = $this->db->select($sql);
        return $result;
    }
}