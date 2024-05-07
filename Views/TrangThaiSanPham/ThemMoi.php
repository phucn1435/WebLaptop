<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm nhân viên</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Thêm trạng thái sản phẩm</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../TrangThaiSanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Thêm mới
    </span>
    
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tên trạng thái</label>
        <input type="text" value="" name="tentrangthai" class="form-control"><br>
       
        <label class="h6">Hình ảnh</label>
        <input type="file" name="hinhanh" class="form-control" id=""> <br>
        <label class="h6">Trạng thái hoạt động</label>
        <select class="form-select" name="trangthai">
            <option value="0">Không hoạt động</option>
            <option value="1">Hoạt động</option>
        </select>

        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../TrangThaiSanPham/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
</div>
<?php
    include "./Views/Layout/footer.php";
?>