<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>

<style>
 .toastMessage {
  display: none;
  position: fixed;
  bottom: 20px;
  right: -100%; /* Bắt đầu ở vị trí ngoài màn hình bên phải */
  background-color: #333;
  color: #fff;
  padding: 15px 20px;
  border-radius: 5px;
  z-index: 999;
  transition: right 0.5s ease-in-out; /* Hiệu ứng di chuyển */
}

    .gia {
    margin: 0px;
    padding: 0px;
    border-style: none;
    border-width: 1px;
    border-color: unset;
    opacity: 1;
    color: rgb(20, 53, 195);
    font-weight: 700;
    text-decoration: unset;
    font-size: 20px;
    line-height: 28px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: unset;
    max-width: unset;
    min-width: unset;
    transition: color 0.3s ease 0s;
    }

    .gia_km {
        margin: 0px 0.25rem 0px 0px;
    padding: 0px;
    border-style: none;
    border-width: 1px;
    border-color: unset;
    opacity: 1;
    color: rgb(130, 134, 158);
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: unset;
    max-width: unset;
    min-width: unset;
    transition: color 0.3s ease 0s;
    text-decoration: line-through;
    }

    .notification {
            position: fixed;
            top: 50%;
            right: -500px; /* Điều chỉnh khoảng cách từ bên trái màn hình */
            transform: translateY(-50%);
            transform: translateX(-50%);

            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            transition: right 0.5s ease-in-out;
        }

        /* #notifications {
        position: fixed;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f1f1f1;
        color: #333;
        padding: 10px 20px;
        border-radius: 4px;
        transition: top 0.5s ease-in-out;
      }
      
      #notifications.show {
        top: 20px;
      } */


      /* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  animation: appear .4s linear;
}

@keyframes appear {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    75% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);

    }

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
.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* Close button style */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-align: right;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
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
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.name_pro {
    margin: 0;
    padding: 0px 10px;
    border-style: none;
    border-width: 1px;
    border-color: unset;
    opacity: 1;
    color: inherit;
    font-weight: 550;
    text-decoration: unset;
    font-size: 13px;
    line-height: 20px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    max-width: unset;
    min-width: unset;
    transition: color 0.3s ease 0s;
}

.giakm_detail_compo {
    margin: 0px;
    padding: 0px;
    border-style: none;
    border-width: 1px;
    border-color: unset;
    opacity: 1;
    color: rgb(67, 70, 87);
    font-weight: 700;
    text-decoration: unset;
    font-size: 15px;
    line-height: 24px;
    /* overflow: hidden; */
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: unset;
    max-width: unset;
    min-width: unset;
    transition: color 0.3s ease 0s;
}

.gia_detail_compo {
    margin: 0px 0.25rem 0px 0px;
    padding: 0px;
    border-style: none;
    border-width: 1px;
    border-color: unset;
    opacity: 1;
    color: rgb(130, 134, 158);
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    /* overflow: hidden; */
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: unset;
    max-width: unset;
    min-width: unset;
    transition: color 0.3s ease 0s;
    text-decoration: line-through;
}

.same-brand {
    top: 15px;
    /* position: absolute; */
    color: rgb(27, 29, 41);
    font-weight: 700;
    font-size: 20px;
    left: 15px;
  }
  
  .watchall-product--same {
    /* position: absolute; */
    right: 0;
    top: 15px;
    right: 15px;
    text-decoration: none;
    color: gray;
  }

