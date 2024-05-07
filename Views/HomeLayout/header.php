<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/3206410232.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="index.css"> -->
    <!-- <link rel="stylesheet" href="reponsive.css"> -->
    <link rel="stylesheet" type="text/css" href="../Assets/CSS/index2.css"> 
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
      />
</head>
<style>
    .add-address {
        position: absolute;
        top: 50px;
        left: 35%;
        width: 500px;
        height: 20%;
        background: white;
        box-shadow: 1px 2px 5px gray;
        z-index: 2; 
        display: none;
    }

    .historyItem:hover {
        cursor: pointer;
        color: blue;
    }

    /* input {
        background-color: transparent;
        opacity: 0.5;
    } */
    /* .container1 {
        position: relative;
        top: 0;
        left: 0%;
        width: 100%;
        height: 100%;
        opacity: 0.7;
    } */

    #inform-receiveProduct, #inform-receiveProduct1, #inform-receiveProduct2 {
        position: fixed;
        width: 40%;
        height: auto; 
        z-index: 1;
        background: white;
        left: 30%;
        top: 10%;
        box-shadow: 1px 1px 1px 5px gray;
        border-radius: 7px;
        display: none;
        z-index: 10000;
    }

    /* .show1 {
        display: block;
    } */
    @keyframes slideDown {
  0% {
    transform: translateY(-100%);
  }
  100% {
    transform: translateY(0);
  }
}
    
@keyframes slideUp {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-100%);
  }
}
.thongbao--component {
    border-radius: 7px;
    padding: 5px 10px;
}

.thongbao--component:hover {
    background: #d3d3d3;
    transition: all .2s ease-in-out;
}
.header_profile-bell--animation {
    animation: shake 1.5s cubic-bezier(.36,.07,.19,.97) both infinite;
}

.linkk {
    transition: all .2s ease-in-out;
}
.linkk.active {
    margin-left: 10px; 
    border-radius: 50px; 
    padding: 5px 10px; 
    background: #87CEFA; 
    font-weight: 550;
    transition: all .2s ease-in-out;
}

@keyframes shake {
    0% {
    transform: rotate(15deg);
    }

    50% {
        transform: rotate(-15deg);
    }

    100% {
        transform: rotate(15deg);
    }
}
#searchHistory {
    height: auto; 
    width: 100%; 
    background: white;
    z-index: 1000;
    border-radius: 5px;
    box-shadow: 1px 2px 3px #ccc;
}
.historyItem {
    line-height: 1;
    padding: 10px 0;
}


