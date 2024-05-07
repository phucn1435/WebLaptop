<?php
class MaGiamGia{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function DanhSach($item,$offset)
    {
        $sql = "SELECT *,mgg.ID as mggID FROM magiamgia as mgg,loaimagiam as lmg WHERE mgg.ID_loai = lmg.ID ORDER BY mgg.ID DESC LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

  
    public function LocTest($keyword, $id_dm, $trangthai, $from_date, $to_date,$item,$offset ) {
        $sql = "SELECT * FROM magiamgia as mgg,loaimagiam as lmg WHERE mgg.ID_loai = lmg.ID
        AND ('$keyword' = '' OR mgg.ID = '$keyword' OR mgg.tenma LIKE '%$keyword%' OR mgg.code = '$keyword')
        AND ('$trangthai' = ''  OR mgg.trangthai = '$trangthai')
        AND ('$id_dm' = '' OR mgg.ID_loai = '$id_dm')
        AND ('$from_date' = '' OR mgg.ngaybatdau BEtWEEN '$from_date' AND mgg.ngayketthuc) 
        AND ('$to_date' = '' OR mgg.ngaybatdau <= '$to_date')
        AND ('$from_date' = '' OR '$to_date' = '' OR (mgg.ngaybatdau BETWEEN '$from_date' AND '$to_date'))
        LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function TongMaGiamGia() {
        $sql = "SELECT * FROM magiamgia";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function ThemMoi($idloai, $tenma, $hinhanh, $macode, $mota, $luonggiam, $ngaybatdau, $ngayketthuc, $dktt, $dktd, $id_sudung, $id_sp)    
    {
        $sql = "INSERT INTO magiamgia (ID_loai, ID_KH, tenma, image1,code,mota,luonggiam,ngaybatdau,ngayketthuc,trangthai, dieukientoithieu, dieukientoida, 
        id_sudungcode, id_sp, id_loaisp, gioihan_code, gioihan_sp, gioihan_nguoidung)
                VALUES ('$idloai', '1', '$tenma', '$hinhanh', '$macode', '$mota', '$luonggiam', '$ngaybatdau', '$ngayketthuc', '1', 
                '$dktt', '$dktd', '$id_sudung', '$id_sp', '1', '1', '1', '1')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ThemMoi1($ten) {
        $sql = "INSERT INTO magiamgia (tenma)
                VALUES ('$ten')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DanhSach2($code) {
        $sql = "SELECT * FROM giohang as gh, magiamgia as mgg WHERE gh.code_giam = mgg.code AND gh.code_giam = $code";
        $result = $this->db->select($sql);
        return $result;
    }
   
    public function LuongGiam($ma_code)
    {
        $sql = "SELECT donvigiam, code, id_sp,id_sudungcode, id_sanphamgiamgia, id_loaisp, ID_loai, luonggiam, dieukientoithieu, dieukientoida, trangthai from magiamgia,loaimagiam WHERE magiamgia.ID_loai = loaimagiam.ID AND code = '$ma_code'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function Xoa($id)
    {
        $sql = "DELETE FROM magiamgia WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


}