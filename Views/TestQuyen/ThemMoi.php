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
        <label class="h6">Tên vai trò</label>
        <input type="text" value=""name="tenquyen" class="form-control"><br>
       
        <label class="h6">Chọn quyền cho vai trò</label>
        

        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
    </form>
</div>
<?php
    include "./Views/Layout/footer.php";
?>