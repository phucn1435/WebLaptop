  <?php
  include_once("Models/SanPham.php");
  include_once("Models/LoaiSanPham.php");
  include_once("Models/TrangThai.php");
  include_once("Models/ThongBao.php");
  include_once("Models/NhanVien.php");
  include_once("Models/ChamCong.php");
  include_once("Models/DonHangBan.php");
  include_once("Models/Database.php");
  include_once("Models/ChiTietDonHangMua.php");
  include_once("Models/ChiTietDonHangBan.php");
  include_once("Models/DonHangMua.php");
  include_once("Models/KhachHang.php");
  include_once("Models/Tintuc.php");
  include_once("Models/GioHang.php");
  include_once("Models/ThongTinThanhToan.php");
  include_once("Models/Slide.php");
  include_once("Assets/Carbon/autoload.php");
  include_once("Models/VaiTroTaiKhoan.php");
  include_once("Models/LoaiQuyen.php");
  include_once("Models/Quyen.php");
  include_once("Models/forgotPassword.php");
  include_once("Controllers/General.php");
  include_once("Models/loginKhachHang.php");
  include_once("Models/ThanhToan.php");
  include_once("Assets/tfpdf/tfpdf.php");
  include_once("Models/TaiKhoanNhanVien.php");
  include_once("Models/TaiKhoanKhachHang.php"); 
  include_once("Models/NguonHang.php");
  include_once("Models/LoaiTinTuc.php");
  include_once("Models/MaGiamGia.php");
  include_once("Models/LoaiMaGiamGia.php");
  include_once("Models/LoaiQuyen.php");//
  include_once("Models/LoaiSlide.php");
  include_once("Models/PhanQuyen.php");
  include_once("Models/KhachHang.php"); 
  include_once("Models/CongThanhToan.php");
  include_once("Models/NhuCauNguoiDung.php");
  include_once("Models/MauSac.php");
  include_once("Models/ShowRoom.php");
  include_once("Models/PhiShip.php");
  include_once("Models/WhistList.php");
  include_once("Models/ThuocTinhSanPham.php");
  include 'Assets/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
  include 'Assets/functions/functions.php';










// Đường dẫn tới thư mục cần liệt kê các tệp
// $dir = 'Models';

// // Liệt kê tất cả các tệp trong thư mục và lưu vào mảng $files
// $files = scandir($dir);

// // Hiển thị danh sách các tệp
// // foreach ($files as $file) {
// //     $path = "Models/" .$file;
// //     include_once("$path");
// //     echo "<br>";
// // }

// foreach ($files as $file) {
//   if ($file != "." && $file != "..") {
//     $path = "Models/" .$file;
//     include_once("$path");
//     echo "<br>";
//   }
// }
?>