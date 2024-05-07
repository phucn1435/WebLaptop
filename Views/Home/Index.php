<?php include "./Views/HomeLayout/header.php"; ?>  


<style>
    .product-list--li1 {
        /* border: 3px solid red; */
       
        transition: all .2s linear;
    }

    .product-list--li1::after {
        animation: spin 3s linear infinite;
    }

    .product-list--li1::before {
        animation: spin 3s linear infinite;

    }

    @keyframes heartbeat {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
    }


    @keyframes spin {
        /* 25% {
            border-top: 3px solid red;
            box-shadow: 1px 2px 5px blue;
            transition: all 1s linear;
            opacity: 1;
        }
        50% {
            border-right: 3px solid yellow;
            transition: all 1s linear;

        }
        75% {
            border-bottom: 3px solid blue;
            transition: all 1s linear;

        }
        100% {
            border-left: 3px solid green;
            transition: all 1s linear;

        } */
        0% {
            transform: rotate(0deg);
            border: 5px solid red;
        }

        100% {
            transform: rotate(360deg);
            border: 5px solid yellow;
        }

    }

    .heart_beat:hover {
        animation: heartbeat 1s infinite;
        cursor: pointer;
    }

    @keyframes appear1 {
    0% {
        opacity: 0;
        transform: scale(0);
    }
   
    100% {
        opacity: 1;
        transform: scale(1);

    }

}

    .modal1 {
  display: none; /* Ẩn modal ban đầu */
  position: fixed; /* Hiển thị modal dựa trên vị trí tuyệt đối */
  z-index: 999; /* Đảm bảo modal luôn hiển thị phía trên cùng */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5); /* Tạo background mờ */
  animation: appear1 .7s linear;
}

.modal-content1 {
  background-color: #fefefe;
  margin: 15% auto; /* Hiển thị modal giữa màn hình */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px; /* Đảm bảo modal không quá rộng */
  border-radius: 5px;
  position: relative;
}

.close1 {
  color: #aaa;
  float: right;
  font-size: 30px;
  font-weight: bold;
  top: -23px;
  right: 0;
  position: relative;
}

