
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <title>Admin</title> -->
	<link rel="stylesheet" type="text/css" href="../Assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../Assets/CSS/style.css">
	<script src="../Assets/scripts/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/3206410232.js" crossorigin="anonymous"></script>

	<!-- Dùng cho file index -->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.min.css">
	<script src="Assets/scripts/bootstrap.bundle.min.js"></script>
	<script src="https://kit.fontawesome.com/3206410232.js" crossorigin="anonymous"></script>
	<script src="../Assets/Scripts/JavaScript.js"></script>

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Popins', sans-serif;
    }

    @keyframes identifier {
        0% {
            background: #03a9f4;
        }

        50% {
            background: #049fe5;
        }

        100% {
            background: #037ca3;
        }
    }

    .remind_notice {
        color: #fff;
        font-size: 16px;
        border-radius: 7px;
        padding: 10px 20px;
        width: auto; 
        height: auto; 
        border: 1px solid #ccc; 
        background: #fff;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        animation: identifier .5s ease-in-out infinite alternate;
    }

    /* .close_notice {
        display: none;
    } */

    .remind_notice:hover {
        cursor: pointer;
        animation: none;
        background: #037ca3;
        color: #fff;
    }

    

    .close_notice:hover {
        color: black;
    }

    .modal2 {
        width: 100%; 
        z-index: 999; 
        height: 100vh; 
        position: fixed; 
        background-color: rgba(0,0,0,0.5);
        display: none;
    }
    .modal2_content {
        z-index: 9999; 
        left: 50%; 
        background: #fff; 
        position: fixed; 
        top: 40%; 
        display: flex; 
        justify-content: center;
        padding: 10px 20px;
        border-radius: 7px;
    }

   
    .wrapper {
        width: 100%;
        height: 100%;
    }

    .header {
        height: 70px;
        width: 100%;
        position: fixed;
       
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: -1px 4px 5px #c1c1c1;
        z-index: 1000;
        background: black;
    }

    .body {
        display: flex;
        z-index: 0;
        
    }

    .left {
        width: 16%;
        min-height: 100vh;
        background-color: black;    
        position: fixed;
        top: 70px;
        transition: linear .3s;
    }

    .left1 {
        width: 0;
        opacity: 0;
        transition: linear .3s;
    }

    .right {
        width: 84%;
        min-height: 100vh;
        left: 16%;
        position: absolute;
        top: 70px;
        transition: linear .3s;
        z-index: 1;
        background-color: #ebebeb;
    }

    .right1 {
        width: 100%;
        left: 0;
        transition: linear .3s;
    }

    .dropdown-toggle::after {
        position: absolute;
        right: 0;
        margin-top: 10px;
        font-size: 20px;
        color: white;
    }
    
    .li1 {
        transition:  .5s ease-in-out;
    }

    .expand {
        left: 10%;
        z-index: 10000000;
        display: block;
    }

    .showWeb {
        display: block;
    }

    .hideWeb {
        display: none;
    }

    .hover1:hover {
        background: #ccc;
    }

    .animation {
        animation: scale 1s ease-in-out infinite;
    }

    @keyframes scale {
        from {
            transform: scale(2);
            opacity: 0.5;
        }
        to {
            opacity: 1;
            transform: scale(1);

        }
    }

    .billManage {
        width: 22%;
        height: auto;
    }

    .content-contain {
        width: 22%; 
        background: red; 
        padding: 10px;
        border-radius: 7px;
    }

    a {
        text-decoration: none;
    }

    .showBell10 {
        position: absolute; 
        right: 0; 
        top: 100%; 
        background: red; 
        
        border-radius: 7px;
        display: none;
         /* Đặt chiều rộng cụ thể cho thanh ngang */
        max-height: 50vh; /* Đặt chiều cao của phần tử cha, ở đây là 100% chiều cao của trình duyệt */
        overflow-y: scroll; /* Tạo thanh ngang khi nội dung dài hơn chiều cao của phần tử cha */
        scrollbar-width: thin; /* Đặt độ dày của thanh ngang */
        scrollbar-color: #888888 #f2f2f2; /* Tùy chỉnh màu sắc của thanh ngang */
        margin-right: 2px;
        width: 300px;
        font-size: 16px;
    }

    .hoverBell:hover .showBell10 {
        display: block;
        /* z-index: 1000; */
      
    }

    .modal1 {
  display: none; 
  /* position: fixed;  */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5); /* Tạo background mờ */
  /* animation: appear1 .7s linear; */
}

