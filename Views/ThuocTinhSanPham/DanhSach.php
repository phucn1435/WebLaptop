<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
?>
<style>
    .btn-primary:hover{
        transform: scale(1.2);
        transition: all .2s ease-in-out;
        margin-left: 10px;
    }
    
    .btn-find {
        width: 90px;
    }

    .return {
        text-align: right;
        margin: 10px 20px 0 0;
        display: block;
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Tin tức</span>
   
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a href="./DanhSach">Danh sách</a>
    </span>
</div> 

<hr>


<div class="col-md-12 mt-3">
    <form action="" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
                    <a href="../ThuocTinhSanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
            </div>
        </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên thuộc tính</th>
            <th>Giá trị</th>
            <th style="width: 17%;">Action</th>
        </tr>
        <?php 
        $i=0;
        if(!empty($result)) {
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
            } 
          
            foreach ($result as $row) : extract($row);$i++;?> 
            <tr>
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td>
                    <?= $i;?>
                </td>
                <td>
                    <?= $row['tenthuoctinh'] ?>
                </td>
                <td>
                    <?=str_replace("|", ",", $row['giatri']); ?>
                </td>
                
                <td>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../ThuocTinhSanPham/CapNhat&id=<?=$row['ID']?>">Cập nhật</a>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../ThuocTinhSanPham/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>  
    </table>
    </form>
</div>

<?php
        // include("Views/TinTuc/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tentintuc'])) {?>
        <a class="return" href="../TinTuc/DanhSach">Quay lại danh sách sản phẩm</a>
        <?php }?>
    
<?php
    include "./Views/Layout/footer.php";
?>
