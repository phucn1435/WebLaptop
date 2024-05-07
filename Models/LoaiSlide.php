<?php
class LoaiSlide{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSach()
    {
        $sql = "SELECT * FROM loaislides";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function DanhSachBanner($id)
    // {
    //     $sql = "SELECT * FROM sildes WHERE ID_loaisanpham = '$id'";
    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    public function ThemMoi($idloaisanpham, $image)
    {
        $sql = "INSERT INTO sildes(ID_loaisanpham,hinhanh) 
        VALUES ('$idloaisanpham','$image')";
        $result = $this->db->execute($sql);
        return $result;
    }
}