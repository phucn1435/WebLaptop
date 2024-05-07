    <?php

    class PhiShip{
        private $db;
        private $conn;

        public function __construct(){
            $this->db = new Database();
        }

        public function DanhSach($item,$offset) {
            $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, 
            d.name as nameDistrict FROM fee_ship as fs, ward as w, province as p, 
            district as d WHERE fs.ID_tinh = p.province_id AND fs.ID_quan = d.district_id 
            AND fs.ID_xa = w.ward_id ORDER BY ID ASC LIMIT ".$item." OFFSET ".$offset;
            $result = $this->db->select($sql);
            return $result;
        }

        public function LocTest($city,$district,$ward,$item,$offset) {
            $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, 
            d.name as nameDistrict FROM fee_ship as fs, ward as w, province as p, 
            district as d WHERE fs.ID_tinh = p.province_id AND fs.ID_quan = d.district_id 
            AND fs.ID_xa = w.ward_id";

            // Thêm điều kiện tìm kiếm theo thành phố, quận và xã
            if (!empty($city) && empty($district) && empty($ward)) {
                $sql .= " AND fs.ID_tinh = '$city'";
            } elseif (!empty($city) && !empty($district) && empty($ward)) {
                $sql .= " AND fs.ID_tinh = '$city' AND fs.ID_quan = '$district'";
            } elseif (!empty($city) && !empty($district) && !empty($ward)) {
                $sql .= " AND fs.ID_tinh  = '$city' AND fs.ID_quan = '$district' AND fs.ID_xa = '$ward'";
            }

            // Thêm phần giới hạn và lùi offset
            $sql .= " LIMIT $item OFFSET $offset";

            $result = $this->db->select($sql);
            return $result;
        }

        public function TongPhiShip() {
            $sql = "SELECT * FROM fee_ship";
            $result = mysqli_query($this->db->conn, $sql);
            $result = $result->num_rows;
            return $result;
        }

        public function DanhSachTP($id,$item,$offset) {
            $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM fee_ship as fs, ward as w, province as p, district as d WHERE fs.ID_tinh = p.province_id AND fs.ID_quan = d.district_id AND fs.ID_xa = w.ward_id 
            AND p.province_id = $id
            ORDER BY ID ASC LIMIT ".$item." OFFSET ".$offset;
            $result = $this->db->select($sql);
            return $result;
        }

        public function DanhSachTP_Quan($id,$id1,$item,$offset) {
            $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM fee_ship as fs, ward as w, province as p, district as d WHERE fs.ID_tinh = p.province_id AND fs.ID_quan = d.district_id AND fs.ID_xa = w.ward_id 
            AND p.province_id = $id AND d.district_id = $id1
            ORDER BY ID ASC LIMIT ".$item." OFFSET ".$offset;
            $result = $this->db->select($sql);
            return $result;
        }

        public function DanhSachTP_Quan_Xa($id,$id1, $id2,$item,$offset) {
            $sql = "SELECT *,w.name as nameWard, p.name as nameProvince, d.name as nameDistrict FROM fee_ship as fs, ward as w, province as p, district as d WHERE fs.ID_tinh = p.province_id AND fs.ID_quan = d.district_id AND fs.ID_xa = w.ward_id 
            AND p.province_id = $id AND w.ward_id = $id2 AND d.district_id = $id1
            ORDER BY ID ASC LIMIT ".$item." OFFSET ".$offset;
            $result = $this->db->select($sql);
            return $result;
        }

        public function ThemMoi($tp,$quan,$xa,$phi) {
            $sql = "INSERT INTO fee_ship(ID_tinh,ID_quan, ID_xa, fee) 
            VALUES ('$tp','$quan', '$xa', '$phi')";
            $result = $this->db->execute($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function Update($id,$fee) {
            $sql = "UPDATE fee_ship SET
            fee = $fee
            WHERE ID = $id";
            $result = $this->db->execute($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function PhiVanChuyen($id,$id1,$id2) {
            $sql = "SELECT fee from fee_ship where ID_tinh = $id AND ID_quan = $id1 AND ID_xa = $id2";
            $result = $this->db->select($sql);
            return $result;
        }

        public function Xoa($id) {
            $sql = "DELETE FROM fee_ship WHERE ID = '$id'";
            $result = $this->db->execute($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
    ?>