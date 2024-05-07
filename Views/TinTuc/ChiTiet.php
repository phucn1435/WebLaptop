<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách tin tức</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Tin Tức</span>
    <i class="fa fa-angle-double-right" style="color: blue;" aria-hidden="true"></i>
    <span>
        <a href="../TinTuc/DanhSach" style="font-weight: bold;"  >Danh sách</a>
    </span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    <span>
        Chi tiết
    </span>

</div>
<hr>
<div class="row">
<?php foreach ($detail as $row){?> 
    <div class="col-md-4">
        <div class="card">
            <img src="../Assets/data/HinhAnhTinTuc/<?=$row['hinhanh'];?>" alt="Hình ảnh không tồn tại">
        </div>
    </div>
    <div class="col-md-8">
        <h5><?=$row['TenTinTuc']?></h5><br>
        <h5><?=$row['TenLoaiTinTuc']?></h5><br>
        <h5><?=$row['NgayDang']?></h5><br>
        <h6>Nội dung </h6>
        <div class="card">
            <?=$row['NoiDung']?>
        </div>
    </div>
<?php }?>
</div>
    
<?php
    include "./Views/Layout/footer.php";
?>