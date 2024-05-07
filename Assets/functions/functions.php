<?php
class Functions{
    private $db;

    public function exportExcel($data, $filePath, $columnNames = [])
    {
        // Tạo một đối tượng PHPExcel
        $objPHPExcel = new PHPExcel();
    
        // Lặp qua các cột dữ liệu để thiết lập tên cột nếu được cung cấp
        if (!empty($columnNames)) {
            $columnIndex = 'A';
            foreach ($columnNames as $columnName) {
                $objPHPExcel->getActiveSheet()->setCellValue($columnIndex . '1', $columnName);
                $columnIndex++;
            }
        }
    
        // Lặp qua các dòng dữ liệu trong mảng $data và tiến hành ghi dữ liệu vào file excel
        $row = 2; // Bắt đầu từ hàng thứ hai
        foreach ($data as $rowData) {
            $columnIndex = 'A';
            foreach ($rowData as $cellData) {
                $objPHPExcel->getActiveSheet()->setCellValue($columnIndex . $row, $cellData);
                $columnIndex++;
            }
            $row++;
        }
    
        // Tiến hành lưu file
        // header('Content-type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment; filename="'.$filename.'_'.time().'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($filePath);
    }

  
    // Sử dụng hàm exportExcel để tạo và ghi dữ liệu vào file Excel
    // $now = time();
    // $filePath = 'D:\Download\product_import-' . $now . ".xlsx";
    // $data = $this->model->DanhSach(100, 0); // Lấy dữ liệu từ database
    // $columnNames = []; // Tên các cột dữ liệu
    // exportExcel($data, $filePath, $columnNames);
    
}