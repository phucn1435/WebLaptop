<?php
// Include thư viện PHP Spreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo một đối tượng Spreadsheet mới
$spreadsheet = new Spreadsheet();

// Lấy active sheet
$sheet = $spreadsheet->getActiveSheet();

// Thêm dữ liệu vào các ô
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('A2', '1');
$sheet->setCellValue('B2', 'John');
$sheet->setCellValue('A3', '2');
$sheet->setCellValue('B3', 'Doe');

// Tạo một đối tượng Writer cho định dạng Excel (Xlsx)
$writer = new Xlsx($spreadsheet);

// Đặt header cho tập tin
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="example.xlsx"');
header('Cache-Control: max-age=0');

// Ghi tập tin Excel vào đầu ra (output)
$writer->save('php://output');
?>
