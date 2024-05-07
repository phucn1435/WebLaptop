<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
    echo "<title>Danh sách loại sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Loại Quyền</span>
    
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a href="./DanhSach">Danh sách</a>
    </span>
</div>

<div class="">
    <div class="row">
        <div style="color: blue;" class="col-sm-12">
            <i class="fa-solid fa-filter"></i> Filter
        </div>
        <form action="" method="get">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID loại quyền, tên loại quyền,...">
                    </div>
                    <div class="col-sm-12 text-center mt-3">
                        <input type="submit" class="btn btn-primary" value="Lọc kết quả">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>

<div class="col-md-12 mt-3">
<form action="" method="POST">

<div class="row">
        <div class="col-sm-6">
            <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
        </div>
        <div style="text-align: right;" class="col-sm-6">
        <?php if(check('LoaiQuyen/ThemMoi') == true) { ?>
                <a href="../LoaiQuyen/ThemMoi" class="btn btn-primary">Thêm mới</a>
                <?php } ?>
        </div>
    </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên loại quyền</th>
            <th>Action</th>
        </tr>
        <?php 
        $i = 0;
        if(!empty($result)) {
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
        } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr>
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i ?></td>
                <td>
                    <?= $row['tenquyen'] ?>
                </td>
                <td>
                    <?php if(check('LoaiQuyen/CapNhat&id=123')) {  ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../LoaiQuyen/CapNhat&id=<?=$row['ID']?>">Cập nhật</a>
                    <?php } ?>

                    <?php if(check('LoaiQuyen/Xoa&id=123')) {  ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../LoaiQuyen/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>  
    </table>
</div>
<?php
        include("Views/LoaiQuyen/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tenquyen'])) {?>
        <a class="return" href="../LoaiQuyen/DanhSach">Quay lại danh sách loại quyền</a>
        <?php }?>
    
<?php
    include "./Views/Layout/footer.php";
?>