<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Slides</span>
    <span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../SanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Thêm mới
    </span>
    <hr>
    
    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
       
            <select class="form-control" name="loaiSlide" id="select-typeSlide">
                <option value="0">Chọn</option>
                <?php foreach($loai_slide as $row) : extract($row); ?>
                <option id="id_slide" value="<?=$row['ID'];?>"><?=$row['TenLoaiSlide'];?></option>
                <?php endforeach; ?>
            </select>
        <div style="display: none;" id="slide-typeProduct">
            <label class="h6">Loại sản phẩm</label> <br>
            <select class="form-select" name="idloaisanpham">
                <option value="0">Chọn</option>
                <?php 
                    if(!empty($result)):
                    foreach ($result as $row) : extract($row)?> 
                        <option value="<?php echo $row['ID']; ?>"><?php echo $row['TenLoaiSanPham']; ?></option>
                <?php endforeach; endif; ?>
            </select> <br>
       </div>
        

        <label class="h6">Hình ảnh</label> <br>
        <input type="file" id="file-upload" name="hinhanh[]" multiple><br>
        

        <hr>
        <?php if(is_array($error)) { foreach($error as $item) { ?>
            <p style="color: <?=$item['type'];?>"><?=$item['message'];?></p>
        <?php  }} ?>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../Slides/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
</div>
<script>
    document.querySelector("#select-typeSlide").onchange = () => {
        var a = document.querySelector('#select-typeSlide').value;
        if (a == 1) {
            document.getElementById('slide-typeProduct').style.display = "none";
        }
        if (a == 2) {
            if (document.getElementById('slide-typeProduct').style.display == "none") {
                document.getElementById('slide-typeProduct').style.display = "block";
            } else {
                document.getElementById('slide-typeProduct').style.display = "none";
            }       
        }
    }
</script>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<?php
    include "./Views/Layout/footer.php";
?>