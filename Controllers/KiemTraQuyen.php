<?php
include_once("Models/VaiTroTaiKhoan.php");
include_once("Models/TaiKhoanNhanVien.php");
include_once("Models/Quyen.php");

  $str = $_SERVER['REQUEST_URI']; 
  $pattern = '/ChiTietDonHangBan\/DanhSach/';
  if(preg_match($pattern, $str) !== 1){
      unset($_SESSION['hehe']);
  }

if (!function_exists('check')) {
    function check($uri = false) {
            
    $taikhoan = new TaiKhoanNhanVien();
    $vaitro = new VaiTroTaiKhoan();
    $getInfo = $taikhoan->find($_SESSION['dangnhap1']);
    $getRole = $getInfo[0]['role'];
    // print_r($_SESSION['dangnhap1']);
    // $getQuyen1 = [];
    $array_role = explode(",", $getRole);
    // print_r($array_role);
   
    foreach($array_role as $item) {
        $getQuyen = $vaitro->LayPathTuRole($item);
        foreach($getQuyen as $item1) {
            $getQuyen1[] = $item1['duongdan'];
        }
    }
   
    $getQuyen1 = array_unique($getQuyen1);
    
    $uri = $uri != false ? $uri : $_SERVER['REQUEST_URI'];
    
    $flag = false;
    if (!empty($getQuyen1)) {
        foreach($getQuyen1 as $item) {
            if (preg_match($item, $uri) == 1) {
                $flag = true;
                break;
            }   
        }
    }

    // print_r(preg_match("/^SanPham\/ThemMoi/", "SanPham/ThemMoi"));



    return $flag;
    
    }
 }
?>
