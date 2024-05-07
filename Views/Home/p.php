<?php include "./Views/HomeLayout/header.php"; ?>  

        <div style="background: black; padding-bottom: 30px;" class="body">
            <div style="flex-wrap: wrap;" class="slick-slider">
                <?php if(is_array($banner)) foreach($banner as $row) : extract($row); ?>
                    <div class="">
                        <img class="slick-slide--img" src="../Assets/data/Slides/<?=$row['hinhanh'];?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- <div class="category"> -->
        <!-- </div>     -->
            <div class="product container">
                <span class="product--brand">Laptop</span>
                <a class="product-seeon" href="../TrangChu/AllSanPham">Xem tất cả <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></a>
                <div style="margin: 0 auto;" class="product-list row slick-slider1 ">
                    <?php if(is_array($result2))  foreach($result2 as $row) : extract($row); ?>
                    <a style="text-decoration: none;" href="../TrangChu/ChiTietSP?id=<?=$row['ID']?>" class="product-list--li col-sm">
                        <div class="product-list--li__img">
                            <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="">
                        </div>
                        <div class="product-list--li__brand">
                            <span><?=$row['TenLoaiSanPham'];?></span>
                        </div>
                        <div class="product-list--li__describe">
                            <span><?=$row['TenSanPham'];?></span>
                        </div>
                        <div class="product-list--li__price">
                            <span class="hehe"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <br>
                            <span class="xoa">25.990.990 đ</span> <span class="css-1f8jk2s">-23.09%</span> 
                        </div>
                        <div class="product-list--li__gift">
                            <img src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div style="width: 100%; text-align: center; margin-top: 95px; " class="">
                    <a style="background: blue; opacity: 0.65; color: white; padding: 5px 20px; border-radius: 60px; text-decoration: none; " href="../TrangChu/AllSanPham?idloaisp=<?=$_GET['loaisp']?>">Xem thêm</a>
                </div>
            </div>
            
        <!-- </div> -->
        


       

        
<!-- </div> -->
       
    
  
    <?php
    include "./Views/HomeLayout/footer.php";
?>
<!-- <div class=""> -->
    <!-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc.<path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>                    -->
    <!-- <div class=""> -->
       <!-- <div class="header_profile-cart--title"> -->
            <!-- Giỏ hàng của bạn -->
       <!-- </div> -->
        <!-- <div class="header_profile-cart--quatity"> -->
            <!-- (1) sản phẩm -->
        <!-- </div> -->
    <!-- </div>   -->
<!-- </div> -->

