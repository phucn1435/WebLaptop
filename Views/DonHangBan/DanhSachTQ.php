<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách đơn hàng bán</title>";
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
        /* margin: 20px auto; */
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
    <span class="h3 m-2">Đơn hàng bán</span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Danh sách
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
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID mã hóa đơn, ID khách hàng, tên khách hàng,...">
                    </div>
                    
                    <div class="col-sm-3">
                        <select name="id_TTHD" class="form-select" id="">
                            <option value="">Lọc theo trạng thái hóa đơn</option>
                            <?php foreach($trangthaiban as $item) { ?>
                                <option <?php if (isset($_GET['id_TTHD']) && $_GET['id_TTHD'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenTrangThai'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-5 text-left mt">
                        <div class="" style="display: flex; justify-content: space-around; align-items: center;">
                            <div class="col-sm-4 text-center" style="border: 1px solid #ccc; background: #fff; border-radius: 7px; padding: 5px;">Lọc theo giá bill: </div>
                            <div class="col-sm-7 text-left"><div id="price-range-slider"></div></div>
                        </div>
                        <input type="hidden" id="price-min" name="price_min">  <input type="hidden" name="price_max" id="price-max"></p>
                    </div>
                    <div class="col-sm-7 text-left mt-2">
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
                    <div class="col-sm-12 text-center mt-2">
                        <input type="submit" class="btn btn-primary" value="Lọc kết quả">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div style="float: right;">
                    <?php if(check('DonHangBan/ThemMoi')) { ?>
                    <a href="../DonHangBan/ThemMoi" class="btn btn-primary">Tạo đơn hàng</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST">
<div id="duyet_nhanh" class="" style="position: fixed; bottom: 0; left: 50%; z-index: 10; border: 3px solid #ccc; border-radius: 7px;box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
    <div style="padding: 10px;" class="">
        <input onclick="return confirm('Bạn muốn duyệt tất cả đơn bạn đã chọn?');" type="submit" name="duyet_nhanh" class="btn btn-primary" value="Duyệt đơn">
        <input onclick="return confirm('Bạn muốn hủy tất cả đơn bạn đã chọn?');" type="submit" name="huy_nhanh" class="btn btn-danger" value="Hủy đơn" style="margin-left: 10px;">
        <button style="margin-left: 40px;" id="cancle" class="btn btn-warning">Cancel</button>
    </div>
</div>
<div class="col-md-12 mt-3">
    <table class="table table-condensed table-bordered">
    <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
        <tr style="background-color: whitesmoke; color: black; text-align: center;" class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Mã hóa đơn</th>
            <th>Tên Khách hàng</th>
            <th>Ngày lập</th>
            <th>Tổng tiền</th>
            <th>Người lập phiếu</th>
            <th>Trạng thái</th>
            <th>Action</th> 
        </tr>
        <?php 
        $i = 0;
        if(!empty($result)) {
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
            } 
            $tong = 0;
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr style="text-align: center; background: <?php if($i % 2 != 0) { echo "#ccc";}?>">
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i; ?></td>
                <td><?= $row['ID'] ?></td>
                <td>
                <a style="color: black;" href="../KhachHang/DanhSach&id=<?=$row['idKhachHang']?>"><?= $row['TenKhachHang'] ?></a></td>
                <td>
                <?= date('d-m-Y',strtotime($row['NgayLap']))?>
                </td>
                
                <td>
                <?=number_format($row['TongTien'],0,'.', '.'); ?>
                </td>
                <td>
                    <?= $row['TenNhanVien'] ?>
                </td>
                <td style="">
                    <span style="display: inline-block; padding: 2px 5px; font-weight: 550; font-size: 14px; color: #fff; border-radius: 7px; background: <?php if($row['idTrangThai'] == 4) {echo "red";} else {echo "green";}?>">
                        <?=$row['TenTrangThai']?> 
                    </span>
                </td>
                <td>
                    <a style="padding: 7px 5px; font-size: 14px; background: #25539e ; color: #fff; border-radius: 5px;" href="../ChiTietDonHangBan/DanhSachTQ&id=<?=$row['ID_ordersTQ']?>">Chi tiết</a> 
                    <!-- <?php if(check('../DonHangBan/CapNhat&id='.$row['ID'])) { ?>
                    <a href="../DonHangBan/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> | 
                    <?php } ?> -->

                    <!-- <?php if(check('../DonHangBan/Xoa&id='.$row['ID'])) { ?>
                    <a href="../DonHangBan/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    <?php } ?> -->
                    <a style="padding: 7px 10px; font-size: 14px; background: #717171 ; color: #fff; border-radius: 5px;" target="_blank" href="../DonHangBan/InDonHang&id=<?=$row['ID']?>">In</a>
                </td>
                
            </tr>   
            <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>
    </table>
</div>
</form>
<?php
    include("Views/DonHangBan/PhanTrang.php");
    include "./Views/Layout/footer.php";
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script>

$( function() {
                var priceMin = $( "#price-min" );
                var priceMax = $( "#price-max" );
                $( "#price-range-slider" ).slider({
                    range: true,
                    min: <?=$this->model->Gia()[0]['TongTienThapNhat'];?>, 
                    max: <?=$this->model->Gia()[0]['TongTienCaoNhat'];?>,
                    step: 1000000,
                    values: [<?php if (isset($_GET['price_min'])) {echo $_GET['price_min'];} else { echo $this->model->Gia()[0]['TongTienThapNhat'];}?>, <?php if (isset($_GET['price_max'])) {echo $_GET['price_max'];} else { echo $this->model->Gia()[0]['TongTienCaoNhat'];}?>], // Giá trị mặc định cho thanh trượt
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
                        $( "#price-min" ).val( ui.values[0] );
                        $( "#price-max" ).val( ui.values[1] );
                    }
                });
            // Hiển thị giá trị mặc định
            $( "#price-min" ).val( $( "#price-range-slider" ).slider( "values", 0 ) );
            $( "#price-max" ).val( $( "#price-range-slider" ).slider( "values", 1 ) );
        });

</script>
<script>
    function autoFillID($value,$replace) {
  var selectedOption = document.getElementById("haiz1").value;
  var idInput = document.getElementById("haiz");
  
  // Tùy chỉnh quy tắc để tự động điền ID dựa trên option đã chọn
  if (selectedOption === $value) {
    idInput.value = $replace;
  }
}
</script>

<script>
  function redirect(selectElement) {
    var selectedValue = selectElement.value;
    window.location.href = selectedValue;
    }
</script>

<script>
     document.addEventListener('DOMContentLoaded', function(){
var checkboxAll = $('#checkboxAll');
var checkbox = $('.checkbox1');
// console.log(checkbox);
checkboxAll.change(function(){
var isChecked = $(this).prop('checked');
if (isChecked) {
    $('#duyet_nhanh').css('display', 'block');
} else {
    $('#duyet_nhanh').css('display', 'none');
}
checkbox.prop('checked', isChecked);
})

// console.log(checkbox);
checkbox.change(function(){

var isChecked = checkbox.length === $('.checkbox1:checked').length;
// console.log(isChecked);
if ($('.checkbox1:checked').length == 0) {
    $('#duyet_nhanh').css('display', 'none');
} else {
    $('#duyet_nhanh').css('display', 'block');
}
checkboxAll.prop('checked', isChecked);
})
}) 
</script>
<script>
    $(document).ready(function() {
        $('#cancle').on('click',(e)=> {
            e.preventDefault();
            $("#duyet_nhanh").css('display','none');
        }); 
    });
</script>



