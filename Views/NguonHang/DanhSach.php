<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách đơn hàng mua</title>";
    include("Controllers/KiemTraQuyen.php");

?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Nguồn hàng</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a href="./DanhSach">Danh Sách</a>
    </span>

</div>
<div class="row">
        <div style="color: blue;" class="col-sm-12">
            <i class="fa-solid fa-filter"></i> Filter
        </div>
        <form action="" method="get">
            <div class="col-sm-12">
            <!-- $tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon -->
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID nguồn hàng, tên nguồn hàng, email,...">
                    </div>
                    
                    <div class="col-sm-7">
                        <div class="" style="display: flex; justify-content: center; align-items: center;">
                            <div class="col-sm-3 text-center" style="border: 1px solid #ccc; background: #fff; border-radius: 7px; padding: 5px;">Lọc theo ngày: </div>
                            <div class="col-sm-6 text-left" style="display: flex; justify-content: space-around; align-items: center;">
                                <div class="">
                                    <input name="from_date" id="ngaybatdau" value="<?php if(isset($_GET['from_date'])) {echo $_GET['from_date'];} ?>" onchange="validateDate()" type="date" class="form-control">
                                </div>
                                <div class=""> - </div>
                                <div class="">
                                    <input name="to_date" id="ngayketthuc" value="<?php if(isset($_GET['to_date'])) {echo $_GET['to_date'];} ?>" onchange="validateDate()" type="date" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center mt-3">
                        <input type="submit" class="btn btn-primary" value="Lọc kết quả">
                    </div>
                </div>
            </div>
        </form>
    </div>
<hr>

<div class="col-md-12 mt-3">
<form action="" method="POST">
        <!-- <input type="submit" value="Excel" name="excel"> -->
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
            <?php if(check('SanPham/ThemMoi') == true) { ?>
                    <a href="../LoaiSanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th>STT</th>
            <th>Tên nguồn hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo</th>
            <th>Người đại diện</th>
            <th style="width: 20%;">Action</th>
        </tr>
        <?php 
        if(!empty($result)) {
            $i = 0;
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
            } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr class="text-center">
                <td><?= $i ?></td>
                <td>
                    <?= $row['TenNguonHang'] ?>
                </td>
                <td>
                    <?= $row['SoDienThoai'] ?>
                </td>
                <td>
                    <?= $row['Email'] ?>
                </td>
                <td>
                    <?= $row['DiaChi'] ?>
                </td>
                <td>
                    <?= $row['created_at'] ?>
                </td>
                <td>
                    <?= $row['NguoiDaiDien'] ?>
                </td>
                <td style="">
                    <?php if(check('NguonHang/CapNhat&id=123')) {  ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../NguonHang/CapNhat&id=<?=$row['ID']?>">Cập nhật</a>
                    <?php } ?>

                    <?php if(check('NguonHang/Xoa&id=123')) {  ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../NguonHang/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } ?>
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
        include("Views/NguonHang/PhanTrang.php");
    ?>
        <?php if(isset($_GET['id'])) {?>
        <a class="return" href="../NguonHang/DanhSach">Quay lại danh sách nguồn hàng</a>
        <?php }?>
<?php
    include "./Views/Layout/footer.php";
?>