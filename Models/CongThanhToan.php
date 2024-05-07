<?php
class CongThanhToan{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function ThemMoi($partner_code, $order_id, $amount, $order_info, $order_type, $trans_id, $pay_type, $id_dhb){
        $sql = "INSERT INTO tbl_momo (partner_code, order_id, amount, order_info, order_type, trans_id, pay_type, id_dhb )
        VALUES ('$partner_code','$order_id', $amount, '$order_info', '$order_type', $trans_id, '$pay_type', $id_dhb)";
        $result = $this->db->execute($sql);
        return $result;
    }

    public function ThemMoiVNPay($vnp_amount, $vnpay_bankcode, $vnp_banktrans, $card_type, $vnp_orderinfo, $vnp_paydate, $vnp_tmncode, $vnp_transaction, $id_dhb){
        $sql = "INSERT INTO tbl_vnpay (vnp_amount, vnp_bankcode, vnp_banktrans, vnp_cardtype, vnp_orderinfo, vnp_paydate, vnp_tmncode, vnp_transaction, id_dhb )
                VALUES ('$vnp_amount','$vnpay_bankcode', '$vnp_banktrans', '$card_type', '$vnp_orderinfo', '$vnp_paydate', '$vnp_tmncode', '$vnp_transaction', $id_dhb)";
        $result = $this->db->execute($sql);
        return $result;
    }
    
    public function DanhSachVNPay($id)
    {
        $sql = "SELECT * FROM tbl_vnpay as tbl, donhangban as dhb WHERE dhb.ID = tbl.id_dhb AND tbl.id_dhb = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhat($id,$idnhanvienlap,$idkhachhang,$idtrangthai,$ngaylap,$tongtien)
    {
        $sql = "UPDATE donhangban SET 
        idnhanvienlap = '$idnhanvienlap',
        idkhachhang = '$idkhachhang',
        idtrangthai = '$idtrangthai',
        ngaylap = '$ngaylap',
        tongtien = '$tongtien'
        WHERE id = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } 
}