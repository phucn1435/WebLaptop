<?php include "./Views/HomeLayout/header.php"; ?>
<style>
    #slick-slide-control10 {
        display: none;
    }
    .slick-slider .slick-arrow, 
    .slick-slider .slick-dots {display: none !important;}

    .slick-current {
        background: white;
        color: blue;
    }

    .slick-tab--element:hover {
        cursor: pointer;
        color: blue;
    }
    
</style>
<?php date_default_timezone_set("Asia/Ho_Chi_Minh"); ?>

<div class="body klkl" style="width: 80%; margin: 12px auto 0;">
            <form action="" method="GET" style="padding: 10px;">
                <div class="d-flex" style="justify-content: space-between;">
                    <div class=""> <h2>Tin tức</h2></div>
                    <div style="width: 50%;position: relative;" class=""> <input value="<?php if (isset($_GET['searchNew'])) {echo $_GET['searchNew'];}?>" type="search" placeholder="Nhập tên tin tức..." name="searchNew" class="form-control"> <input style="position: absolute; right: 0; top:0; height: auto;" type="submit" value="Tìm Kiếm" class="btn btn-primary"></div>
                </div>
            </form>
    <div style="width: 100%; height: 100%; display: flex; justify-content: space-between; " class="">
        <div style="width: 69%;  height: auto; background: yellow;" class="news-left">  
            <div style="width: 100%; padding: 10px;" class="">
                <div style="" class="container-fluid p-3">
                <?php if(isset($_GET['idltt'])) { if (is_array($danhsachloai)) foreach($danhsachloai as $row) : extract($row); ?>
                    <div class="row mt-5">
                        <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="col-sm-5">
                            <img style="width: 100%;" src="../Assets/data/HinhAnhTinTuc/<?=$row['hinhanh'];?>" alt="">
                        </a>
                        <div class="col-sm-7" style="height: 100px;">
                            <a href="../TrangChu/TinTuc?idltt=<?=$row['IDLoaiTinTuc'];?>" style="color: white; padding: 5px 10px; border-radius: 5px; background: <?=$test;?>; text-decoration: none; font-size: 12px; font-weight: 550;"><?=$row['TenLoaiTinTuc'];?></a> <br>
                            <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" style="text-decoration: none; color: black;font-size: 30px;font-weight: bold;"><?=$row['TenTinTuc'];?></a>
                            <div style="font-size: 12px; color: gray;" class=""><?=$row['NgayDang'];?></div>
                            <div style="display: -webkit-box; max-height: 2.8em; -webkit-line-clamp: 2;  -webkit-box-orient: vertical; overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap; " class=""><?=$row['NoiDung'];?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php } elseif(isset($_GET['searchNew'])) { foreach($searchNew as $row) : extract($row);  ?>
                    <div class="row mt-5">
                        <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="col-sm-5">
                            <img style="width: 100%;" src="../Assets/data/HinhAnhTinTuc/<?=$row['hinhanh'];?>" alt="">
                        </a>
                        <div class="col-sm-7" style="height: 100px;">
                            <a href="../TrangChu/TinTuc?idltt=<?=$row['IDLoaiTinTuc'];?>" style="color: white; padding: 5px 10px; border-radius: 5px; background: <?=$test;?>; text-decoration: none; font-size: 12px; font-weight: 550;"><?=$row['TenLoaiTinTuc'];?></a> <br>
                            <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" style="text-decoration: none; color: black;font-size: 30px;font-weight: bold;"><?=$row['TenTinTuc'];?></a>
                            <div style="font-size: 12px; color: gray;" class=""><?=$row['NgayDang'];?></div>
                            <div style="display: -webkit-box; max-height: 2.8em; -webkit-line-clamp: 2;  -webkit-box-orient: vertical; overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap; " class=""><?=$row['NoiDung'];?></div>
                        </div>
                    </div>
                <?php endforeach; } else {  ?>
                <?php if (is_array($chitiet)) { ?>
                    <div class=""><?=$chitiet[0]['NoiDung'];?></div>
                    <?php } else { ?>
                        <?php if(is_array($tintuc)) foreach($tintuc as $row) : extract($row); ?>
                    <div class="row mt-5">
                        <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="col-sm-5">
                            <img style="width: 100%;" src="../Assets/data/HinhAnhTinTuc/<?=$row['hinhanh'];?>" alt="">
                        </a>
                        <div class="col-sm-7" style="height: 100px;">
                            <a href="../TrangChu/TinTuc?idltt=<?=$row['IDLoaiTinTuc'];?>" style="padding: 5px 10px; border-radius: 5px; background: <?=$test;?>; color: #fff; text-decoration: none; font-size: 12px; font-weight: 550;"><?=$row['TenLoaiTinTuc'];?></a> <br>
                            <a href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" style="text-decoration: none; color: black;font-size: 30px;font-weight: bold;"><?=$row['TenTinTuc'];?></a>
                            <div style="font-size: 12px; color: gray;" class=""><?=$row['NgayDang'];?></div>
                            <div style="display: -webkit-box; max-height: 2.8em; -webkit-line-clamp: 2;  -webkit-box-orient: vertical; overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap; " class=""><?=$row['NoiDung'];?></div>
                        </div>
                       
                    </div>
                    <?php endforeach;  ?>
                    <?php }} ?>
                </div>
                <hr>
            </div>
        </div>
       
        <div class="news-right" style="width: 29%; height: 100vh; background: red;">
            <div class="container-fluid">
                <div class="container" style="background: #fff;">
                    <h5 class="mt-3">Recent Post</h5>
                    <div class="row">
                        <?php $i = 0; ?>
                        <?php if (is_array($recent_post)) foreach($recent_post as $row) : extract($row); $i++; ?>
                        <div class="col-sm-12 d-flex mt-3">
                            <div class="number">
                                <span style="font-size: 12px; border-radius: 7px; color: #fff; padding: 3px 6px; background: 
                                <?php if($i == 1) {
                                        echo "red";
                                    } elseif($i == 2) {
                                        echo "orange";
                                    } elseif ($i == 3) {
                                        echo "blue";
                                    } else {
                                        echo "#ccc";
                                    } 
                                ?>">
                                <?=$i;?></span>
                            </div>
                            <div style="margin-left: 10px;" class="">
                                <a style="color: black; text-decoration: none;" href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="" style="margin-left: 10px; display: inline-block;">
                                    <?=$row['TenTinTuc'];?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-3">
                <div style="background: #e9e9e9; font-size: 12px; color: #ccc;" class="slick slick-tab">
                    <div class="slick-tab--element" style="padding: 10px; text-align: center;">
                        <i class="fa-solid fa-star"></i> <br>
                        Popular
                    </div>
                    <div class="slick-tab--element" style="padding: 10px; text-align: center;">
                        <i class="fa-solid fa-clock"></i> <br>
                        Latest
                    </div>
                </div> 
                <div class="slick slick-content">
                    <div style="padding: 10px;" class="">
                        <?php $i = 0; if (is_array($danhsachpb)) foreach($danhsachpb as $row): extract($row); $i++; ?>
                        <div class="" style="display: flex; margin-top: 20px;">
                            <div class="">
                                <span style="font-size: 12px; border-radius: 7px; color: #fff; padding: 3px 6px; background: 
                                    <?php if($i == 1) {
                                            echo "red";
                                        } elseif($i == 2) {
                                            echo "orange";
                                        } elseif ($i == 3) {
                                            echo "blue";
                                        } else {
                                            echo "#ccc";
                                        } 
                                    ?>">
                                <?=$i;?></span>
                            </div>
                            <div style="margin-left: 10px;" class="">
                                <a style="color: black; text-decoration: none;" href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="" style="margin-left: 10px; display: inline-block;">
                                    <?=$row['TenTinTuc'];?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div style="padding: 10px;" class="">
                        <?php $i = 0; if (is_array($recent_post)) foreach($recent_post as $row): extract($row); $i++; ?>
                        <div class="" style="display: flex; margin-top: 20px;">
                                    
                            <div class="">
                                <span style="font-size: 12px; border-radius: 7px; color: #fff; padding: 3px 6px; background: 
                                    <?php if($i == 1) {
                                            echo "red";
                                        } elseif($i == 2) {
                                            echo "orange";
                                        } elseif ($i == 3) {
                                            echo "blue";
                                        } else {
                                            echo "#ccc";
                                        } 
                                    ?>">
                                <?=$i;?></span>
                            </div>
                            <div style="margin-left: 10px;" class="">
                                <a style="color: black; text-decoration: none;" href="../TrangChu/TinTuc?id=<?=$row['ID'];?>" class="" style="margin-left: 10px; display: inline-block;">
                                    <?=$row['TenTinTuc'];?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
        <script>
            $(document).ready(function() {
              
                $('.slick-content').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slick-tab'
                });
                $('.slick-tab').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slick-content',
                    // dots: true,
                    
                    focusOnSelect: true
                });
		
            });
        </script>

<?php include "./Views/HomeLayout/footer.php"; ?>