</style>
<div id="toastMessage" class="toastMessage">Thêm vào giỏ hàng thành công</div>
        <div class="body body1" style="width: 80%; margin: 0 auto;">
            <?php if(is_array($test2)) foreach($test2 as $row) : extract ($row); 
                if ($row['thuoctinh']!="") {
                    $json_decode = json_decode($row['thuoctinh'], true);
                }
            ?>
            <div class="body-title">
                <a href="#">Trang chủ</a> <i style="margin-left: 10px;" class="fa-solid fa-arrow-right"></i> <span style="margin-left: 10px; cursor: default;"><?=$row['TenSanPham'];?></span> 
            </div>
           
            <div class="product-details">
                <div class="product-details--container">
                    <div class="product-details--img" style="margin-right: 15px;">
                        <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="">
                        <!-- - CPU: Intel Core i5-11400H <br>
                        - Màn hình: 15.6" IPS (1920 x 1080),144Hz <br>
                        - RAM: 1 x 8GB DDR4 3200MHz <br>
                        - Đồ họa: RTX 3050 4GB GDDR6 / Intel UHD Graphics <br>
                        - Lưu trữ: 512GB SSD M.2 NVMe / <br>
                        - Hệ điều hành: Windows 11 <br>
                        - Pin: 4 cell 57 Wh Pin liền <br>
                        - Khối lượng: 2.2kg <br> -->
                    </div>
                    <div class="product-details--des">
                        <div class="product-details--product--name">
                            <?=$row['TenSanPham']?>
                        </div>
                        <div class="product-details--brand--name">
                            Thương hiệu <a href="../TrangChu/AllSanPham?idloaisp=<?=$row['idLoaiSanPham']?>"><?=$row['TenLoaiSanPham']?></a>
                        </div>   
                        <br>
                        <div class="product-list--li__price">
                        
                        <?php 
                            if (!isset($_GET['id_bt'])) {
                                if($row['GiaKhuyenMai'] != 0) { ?>
                                    <span style="font-size: 22px;" class="hehe"><?= number_format($row['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                    <span class="xoa"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=round((($row['Gia']-$row['GiaKhuyenMai']) / $row['Gia']) * 100 , 2)?>%</span> 
                                <?php } else { ?>
                                    <span style="font-size: 22px;" class="hehe"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <br>
                                    <span class="xoa"></span> <span class="css-1f8jk2s"></span> 
                                <?php } } else { 
                               
                                foreach($json_decode as $item) {
                                    if ($item['ID'] == $_GET['id_bt']) {
                                        if ($item['price_dis'] != 0) {
                                            $price_dis = number_format($item['price_dis'], 0, '.', '.');
                                            $price_ori = number_format($item['price_ori'], 0, '.', '.');
                                            $phantram = round((($item['price_ori']-$item['price_dis']) / $item['price_ori']) * 100 , 2);
                                            echo "
                                                <span style='font-size: 22px;' class='hehe'> $price_dis đ</span> <br>
                                                <span class='xoa'>$price_ori đ</span> <span class='css-1f8jk2s'>$phantram%</span> 
                                            ";
                                        } else {
                                            $price_dis = number_format($item['price_dis'], 0, '.', '.');
                                            $price_ori = number_format($item['price_ori'], 0, '.', '.');
                                            $phantram = round((($item['price_ori']-$item['price_dis']) / $item['price_ori']) * 100 , 2);
                                            echo "
                                                <span style='font-size: 22px;' class='hehe'> $price_ori đ</span> <br>
                                            ";
                                        }
                                        break;
                                    }
                                }    
                                ?>
                                <?php } ?>
                        </div> 
                        <br>
                        <hr style="border-top: 1px dashed black; top: 10px;">
                        
                        <br>
                       
                        <!-- <div class="row" style="gap: 5px 10%;">
                            <?php foreach($json_decode as $item) { ?>
                                <a href="../TrangChu/ChiTietSP?id=<?=$_GET['id']?>&id_bt=<?=$item['ID'];?>" data-id_sp="<?=$item['ID'];?>" style="text-decoration: none; font-size: 13px; font-weight: bold; padding: 5px 10px; border-radius: 7px; border: 1px solid <?php echo isset($_GET['id_bt']) && $item['ID'] == $_GET['id_bt'] ? "red" : "#ccc"; ?>" class="col-sm-3 tt">
                                    <?php echo $item['core'] . " " .$item['ram']. " - " .$item['rom']. " " .$item['color'];?>
                                </a>
                            <?php } ?>
                        </div> -->
                        <form action="" method="POST">
                        <div class="buy-product">
                            <?php if($row['SoLuong'] > 0 && $row['trangthai'] == 1) {  ?>
                            <!-- <div class="buy-product--now">
                                <input name="submitBuyNow" id="openModalBtn" class="buy-product--now-button" type="submit" value="MUA NGAY">
                            <div style="z-index: 10000;" id="notifications"></div> -->
                            <!-- name="submitBuyNow" -->
                            <!-- </div> -->

                            <!-- <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p style="font-size: 30px; color: blue; font-weight: bold; text-align: center;">Bạn muốn mua ngay?</p>
                                    <div style="display: flex; justify-content: space-between;" class="">
                                        <div style="display: flex; justify-content: center; width: 100%;" class="">
                                            <div class="">
                                                <input style="color: white; font-weight: bold;" class="btn btn-warning" type="submit" value="MUA NGAY" name="submitBuyNow">
                                            </div>
                                            <div style="margin-left: 10px;" class="">
                                                <button id="button1" style="width: 117.58px;" class="btn btn-danger">Hủy</button>
                                            </div>
                                        </div>
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div> -->

                            
                            
                            <div class="buy-product--addcart w-100">
                                <input class="buy-product--addcart-button btn btn-primary" type="submit" value="THÊM VÀO GIỎ HÀNG" name="submit">
                                <!-- <button  class="buy-product--addcart-button" value="Thêm vào giỏ hàng" name="submit" onclick="showNotification()">Thêm vào giỏ hàng</button> -->
                            </div>
                            <?php } elseif($row['trangthai'] == 0) { ?>
                                <div style="width: 100%;" class="">
                                <input type="text" value="Ngừng kinh doanh" style="width: 100%; background: gray; border: none; height: 45px; font-size: 24px;" class="btn btn-primary" disabled >
                            </div>
                            <?php } else { ?>
                                <div style="width: 100%;" class="">
                                    <input type="text" value="Hết hàng" style="width: 100%; background: gray; border: none; height: 45px; font-size: 24px;" class="btn btn-primary" disabled >
                                </div>
                            <?php } ?>
                        </div>
                        </form>
                        <hr style="border: 1px dashed black; width: 100%; margin-top: 20px;"> <br>
                        <div class="discount-relate">
                            <p>Khuyến mãi liên quan</p>
                            <div class=""></div>
                        </div>
                    </div>
                    
                </div>
                <div class="company">
                    <div class="company-support">
                        <div class="company-support--img">
                            <img src="https://lh3.googleusercontent.com/qOnchEYD7No58bjEQs5pf_05IV-0DmoaCmEFXD007VHs5cn16LZ6PC98IlY3OiBL9UXsEwNzwiVHRrvSDMQ" alt="">
                        </div>
                        <div class="company-support--link">
                            <a href="#">CÔNG TY CỔ PHẦN THƯƠNG MẠI DỊCH VỤ PHONG VŨ</a>
                        </div>
                    </div>
                    <div class="legal-sell">
                        <div style="padding: 20px;" class="">
                            <p style="font-weight: 550;">Chính sách bán hàng</p> <br>
                            <div class="legal-sell--detail">
                                <div class="legal-sell--img">
                                    <img src="https://lh3.googleusercontent.com/uvWBg1q90XtEWvHkWGDbDemjEaANJ_kX3NEfIywURPTMeaSZTORdttpehuFBNKpYiWQ3jHgito4ciCt9pEJIHH1V4IlPYoE=rw" alt="">
                                </div>
                                <div class="legal-sell--span">
                                    <span>Miễn phí giao trả hàng từ 5 củ tỏi</span>
                                </div>
                            </div>
                            <div class="legal-sell--detail">
                                <div class="legal-sell--img">
                                    <img src="https://lh3.googleusercontent.com/LT3jrA76x0rGqq9TmqrwY09FgyZfy0sjMxbS4PLFwUekIrCA9GlLF6EkiFuKKL711tFBT7f2JaUgKT3--To8zOW4kHxPPHs4=rw" alt="">
                                </div>
                                <div class="legal-sell--span">
                                    <span>Cam kết chính hãng 1000%</span>
                                </div>
                            </div>
                            <div class="legal-sell--detail">
                                <div class="legal-sell--img">
                                    <img src="https://lh3.googleusercontent.com/TECKlw8DFChVXu_FAYdNjbCuaDVhmOhbqsKLnayhIgx5Pvv0EX051qHWJR7vUgxiUXN5heAlx4bIDYsoES7X8pby5Pn9LXWN=rw" alt="">
                                </div>
                                <div class="legal-sell--span">
                                    <span>Đổi trả trong vòng 10 ngày</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="fb-comments" data-href="http://localhost/DemoWeb5/TrangChu/ChiTietSP?id=40" data-width="" data-numposts="5"></div>
            <div class="product-describe">
                <p style="font-weight: bold; font-size: 18px;">Mô tả sản phẩm</p>
                <p><?=$row['MoTa']?></p>
                <div id="fb-root"></div>
            </div>
            <div class="xuat"></div>
            <!-- <div class="fb-comments" data-href="http://localhost/DemoWeb5/TrangChu/ChiTietSP?id=40" data-width="" data-numposts="5"></div> -->

            <div style="" class="product container product1">
                <div class="row p-3">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="same-brand">Cùng thương hiệu <?=$tenloaisanpham[0]['TenLoaiSanPham']?></span>
                            </div>
                            <div class="col-sm-6" style="text-align: right;">
                                <a class="watchall-product--same" href="#">Xem tất cả <i class="fa-solid fa-arrow-right" style="color: gray;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              
                <!-- <div class="product-list row slick-slider2"> -->
                    
                    <?php $test10 = $this->model->LaySanPham($row['idLoaiSanPham']);
                    $target_id = $_GET['id'];

                    // Lặp qua từng phần tử trong mảng
                    foreach ($test10 as $key => $value) {
                        // Kiểm tra nếu 'ID' của phần tử hiện tại bằng với ID cần xóa
                        if ($value['ID'] == $target_id) {
                            // Sử dụng unset() để xóa phần tử khỏi mảng
                            unset($test10[$key]);
                            // Thoát khỏi vòng lặp vì đã xóa phần tử
                            break;
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row slick-slider1">
                                <?php foreach($test10 as $row) : extract($row); ?>
                                <div class="col-sm-3">
                                    <a style="text-decoration: none;" href="../TrangChu/ChiTietSP?id=<?=$row['ID'];?>" class="product-list--li col-sm">
                                        <div class="product-list--li__img">
                                            <img style="" src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="">
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
                                        <!-- <div class="product-list--li__gift">
                                            <img src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                                        </div> -->
                                    </a> 
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    
                <!-- </div> -->
               
            </div>
        </div>
        <?php endforeach;  ?>
        <!-- <div id="fb-root"></div> -->
        <div id="notification" class="notification">
    <?php if(isset($alert)) {echo $alert;} ?>
</div>
<span style="color: red;" id="ko"></span>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="A7uTZ1Dx"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function() {
        $('#add_cart_compo').click(function() {
            // Lấy số lượng từ input có class myNumber
            var products = [];

            // Lặp qua mỗi hàng trong mảng id_num
            $('.id_num').each(function() {
                // Lấy ID sản phẩm từ thuộc tính data-id_sp1 của hàng hiện tại
                var productId = $(this).data('id_sp1');
                
                // Lấy số lượng từ input có class myNumber trong hàng hiện tại
                var quantity = $(this).find('.myNumber').val();

                // Thêm thông tin sản phẩm vào mảng products
                products.push({ productId: productId, quantity: quantity });
            });

            // In thông tin sản phẩm ra console để kiểm tra
            $.ajax({
                url : "../TrangChu/lol",
                method: "POST",
                data: {data: products},
                success: function(data) {
                    closeModal();
                }
            });
            // Đoạn này bạn có thể thực hiện các hành động khác như gửi số lượng và ID sản phẩm đến server để xử lý thêm vào giỏ hàng.
        });
    });

    $(document).ready(function() {
        var array = [
            // Các phần tử của mảng nếu cần
        ];
        <?php $soluong = $this->model->ChiTiet($_GET['id']); $soluong_giohang = $this->giohang->LaySoLuong1($_GET['id'],$_SESSION['id_user']);?>
            array.push({ id: '<?=$_GET['id']?>', value: '1' , tonkho : '<?php echo $soluong[0]['SoLuong']; ?>',soluong_giohang : '<?php if(isset($soluong_giohang)) { echo $soluong_giohang[0]['SoLuong1'];} else {echo 0;}?>' });
        <?php 

        // Tìm vị trí của giá trị cần xóa
        $key = array_search($_GET['id'], $compo);
        // Nếu giá trị tồn tại trong mảng
        if ($key !== false) {
            // Xóa giá trị tại vị trí tìm được
            unset($compo[$key]);
        }
        foreach($compo as $item) { $soluong = $this->model->ChiTiet($item); 
            $soluong_giohang = $this->giohang->LaySoLuong1($item,$_SESSION['id_user']);
            ?>
                array.push({ id: '<?=$item;?>', value: '1', tonkho : '<?php echo $soluong[0]['SoLuong']; ?>',soluong_giohang : '<?php if(isset($soluong_giohang)) { echo $soluong_giohang[0]['SoLuong1'];} else {echo 0;}?>' });
            <?php } ?>
            console.log(array);
            
            $('.myNumber').change(function() {
                var parentDiv = $(this).closest('.id_num');
                var id_sp1 = parentDiv.attr('data-id_sp1');
                var newValue = $(this).val();
                var tong = $('.tonggia').data('tong');

                // console.log(newValue);
                // Khởi tạo mảng chứa id và số lượng
                
                // Kiểm tra xem id đã tồn tại trong mảng hay chưa
                var idExists = false;
                for (var i = 0; i < array.length; i++) {
                    if (array[i].id === id_sp1) {
                        // Nếu id đã tồn tại trong mảng
                        idExists = true;
                        if (parseInt(newValue) <= parseInt(array[i].tonkho) &&  (parseInt(array[i].soluong_giohang) + parseInt(newValue)) <=  parseInt(array[i].tonkho)) {
                            // Nếu số lượng mới không vượt quá tồn kho, cập nhật giá trị mới cho id đã tồn tại
                            array[i].value = newValue;
                        } else {
                            // Nếu số lượng mới vượt quá tồn kho, báo lỗi
                            alert('Số lượng vượt quá tồn kho!');
                            // Đặt lại giá trị của input về giá trị cũ
                            $(this).val(array[i].value);
                        }
                        break;
                    }
                }
                // Nếu id chưa tồn tại trong mảng, thêm một cặp id-value mới vào mảng
                if (idExists) {
                    $.ajax({
                        url: "../TrangChu/Tong_compo",
                        method: "POST",
                        data: {array: array, tong:tong},
                        success: function(data) {
                            $('.tonggia').html(data);
                        }
                    });
                    // array.push({ id: id_sp1, value: newValue });
                    }
                });
            });

        $(document).ready(function(){
            $('.submit_compo').on('click', function(){
            // Lấy tất cả các phần tử có thuộc tính data-id_sp
            var elementsWithDataIdSp = document.querySelectorAll('[data-id_sp]');

            // Khai báo một mảng để lưu trữ tất cả các ID
            var allIds = [];

            // Duyệt qua tất cả các phần tử có thuộc tính data-id_sp và lấy giá trị của thuộc tính đó
            elementsWithDataIdSp.forEach(function(element) {
                var id = element.getAttribute('data-id_sp');
                allIds.push(id); // Thêm ID vào mảng allIds
            });
            // Bây giờ mảng allIds chứa tất cả các ID từ thuộc tính data-id_sp của các phần tử
            var jsonData = JSON.stringify(allIds);
                $.ajax({
                    url: "../TrangChu/buyCompo",
                    method: "POST",
                    data: { data: allIds },
                    success: function(data) {
                        $('.xuat').html(data);
                    }
                });
        
            });
        });


var modal = document.getElementById("myModal");

document.getElementById('button1').onclick = (e) => {
    e.preventDefault();
    modal.style.display = "none";
}

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function (e) {
    e.preventDefault();
    
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

   
    function getQueryStringParams() {
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const paramsObject = {};

        params.forEach((value, key) => {
        paramsObject[key] = value;
    });
    return paramsObject;
    }

// Sử dụng hàm để lấy tham số GET từ URL
    const params = getQueryStringParams();
    const newItem = params.id;

    if (localStorage.getItem("myItems") === null) {
      // Nếu localStorage chưa tồn tại, tạo mới một mảng và thêm phần tử đầu tiên
      const initialItems = [newItem];
      localStorage.setItem("myItems", JSON.stringify(initialItems));
      console.log("Đã tạo mới localStorage và thêm phần tử đầu tiên.");
    } else {
      // Nếu localStorage đã tồn tại, lấy danh sách mục hiện tại và thêm phần tử mới vào
      const existingItems = JSON.parse(localStorage.getItem("myItems"));
      
      if (existingItems.includes(newItem)) {
        console.log("Phần tử đã tồn tại trong localStorage. Bỏ qua thêm.");
      } else {
        existingItems.push(newItem);
        localStorage.setItem("myItems", JSON.stringify(existingItems));
        console.log("Đã thêm phần tử mới vào localStorage.");
      }
    }
// localStorage.setItem('Array',  JSON.stringify(test2));


// Ví dụ sử dụng:
    // console.log(params.id); // Nếu URL là something.com?name=John, đầu ra sẽ là "John"
    
    function showNotification() {
        var notification = document.getElementById("notification");
        notification.style.right = "10px"; /* Điều chỉnh khoảng cách từ bên trái màn hình */
        setTimeout(function() {
            notification.style.right = "-500px";
        }, 3000); // Thời gian hiển thị thông báo (đơn vị: milliseconds)
    }
</script>

<script>
    window.addEventListener('popstate', function(event) {
  // Xử lý sự kiện back trang tại đây
  // Ví dụ: Hiển thị thông báo, chuyển hướng, tải lại dữ liệu, vv.
    window.location.href = "../TrangChu/Index";
});
</script>

<script>
    function showToast() {
  var toast = document.getElementById("toastMessage");
  toast.style.display = "block";
  setTimeout(function(){
    toast.style.right = "20px"; // Hiển thị toast message từ bên ngoài vào
  }, 10); // Đợi một chút để tránh hiệu ứng bị mất
  setTimeout(function(){
    hideToast(); // Sau 3 giây, ẩn lại toast message
  }, 3000); // 3000 milliseconds = 3 seconds
}

function hideToast() {
  var toast = document.getElementById("toastMessage");
  toast.style.right = "-100%"; // Ẩn toast message bằng cách di chuyển ra khỏi màn hình
  setTimeout(function(){
    toast.style.display = "none"; // Sau khi ẩn, ẩn đi thực sự
  }, 500); // 500 milliseconds để đảm bảo hiệu ứng hoàn thành trước khi ẩn
}

    function openModal() {
        var modal = document.getElementById("myModal1");
        
        modal.style.display = "block";
      }
      
      function closeModal() {
        var modal = document.getElementById("myModal1");
        modal.style.display = "none";
      }
      
      // Thêm sự kiện click cho nền mờ (vùng bên ngoài modal)
      document.getElementById("myModal1").addEventListener('click', function(event) {
        if (event.target === this) { // Kiểm tra xem sự kiện click có xảy ra trên modal không
          closeModal(); // Nếu click xảy ra trên nền mờ, đóng modal
        }
      });

     // Wait for the DOM content to be fully loaded
    // Wait for the DOM content to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get all elements with class 'tt'
        var ttElements = document.querySelectorAll('.tt');

        // Add click event listener to each 'tt' element
        ttElements.forEach(function(element) {
            element.addEventListener('click', function() {
                alert('1'); // Show the alert when clicked
            });
        });
    });
</script>



<?php include("./Views/HomeLayout/footer.php"); ?>


