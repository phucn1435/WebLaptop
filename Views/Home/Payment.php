<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>
<div class="container p-3">
    <?php if(isset($_SESSION['cart'])) { ?>
    <div class="row">
        <div class="col-md-8">
            <h5>Thông tin của bạn</h5>
            <ul>
                <?php foreach($thongtinkhachhang as $item) { ?>
                    <li>Họ và tên: <?=$item['hoten'];?> </li>
                    <li>Số điện thoại: <?= '0' .$item['SDT'];?> </li>
                    <li>Email: <?=$item['Email'];?> </li>
                    <li>Địa chỉ: <?=$item['cuthe'] .', '. $item['nameWard'] .', '. $item['nameDistrict'] .', '. $item['nameProvince'];?> </li>
                <?php } ?>
            <li>Ghi chú: <?=$_SESSION['cart']['ghi_chu'];?> </li>
            </ul>
            <h5 class="">Giỏ hàng của bạn</h5>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ;$tongcong = 0; $tt = 0;
                    foreach($test3 as $row) :extract($row);
                    ?>
                    
                    <tr>
                        <th scope="row"><?=++$i;?></th>
                        <td><?=$row['TenSanPham'];?></td>
                        <td><?=number_format($row['Gia'], 0, '.', '.') ;?>VND</td>
                        <td><?=$row['SoLuong1'];?></td>
                        <td><?=number_format($row['dongia'], 0, '.', '.') ;?>VND</td>
                        <td><?=number_format($row['ThanhTien'], 0, '.', '.') ;?>VND</td>
                        <?php $tt += $row['ThanhTien']; if($row['ThanhTienCoMaGiam'] != 0) {$tongcong += $row['ThanhTienCoMaGiam'] ;} else {$tongcong += $row['ThanhTien'];} ?>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 18px;">Tổng tạm tính</td>
                        <td></td>
                        <td></td>
                        <td><?=number_format($tt, 0, '.', '.') ;?>VND</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 18px;">Phí vận chuyển</td>
                        <td></td>
                        <td></td>
                        <?php print_r($_SESSION['cart']); ?>
                        <td><?=number_format($_SESSION['cart']['fee'], 0, '.', '.') ;?>VND</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 18px;">Mã giảm giá</td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul>
                                <?php foreach($test3 as $row) : extract($row); 
                                        if ($row['code_giam'] != "") { $mang = explode(",", $row['code_giam']); 
                                            for ($i = 0; $i < count($mang); $i++) { 
                                                if ($this->magiam->LuongGiam($mang[$i])[0]['ID_loai'] == 1) { $donvi = '%';} else { $donvi = 'VND'; }
                                        ?>
                                    <li style="text-align: left;"><span style="font-size: 14px; font-weight: bold;"><?=$mang[$i];?></span> -<?php echo $this->magiam->LuongGiam($mang[$i])[0]['luonggiam'] . $donvi; ?></li>
                                <?php } } endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    <?php if(!empty($phantramgiam)) { ?>
                    <tr>
                        <td style="text-align: center; font-weight: bold;" colspan="6">Giảm giá thêm <span style="color: red;"><?=$phantramgiam?>%</span> theo chính sách mặc định của cửa hàng khi sử dụng số điện thoại này.</td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 18px;">Thành tiền</td>
                        <td></td>
                        <td></td>
                        <?php $tongcong = $tongcong - ($tongcong * $phantramgiam / 100); if (isset($_SESSION['cart']['fee'])) {$tongcong = $tongcong - $_SESSION['cart']['fee'];}  ?>
                        <td><?=number_format($tongcong, 0, '.', '.') ;?>VND</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h5>Phương thức thanh toán</h5>
            <form action="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                <input class="btn btn-primary" style="width: 100%;" type="submit" name="tt_cash" value="Payment By Cash">
                <input class="btn btn-danger mt-2" style="width: 100%;" type="submit" name="tt_momo_qr" value="Payment By QR_Code">
                <input class="btn btn-danger mt-2" style="width: 100%;" type="submit" name="tt_momo_atm" value="Payment By ATM">
                <input class="btn btn-danger mt-2" style="width: 100%;" type="submit" name="tt_onepay" value="Payment By OnePay">
                <input class="btn btn-danger mt-2" style="width: 100%;" type="submit" name="redirect" value="Payment By VNPay">
                
                <input type="hidden" name="amount" value="<?=$tongcong;?>">
            </form>
        </div>
       
    </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="../TrangChu/Index" class="btn btn-primary">Mua sắm ngay</a>
            </div>
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
        // Sử dụng sự kiện 'popstate' để bắt sự kiện khi người dùng bấm nút "Back"
        window.onpopstate = function(event) {
            // Thực hiện các hành động mà bạn muốn khi người dùng quay lại trang trước
            alert('Bạn đã bấm nút "Back" để quay lại trang trước.');
            window.location.href = "../TrangChu/DatHang";
        };

        // Sử dụng sự kiện 'pushState' để tạo lịch sử trình duyệt
        function navigateToPage() {
            history.pushState({}, "", "newpage.php");
        }
    </script>

<?php include('./Views/HomeLayout/footer.php'); ?>
