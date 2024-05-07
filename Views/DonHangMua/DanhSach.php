<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách đơn hàng mua</title>";
    include("Controllers/KiemTraQuyen.php");
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<style>
     .slider-value-top {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-size: 12px;
    background-color: #007bff;
    padding: 5px 8px;
    border-radius: 4px;
}   
    #price-range-slider {
        width: 80%;
        margin: 20px auto;
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
    <span class="h3 m-2">Đơn hàng nhập</span>
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
            <!-- $tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon -->
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID mã hóa đơn,...">
                    </div>
                    <div class="col-sm-3">
                        <select name="id_nguonhang" class="form-select" id="">
                            <option value="">Lọc theo nguồn hàng cung cấp</option>
                            <?php foreach($ListNguonHang as $item) { ?>
                            <option <?php if (isset($_GET['id_nguonhang']) && $_GET['id_nguonhang'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenNguonHang']; ?></option>   
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="id_TTHD" class="form-select" id="">
                            <option value="">Lọc theo trạng thái hóa đơn</option>
                            <?php foreach($ListTrangThai as $item) { ?>
                                <option <?php if (isset($_GET['id_TTHD']) && $_GET['id_TTHD'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenTrangThai'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="id_NVL" class="form-select" id="">
                            <option value="">Lọc theo nhân viên lập</option>
                            <?php foreach($ListNhanVien as $item) { ?>
                                <option <?php if (isset($_GET['id_NVL']) && $_GET['id_NVL'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenNhanVien'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-5 text-left mt-2">
                        <div class="" style="display: flex; justify-content: space-around; align-items: center;">
                            <div class="col-sm-4 text-center" style="border: 1px solid #ccc; background: #fff; border-radius: 7px; padding: 5px;">Lọc theo giá bill: </div>
                            <div class="col-sm-7 text-left"><div id="price-range-slider"></div></div>
                        </div>
                        <input type="hidden" id="price-min" name="price_min">  <input type="hidden" name="price_max" id="price-max"></p>
                    </div>
                    <div class="col-sm-7 mt-3">
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
                    <div class="col-sm-12 text-center">
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
            <input type="submit" onclick="return confirm('Xác nhận xóa !');" name="delete" value="Delete" class="btn btn-danger">
        </div>
        <div style="text-align: right;" class="col-sm-6">
        <?php if(check('DonHangMua/ThemMoi') == true) { ?>
                <a href="../DonHangMua/ThemMoi" class="btn btn-primary">Thêm mới</a>
                <?php } ?>
        </div>
    </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Mã hóa đơn</th>
            <th>Tên Nguồn Hàng</th>
            <th>Ngày lập</th>
            <th>Tổng tiền</th>
            <th>Người lập phiếu</th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
        <?php 
          $i=0;
          $color = "";
          if(!empty($result)) {
              if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                  $i = ($current * $item1) - $item1;
              } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <?php if ($row['idTrangThai'] == 1) {$color = "#aba9a9";} elseif ($row['idTrangThai'] == 2) {$color = "green";} else {$color = "#bcbc0b";} ?>
            <tr>
            <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>

            <td><?= $i ?></td>
                <td><?= $row['ID'] ?></td>
                <td>
                    <?= $row['TenNguonHang'] ?>
                </td>
                <td>
                    <?= date('d-m-Y',strtotime($row['created_at'])) ?>
                </td>
                <td>
                    <?= number_format($row['TongTien'],0,'.', '.') ?>
                </td>
                <td>
                    <?= $row['TenNhanVien'] ?>
                </td>
                <td>
                    <span style="padding: 7px 5px; font-size: 14px; background: <?=$color;?>; color: #fff; border-radius: 5px;"><?= $row['TenTrangThai']; ?></span>
                </td>
                <td>
                    <a style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="../ChiTietDonHangMua/DanhSach&id=<?=$row['ID']?>">Chi tiết</a> 
                    <?php if(check('DonHangMua/CapNhat&id=123')) { ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../DonHangMua/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> 
                    <?php } ?>

                    <?php if(check('DonHangMua/Xoa&id=123')) { ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../DonHangMua/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
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
        include("Views/DonHangMua/PhanTrang.php");
    ?>
        <?php if(isset($_GET['id'])) {?>
        <a class="return" href="../DonHangMua/DanhSach">Quay lại danh sách đơn hàng mua</a>
        <?php }?>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
        <script>
            $( function() {
                var priceMin = $( "#price-min" );
                var priceMax = $( "#price-max" );
                $( "#price-range-slider" ).slider({
                    range: true,
                    min: <?=$this->model->GiaThapNhat()[0]['TongTienThapNhat'];?>,
                    max: <?=$this->model->GiaCaoNhat()[0]['TongTienCaoNhat'];?>,
                    step: 1000000,
                    values: [<?php if (isset($_GET['price_min'])) {echo $_GET['price_min'];} else { echo (int)$this->model->GiaThapNhat()[0]['TongTienThapNhat'];}?>, <?php if (isset($_GET['price_max'])) {echo $_GET['price_max'];} else { echo (int)$this->model->GiaCaoNhat()[0]['TongTienCaoNhat'];}?> ], // Giá trị mặc định cho thanh trượt
                    create: function(event, ui) {
                        var handles = $(this).find('.ui-slider-handle');
                        var values = $(this).slider("option", "values");
                        $(handles[0]).append('<div class="slider-value-top">' + values[0] + '</div>');
                        $(handles[1]).append('<div class="slider-value-top">' + values[1] + '</div>');
                    },
                    slide: function( event, ui ) {
                        if (ui.values[0] >= ui.values[1]) {
                            return false; // Ngăn kéo nếu giá trị min >= max
                        }
                        priceMin.val(ui.values[0]);
                        priceMax.val(ui.values[1]);
                        var handles = $(this).find('.ui-slider-handle');
                        $(handles[0]).find('.slider-value-top').text(ui.values[0]);
                        $(handles[1]).find('.slider-value-top').text(ui.values[1]);
                        $( "#price-min" ).val( ui.values[ 0 ] );
                        $( "#price-max" ).val( ui.values[ 1 ] );
                    }
                });
            // Hiển thị giá trị mặc định
            $( "#price-min" ).val( $( "#price-range-slider" ).slider( "values", 0 ) );
            $( "#price-max" ).val( $( "#price-range-slider" ).slider( "values", 1 ) );
        });
        </script>
<?php
    include "./Views/Layout/footer.php";
?>