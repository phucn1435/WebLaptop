<?php 

class TaiKhoan1 {
    public $tendangnhap;
    public $matkhau; 
   

    public function setTenDangNhap ($username) {
        $this->username = trim($username);
    }

    public function getTenDangNhap () {
        return $this->username;
    }

    public function setMatKhau ($password) {
        $this->password = trim($password);
    }

    public function getMatKhau () {
        return $this->password;
    }

  
    // public function arrayData() {
    //     return [
    //         'tenDangNhap' => $this->getTenDangNhap(),
    //         'matKhau' => $this->getMatKhau()
    //     ];
    // }

}

?>


<?php
use PHPUnit\Framework\TestCase;
use Mockery\MockInterface;


class Database1 {
    // public function luuDuLieu(array $data) {
    //     // Lưu dữ liệu vào cơ sở dữ liệu
    //     // ...
    //     return true; // Giả sử lưu thành công
    // }

    public function layDuLieu($tenDangNhap) {
        // Lấy dữ liệu từ cơ sở dữ liệu
        // ...
        return ['ten_dang_nhap' => $tenDangNhap, 'mat_khau' => 'password123']; // Giả sử dữ liệu lấy ra từ cơ sở dữ liệu
    }
}


class DangNhapTest extends TestCase {
    
    public function dangNhapTest() {
        $databaseMock = $this->getMockBuilder('Database') // Thay 'YourDatabaseClass' bằng tên lớp cụ thể của bạn
        ->disableOriginalConstructor() // Tắt việc gọi constructor của lớp cơ sở dữ liệu
        ->getMock();
        $taikhoan = new TaiKhoan();
        $taikhoan->setTenDangNhap('HP6566');
        $taikhoan->setMatKhau('123456');
        $tendangnhap = $taikhoan->getTenDangNhap();
        $matkhau = $taikhoan->getMatKhau();

        // Thiết lập giả định: hàm layDuLieu sẽ trả về dữ liệu giả định
        $databaseMock->method('layDuLieu')->willReturn(['ten_dang_nhap' => 'user123', 'mat_khau' => 'password123']);
        
        // Thực hiện hành động lấy dữ liệu từ cơ sở dữ liệu
        $retrievedData = $databaseMock->layDuLieu($dataToInsert['ten_dang_nhap']);
    }
//     public function testTenKhachHang() {
//         $taikhoan = new TaiKhoan();
//         $taikhoan->setTenKhachHang('HP');
//         $taikhoan->setMatKhau('123456');
//         $tendangnhap = $taikhoan->getTenDangNhap();

//         $tenKhachHang = $taikhoan->getTenKhachHang();
//         $this->assertNotEmpty($tenKhachHang, 'Giá trị không phải là rỗng.');
//     }

//     public function testTenDangNhap() {
//         $taikhoan = new TaiKhoan();
//         $taikhoan->setTenDangNhap('ph');

//         $tendangnhap = $taikhoan->getTenDangNhap();
//         $this->assertNotEmpty($tendangnhap, 'Giá trị không phải là rỗng.');
//         $this->assertGreaterThanOrEqual(3, strlen($tendangnhap), 'Tên đăng nhập phải có ít nhất 3 ký tự.');
//         $this->assertLessThanOrEqual(30, strlen($tendangnhap), 'Tên đăng nhập tối đa 30 ký tự.');
//     }

//     public function testTenDangNhapTrung() {
//         // Tạo một thể hiện của lớp TaiKhoanMock thay vì TaiKhoan
//         $taikhoan = new TaiKhoanMock();
    
//         // Sử dụng phương thức được ghi đè trong kiểm thử để đặt giá trị cho tên đăng nhập
//         $taikhoan->setTenDangNhap('phucn782');
    
//         // Lấy giá trị của tên đăng nhập
//         $tendangnhap = $taikhoan->getTenDangNhap();
    
//         // Kiểm tra xem tên đăng nhập có coi là trùng lặp hay không, và xử lý tùy thuộc vào kết quả
//         $this->assertTrue($taikhoan->kiemTraKhongTrungTenDangNhap(), 'Tên đăng nhập đã tồn tại trong cơ sở dữ liệu.');
//     }
    

//     public function testMatKhau() {
//         // Tạo một đối tượng TaiKhoan mới
//         $taikhoan = new TaiKhoan();

//         // Thiết lập mật khẩu và nhập lại mật khẩu cho đối tượng
//         $taikhoan->setMatKhau('123456');
//         $taikhoan->setRe_MatKhau('123456');
    
//         // Lấy giá trị của mật khẩu và nhập lại mật khẩu
//         $matkhau = $taikhoan->getMatKhau();
//         $re_matkhau = $taikhoan->getRe_MatKhau();
    
//         // Kiểm tra mật khẩu
//         $this->assertNotEmpty($matkhau, 'Giá trị không phải là rỗng.');
//         $this->assertGreaterThanOrEqual(3, strlen($matkhau), 'Tên đăng nhập phải có ít nhất 3 ký tự.');
//         $this->assertLessThanOrEqual(30, strlen($matkhau), 'Tên đăng nhập tối đa 30 ký tự.');
    
//         // Kiểm tra nhập lại mật khẩu
//         $this->assertNotEmpty($re_matkhau, 'Giá trị không phải là rỗng.');
//         $this->assertGreaterThanOrEqual(3, strlen($re_matkhau), 'Tên đăng nhập phải có ít nhất 3 ký tự.');
//         $this->assertLessThanOrEqual(30, strlen($re_matkhau), 'Tên đăng nhập tối đa 30 ký tự.');
    
//         // Kiểm tra xem mật khẩu và nhập lại mật khẩu có trùng khớp không
//         $this->assertEquals($matkhau, $re_matkhau, 'Mật khẩu và nhập lại mật khẩu không trùng khớp.');
//     }

//     public function testLuuDuLieuDB() {
//          // Mảng dữ liệu mẫu
//          $taikhoan = new TaiKhoan();
//          $taikhoan->setTenKhachHang = 'HoaiPhuc';
//          $taikhoan->setTenDangNhap = 'phucn555';
//          $taikhoan->setMatKhau = '123123123';
 
//          $dataToInsert = $taikhoan->arrayData();

//           // Tạo mock cho lớp truy cập cơ sở dữ liệu
//         $databaseMock = $this->getMockBuilder('Database') // 
//         ->disableOriginalConstructor() // gọi constructor của lớp cơ sở dữ liệu
//         ->getMock();

//         // Thiết lập giả định: hàm luuDuLieu sẽ trả về true
//         $databaseMock->method('luuDuLieu')->willReturn(true);
          
//         // Thực hiện hành động lưu dữ liệu vào cơ sở dữ liệu
//         $result = $databaseMock->luuDuLieu($dataToInsert);

//         // Kiểm tra xem hành động lưu dữ liệu có thành công không
//         $this->assertTrue($result, 'Lưu dữ liệu vào cơ sở dữ liệu không thành công.');
//     }
//     public function testLuuVaLayDuLieuTuCSDL() {
//         // Mảng dữ liệu mẫu
//         $taikhoan = new TaiKhoan();
//         $taikhoan->setTenKhachHang = 'HoaiPhuc';
//         $taikhoan->setTenDangNhap = 'phucn555';
//         $taikhoan->setMatKhau = '123123123';

//         $dataToInsert = $taikhoan->arrayData();

//          // Tạo mock cho lớp truy cập cơ sở dữ liệu
//         $databaseMock = $this->getMockBuilder('Database') // Thay 'YourDatabaseClass' bằng tên lớp cụ thể của bạn
//         ->disableOriginalConstructor() // Tắt việc gọi constructor của lớp cơ sở dữ liệu
//         ->getMock();
//         // $dataToInsert = [
//         //     'ten_dang_nhap' => 'user123',
//         //     'mat_khau' => 'password123'
//         //     // 'email' => 'user@example.com'
//         //     // ... other fields ...
//         // ];

       

//         // Thiết lập giả định: hàm luuDuLieu sẽ trả về true
//         $databaseMock->method('luuDuLieu')->willReturn(true);

//         // Thiết lập giả định: hàm layDuLieu sẽ trả về dữ liệu giả định
//         $databaseMock->method('layDuLieu')->willReturn(['ten_dang_nhap' => 'user123', 'mat_khau' => 'password123']);
//  // Thực hiện hành động lấy dữ liệu từ cơ sở dữ liệu
//  $retrievedData = $databaseMock->layDuLieu($dataToInsert['ten_dang_nhap']);
//         // Thực hiện hành động lưu dữ liệu vào cơ sở dữ liệu
//         $result = $databaseMock->luuDuLieu($dataToInsert);

//         // Kiểm tra xem hành động lưu dữ liệu có thành công không
//         $this->assertTrue($result, 'Lưu dữ liệu vào cơ sở dữ liệu không thành công.');

       

//         // Kiểm tra xem dữ liệu đã được lưu và lấy đúng cách hay không
//         // $this->assertEquals($dataToInsert, $retrievedData, 'Dữ liệu không được lưu và lấy đúng cách.');
//     }

    
}


?>