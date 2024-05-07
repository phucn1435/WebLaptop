<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách đơn hàng bán</title>";
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
    .cancel{ 
        width: 100%;
        background: #e4ba00;
        padding-bottom: 40px;
        border-top: 5px solid yellow;
        border-radius: 5px;
        position: relative;
    }

    .title-cancel{
        position: absolute;
        left: 20px;
        font-weight: 600;
        bottom: 10px;
    }

    th, td {
        padding: 10px;
    }
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Đơn hàng bán</span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../DonHangBan/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Chi tiết
    </span>

</div>
<hr>
<!-- <div class="">
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
                    <button class="btn btn-danger">Import</button>
                    <button class="btn btn-success">Export</button>
                    <?php foreach ($resultDonHang as $row) : extract($row); ?>
                    <?php if($row['idTrangThai'] == 6) { ?>
                        <a href="#" class="btn btn-secondary" style="cursor: default; pointer-events: none" disabled>Thêm mới</a>
                    <?php  } else { ?>
                        <a  href="../ChiTietDonHangBan/ThemMoi&id=<?= $row['ID']?>" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="col-md-12 mt-3">
    <div style="text-transform: uppercase; font-weight: bold;" class="">Thông tin khách hàng</div>
    <?php $giamgia = 0; ?>
    <?php foreach ($resultDonHang as $row) : extract($row); ?>
    <?php if(in_array($row['ID'], $_SESSION['huydon'])) { echo "<p class='cancel'><span class='title-cancel'>Đơn hàng ".$row['ID']." đã bị hủy</span></p>"; }?>
    <table class="tableKH" style="margin: 10px 0 0 20px;">
        <tr>
            <th>Mã đơn hàng</th>
            <td style="color: red; font-weight: bold;"><?= $row['ID']?></td>
        </tr>
        <tr >
            <th>Ngày lập</th>
            <td><?= date('d-m-Y',strtotime($row['NgayLap']))?></td>
        </tr>
        <tr>
            <th>Tên khách hàng</th>
            <td><?= $row['TenKhachHang'];?></td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td style="letter-spacing: 0.05em;"><?= $row['SoDienThoai'];?></td>
        </tr>
        <tr>
            <th>Địa chỉ nhận hàng</th>
            <td><?=$row['cuthe'] .", ". $row['nameWard'] .", ". $row['nameDistrict'] .", ". $row['nameProvince']; ?></td>
        </tr>
        <tr>
            <th>Mã giảm giá đã áp dụng</th>
            <td>
                <ul>
                <?php $array_code = []; 
                foreach($result as $item) { 
                    $array_code1 = explode(",", $item['code_giam']);
                    foreach($array_code1 as $item1) {
                        $array_code[] = $item1;
                    }
                } 
                if (is_array(array_unique($array_code))) {
                    foreach(array_unique($array_code) as $item) { ?>
                        <li style="list-style: inside; color: red;"><?=$item;?></li>
                  <?php  }
                }
                ?>
                <li style="list-style: inside; color: red;"><?php if($row['giamgia'] != 0) { $giamgia = $row['giamgia']; echo "Giảm giá thêm $giamgia% theo chính sách mặc định của đơn hàng"; } ?></li>
                </ul>
            </td>
        </tr>
        
        <tr>
            <th>Tổng tiền</th>
            <td><?php $tong = number_format($row['TongTien'],0,'.', '.'); echo number_format($row['TongTien'],0,'.', '.')?> VND</td>
        </tr> 
        <tr>
            <form action="" method="POST">
                <th>Tình trạng đơn hàng</th>
                <td>
                    <select name="status" id="">
                        <option value=""><?=$row['TenTrangThai']?></option>
                        <?php foreach($danhsachdonhang as $row) : extract($row);?>
                            <option value="<?=$row['ID']?>">
                                <?=$row['TenTrangThai'];?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="updateStatus" value="Cập nhật">
                </td>
            </form>
        </tr>
    </table>
    
    <!-- <form action="" method="post">
    <?php if($row['TongTien'] > 0) { ?>
            <?php if($result10[0]['idTrangThai'] == 4 || $result10[0]['idTrangThai'] == 5) { ?>
                <input type="submit" value="Thanh toán" name="button1"></input>
            <?php }?>
            <?php 
                if($result10[0]['idTrangThai'] == 6) {
                    echo '<input type="submit" value="Hoàn trả" name="button2"></input>';
                } 
        ?>
        <?php } ?>
        <?php if(isset($_SESSION['hehe'])) {
            echo $_SESSION['hehe'];
        } ?>
      
        
    </form> -->
    <br>
    <?php endforeach;?>
    <!-- <a class="btn btn-primary" style="margin-bottom: 10px;"  href="../ChiTietDonHangBan/InDonHang&id=<?=$_GET['id']?>">In đơn hàng</a> -->
    <?php if(isset($_SESSION['nn'])){ ?>
        <span style="color: green;"><?=$_SESSION['nn']?></span>
    <?php } ?> 
    <table class="table table-condensed table-bordered">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá áp dụng</th>
            <th>Mã giảm giá</th>
            <th>Thành tiền</th>
            <th>Action</th>
        </tr>
        <?php 
        if(!empty($result)):
            $i = 0; $tt = 0;
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <?= $row['TenSanPham'] ?>
                </td>
                <td>
                    <?= $row['SoLuong']?>
                </td>
                <td>
                    <?= number_format($row['DonGiaApDung'],0,'.', '.') ?>
                </td>
                <td>
                    <?=$row['code_giam'];?>
                </td>
                <td>
                    <?= number_format($row['ThanhTien'],0,'.', '.') ?>
                    <?php $tt += $row['ThanhTien']; ?>
                </td>
                <td>
                <?php if ($this->model->TrangThaiChiTiet($_GET['id'])[0]['idTrangThai'] == 6) { ?>
                    <a href="#" style="cursor: default; pointer-events: none; color: gray" disabled>Cập nhật</a> | 
                    <a href="#" style="cursor: default; pointer-events: none; color: gray" disabled onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } else { ?>
                    <a href="../ChiTietDonHangBan/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> | 
                    <a href="../ChiTietDonHangBan/Xoa&id=<?=$row['idDonHangBan']?>&act=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            <tr>
                <td style="text-align: center; font-weight: bold;" colspan="6">Sau khi áp dụng các mã giảm giá trên</td>
            </tr>
            <tr>
                <td colspan="5">Phí vận chuyển</td>
                <td>- <?=number_format($row['phivanchuyen'],0,'.', '.');?></td>
            </tr>
            <tr style="text-align: center;">
                <td style="font-weight: bold;" colspan="4">Tổng tiền</td>
                <td colspan="2"><?=number_format($tt - ($tt * $giamgia / 100) - $row['phivanchuyen'],0,'.', '.');?> VND</td> 
            </tr>
    </table>
</div>


<?php
        // include("Views/ChiTietDonHangBan/PhanTrang.php");
    ?>
        <?php if(isset($_GET['id'])) {?>
        <a class="return" href="../DonHangBan/DanhSach">Quay lại danh sách đơn hàng bán</a>
        <?php }?> 
  
<?php
    include "./Views/Layout/footer.php";
?>