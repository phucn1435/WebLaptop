<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
    echo "<title>Danh sách sản phẩm</title>";
?>
<style>
    
    .return {
        text-align: right;
        margin: 10px 20px 0 0;
        display: block;
        font-weight: bold;
        font-size: 18px;
    }
</style>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Hàng tồn kho</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Danh sách
    </span>

</div>
<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <form method="get" class="row">
                    <div class="col-md-8">
                        <input type="text" name="tensanpham" class="form-control" placeholder="Nhập tên sản phẩm..." >
                    </div>
                    <div class="col-md-4" style="padding:0;margin-left:-7px;">
                        <button class="btn btn-primary">Tìm</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div style="float: right;">
                <form action="" method="POST">
                    <button class="btn btn-danger">Import</button>
                    <button type="submit" name="export" class="btn btn-success">Export</button>
                    <?php if(check('../SanPham/ThemMoi')) {?>
                    <a href="../HangTon/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3">
    <form action="" method="POST">
        <input type="submit" value="Excel" name="excel">
    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
    <table class="table table-condensed table-bordered">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giá khuyến mãi</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Action</th>
        </tr>
        <?php 
            $i = 0;
            if(!empty($result)):
                if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['tensanpham'])) {
                    $i = ($current * $item) - $item;
            } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr>
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i ?></td>
                
                <td>
                    <?= $row['TenSanPham'] ?>
                </td>

                <td>
                    <?= $row['TenLoaiSanPham'] ?>
                </td>
            
                <td>
                    <?= $row['Gia'] ?>
                </td>
                
                <td>
                    <?=$row['GiaKhuyenMai']?>
                </td>

                <td>
                    <?php if($row['SoLuong'] == 0) { ?>
                        <span style="color: red;">Hết hàng.</span>
                        <?php } else { ?>
                        <?=$row['SoLuong']?>
                            <?php } ?>
                </td>
                
                <td>
                    <a href="../SanPham/CapNhatHinhAnh&id=<?=$row['ID']?>">
                        <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="TAP" height="50px" width="50px" >
                    </a>
                </td>
                
                <td>
                    <a href="../SanPham/ChiTiet&id=<?=$row['ID']?>">Chi tiết</a> | 
                
                    <?php if(check('../SanPham/CapNhat&id='.$row['ID'])) { ?>
                    <a href="../SanPham/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> | 
                    <?php } ?>

                    <?php if(check('../SanPham/Xoa&id='.$row["ID"])) {?>
                    <a href="../SanPham/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } ?>
                </td>
                
            </tr>
            <?php endforeach; endif; ?>
    </table>
    </form>
</div>
<?php
        include("Views/SanPham/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tensanpham'])) {?>
        <a class="return" href="../SanPham/DanhSach">Quay lại danh sách sản phẩm</a>
        <?php }?>
    
<script>
    document.addEventListener('DOMContentLoaded', function(){
var checkboxAll = $('#checkboxAll');
var checkbox = $('.checkbox1');
// console.log(checkbox);
checkboxAll.change(function(){
var isChecked = $(this).prop('checked');
checkbox.prop('checked', isChecked);
})

// console.log(checkbox);
checkbox.change(function(){
var isChecked = checkbox.length === $('.checkbox1:checked').length;
// console.log(isChecked);
checkboxAll.prop('checked', isChecked);
})
}) 
</script>
<?php
    include "./Views/Layout/footer.php";
?>