.close1:hover,
.close1:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

        <div class="body">
            <div class="slick-slider">
                <?php foreach($slideTrangChu as $row) : extract($row); ?>
                <div class="">
                    <img class="slick-slide--img" src="../Assets/data/Slides/<?=$row['hinhanh'];?>" alt="">
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="">
                <div class="category-list">
                    <div style="width: 14%; background: white; " class="hix1">
                        <div style="height: 40px; width: 100%; line-height: 40px;" class="ooo">
                            <div style="width: 20%; float: left; " class="">
                                <span style="width: 100%; padding-left: 10px; ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 32C92.7 32 64 60.7 64 96V352h64V96H512V352h64V96c0-35.3-28.7-64-64-64H128zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480H563.2c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2H19.2z"/></svg>
                                </span>
                            </div>
                            <div style="width: 80%; float: left;" class="">
                                <span style="width: 100%;">Laptop</span>
                            </div>   
                        </div>     
                    </div>
                    <div style="position: absolute; left: 14%; top: 0; height: auto; width: 86%; display: none; background: white;" class="hix">
                        <div style="padding: 10px; display: flex; justify-content: space-between;" class="">
                            <div style="width: 20%; height: auto;" class="">
                                <div style="color: blue; font-size: 16px; font-weight: bold;" class="">Laptop theo thương hiệu</div>
                                <div style="margin-top: 10px;" class="">
                                    <?php foreach($loaisanpham1 as $row) : extract ($row); ?>
                                    <div style="margin-top: 5px; font-size: 15px;" class="link-brand">
                                        <a style="text-decoration: none; color: gray;" href="../TrangChu/AllSanPham?idloaisp=<?=$row['ID']?>"><?=$row['TenLoaiSanPham'];?></a>
                                    </div> 
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php foreach($list_tt ?? [] as $item) { ?>  
                <div style="background-image: url('../Assets/data/HinhAnhTTSP/<?=$item['hinhanh'];?>');" class="product container">
                    <span class="product--brand">Laptop <?=$item['TenTrangThai'];?></span>
                    <a class="product-seeon" href="../TrangChu/AllSanPham">Xem tất cả <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></a>
                    <div style="margin: 0 auto;" class="product-list row slick-slider1">
                    
                        <?php foreach($result5 ?? [] as $row) : extract($row); if ($row['ID_TT'] == $item['ID']) { ?> 
                        <a style="text-decoration: none;" href="../TrangChu/ChiTietSP?id=<?=$row['ID'];?>" class="product-list--li col-sm">
                            <div class="product-list--li__img">
                                <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="">
                            </div>
                            <div class="product-list--li__brand">
                                <span><?=$row['TenLoaiSanPham']?></span>
                            </div>
                            <div class="product-list--li__describe">
                                <span><?=$row['TenSanPham'];?></span>
                            </div>
                            <div class="product-list--li__price">
                                <?php if($row['GiaKhuyenMai'] != 0) { ?>
                                    <span class="hehe"><?= number_format($row['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                    <span class="xoa"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=round((($row['Gia']-$row['GiaKhuyenMai']) / $row['Gia']) * 100 , 2)?>%</span> 
                                <?php } else { ?>
                                    <span class="hehe"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <br>
                                    <span class="xoa"></span> <span class="css-1f8jk2s"></span> 
                                <?php } ?>
                            </div>
                            <div class="product-list--li__gift">
                                <img src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                            </div>
                        </a>
                        
                        <?php } endforeach; ?>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <!-- </div> -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6571506cff45ca7d4787ab5c/1hh1a4a18';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>   
        <div class="discount">
            <img src="https://lh3.googleusercontent.com/WFe_wAjN4eg3vNMYYmAgKgerNiCVnqNgxsWEkE-zvB5lgCK5Rh26lR4MIVKLdPPSupC2z1_f2aYYNkX4kmLltsEAx9mMWPIA=w1232-rw" alt="">
        </div>

        
        <div class="container product-brand--outstanding">
            <p style="padding-top: 10px;color: rgb(27, 29, 41); font-size: 20px; opacity: 1; font-weight: 700;">Thương hiệu nổi bật</p>
            <div class="row slick-slider2">
                <?php foreach($loaisanpham ?? [] as $row) : extract($row); ?>
              <a href="../TrangChu/p?loaisp=<?=($row['ID'])?>" style="text-decoration: none;" class="col-sm" target="_blank">
                <img style="max-height: 150px;" src="../Assets/data/HinhAnhLoaiSanPham/<?= $row['hinhanh'] ?>" alt=""> <br>
                <p class="slick-slider2-title"><?=$row['TenLoaiSanPham']?></p>
              </a>
              <?php endforeach; ?>
            </div>
        </div>
        <div class="all-product">
            <p class="css-1x5ixzd">Laptop</p> <br>
            <a class="watch-all" href="../TrangChu/AllSanPham">Xem tất cả <i class="fa-solid fa-arrow-right"></i></a>
            <div class="row">
                <?php foreach($result2 ?? [] as $row) : extract($row); ?>
                <?php if($row['trangthai'] == 1) { ?>
                <div class="col-sm-3">
                    <div class="row">
                        <a href="../TrangChu/ChiTietSP?id=<?=$row['ID']?>" style="text-decoration: none;" class="col-sm-12">
                            <img style="object-fit: contain;padding: 10px 0; height: 160px; width: 100%;" src="../Assets/data/Hinhanhsanpham/<?= $row['HinhAnh'] ?>" alt=""> 
                            <div class="product-list--li__brand">
                                <span><?=$row['TenLoaiSanPham']?></span>
                            </div>
                            <div style="width: 100%; overflow: hidden;" class="product-list--li__describe1">
                                <span style="display: -webkit-box;
                                -webkit-line-clamp: 3; /* Số dòng hiển thị trước khi hiển thị dấu ba chấm */
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                text-overflow: ellipsis;"><?=$row['TenSanPham']?></span>
                            </div>
                            <div style="margin-top: 10px;">
                                <span class="hehe"><?=number_format($row['Gia'], 0, '.', '.')?> đ</span> <br>
                                <span class="xoa">25.990.990 đ</span> <span class="css-1f8jk2s">-23.09%</span> 
                            </div>
                            <div style="width: 25px; height: 25px;" class="">
                                <img style="width: 100%; height: 100%;" src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                            </div>
                        </a>
                        <div class="col-sm-12">
                            <div class="" style="display: flex; align-items: center; justify-content: flex-end;">
                                <div style="font-size: 14px; color: gray;" class="">Yêu thích</div>
                                <div style="margin-left: 5px;" class="heart_beat">
                                    <?php if(isset($_SESSION['id_user'])) {  
                                        $flag = 0;
                                        if (isset($list_whistlist)) {
                                            foreach($list_whistlist as $item) {
                                                if ($row['ID'] == $item['ID_product']) {
                                                    $flag = 1;
                                                    break;
                                                }
                                            }   
                                        }
                                    ?>
                                        <i data-id_heart_pro="<?=$row['ID'];?>" style="font-size: 18px; color: red;" class="fa-<?php if($flag == 1) {echo "solid";} else {echo "regular";} ?> fa-heart fa-heart-active fa-heart-<?=$row['ID']?> "></i>
                                    <?php } else { ?>
                                        <i onclick="openModal();" style="font-size: 18px; color: red;" class="fa-regular fa-heart" id="fa-heart-active1"></i>
                                    <?php } ?>
                                </div>

                                <div id="myModal1" class="modal1">
                                    <div class="modal-content1">
                                        <span class="close1" onclick="closeModal()">&times;</span>
                                        <p style="font-size: 20px; font-weight: bold; color: red; text-align: center;">HP_Member</p>
                                        <div style="width: 100%; display: grid; place-items: center;" class="">
                                            <img style="width: 80px; height: 80px;" src="https://media.istockphoto.com/id/1206553516/vi/vec-to/ch%E1%BB%AF-l%E1%BB%93ng-hp-v%C3%A0ng.jpg?s=1024x1024&w=is&k=20&c=L1uJfu5s9_RktqLx1YJSSx3gPuTWpmRYA7J2GAbONtw=" alt="" srcset="">
                                        </div>
                                        <p style="font-weight: bold; font-size: 17px; text-align: center;">Vui lòng đăng nhập tài khoản để thêm sản phẩm yêu thích của bạn.</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row" style="display: flex; justify-content:center;">
                                                    <div class="col-sm-5">
                                                        <button id="Register" style=" width: 100px;
                                                            height: 50px;
                                                            width: 200px;
                                                            border-radius: 5px;
                                                            margin: 5px;
                                                            font-size: 17px;
                                                            font-weight: bold;
                                                            color: red;
                                                            border: 3px solid #C73866;
                                                            background-color: #fff;
                                                            cursor: pointer;">Đăng ký
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <button id="SignIn" style=" width: 100px;
                                                            height: 50px;
                                                            width: 200px;
                                                            border-radius: 5px;
                                                            margin: 5px;
                                                            font-size: 17px;
                                                            font-weight: bold;
                                                            color: #fff;
                                                            background-color: #ff0000;
                                                            border: none;
                                                            cursor: pointer;">Đăng nhập
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } endforeach;  ?>
            </div>
           
           
           
        </div>
<!-- </div> -->
        <div class="fb-comments" data-href="http://localhost/DemoWeb5/TrangChu/Index" data-width="100%" data-numposts="5"></div>
        <div style=" background-image: linear-gradient(#5ddcff, #3c67e3 43%, #4e00c2);" class="product1 container">
            <span class="product--brand" style="color: black;">Sản phẩm vừa xem</span>
            <?php if(isset($_COOKIE['myCookie'])) { ?>
            <div class="product-list row slick-slider3">
                <?php for($i = 0; $i < count($arrayFromCookie); $i++) { 
                    $test = $this->model->ChiTiet($arrayFromCookie[$i]);
                ?> 
                <a href="../TrangChu/ChiTietSP?id=<?=$test[0]['ID']?>" style="text-decoration: none; cursor: pointer;" class="product-list--li1 col-sm">
                    <div class="product-list--li__img">
                        <img src="../Assets/data/HinhAnhSanPham/<?= $test[0]['HinhAnh'] ?>" alt="">
                    </div>
                    <div class="product-list--li__brand">
                        <span><?= $test[0]['TenLoaiSanPham'] ?></span>
                    </div>
                    <div class="product-list--li__describe">
                        <span><?= $test[0]['TenSanPham'] ?></span>
                    </div>
                    <div class="product-list--li__price">
                        <span class="hehe"><?= number_format($test[0]['Gia'], 0, '.', '.'); ?>đ</span> <br>
                        <span class="xoa">25.990.990 đ</span> <span class="css-1f8jk2s">-23.09%</span> 
                    </div>
                    <div class="product-list--li__gift">
                        <img src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                    </div>
                </a>
                <?php } ?>  
            </div>
            <?php } ?>
        </div>
       
    <?php if(isset($_SESSION['luongtruycap'])) { echo $_SESSION['luongtruycap'];} ?>
    <script>
        $(document).ready(function() {
            $('.fa-heart-active').on('click', function() {
                var id_product = $(this).data("id_heart_pro");
                <?php if(isset($_SESSION['id_user'])) { ?>
                    var id_user = <?php echo $_SESSION['id_user'] ?>;
                    
                    $.ajax({
                        url: "../WhistList/handle_insert_list",
                        method: "POST",
                        data: { id_product: id_product, id_user: id_user },
                        success: function(data) {
                            if ($('.fa-heart-' + id_product).hasClass('fa-solid')) {
                                $('.fa-heart-' + id_product).removeClass('fa-solid');
                                $('.fa-heart-' + id_product).addClass('fa-regular');
                                alert("Đã xóa sản phẩm này khỏi  whistlist của bạn");
                            } else {
                                $('.fa-heart-' + id_product).removeClass('fa-regular');
                                $('.fa-heart-' + id_product).addClass('fa-solid');
                                alert("Thêm thành công sản phẩm này vào whistlist của bạn");
                            }

                        }
                    });     
                <?php } ?>
            });
        });

        function openModal() {
            var modal = document.getElementById("myModal1");
            modal.style.display = "block";
        }
      
        function closeModal() {
            var modal = document.getElementById("myModal1");
            modal.style.display = "none";
        }

        $('#SignIn').on('click', function(e){
            e.preventDefault();
            window.location.href = "../TrangChu/DangNhap";
        });

        $('#Register').on('click', function(e){
            e.preventDefault();
            window.location.href = "../TrangChu/TaoTaiKhoan";
        });
        // Thêm sự kiện click cho nền mờ (vùng bên ngoài modal)
        document.getElementById("myModal1").addEventListener('click', function(event) {
            if (event.target === this) { // Kiểm tra xem sự kiện click có xảy ra trên modal không
                closeModal(); // Nếu click xảy ra trên nền mờ, đóng modal
            }
        });
    </script>
   
    </div>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="rr9r4vel"></script>
    <?php include "./Views/HomeLayout/footer.php"; ?>  
    
