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
    $district_id = $_GET['district_id'];

    // echo $district_id;
    
    $sql = "SELECT * FROM `ward` WHERE `district_id` = {$district_id}";
    $result = mysqli_query($this->db->conn, $sql);
    

    $data[0] = [
        'id' => null,
        'name' => 'Chọn một xã/phường'
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id' => $row['ward_id'],
            'name'=> $row['name']
        ];
    }
    echo json_encode($data);
?>