.modal-content1 {
  background-color: #fefefe;
  margin: 15% auto; /* Hiển thị modal giữa màn hình */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px; /* Đảm bảo modal không quá rộng */
  border-radius: 5px;
  /* position: relative; */
}

.close_modal {
  color: #aaa;
  /* float: right; */
  font-size: 28px;
  font-weight: bold;
}

.close_modal:hover,
.close_modal:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
<body>
    <div style="" id="" class="modal2">
        <div style="" class="modal2_content">
        <div class="">
            <div style="text-align: right;" class="">            
                <span class="close_modal" style="" >&times;</span>
            </div>
            <p style='font-size: 18px; font-weight: bold; text-align: left;'>Hôm nay bạn chưa chấm công!</p>
            <hr>  
            <div class="text-center">
                <button id="chamcong" class="btn btn-danger">Chấm công ngay</button>
            </div>
        </div>
           
        </div>
    </div>
    <div class="wrapper">
        <div style="z-index: 10000;" class="header">
        <!-- <div id="myModal1" class="modal1">
            <div class='modal-content1'>
            <span class='close1' onclick='closeModal()'>&times;</span>
            <p style='font-size: 20px; font-weight: bold; text-align: left;'>Quyền của vai trò: <span style='color: red;'>$tenvaitro</span></p>
            <hr>
            
        </div> -->
            <div style="width: 16%;" class="">
                <img style="width: 100%; height: 100%;" src="https://top10soctrang.vn/wp-content/uploads/2021/07/phong-vu-soc-trang-2-1024x312.jpg" lt="">
            </div>
            <div style="width: 84%; display: flex; justify-content: space-between; align-items: center;" class="">
                <div style="width: 100%; height: 100%; display: flex;" class="">
                    <div id="showWeb1" style="cursor: pointer; display: flex; justify-content: center; align-items: center; background: gray; width: 20px; height: 20px; border-radius: 50%; font-size: 20px; color: white; font-weight: bold; margin-left: 10px;" class="">
                            +
                    </div>
                    <div style="margin-left: 10px;" class="showWeb" id="showw">
                        <a target="_blank" style="text-decoration: none; color: white;" href="../TrangChu/Index">Website</a>
                    </div>
                </div>
               
                <div style="display: flex;" class="">
                    <!-- <div style="margin-left: 20px;" class="">
                        <a href="">
                            Home
                        </a>
                    </div>
                    <div style="margin-left: 20px;" class="">
                        <a href="">
                            Setting
                        </a>
                    </div>
                    <div style="margin-left: 20px;" class="">
                        <a href="">
                            Info
                        </a>
                    </div> -->
                </div>
                
                <div style="margin-right: 20px; display: flex; align-items:center;" class="">
                    <div style="cursor: pointer; z-index: 100;color: white; margin-right: 10px; font-size: 20px; position: relative;" class="hoverBell">
                        <i class="fa-regular fa-bell"></i>
                        <div class="" style="position: absolute; right: 0; top: 0; border-radius: 50%; background: red; height: 12px; width: 12px;"></div>
                        <div class="showBell10" style="background: #fff; box-shadow: 1px 2px 3px 4px #ccc;">
                        <?php if(is_array($thongbaoadmin)) foreach($thongbaoadmin as $row) : extract($row); ?>    
                        <div style="padding: 7px;" class="hover1">
                               
                                <a style="text-decoration: none; margin-top: 10px; display: inline-block;" href="../ThongBao/DanhSach" class="">
                                    <div class=""><?=$row['content'];?></div>
                                    <div style="color: blue; font-size: 13px; font-weight: 550; margin-left: 15px;" class=""><?=$row['ngay'];?></div>
                                </a>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="dropdown">
                        <a style="margin-right: 10px; background: none; border: none;" class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Adminstrator
                        </a>
                      
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="../Home/Logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%; height: 100%; z-index: 0;" class="body">
            <div class="body1">
                <div id="leftt" style="overflow: hidden;" class="left">
                    <div style="padding: 20px 30px 20px 15px; display: flex; align-items: center;" class="">
                        <div class="">
                            <img style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" src="../Assets/AvatarNhanVien/<?= $_SESSION['avatar'] ?>" alt="">
                        </div>
                        <div style="margin-left: 10px; font-size: 15px;" class="">
                            <p style="margin: 0; color: #ccc;">Xin chào, <span style="font-weight: bold;"><?php
							if (isset($_SESSION['dangnhap']))
								echo $_SESSION['dangnhap'];
							?></span></p>
                            <div style="display: flex; align-items: center;" class="">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: green;" class="animation"></div>
                                <div style="margin-left: 5px; font-size: 13px; color: #fff;" class="">Online</div>
                            </div>
                            
                            <?php
                                
                                 $array_get_cc = []; 
                                 $get_cc = $this->chamcong->Get_Employ_CC();  
                                 if (!empty($get_cc)) {
                                    foreach($get_cc as $item) {
                                        $array_get_cc[] =  $item['ID_user'];
                                    }
                                 }
                                
                                 if (!in_array($_SESSION['dangnhap1'], $array_get_cc)) {
                                    echo '<div style="font-weight: bold; text-align: center; border-radius: 5px; font-size: 12px;color: #fff; background: red; width: auto;" class="">
                                    <span style="">Chưa chấm công</span>
                                    </div>';
                                 } else {
                                    echo '<div style="font-weight: bold; text-align: center; border-radius: 5px; font-size: 12px;color: #fff; background: green; width: auto;" class="">
                                    <span style="">Đã chấm công</span>
                                    </div>';
                                 }
                                 
                                ?>
                        </div>
                    </div>
                    
                    <div style="padding: 20px 30px 20px 15px;overflow: auto;height: 80vh; " class="">
                       
                        <ul class="nav nav-stacked active">
                            <li style="width: 100%; padding-bottom: 10px;">
                                <a style="text-decoration: none;" href="#" class="">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff; font-size: 16px;"></i></span>
                                    <a href="../Home/TrangChu" class="bbb" style="text-decoration: none;color: white; margin-left: 7px; font-size: 16px;">Dashboard</a>
                                </a>
                            </li>
                            
                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse0" class="collapsed">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Profile</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse0" class=" text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../Profile/MyProfile">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>My Proflie</span></li>
                                    </a>
                                </ul>
                            </li>
    
                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Sản phẩm</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse1" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../SanPham/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Sản phẩm</span></li>
                                    </a>
                                    <a style="text-decoration: none;" href="../TrangThaiSanPham/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Trạng thái sản phẩm</span></li>
                                    </a>
                                    <!-- <a style="text-decoration: none;" href="../ThuocTinhSanPham/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Thuộc tính sản phẩm</span></li>
                                    </a> -->
                                    <a style="text-decoration: none;" href="../LoaiSanPham/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc;padding: 5px 5px 5px 20px; margin-left: -25px; "><span>Danh mục</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Nhập hàng</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse2" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../DonHangMua/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Đơn hàng nhập</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse9">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Nhà cung cấp</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse9" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../NguonHang/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc;padding: 5px 5px 5px 20px; margin-left: -25px; "><span>Nhà cung cấp</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Bán hàng</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse3" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../DonHangBan/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Đơn hàng trực tuyến</span></li>
                                    </a>
                                    <a style="text-decoration: none;" href="../DonHangBan/DanhSachTQ">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Đơn hàng tại quầy</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse10">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Nhân viên</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse10" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../NhanVien/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc;padding: 5px 5px 5px 20px; margin-left: -25px; "><span>Nhân viên</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse11">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Khách hàng</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse11" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../KhachHang/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc;padding: 5px 5px 5px 20px; margin-left: -25px; "><span>Khách hàng</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Quản lí tài khoản</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse4" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../TaiKhoanNhanVien/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Tài khoản nhân viên</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Quản lí quyền</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse5" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../Quyen/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Quyền tài khoản</span></li>
                                    </a>
                                    <a style="text-decoration: none;" href="../LoaiQuyen/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Loại quyền tài khoản</span></li>
                                    </a>
                                </ul>
                            </li>

                            <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse8">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Quản lí vai trò tài khoản</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse8" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../VaiTroTaiKhoan/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Tạo vai trò tài khoản</span></li>
                                    </a>
                                </ul>
                            </li>

                            <!-- <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse6">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Quản lí tin tức</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse6" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../TinTuc/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Tin tức</span></li>
                                    </a>
                                    <a style="text-decoration: none;" href="../LoaiTinTuc/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Loại tin tức</span></li>
                                    </a>
                                </ul>
                            </li> -->

                            <!-- <li style="width: 100%; padding: 10px 0; position: relative;" data-bs-toggle="collapse" data-bs-target="#collapse7">
                                <button style="width: 100%; text-align: left; border: none; background: none;" class="dropdown-toggle">
                                    <span class="aaa"><i style="font-size: 16px; color: #fff;" class="fa-brands fa-slideshare"></i></span>
                                    <span class="bbb" style="color: white; margin-left: 7px; font-size: 15px;">Quản lí Slides</span>
                                </button>
                                <ul class="li1 collapse" style="list-style: none;" id="collapse7" class="collapse text-white-50" data-bs-parent="#accordion">
                                    <a style="text-decoration: none;" href="../Slides/DanhSach">
                                        <li style=" border-left: 1px dashed #ccc; padding: 5px 5px 5px 20px; margin-left: -25px;"><span>Slides</span></li>
                                    </a>
                                   
                                </ul>
                            </li> -->

                            <li style="width: 100%; padding-bottom: 10px;">
                                <a style="text-decoration: none;" href="#" class="">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff; font-size: 16px;"></i></span>
                                    <a href="../PhiShip/DanhSach" class="bbb" style="text-decoration: none;color: white; margin-left: 7px; font-size: 16px;">Phí ship</a>
                                </a>
                            </li>


                            <!-- <li style="width: 100%; padding-bottom: 10px;">
                                <a style="text-decoration: none;" href="#" class="">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff; font-size: 16px;"></i></span>
                                    <a href="../MaGiamGia/DanhSach" class="bbb" style="text-decoration: none;color: white; margin-left: 7px; font-size: 16px;">Mã giảm giá</a>
                                </a>
                            </li> -->
