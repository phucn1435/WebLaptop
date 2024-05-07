<?php
class Slide{
    private $db;

    private $idSlideHomeWebSite;

    public function __construct(){
        $this->db = new Database();
        $this->idSlideHomeWebSite = 1;
    }

    public function DanhSach()
    {
        $sql = "SELECT *, lsp.TenLoaiSanPham, slide.hinhanh FROM sildes as slide, loaisanpham as lsp WHERE slide.ID_loaisanpham = lsp.ID";
        $result = $this->db->select($sql);  
        return $result;
    }

    public function DanhSachSlideTC() {
        $sql = "SELECT * FROM sildes WHERE ID_loaislides = '$this->idSlideHomeWebSite'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function DanhSachBanner($id)
    {
        $sql = "SELECT *, slide.hinhanh, lsp.TenLoaiSanPham FROM sildes as slide, loaisanpham as lsp WHERE slide.ID_loaisanpham = lsp.ID and  ID_loaisanpham = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThemMoi($id, $idloaisanpham, $image)
    {
        $sql = "INSERT INTO sildes(ID_loaislides, ID_loaisanpham, hinhanh) 
        VALUES ('$id', '$idloaisanpham','$image')";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function Xoa($id)
    {
        $sql = "DELETE FROM sildes WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function ChiTiet($id) {
        $sql = "SELECT *, sl.ID FROM sildes sl, loaislides lsl, loaisanpham lsp 
        WHERE sl.ID_loaislides = lsl.ID AND sl.ID_loaisanpham = lsl.ID AND sl.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
}