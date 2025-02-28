<?php
    include "./Views/Layout/header.php";
    echo "<title>Update Sản Phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Loại Sản Phẩm</span>
    <span>
        <a href="../SanPham/DanhSach">Danh sách</a>
    </span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    <span>
        Cập nhật hình ảnh
    </span>
    <hr>
    <?php if(!empty($dataUpdate)):
        foreach ($dataUpdate as $row):extract($row);?>
        <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
            <label class="h6">Cập nhật Hình ảnh (<?=$row['TenLoaiSanPham']?>)</label><br>
            <img src="../Assets/data/HinhAnhLoaiSanPham/<?= $row['hinhanh'] ?>" alt="TAP" height="200px" width="200px"> <br> <br>
            <input type="file" name="hinhanh">
            <hr>
            <input type="submit" value="Update" name="submit" class="btn btn-primary">
            <a href="../LoaiSanPham/DanhSach" class="btn btn-warning">Quay lại</a>
        </form>
    <?php endforeach; endif; ?>
</div>

<?php
    include "./Views/Layout/footer.php";
?>