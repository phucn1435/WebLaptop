<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm nhân viên</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Cập nhật trạng thái sản phẩm</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../TrangThaiSanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Cập nhật
    </span>
    
    <hr>
    <?php foreach($dataUpdate as $row) : extract($row); ?>
    <form method="post" class="form-group col-md-7" style="margin: auto;">
        <label class="h6">Tên trạng thái</label>
        <input type="text" value="<?=$row['TenTrangThai'];?>" name="tentrangthai" class="form-control"><br>
       
        <label class="h6">Trạng thái hoạt động</label>
        <select class="form-select" name="trangthai">
            <option <?php if ($row['trangthai'] == 0) {echo "selected";} ?> value="0">Không hoạt động</option>
            <option <?php if ($row['trangthai'] == 1) {echo "selected";} ?> value="1">Hoạt động</option>
        </select>

        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../TrangThaiSanPham/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
    <?php endforeach;  ?>
</div>
<?php
    include "./Views/Layout/footer.php";
?>