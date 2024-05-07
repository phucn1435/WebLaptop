<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị tháng từ yêu cầu Ajax
    $selectedMonth = $_POST['month'];

    // Tính số ngày trong tháng
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date('Y'));

    // Tạo danh sách các ngày
    $options = '';
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $options .= "<option value='$day'>$day</option>";
    }

    // Trả về danh sách ngày dưới dạng HTML
    echo $options;
}
?>
