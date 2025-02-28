<?php

class ChiTietDonHangMua{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }   
    public function DanhSach($id,$item,$offset)
    {
        $sql = "SELECT ct.ID, ct.idDonHangMua, sp.TenSanPham, ct.SoLuong, ct.DonGiaApDung, ct.ThanhTien
        FROM chitietdonhangmua ct
        INNER JOIN sanpham sp ON ct.idSanPham = sp.ID
       
        WHERE ct.idDonHangMua = '$id' LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    public function TongChiTietDHM() {
        $sql = "SELECT * FROM chitietdonhangmua";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
    public function find($id)
    {
        $sql = "SELECT ct.ID, ct.idDonHangMua, ct.idSanPham, sp.TenSanPham, ct.SoLuong, ct.DonGiaApDung, ct.ThanhTien
        FROM chitietdonhangmua ct
        INNER JOIN sanpham sp ON ct.idSanPham = sp.ID
       
        AND ct.ID = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ThemMoi($iddonhangmua,$idsanpham, $soluong, $dongiaapdung)
    {
        $id = null;
        $thanhtien = $this->ThanhTien($soluong, $dongiaapdung);
        $sql = "INSERT INTO chitietdonhangmua (idDonHangMua,idSanPham,SoLuong,DonGiaApDung,ThanhTien)
            VALUES ('$iddonhangmua','$idsanpham', '$soluong', '$dongiaapdung', '$thanhtien')";
            
        $result = mysqli_query($this->db->conn, $sql);
        $id = mysqli_insert_id($this->db->conn);

        //$result = $this->db->execute($sql);
        $capnhattongtien = $this->CapNhatTongTien($iddonhangmua);
        // $capnhatsoluong = $this->CapNhatSoLuong($id,$idsanpham);
        if ($result) {
            return array($capnhattongtien,$capnhatsoluong);
        } else {
            return false;
        }
    }
    public function CapNhatTongTien($iddonhangmua)
    {
        $sql = "UPDATE donhangmua
        SET TongTien = (SELECT SUM(soluong * dongiaapdung) 
                         FROM ChiTietDonHangMua 
                         WHERE idDonHangMua = '$iddonhangmua') 
        WHERE ID = '$iddonhangmua'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function CapNhatSoLuong($id,$idsanpham)
    {
        $sql = "UPDATE SanPham
        SET SoLuong = SoLuong + (SELECT soluong 
                         FROM ChiTietDonHangMua
                         WHERE idSanPham = '$idsanpham'
                         AND ID =  '$id') 
        WHERE ID = '$idsanpham'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function SoLuongBanDau($id,$idsanpham)
    {
        $sql = "UPDATE SanPham
        SET SoLuong = SoLuong - (SELECT soluong 
                         FROM ChiTietDonHangMua
                         WHERE idSanPham = '$idsanpham'
                         AND ID =  '$id') 
        WHERE ID = '$idsanpham'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    //ĐỪNG XÓA HÀM NÀY !
    // public function CapNhatSoLuong($idsanpham)
    // {
    //     $sql = "UPDATE SanPham
    //     SET SoLuong = (SELECT SUM(soluong) 
    //                      FROM ChiTietDonHangMua
    //                      WHERE idSanPham = '$idsanpham') 
    //     WHERE ID = '$idsanpham'";
    //     $result = $this->db->execute($sql);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    
    public function CapNhat($id,$iddonhangmua,$idsanpham,$soluong,$dongiaapdung)
    {
        $thanhtien= $this->ThanhTien($soluong, $dongiaapdung);
        $soluongbandau = $this->SoLuongBanDau($id,$idsanpham);
        $sql = "UPDATE chitietdonhangmua SET
        idsanpham = '$idsanpham',
        soluong = '$soluong',
        dongiaapdung = '$dongiaapdung',
        thanhtien = '$thanhtien',
        iddonhangmua = '$iddonhangmua'
        WHERE ID = '$id'";
        $result = $this->db->execute($sql);
            
        if ($result) {
            $capnhattongtien = $this->CapNhatTongTien($iddonhangmua);
            $capnhatsoluong = $this->CapNhatSoLuong($id,$idsanpham);
            return true;
        } else {
            return false;
        }
    }
    
    public function Xoa($id,$iddonhangmua)
    {
        $sql = "DELETE FROM chitietdonhangmua WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            $capnhattongtien = $this->CapNhatTongTien($iddonhangmua);
            return true;
        } else {
            return false;
        }
    }
    public function ThanhTien($soluong,$dongiaapdung)
    {
        $thanhTien = null;
        return $thanhTien = $soluong * $dongiaapdung;
    }

    public function XoaHet($id) {
        $sql = "DELETE FROM chitietdonhangmua WHERE idDonHangMua = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            // $capnhattongtien = $this->CapNhatTongTien($iddonhangban);
            return true;
        } else {
            return false;
        }

    }

    public function test($id){
        $sql = " SELECT idSanPham, SUM(soluong) AS total_quantity
        FROM chitietdonhangmua
        WHERE idDonHangMua = '$id'
        GROUP BY idSanPham";
        $result = $this->db->select($sql);
        return $result;
    }

    public function hihi1($idsanpham,$tongsoluong) {
        $sql = "UPDATE sanpham
        SET SoLuong = SoLuong + $tongsoluong
        WHERE ID = '$idsanpham'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}