</style>
<body>  

    <a style="position: fixed; z-index: 10000;  right: 2.5%; bottom: 90px;" href="https://www.facebook.com/messages/t/100009130386390" target="_blank">
        <img style="filter: drop-shadow(1px 2px 3px); width: 65px; height: 50px;" src="../Assets/Image/ssds-removebg-preview.png" title="Chat với chúng tôi" alt="">
    </a>
    <form action="" method="POST">
    <div id="inform-receiveProduct">
            <div style="padding: 15px 20px;" class="inform-receiveProduct--contain">
                <div class=""> 
                    <!-- <form action="" method="POST"> -->
                    <input type="hidden" value="<?=$mon?>" name="mon">
                    <p style="font-size: 20px; font-weight: bold;">Thông tin người nhận</p>
                     
                    <?php foreach($getData1 as $row) : extract($row); ?>
                    <div class="">
                        <p><span style="color: red;">*</span> Họ tên</p>
                        <input value="<?=$row['hoten']?>" id="hoten1" name="hoten1" placeholder="Vui lòng nhập tên người nhận" type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="">
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Số điện thoại</p>
                            <input value="<?=$row['SDT']?>" id="sdt1" name="sdt1" placeholder="Vui lòng nhập số điện thoại"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Email</p>
                            <input value="<?=$row['Email']?>" id="email1" name="email1" placeholder="Vui lòng nhập Email"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                    </div>
                    <p style="font-size: 20px; font-weight: bold;" class="">Địa chỉ người nhận</p>
                    <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Tỉnh/Thành phố</p>
                                <select name="province" id="province1" class="form-control province">
                                    <option value="">Chọn một tỉnh</option>c
                                    <?php foreach($province as $row) : extract($row); ?>
                                        <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
                                    <?php endforeach; ?>
                                </select>   
                                <!-- <input  style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập tỉnh/thành phố" name="tinh"> -->
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Quận/huyện</p>
                                <select id="district1" name="quan1" class="form-control district">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Phường/Xã</p>
                                <select id="wards1" name="xa1" class="form-control wards">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                                <!-- <input   name="xa" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập phường/xã"> -->
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Địa chỉ cụ thể</p>
                                <input class="form-control" id="cuthe1"  name="cuthe1" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập địa chỉ cụ thể">
                            </div>
                        </div>
                        <div id="error1"></div>
                        <div style="display: flex; justify-content: space-between; margin-top: 30px; " class="">
                            <div style="width: 20%; " class="">
                                <input style="height: 40px; width: 100%;" type="button" value="Hủy bỏ" onclick="hideForm()">
                            </div>
                            <div style="width: 20%;" class="">
                                <input style="height: 40px; background: blue; color: white; width: 100%;" id="updateTT" type="button" value="Lưu địa chỉ" name="updateTT">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <!-- </form> -->
                </div>
            </div>
    </div>
    <div id="inform-receiveProduct1">
            <div style="padding: 15px 20px;" class="inform-receiveProduct--contain1">
                <div class=""> 
                    <!-- <form action="" method="POST"> -->

                    <p style="font-size: 20px; font-weight: bold;">Thông tin người nhận</p>
                    
                    <div class="">
                        <p><span style="color: red;">*</span> Họ tên</p>
                        <input class="form-control" id="hoten" name="hoten" placeholder="Vui lòng nhập tên người nhận" type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="">
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Số điện thoại</p>
                            <input class="form-control" id="sdt"  name="sdt" placeholder="Vui lòng nhập số điện thoại"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Email</p>
                            <input class="form-control" value="" id="email" name="email" placeholder="Vui lòng nhập Email"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                    </div>
                    <p style="font-size: 20px; font-weight: bold;" class="">Địa chỉ người nhận</p>
                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Tỉnh/Thành phố</p>
                                <select id="province" name="tinh" class="form-control province">
                                    <option value="">Chọn một tỉnh</option>c
                                    <?php foreach($province as $row) : extract($row); ?>
                                        <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <input  style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập tỉnh/thành phố" name="tinh"> -->
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Quận/huyện</p>
                                <select id="district" name="quan" class="form-control district">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Phường/Xã</p>
                                <select id="wards" name="xa" class="form-control wards">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                                <!-- <input   name="xa" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập phường/xã"> -->
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Địa chỉ cụ thể</p>
                                <input class="form-control" id="cuthe"  name="cuthe" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập địa chỉ cụ thể">
                            </div>
                        </div>
                        <div style="text-align: center;" id="error">
                            
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 30px; " class="">
                            <div style="width: 20%; " class="">
                                <input class="btn btn-danger" style="height: 40px; width: 100%;" type="button" value="Hủy bỏ" onclick="hideForm1()">
                            </div>
                            <div style="width: 20%;" class="">
                                <!-- <input style="height: 40px; background: blue; color: white; width: 100%;" type="submit" value="Lưu địa chỉ" name="saveAddress1"> -->
                                <button class="btn btn-primary" style="height: 40px; background: blue; color: white; width: 100%;" id="saveAddress1" type="button" name="saveAddress1">Lưu  </button>

                            </div>
                        </div>
                        
                    <!-- </form> -->
                </div>
            </div>
    </div>

    <div id="inform-receiveProduct2">
            <div style="padding: 15px 20px;" class="inform-receiveProduct--contain2">
                <div class=""> 
                    <!-- <form action="" method="POST"> -->

                    <p style="font-size: 20px; font-weight: bold;">Thông tin người nhận</p>
                     <?php if(isset($getData)) { foreach($getData as $row) : extract ($row); ?>
                    <div class="">
                        <p><span style="color: red;">*</span> Họ tên</p>
                        <input value="<?=$row['hoten'];?>"  id="hoten4" name="hoten3" placeholder="Vui lòng nhập tên người nhận" type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="">
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Số điện thoại</p>
                            <input value="<?=$row['SDT'];?>" id="sdt4"   name="sdt3" placeholder="Vui lòng nhập số điện thoại"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Email</p>
                            <input value="<?=$row['Email'];?>" id="email4" name="email3" placeholder="Vui lòng nhập Email"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                    </div>
                    <p style="font-size: 20px; font-weight: bold;" class="">Địa chỉ người nhận</p>
                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Tỉnh/Thành phố</p>
                                <select id="province4" name="tinh3" class="form-control province">
                                    <option value="">Chọn một tỉnh</option>
                                    <?php foreach($province as $row) : extract($row); ?>
                                        <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Quận/huyện</p>
                                <select id="district4" name="quan3" class="form-control district">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Phường/Xã</p>
                                <select id="wards4" name="xa3" class="form-control wards">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Địa chỉ cụ thể</p>
                                <input name="cuthe3" id="cuthe4" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập địa chỉ cụ thể">
                            </div>
                        </div>
                        <div id="error3"></div>
                        <div style="display: flex; justify-content: space-between; margin-top: 30px; " class="">
                            <div style="width: 20%; " class="">
                                <input style="height: 40px; width: 100%;" type="button" value="Hủy bỏ" onclick="hideForm2()">
                            </div>
                            <div style="width: 20%;" class="">
                                <input style="height: 40px; background: blue; color: white; width: 100%;" type="button" id="updateTT3" value="Lưu địa chỉ" name="saveAddress2">
                            </div>
                        </div>
                        <?php endforeach; } else { ?>
                            <div class="">
                        <p><span style="color: red;">*</span> Họ tên</p>
                        <input  name="hoten3" id="hoten3" placeholder="Vui lòng nhập tên người nhận" type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="">
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Số điện thoại</p>
                            <input  name="sdt3" id="sdt3" placeholder="Vui lòng nhập số điện thoại"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                        <div style="width: 49%;" class="">
                            <p><span style="color: red;">*</span> Email</p>
                            <input  name="email3" id="email3" placeholder="Vui lòng nhập Email"  type="text" style="width: 100%; height: 40px; padding-left: 10px;">
                        </div>
                    </div>
                    <p style="font-size: 20px; font-weight: bold;" class="">Địa chỉ người nhận</p>
                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Tỉnh/Thành phố</p>
                                <select id="province3" name="tinh3" class="form-control province">
                                    <option value="">Chọn một tỉnh</option>c
                                    <?php foreach($province as $row) : extract($row); ?>
                                        <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Quận/huyện</p>
                                <select id="district3" name="quan3" class="form-control district">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;" class="">
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Phường/Xã</p>
                                <select id="wards3" name="xa3" class="form-control wards">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                            </div>
                            <div style="width: 49%;" class="">
                                <p><span style="color: red;">*</span> Địa chỉ cụ thể</p>
                                <input name="cuthe" id="cuthe3" style="width: 100%; height: 40px; padding-left: 10px;" type="text" placeholder="Nhập địa chỉ cụ thể">
                            </div>
                        </div>
                        <div id="error2"></div>
                        <div style="display: flex; justify-content: space-between; margin-top: 30px; " class="">
                            <div style="width: 20%; " class="">
                                <input style="height: 40px; width: 100%;" type="button" value="Hủy bỏ" onclick="hideForm2()">
                            </div>
                            <div style="width: 20%;" class="">
                                <input style="height: 40px; background: blue; color: white; width: 100%;" type="button" id="updateTT1" value="Lưu địa chỉ" name="saveAddress2">
                            </div>
                        </div>
                       <?php } ?>
                    <!-- </form> -->
                </div>
            </div>
    </div>
    <div id="container10" class="container1 overlay">
        <div class="add-address"></div>
        <div id="back-to-top" ><i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i></div>
        <div class="header">
            <div class="header_slide">
                <!-- <div class=""> -->
                    <img src="https://lh3.googleusercontent.com/T6D_zcRDHlK6bTLn1zuTGci6iT7UXaGeiM4mLQbZ40qGHIUkF3Vf7_YvYmXEu6Dc3JLUvB0jT0DJJn6YN632SqO6oQLVeKuWXA=w1920-rw" alt="">
                <!-- </div> -->
               
            </div>
            <div class="header_list">
                <ul class="header_ul">
                    <li><a style="background: transparent;" href="../TrangChu/KhuyenMai"><i class="fa-sharp fa-solid fa-ticket" style="color: #ffffff;"></i> <span>Khuyến mãi</span></a></li>
                    <li><a style="background: transparent;" href="../TrangChu/show_showroom"><i class="fa-regular fa-car"></i> <span>Hệ thống Showroom</span></a></li>
                    <li class="counselor"><a style="background: transparent;" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 80C149.9 80 62.4 159.4 49.6 262c9.4-3.8 19.6-6 30.4-6c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48c-44.2 0-80-35.8-80-80V384 336 288C0 146.6 114.6 32 256 32s256 114.6 256 256v48 48 16c0 44.2-35.8 80-80 80c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48c10.8 0 21 2.1 30.4 6C449.6 159.4 362.1 80 256 80z"/></svg> <span>Tư vấn mua hàng (miễn phí): 1800 6867</span></a></li>
                    <li><a style="background: transparent;" href="#"><i class="fa-solid fa-user"></i> <span>CSKH: 1800 6865</span></a></li>
                    <li><a style="background: transparent;" href="../TrangChu/TinTuc"><i class="fa-regular fa-newspaper"></i> <span>Tin công nghệ</span></a> </li>
                    <li><a style="background: transparent;" href="#"><i class="fa-solid fa-wrench"></i> <span>Xây dựng cấu hình</span></a></li>
                </ul>
            </div>
            
            <div style="background: white; width: 100%" class="header_profile" id="fixed">
                <div style="width: 75%; margin: 0 auto" class="header_profile-container">
                    <div class="header_profile-logo" id="hide-element">
                        <!-- <div class="">                         -->
                            <a href="./Index"><img src="https://shopfront-cdn.tekoapis.com/static/phongvu/logo-full.svg" alt=""></a>
                        <!-- </div> -->
                    </div>  
                    <div style="display: none;" id="header-cate" class=""> 
                        <div class="header-cate--container">
                            <div class="header-cate--title">
                                <div class=""><i class="fa-solid fa-arrow-right" style="color: rgb(130, 134, 158);"></i></div>
                                <div style="line-height: 1;" class="">
                                    <span style="color: rgb(130, 134, 158);">Danh mục sản phẩm</span>
                                </div>
                            </div>
                            <div style="box-shadow: 1px 1px 5px 2px rgb(153,151,151);" class="header-cate--title--list">
                              <?php foreach($loaisanpham1 as $row) : extract ($row); ?>
                              <div style="height: 40px;  width: 100%; line-height: 40px;" class="">
                                    <div style="width: 20%; float: left; " class="">
                                        <span style="width: 100%; padding-left: 10px; ">
                                            <svg style="background-color: black;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 32C92.7 32 64 60.7 64 96V352h64V96H512V352h64V96c0-35.3-28.7-64-64-64H128zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480H563.2c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2H19.2z"/></svg>
                                        </span>
                                    </div>
                                    <a href="../TrangChu/AllSanPham?idloaisp=<?=$row['ID']?>" style="width: 80%; float: left; text-decoration: none; color: black; " class="">
                                        <span style="width: 100%;"><?=$row['TenLoaiSanPham'];?></span>
                                    </a>
                                </div>
                              <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div id="hayho" class="header_profile-search">
                      
                        <input autocomplete="off" class="test" type="text" id="timkiem" name="search-product" placeholder="Nhập từ khóa cần tìm">
                        <button onclick=myFunction() type="submit" name="submitSearch"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button> 
                      
                        <div style="z-index: 100000; position: absolute; top: 66%; padding: 10px;" class="" id="searchHistory">
                            
                        </div>
                    </div>
                    <div href="#" class="header_profile-info">
                        <?php if(isset($_SESSION['id_user'])) { ?>
                        <?php foreach($thongtin as $row) : extract ($row); ?>
                        <div class="header_profile-info--img">
                            <img src="../Assets/data/AvatarKhachHang/<?= $row['AnhDaiDien']; ?>" alt="">
                        </div>
                        <div class="header_profile-info--title">
                            <div class="header_profile-info--hi">Xin chào,</div>
                            <div class="header_profile-info--name"><?=$row['TenKhachHang']; ?></div>
                        </div>
                        <div class="tt4">
                            <div style="padding: 10px;" class="">
                                <div style="line-height: 2; display: flex; justify-content: center; align-items: center;" class="">
                                    <div style="width: 30%;" class="">
                                        <img style="width: 40px; height: 40px;" src="../Assets/data/AvatarKhachHang/<?= $row['AnhDaiDien']; ?>" alt="">
                                    </div>
                                    <div style="margin-top: -5px;" class="info-user">
                                        <div class="name-user"><?=$row['TenKhachHang'];?></div>
                                        <div class="gmail-user"><?=$row['Email'];?></div>
                                    </div>
                                </div>

                                <div class="manage-account">
                                        <a style="text-decoration: none;" href="../TrangChu/ThongTinTaiKhoan" class="manage-account--list">
                                            <div class="manage-account-icon">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <div class="manage-account-list--li">
                                            Thông tin tài khoản
                                        </div>
                                    </a>
                                    <a style="text-decoration: none;" href="../TrangChu/LichSuMuaHang" class="manage-account--list">
                                        <div class="manage-account-icon">
                                            <svg width="auto" height="auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14 7C13.4477 7 13 7.44772 13 8V16C13 16.5523 13.4477 17 14 17H18C18.5523 17 19 16.5523 19 16V8C19 7.44772 18.5523 7 18 7H14ZM17 9H15V15H17V9Z" fill="currentColor" /><path d="M6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H10C10.5523 9 11 8.55228 11 8C11 7.44772 10.5523 7 10 7H6Z" fill="currentColor" /><path d="M6 11C5.44772 11 5 11.4477 5 12C5 12.5523 5.44772 13 6 13H10C10.5523 13 11 12.5523 11 12C11 11.4477 10.5523 11 10 11H6Z" fill="currentColor" /><path d="M5 16C5 15.4477 5.44772 15 6 15H10C10.5523 15 11 15.4477 11 16C11 16.5523 10.5523 17 10 17H6C5.44772 17 5 16.5523 5 16Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M4 3C2.34315 3 1 4.34315 1 6V18C1 19.6569 2.34315 21 4 21H20C21.6569 21 23 19.6569 23 18V6C23 4.34315 21.6569 3 20 3H4ZM20 5H4C3.44772 5 3 5.44772 3 6V18C3 18.5523 3.44772 19 4 19H20C20.5523 19 21 18.5523 21 18V6C21 5.44772 20.5523 5 20 5Z" fill="currentColor" /></svg>
                                        </div>
                                        <div class="manage-account-list--li">
                                            Quản lí đơn hàng
                                        </div>
                                    </a>
                                    <div class="manage-account--list">
                                        <div class="manage-account-icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="manage-account-list--li">
                                            Sổ địa chỉ
                                        </div>
                                    </div>
                                    <a style="text-decoration: none;" href="../TrangChu/WhistList" class="manage-account--list">
                                        <div class="manage-account-icon" style="">
                                        <i class="fa-regular fa-heart"></i>
                                        </div>
                                        <div class="manage-account-list--li">
                                            WhistList
                                        </div>
                                    </a>
                                    <a style="text-decoration: none;" href="../TrangChu/ThongBao" class="manage-account--list">
                                        <div class="manage-account-icon">
                                            <svg width="auto" height="auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14 3V3.28988C16.8915 4.15043 19 6.82898 19 10V17H20V19H4V17H5V10C5 6.82898 7.10851 4.15043 10 3.28988V3C10 1.89543 10.8954 1 12 1C13.1046 1 14 1.89543 14 3ZM7 17H17V10C17 7.23858 14.7614 5 12 5C9.23858 5 7 7.23858 7 10V17ZM14 21V20H10V21C10 22.1046 10.8954 23 12 23C13.1046 23 14 22.1046 14 21Z" fill="currentColor" /></svg>
                                        </div>
                                        <div class="manage-account-list--li">
                                            Thông báo
                                        </div>
                                    </a>
                                </div>
                                <div class="" style="width: 100%; height: 40px; position: relative;">
                                    <a class="btn btn-primary" style="position: absolute; top: 0; width: 100%; height: 100%;" href="../TrangChu/DangXuat">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php } else { ?>
                            <a href="../TrangChu/DangNhap" class="header_profile-info--img">
                              <img src="https://tse4.mm.bing.net/th?id=OIP.jixXH_Els1MXBRmKFdMQPAHaHa&pid=Api&P=0&h=180" alt="">
                            </a>
                            <a style="color: gray;" href="../TrangChu/DangNhap" class="header_profile-info--title" onmouseover="showForm2()">
                              <div class="header_profile-info--hi">Đăng nhập</div>
                              <div class="header_profile-info--name">Đăng kí</div>
                            </a>

                        <?php } ?>
                    </div>
                    <div class="header_profile-bell">
                        <div style="position: relative;" class="header_profile-bell--animation">                        
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/></svg>
                            <?php if(isset($_SESSION['id_user'])) { if($this->thongbao->TongThongBao($_SESSION['id_user']) > 0) { ?>
                            <div style="color: white; font-weight: 550; line-height: 1.5;font-size: 14px;text-align: center;top: 45%; right: -5px; width: 20px; height: auto; border-radius: 50%; background: red; position: absolute;" class="">
                                <?=$this->thongbao->TongThongBao($_SESSION['id_user']);?>
                            </div>
                            <?php } } ?>
                        </div>
                        <div class="header_profile-bell-notice">
                            <div style="padding: 0 15px <?= !isset($_SESSION['id_user']) ? "0px" : "15px"?> 15px;" class="notifi-contain">
                            <?php if(isset($_SESSION['id_user'])) { ?>
                                <div style="text-align: left; padding-top: 10px;" class="">
                                 <a id="link1" class="linkk active" style="text-decoration: none;" href="../TrangChu/ThongBao?xemall=1">Tất cả</a> 
                                 <!-- <a id="link2" class="linkk" style="text-decoration: none;" href="#">Chưa đọc</a>  -->
                                 <!-- <input type="submit" name="OKE" value="SUBMIT">  -->
                                 </div> 
                                <p style="margin-bottom: 0;text-align: right;"><a style=" text-decoration: none; " href="../TrangChu/ThongBao">Xem tất cả</a></p>
                                <?php 
                                
                                if (!is_array($thongbao1)) {
                                    echo "Không có thông báo";
                                } else 
                                foreach($thongbao1 as $row) : extract ($row); ?>
                                <?php if($row['action'] == 0) { ?>
                                <a href="?xemthongbao=<?=$row['ID_DH']?>" style="text-decoration: none; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: blue; font-size: 14px; font-weight: 550; margin-left: 20px;" class="">
                                        <i class="fa-solid fa-clock"></i> <?=$row['ngay']?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background: blue;" class=""></div>
                                    </div>
                                </a>
                                <?php } else { ?> 
                                 <!-- <a id="link2" class="linkk" style="text-decoration: none;" href="#">Chưa đọc</a>  -->
                                 <!-- <input type="submit" name="OKE" value="SUBMIT">  -->
                                <a style="text-decoration: none; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: #c0c0c0; font-size: 14px; font-weight: 550;" class="">
                                            <?=$row['ngay']?>
                                        </div>
                                    </div>
                                </a>
                                 <?php }  ?>
                                <?php endforeach; } else { ?>
                                    <p style="margin-bottom: 0;"><a style="text-decoration: none; color: #c0c0c0; " href="../TrangChu/ThongBao">Xem tất cả thông báo</a></p>
                                <?php }  ?>
                            </div>   
                        </div>
                    </div>
                    <div class="header_profile-cart">
                        <div class="header_profile-info--img">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>                   
                        </div>
                        <a href="../TrangChu/GioHang1" style="color: gray;" class="header_profile-info--title" >
                            <div class="header_profile-info--hi">Giỏ hàng của bạn</div>
                            <div class="header_profile-info--name">(<?php if(isset($_SESSION['id_user'])) {
          if($this->giohang->Tong1($_SESSION['id_user']) > 0) {
            echo $this->giohang->Tong1($_SESSION['id_user']);
          } else {
            echo 0;
          }
        } else {
          if($this->giohang->Tong() > 0) {
            echo $this->giohang->Tong();
          } else {
            echo 0;
          }
        }?>) sản phẩm</div>
                        </a> <br>
                        <div class="header_profile-cart--list">
                                
                            <div class="ttt1">
                            <?php 
                                   
                                        if(is_array( isset($_SESSION['id_user']) ? $test3 : $test)) {
                                    $i = 0;
                                    $tong = 0;
                                    foreach(isset($_SESSION['id_user']) ? $test3 : $test as $row) : extract ($row); $i++;
                                ?>
                                <div style="height: auto; display: flex; align-items: center; padding-left: 10px; " class="">
                                    <div style="width: 30%; height: 100%;" class="">
                                        <img style="border: 1px solid rgb(221, 217, 217); padding: 2px; border-radius: 7px; width: 100%;" src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh']?>" alt="">
                                    </div>
                                    <div style="width: auto; height: 100%; margin-left: 15px; margin-top: 10px;" class="">
                                        <div style="line-height: 1.5; font-size: 13px;" class="name-product--bill"><?=$row['TenSanPham']?></div>
                                        <div style="line-height: 2; font-size: 12px;" class=""><?=$row['SoLuong1']?></div>
                                        <div style="line-height: 2; font-size: 14px; font-weight: bold; color: black; margin-bottom: 5px;" class="">
                                        <?php if($row['GiaKhuyenMai'] != 0) { $phantram = round(( ($row['Gia'] - $row['GiaKhuyenMai']) / $row['Gia']) * 100,2); ?>
                                      
                                      <span class="hehe"><?= number_format($row['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                      <span class="xoa"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=$phantram;?>%</span> 
                                    <?php } else { ?>
                                      <div style="color: 16px; font-weight: 550; " class=""><?=number_format($row['Gia'], 0, '.', '.');?>đ</div>
                                    <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $tong += $row['ThanhTien']; ?>
                                <?php endforeach; ?>    
                            </div>

                            <hr style="border: 1px dashed gray;">
                            <div class="ttt2">
                                <div class="">
                                    <div style="display: flex; justify-content: space-between; line-height: 1.5; padding-bottom: 10px;" class="">
                                        <div style="">Tổng tiền (<?php if(isset($_SESSION['id_user'])) { echo $this->giohang->Tong1($_SESSION['id_user']);} else {echo $this->giohang->Tong();} ?>) sản phẩm</div>
                                        <div class=""><?=number_format($tong, 0, '.', '.')?>đ</div>
                                    </div>
                                    <div style="line-height: 1; margin-bottom: 30px;" class="">
                                        <a style="width: 100%; height: 40px; font-size: 15px;" href="../TrangChu/GioHang1" class="btn btn-primary">Xem giỏ hàng</a>
                                    </div>
                                </div>  
                            </div>

                            <?php } else { ?>
                            <div class="empty-cart">
                                <div>
                                    <a href="../TrangChu/Index" class="btn btn-primary">Mua sắm ngay</a>
                                </div>
                            </div>  
                             <?php } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        </form>
        <script>
            function myFunction() {
                let timkiem = document.getElementById('timkiem').value;
                let danhsach = [{
                    "query" : timkiem
                }]
                // localStorage.setItem('local', JSON.stringify(danhsach));
                
                const duLieuTuLocalStorage = localStorage.getItem("local");
                let mangTuLocalStorage = [];

                if (duLieuTuLocalStorage !== null) {
                // Nếu dữ liệu đã tồn tại, chuyển chuỗi JSON thành mảng các đối tượng
                mangTuLocalStorage = JSON.parse(duLieuTuLocalStorage);
                }

                // Bước 3: Thêm dữ liệu mới vào mảng đã có hoặc tạo mới mảng nếu chưa có dữ liệu
                danhsach.forEach((nguoiDungMoi) => {
                // Kiểm tra xem id của người dùng mới có trùng với id của người dùng đã có hay không
                const isExist = mangTuLocalStorage.some((nguoiDung) => nguoiDung.query === nguoiDungMoi.query);

                // Nếu không có trùng lặp thì thêm dữ liệu mới vào mảng
                if (!isExist) {
                    mangTuLocalStorage.unshift(nguoiDungMoi);
                }   
                });

                // Bước 4: Lưu mảng vào localStorage sau khi đã thêm dữ liệu mới
                localStorage.setItem("local", JSON.stringify(mangTuLocalStorage));
            }
            // Lấy các phần tử cần sử dụng
const searchInput = document.getElementById('timkiem');
const searchHistoryDiv = document.getElementById('searchHistory');

// Hàm hiển thị lịch sử tìm kiếm
function showSearchHistory() {
document.getElementById('searchHistory').style.display = "block";

  // Lấy dữ liệu lịch sử từ localStorage (nếu có)
  const searchHistory = JSON.parse(localStorage.getItem('local')) || [];
  const numberHistory = 5;
  var elementsToShow = searchHistory.slice(0, numberHistory);
  // Xóa nội dung hiện tại của searchHistoryDiv
  searchHistoryDiv.innerHTML = '';

  // Hiển thị lịch sử tìm kiếm
  elementsToShow.forEach((item) => {
    const historyItem = document.createElement('div');
    // historyItem.className = "container-history";
    
    historyItem.textContent = item.query;
    historyItem.classList.add('historyItem');

    // Bắt sự kiện khi click vào một phần tử lịch sử
    historyItem.addEventListener('click', () => {
      searchInput.value = item.query;
        window.location.href=`../TrangChu/AllSanPham?query=listing&search=${item.query}`;
      // Do something when a history item is clicked, e.g., trigger a search
      // handleSearch(item);
    });
    
    for (var i = 0; i < elementsToShow.length;i++) {
        searchHistoryDiv.appendChild(historyItem);
    }
  });
}

// Bắt sự kiện focus vào ô input
searchInput.addEventListener('hover', showSearchHistory);
searchInput.addEventListener('focus', showSearchHistory);





// Bắt sự kiện khi người dùng gõ vào ô input
searchInput.addEventListener('input', (event) => {
  const value = event.target.value.trim();
  // Xử lý và hiển thị lịch sử tìm kiếm
  if (value.length > 0) {
    showSearchHistory();
  } else {
    searchHistoryDiv.innerHTML = '';
  }
});
var hayho = document.getElementById('hayho');
// Bắt sự kiện khi người dùng blur (mất focus) khỏi ô input
hayho.addEventListener('blur', (event) => {
//   const value = event.target.value.trim();
//   // Lưu lịch sử tìm kiếm khi người dùng blur (mất focus)
//   if (value.length > 0) {
//     saveSearchHistory(value);
//   }
document.getElementById('searchHistory').style.display = "none";
});
var test1 = document.getElementById('searchHistory');
// searchInput.addEventListener('mouseleave', (event) => {
//     document.getElementById('searchHistory').style.display = "none";
//     searchInput.blur();
// });

hayho.addEventListener('mouseleave', (event) => {
    document.getElementById('searchHistory').style.display = "none";
    searchInput.blur();
});

        </script>


<script>
    
</script>

       