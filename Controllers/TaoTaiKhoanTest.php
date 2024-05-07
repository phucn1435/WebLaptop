<?php 
// TaoTaiKhoanTest.php
use PHPUnit\Framework\TestCase;

class TaoTaiKhoanTest extends TestCase {
    
    public function testEmptyInput()
    {
        // Chuẩn bị dữ liệu đầu vào rỗng
        $_POST['submit'] = true;
        $_POST['tenkhachhang'] = '';
        $_POST['tendangnhap'] = '';
        $_POST['matkhau'] = '';
        $_POST['matkhau2'] = '';

        // Tạo đối tượng của class TaiKhoanService
        $taiKhoanService = new TaiKhoanService(); // Đảm bảo thay thế TaiKhoanService với tên thực tế của class chứa hàm TaoTaiKhoan

        // Gọi hàm TaoTaiKhoan
        $taiKhoanService->TaoTaiKhoan();

        // Kiểm tra rằng thông báo đúng đã được đặt
        $this->assertEquals("Dữ liệu nhập vào không được rỗng. Vui lòng kiểm tra lại.", $taiKhoanService->getMess());
    }

    // Thêm các phương thức kiểm thử khác tương tự cho các trường hợp khác
}

?>