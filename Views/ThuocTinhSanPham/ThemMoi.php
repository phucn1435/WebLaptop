<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Thuộc tính sản phẩm</span>
    <span>
        <a class="title-non_active" href="../ThuocTinhSanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Thêm mới
    </span>
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;">
        <label class="h6">Tên thuộc tính sản phẩm</label>
        <input type="text" name="tenthuoctinh" class="form-control">
        <br>
        <label class="h6">Giá trị</label> <br>
        <textarea name="giatri" class="w-100" id="" cols="30" rows="5"></textarea>
        
        <hr>
        <?php if(isset($output)) { ?>
            <p class="text-center" style="color: red; font-size: 14px;"><?=$output;?></p>
        <?php } ?>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../ThuocTinhSanPham/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
</div>

<?php
    include "./Views/Layout/footer.php";
?>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script> 
        CKEDITOR.replace('noidung');
        // CKEDITOR.config.filebrowserImageUploadUrl = '{!! route('uploadPhoto').'?_token='.csrf_token() !!}';
</script>