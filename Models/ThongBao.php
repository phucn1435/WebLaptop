<?php
class ThongBao{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function ThemMoi($iddh,$idkh,$content,$ngay,$action){
        $sql = "INSERT INTO thongbao (ID_DH,ID_KH,content,ngay,action)
        VALUES ('$iddh','$idkh', '$content', '$ngay', $action)";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ThemMoi1($iddh,$idkh,$content,$ngay,$action){
        $sql = "INSERT INTO thongbao (ID_DH,ID_KH,content,ngay,action)
        VALUES ('$iddh','$idkh', '$content', '$ngay', $action)";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function TongThongBao($id) {
        $sql = "SELECT * FROM thongbao WHERE action=0 and ID_KH=$id";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    public function DanhSach($idkh){
        $sql = "SELECT * from thongbao as tb where tb.ID_KH='$idkh' ORDER BY ID DESC";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachAdmin(){
        $sql = "SELECT * from thongbao as tb where tb.ID_KH=0 ORDER BY ID DESC";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTiet($id) {
        $sql = "SELECT * FROM thongbao WHERE ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    
    public function DanhSach1(){
        $sql = "SELECT * from thongbao as tb where tb.ID_KH = 0 ORDER BY ID DESC";
        $result = $this->db->select($sql);
        return $result;
    }

    public function update($id){
        $sql = "UPDATE thongbao SET action = 1 WHERE ID_DH='$id'";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function update1($id){
        $sql = "UPDATE thongbao SET action = 1 WHERE ID_KH='$id'";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function update2($id){
        $sql = "UPDATE thongbao SET action = 1 WHERE ID='$id'";
        $result = $this->db->execute($sql);
        return $result; 
    }

    public function notice_not_see() {
        $sql = "SELECT count(ID) as notice_not_see FROM thongbao WHERE ID_KH=0 and action=0";
        $result = $this->db->select($sql);
        return $result;
    }


    

   


}