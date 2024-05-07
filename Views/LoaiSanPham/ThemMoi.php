<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm mới loại sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Loại sản phẩm</span>
    <span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../LoaiSanPham/DanhSach">Danh sách</a>
    </span>
    
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Thêm mới
    </span>
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tên loại sản phẩm</label>
        <input type="text" value="" name="tenloaisanpham" class="form-control"><br>
        <input type="file" name="hinhanh" class="form-control" id=""> <br>
        <select name="trangthai" class="form-select" id="">
            <option value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
        </select>
        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../LoaiSanPham/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
</div>
<?php
    include "./Views/Layout/footer.php";
?>