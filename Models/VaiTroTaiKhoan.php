<?php

class VaiTroTaiKhoan{
    private $db;
    private $conn;

    public function __construct(){
        $this->db = new Database();
    }
    public function DanhSachVaiTro($item,$offset) {
        $sql = "SELECT * FROM vaitro LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }

    public function LocTest($keyword,$item,$offset) {
        $sql = "SELECT *
        FROM vaitro as vt
        WHERE ('$keyword' = '' OR vt.tenvaitro LIKE '%$keyword%' OR vt.ID = '$keyword') LIMIT ".$item." OFFSET ".$offset;
        $result = $this->db->select($sql);
        return $result;
    }
    
    public function ThemMoi($tenvaitro, $dataQuyen)
    {
        $sqlRole = "INSERT INTO vaitro (tenvaitro) VALUES ('$tenvaitro')";
        if ($this->db->conn->query($sqlRole) === TRUE) {
            $idRole = $this->db->conn->insert_id;
            
            foreach ($dataQuyen as $data) {
                // Thực hiện câu lệnh INSERT
                    $sqlChiTiet = "INSERT INTO vaitro_quyen (ID_vaitro, ID_quyen) VALUES ($idRole, $data)";
                    $this->db->execute($sqlChiTiet);
            }
        }else{echo'lỗi foreach';};
    }

    public function getTen($id) {
        $sql = "SELECT tenvaitro from vaitro WHERE ID = $id";
        $result = $this->db->select($sql);
        return $result;
    }
 
    public function LayPathTuRole($id) {
        $sql = "SELECT q.duongdan from vaitro_quyen as vt, quyen as q WHERE     
        vt.ID_quyen = q.ID and ID_vaitro = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function ChiTiet($id) {
        $sql = "SELECT *,tenvaitro FROM vaitro_quyen as vt_q, quyen as q,vaitro as vt WHERE vt_q.ID_vaitro = vt.ID and vt_q.ID_quyen = q.ID and vt_q.ID_vaitro = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function CapNhat($id, $dataQuyen) {
        $sql = "DELETE FROM vaitro_quyen WHERE ID_vaitro = $id";
        if ($this->db->conn->query($sql) === TRUE) { 
            foreach ($dataQuyen as $data) {
                // Thực hiện câu lệnh INSERT
                    $sqlChiTiet = "INSERT INTO vaitro_quyen (ID_vaitro, ID_quyen) VALUES ($id, $data)";
                    $this->db->execute($sqlChiTiet);
            }
        }else{echo'lỗi foreach';};
    }

    public function Xoa($id)
    {
        $sql = "DELETE FROM vaitro WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function TongVaiTro() {
        $sql = "SELECT * FROM vaitro";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }

    
}

   

