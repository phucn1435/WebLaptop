<?php 
    include_once("Models/Database.php");
    //Checklist
    /*
        1. Chuẩn bị Có sở dữ liệu
        2. Tạo giao diện
        3. Connect Db
        4. Get Province
        5. Ajax show District
        6. Ajax show Awards
        7. Show kết quả
        */
        $this->db = new Database();
    
    $province_id = $_GET['province_id'];
    
    $sql = "SELECT * FROM `district` WHERE `province_id` = {$province_id}";
    $result = mysqli_query($this->db->conn, $sql);

    $data[0] = [
        'id' => null,
        'name' => 'Chọn một Quận/huyện'
    ];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id' => $row['district_id'],
            'name'=> $row['name']
        ];
    }
    echo json_encode($data);
?>