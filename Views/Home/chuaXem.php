<?php 
$action = $_POST['action'];
if ($action == "xemTatCa") {
    // Xử lý yêu cầu xem tất cả thông báo
    // Thực hiện truy vấn cơ sở dữ liệu để lấy tất cả các mục tin chưa xem
    // $result = // Thực hiện truy vấn để lấy danh sách các mục tin chưa xem từ cơ sở dữ liệu

    // Xử lý kết quả truy vấn và tạo HTML để hiển thị danh sách các mục tin chưa xem
    // $output = "<ul>";
    // while ($row = // Lấy từng hàng dữ liệu từ kết quả truy vấn) {
    //     // Tạo mục tin từ dữ liệu trong hàng
    //     $output .= "<li>" . $row['thong_bao'] . "</li>";
    // }
    // $output .= "</ul>";
    $output = 1;

    echo $output;
}

?>