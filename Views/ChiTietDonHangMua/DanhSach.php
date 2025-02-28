<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách đơn hàng mua</title>";
    include("Controllers/KiemTraQuyen.php");
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
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Đơn hàng nhập</span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../DonHangMua/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Chi tiết
    </span>

</div>
<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="" class="form-control" placeholder="Nhập sản phẩm..." >
                    </div>
                    <div class="col-md-4" style="padding:0;margin-left:-7px;">
                        <button class="btn btn-primary">Tìm</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div style="float: right;">
                    <?php if($resultDonHang[0]['idTrangThai'] != 2) {  if (check("ChiTietDonHangMua/ThemMoi&id=123") == true) { ?>
                    <a href="../ChiTietDonHangMua/ThemMoi&id=<?=$_GET['id'];?>" class="btn btn-primary">Thêm mới</a>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mt-3">
    <?php foreach ($resultDonHang as $row) : extract($row); ?>
    <table>
        <tr>
            <th>Ngày lập:</th>
            <td><?= date('d-m-Y',strtotime($row['created_at']))?></td>
        </tr>
        <tr>
            <th>Mã đơn hàng:</th>
            <td><?= $row['ID']?></td>
        </tr>
        <tr>
            <th>Nguồn Hàng:</th>
            <td><?= $row['TenNguonHang']?></td>
        </tr>
        <tr>
            <th>Tổng tiền:</th>
            <td><?= number_format($row['TongTien'],0,'.', '.')?></td>
        </tr>
    </table>
    <form action="" method="post">
        <?php 
            if((int)$row['TongTien'] > 0 && $row['idTrangThai'] == 3) { ?>
                <input type="submit" value="Xác nhận đơn hàng mua" name="button1"></input>
        <?php } ?>
        <?php 
            if($row['idTrangThai'] == 2) {
                echo '<input type="submit" value="Đã xác nhận" name="button2" disabled></input>';
            } ?>
    </form> 
    <br>
    <?php endforeach;?>
    <table class="table table-condensed table-bordered">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá áp dụng</th>
            <th>Thành tiền</th>
            <?php if($resultDonHang[0]['idTrangThai']!=2) { ?>
            <th>Action</th>
            <?php } ?>
        </tr>
        <?php 
        if(!empty($result)):
            $i = 0;
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr>
                <td><?= $i ?></td>
                <td>
                    <?= $row['TenSanPham'] ?>
                </td>
                <td>
                    <?= $row['SoLuong'] ?>
                </td>
                <td>
                    <?= number_format($row['DonGiaApDung'],0,'.', '.') ?>
                </td>
                <td>
                    <?= number_format($row['ThanhTien'],0,'.', '.') ?>
                </td>
                <?php if($resultDonHang[0]['idTrangThai']!=2) { ?>
                <td>  
                    <a href="../ChiTietDonHangMua/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> | 
                    <a href="../ChiTietDonHangMua/Xoa&id=<?=$row['idDonHangMua']?>&act=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>  
                </td>
                <?php } ?>
            </tr>
            <?php endforeach; endif; ?>
    </table>
</div>
<?php
        include("Views/ChiTietDonHangMua/PhanTrang.php");
    ?>
        <?php if(isset($_GET['id'])) {?>
        <a class="btn btn-warning" style="float: right;" href="../DonHangMua/DanhSach">Quay lại</a>
        <?php }?>
<?php
    include "./Views/Layout/footer.php";
?>