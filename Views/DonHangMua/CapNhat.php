<?php
    include "./Views/Layout/header.php";
    echo "<title>Update dơn hàng mua</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Đơn hàng nhập</span>
    <span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../DonHangMua/DanhSach">Danh sách</a>
    </span>
   
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Cập nhật
    </span>
    <hr>
    <?php foreach ($dataUpdate as $row) : extract($row); ?>
    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tên nhân viên lập</label>
        <select name="idnhanvienlap" class="form-control">
                <?php if(!empty($ListNhanVien))
                    foreach ($ListNhanVien as $item) : extract($item)?>
                        <option <?php if($row['idNhanVienLap'] == $item['ID']) {echo "selected";} ?> value="<?= $item['ID']?>">
                            <?= $item['TenNhanVien']?>
                        </option>
                <?php endforeach;?>    
            </select><br>

        <label class="h6">Tên nguồn hàng</label>
        <select name="idnguonhang" class="form-control">
                <?php if(!empty($ListNguonHang))
                    foreach ($ListNguonHang as $itemNH) : extract($itemNH)?>
                        <option  <?php if($row['idNguonHang'] == $itemNH['ID']) {echo "selected";} ?> value="<?= $itemNH['ID']?>">
                            <?= $itemNH['TenNguonHang']?>
                        </option>
                <?php endforeach;?>    
            </select><br>

        <label class="h6">Tổng tiền</label>
        <input readonly type="text" value="<?= $row['TongTien']?>"name="tongtien" class="form-control"><br>
        <?php
                echo $alert ;
        ?>

        <hr>
        <input type="submit" value="Update" name="submit" class="btn btn-primary">
        <a href="../DonHangMua/DanhSach" class="btn btn-warning">Quay lại</a>

    </form>
    <?php endforeach;?>
</div>
<?php
    include "./Views/Layout/footer.php";
?>