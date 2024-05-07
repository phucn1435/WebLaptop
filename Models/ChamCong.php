<?php
class ChamCong{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function TongBangLuong() {
        $sql = "SELECT * FROM chamcong GROUP BY ID_user";
        $result = mysqli_query($this->db->conn, $sql);
        $result = $result->num_rows;
        return $result;
    }
   
    public function ThemChamCong($id_user) {
        $cur_date = date("Y-m-d");
        $sql = "INSERT INTO chamcong (ID_user,ngaychamcong)
                VALUES ('$id_user', '$cur_date')";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function Get_Employ_CC() {
        $sql = "SELECT * FROM chamcong WHERE CURDATE() = ngaychamcong";
        $result = $this->db->select($sql);
        return $result;
    }


    public function Get_Year() {
        $sql = "SELECT MIN(YEAR(ngaychamcong)) as min_year, MAX(YEAR(ngaychamcong)) as max_year FROM chamcong";
        $result = $this->db->select($sql);
        return $result;
    }

    public function Xoa($id)
    {
        $sql = "DELETE FROM chamcong WHERE ID = '$id'";
        $result = $this->db->execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function test2() {
        $sql = "SELECT ID_user,
        YEAR(ngaychamcong) AS year,
        MONTH(ngaychamcong) AS month,
        COUNT(DISTINCT DATE(ngaychamcong)) AS work_days
        FROM chamcong GROUP BY ID_user, YEAR(ngaychamcong), MONTH(ngaychamcong);
        ";
        $result = $this->db->select($sql);
        return $result;
    }

    public function test3($id_user) {
        $sql = "SELECT ID_user,
        YEAR(ngaychamcong) AS year,
        MONTH(ngaychamcong) AS month,
        COUNT(DISTINCT DATE(ngaychamcong)) AS work_days
        FROM chamcong WHERE ID_user = '$id_user' GROUP BY ID_user,YEAR(ngaychamcong), MONTH(ngaychamcong);
        ";
        $result = $this->db->select($sql);
        return $result;
    }
    
}