<!-- 
                            <li style="width: 100%; padding-bottom: 10px;">
                                <a style="text-decoration: none;" href="#" class="">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff; font-size: 16px;"></i></span>
                                    <a href="../ThongKe/ChiTiet" class="bbb" style="text-decoration: none;color: white; margin-left: 7px; font-size: 16px;">Thống kê</a>
                                </a>
                            </li> -->

                            <li style="width: 100%; padding-bottom: 10px;">
                                <a style="text-decoration: none;" href="#" class="">
                                    <span class="aaa"><i class="fa-regular fa-user" style="color: #ffffff; font-size: 16px;"></i></span>
                                    <a href="../BangLuong/ChiTiet" class="bbb" style="text-decoration: none;color: white; margin-left: 7px; font-size: 16px;">Bảng lương nhân viên</a>
                                </a>
                            </li>
                        </ul>
                    </div>  
                </div>
                
				<div id="rightt" class="right">
                    <div id="expanded" style="position: sticky; z-index: 1000; left: 0; top: 70px;" class="">
                        <div class="" style="display: flex; justify-content: space-between; width: 100%;">
                            <div class="">
                                <i style="font-size: 20px; color: white ;cursor: pointer; margin-top: 5px;" class="fa-solid fa-bars size"></i>
                            </div>
                            <?php $count = $this->thongbao->notice_not_see()[0]['notice_not_see']; ?>
                            <?php if ($count > 0) { ?>
                            <a href="../ThongBao/DanhSach" class="remind_notice">
                                <div class="" style="text-align: right; font-size: 18px;"><i class="close_notice fa-solid fa-circle-xmark"></i></div>
                                <div class="">
                                    Bạn có <?php echo $count; ?> thông báo mới chưa xem.
                                </div>  
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Them phan tu -->
                    <div style="width: 100%; height: 100%; padding: 10px 30px 20px; " class="">

				<!-- <i class="fa-sharp fa-solid fa-caret-down" style="color: #ffffff; width: 18px; display: inline-block;"></i> -->

				<!-- Đây là form thông báo -->
	<script>
         const size = document.querySelector('.size');

const lefft = document.getElementById('leftt');
const rightt = document.getElementById('rightt');
const expand = document.querySelector('.expand');
const expand1 = document.getElementById('expanded');


const showWeb = document.getElementById('showWeb1');
const showWeb1 = document.getElementById('showw');

showWeb.onclick = () => {
    showWeb1.classList.toggle('showWeb');
    showWeb1.classList.toggle('hideWeb');
}


size.onclick = () => {
    lefft.classList.toggle('left1');
    rightt.classList.toggle('right1');
    expand1.classList.toggle('expand');
}

    </script>
    <script>

        $('#chamcong').on('click', ()=> {
            $.ajax({
            url: '../NhanVien/ChamCong',
            method: "POST",
            data: {id_user: <?=$_SESSION['dangnhap1'];?>},
            success: function(data){
                alert('Chấm công thành công. Chúc bạn làm việc vui vẻ!');
                $('.modal2').css('display','none');
            }
        });
        });
        $(document).ready(function(){
           
    <?php if (!in_array($_SESSION['dangnhap1'], $array_get_cc)) { ?>
        $('.modal2').css('display','block');
    <?php } ?>
        });
    

    $(".close_modal").on('click', ()=>{
        $(".modal2").css('display','none');
    });

   
    $('.close_notice').on('click', (e)=> {
        e.preventDefault();
        $('.remind_notice').css('display','none'); 
    });
    </script>