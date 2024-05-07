<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Thông tin tài khoản</title>";
?>
<style>
    
    
    .container-address1 {
        width: 100%;
        height: 100%;
        background: red;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-address2 {
        width: 512px;
        height: auto;
        background: yellow;
        position: absolute;
    }
</style>
        
<div class="body klkl" style="width: 80%; margin: 12px auto 0;">
    <div style="width: 100%; height: 100%; " class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <?php if(isset($thongtin)) { foreach($thongtin as $row) : extract ($row); ?>
                        
                        <?php endforeach; }?>
                    </div>
                    <div class="col-sm-9">
                        <div style="width: 100%; height: auto; " class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span style="font-size: 20px; color: black; font-weight: 550;" class="">Sản phẩm yêu thích của bạn</span>
                                </div>
                            </div>
                            
                            <div style="box-shadow: 1px 2px 3px 4px gray; margin-top: 20px; height: auto; padding: 20px; background-image: url('https://tse3.mm.bing.net/th?id=OIF.OhZrotnkg0VWgRIfKlHB1w&pid=Api&P=0&h=180');" class="container">
                                <div style="margin: 0 auto; width: 100%; top: 0; " class="product-list row slick-slider1">
                                    <?php if(!empty($whistlist)) { foreach($whistlist as $item)  { $chitiet = $this->model->ChiTiet($item['ID_product']); ?> 
                                    <a style="text-decoration: none; margin-left: 5px; background: #fff;" href="../TrangChu/ChiTietSP?id=<?=$chitiet[0]['ID'];?>" class="col-sm">
                                        <div class="product-list--li__img">
                                            <img src="../Assets/data/HinhAnhSanPham/<?= $chitiet[0]['HinhAnh'] ?>" alt="">
                                        </div>
                                        <div class="product-list--li__brand">
                                            <span><?=$chitiet[0]['TenLoaiSanPham']?></span>
                                        </div>
                                        <div class="product-list--li__describe">
                                            <span><?=$chitiet[0]['TenSanPham'];?></span>
                                        </div>
                                        <div class="product-list--li__price">
                                            <?php if($chitiet[0]['GiaKhuyenMai'] != 0) { ?>
                                                <span class="hehe"><?= number_format($chitiet[0]['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                                <span class="xoa"><?= number_format($chitiet[0]['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=round((($chitiet[0]['Gia']-$chitiet[0]['GiaKhuyenMai']) / $chitiet[0]['Gia']) * 100 , 2)?>%</span> 
                                            <?php } else { ?>
                                                <span class="hehe"><?= number_format($chitiet[0]['Gia'], 0, '.', '.')?> đ</span> <br>
                                                <span class="xoa"></span> <span class="css-1f8jk2s"></span> 
                                            <?php } ?>
                                        </div>
                                       
                                    </a>
                                    <?php } } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!-- <div >
                    
                    <div style="width: 100%;" class="">
                        <div style="padding-bottom: 5px;display: flex; justify-content: space-between;" class="">
                            <div style="font-size: 20px; color: black; font-weight: 550;" class="">Sản phẩm yêu thích của bạn</div>
                            <div class=""><a style="text-decoration: none;" href="?xemthongbaoall">Đánh dấu tất cả là đã đọc</a></div>
                        </div>
                        <div style="box-shadow: 1px 2px 3px 4px gray; margin-top: 20px;" class="">
                            <div style="margin: 0 auto;" class="product-list row slick-slider1">
                                <?php if(!empty($whistlist)) { foreach($whistlist as $item)  { $chitiet = $this->model->ChiTiet($item['ID_product']); ?> 
                                <a style="text-decoration: none;" href="../TrangChu/ChiTietSP?id=<?=$chitiet[0]['ID'];?>" class="product-list--li col-sm">
                                    <div class="product-list--li__img">
                                        <img src="../Assets/data/HinhAnhSanPham/<?= $chitiet[0]['HinhAnh'] ?>" alt="">
                                    </div>
                                    <div class="product-list--li__brand">
                                        <span><?=$chitiet[0]['TenLoaiSanPham']?></span>
                                    </div>
                                    <div class="product-list--li__describe">
                                        <span><?=$chitiet[0]['TenSanPham'];?></span>
                                    </div>
                                    <div class="product-list--li__price">
                                        <?php if($chitiet[0]['GiaKhuyenMai'] != 0) { ?>
                                            <span class="hehe"><?= number_format($chitiet[0]['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                            <span class="xoa"><?= number_format($chitiet[0]['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=round((($chitiet[0]['Gia']-$chitiet[0]['GiaKhuyenMai']) / $chitiet[0]['Gia']) * 100 , 2)?>%</span> 
                                        <?php } else { ?>
                                            <span class="hehe"><?= number_format($chitiet[0]['Gia'], 0, '.', '.')?> đ</span> <br>
                                            <span class="xoa"></span> <span class="css-1f8jk2s"></span> 
                                        <?php } ?>
                                    </div>
                                    <div class="product-list--li__gift">
                                        <img src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt="">
                                    </div>
                                </a>
                                <?php } } ?>
                                
                            </div>
                        </div>
                    </div>
                    
                </div> -->
    </div>
</div>
        
        
<?php include "./Views/HomeLayout/footer.php" ?>






