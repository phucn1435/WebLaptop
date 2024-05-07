<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>
<div class="container p-3">
    <h3 style="text-transform: uppercase; text-align: center; font-weight: bold;">Khuyến mãi Hot</h3>
    <div class="row">
        <?php $ngayGioHienTai = new DateTime(); ?>
        <?php if (is_array($show)) foreach($show as $row) : extract ($row); ?>
        <?php $ngayGioCuThe = new DateTime($row['ngayketthuc']);
        if ($row['trangthai'] == 1) { ?>
        <div class="col-md-6 mt-3">
            <div class="card" style="width: 100%;">
                <img style="width: 100%; height: 30vh; object-fit: cover;" class="card-img-top" src="../Assets/data/HinhAnhMaGiamGia/<?= $row['image1']?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$row['tenma'];?></h5>
                    <p class="card-text"><?=$row['mota'];?></p>
                    <p class="card-text"><?= date("d/m", strtotime($row['ngaybatdau']));?> - <?=date("d/m/Y", strtotime($row['ngayketthuc']));?></p>
                    <div style="text-align: right;" class="">
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php endforeach; ?>
    </div>
    
</div>

<?php
    include "./Views/HomeLayout/footer.php";
    echo "<title>Danh sách sản phẩm</title>";
?>