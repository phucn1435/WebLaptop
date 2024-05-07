<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
    echo "<title>Danh sách sản phẩm</title>";
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

    .row-sp:hover {
        background: #ccc;
    }
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Sản Phẩm</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Danh sách
    </span>

</div>
<hr>
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
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID sản phẩm, tên sản phẩm,...">
                    </div>
                    <div class="col-sm-3">
                        <select name="id_danhmuc" class="form-select" id="">
                            <option value="">Lọc theo danh mục sản phẩm</option>
                            <?php foreach($loaisanpham as $item) { ?>
                            <option <?php if (isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenLoaiSanPham']; ?></option>   
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="id_TTLSP" class="form-select" id="">
                            <option value="">Lọc theo trạng thái sản phẩm</option>
                            <?php foreach($trangthaisanpham as $item) { ?>
                                <option <?php if (isset($_GET['id_TTLSP']) && $_GET['id_TTLSP'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenTrangThai'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="trangthai" class="form-select" id="">
                            <option value="">Điều kiện</option>
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 0) { echo "selected"; } ?>  value="0">Chưa kích hoạt</option>
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 1) { echo "selected"; } ?> value="1">Kích hoạt</option>
                        </select>
                    </div>
                    <div class="col-sm-5 text-left mt-2">
                        <div class="" style="display: flex; justify-content: space-around; align-items: center;">
                            <div class="col-sm-4 text-center" style="border: 1px solid #ccc; background: #fff; border-radius: 7px; padding: 5px;">Lọc theo khoảng giá: </div>
                            <div class="col-sm-7 text-left"><div id="price-range-slider"></div></div>
                        </div>
                        <input type="hidden" id="price-min" name="price_min">  <input type="hidden" name="price_max" id="price-max"></p>
                    </div>
                    <div class="col-sm-7 mt-2">
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
<div class="col-md-12 col-sm-12 mt-3">
    <form action="" method="POST">
        <!-- <input type="submit" value="Excel" name="excel"> -->
        <div class="row">
            <div class="col-sm-6">
                <input type="submit" name="delete" onclick="return confirm('Xác nhận xóa !');" value="Delete" class="btn btn-danger">
            </div>
          
            <div style="text-align: right;" class="col-sm-6">
            <input type="submit" class="btn btn-info" name="export_excel" value="Export">
            <?php if(check('SanPham/ThemMoi') == true) { ?>
                    <a href="../SanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
    <table class="table table-condensed table-bordered">
        <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giá khuyến mãi</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Kích hoạt</th>
            <th>Thao tác</th>
        </tr>
        <?php 
            $i = 0;
            if(!empty($result)){
                if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['tensanpham'])) {
                    $i = ($current * $item1) - $item1;
            } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr class="row-sp text-center">
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i ?></td>
                
                <td>
                    <?= $row['TenSanPham'] ?>
                </td>

                <td>
                    <?= $row['TenLoaiSanPham'] ?>
                </td>
            
                <td>
                    <?= number_format($row['Gia'], 0, '.', '.') ?> đ
                </td>
                
                <td>
                    <?=number_format($row['GiaKhuyenMai'], 0, '.', '.')?> đ
                </td>

                <td>
                    <?php if($row['SoLuong'] == 0) { ?>
                        <span style="color: red;">Hết hàng.</span>
                        <?php } elseif ($row['SoLuong'] < 5) { ?>  
                        <?=$row['SoLuong'];?><span style="color: red;"> ( Số lượng khá ít )</span>
                        <?php } else { ?>
                        <?=$row['SoLuong']?>
                            <?php } ?>
                </td>
                
                <td>
                    <a href="../SanPham/CapNhatHinhAnh&id=<?=$row['ID']?>">
                        <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="TAP" height="50px" width="50px" >
                    </a>
                </td>
                <td style="text-align: center;">
                    <?php if($row['trangthai'] == 0) {  ?>
                        <i style="color: red; font-size: 18px;" class="fa-solid fa-circle-xmark"></i>
                    <?php } else { ?>
                        <i style="color: green; font-size: 18px;" class="fa-solid fa-circle-check"></i>
                    <?php } ?>
                </td>
                <?php if(isset($_SESSION['number_notice_admin'])) {echo $_SESSION['number_notice_admin'];} ?>
                
                <td style="text-align: center;">
                    <div class="row text-left">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-5">
                                    <a style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="../SanPham/ChiTiet&id=<?=$row['ID']?>">
                                        <i class="fa-solid fa-eye"></i> Chi tiết
                                    </a> 
                                </div>
                                <?php if(check('SanPham/CapNhat&id=123') == true) { ?>
                                <div class="col-sm-6"> 
                                    <a style="padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../SanPham/CapNhat&id=<?=$row['ID']?>">
                                        <i class="fa-solid fa-pen-to-square"></i> Cập nhật
                                    </a>     
                                </div>
                                <?php } ?>
                                <?php if(check('SanPham/Xoa&id=123') == true) {?>
                                <div class="col-sm-4 mt-2">
                                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../SanPham/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </a>   
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </td>
                
            </tr>
            <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>
    </table>
    </form>
    <?php include("Views/SanPham/PhanTrang.php"); ?>
</div>

<?php
        // include("Views/SanPham/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tensanpham'])) {?>
        <a class="return" href="../SanPham/DanhSach">Quay lại danh sách sản phẩm</a>
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
                    min: <?php echo (int)$this->model->GiaThapNhat()[0]['GiaThapNhat'];?>,
                    max: <?php echo (int)$this->model->GiaCaoNhat()[0]['GiaCaoNhat'];?>,
                    step: 500000,
                    values: [ <?php if (isset($_GET['price_min'])) {echo $_GET['price_min'];} else { echo (int)$this->model->GiaThapNhat()[0]['GiaThapNhat'];}?>, <?php if (isset($_GET['price_max'])) {echo $_GET['price_max'];} else { echo (int)$this->model->GiaCaoNhat()[0]['GiaCaoNhat'];}?> ], // Giá trị mặc định cho thanh trượt
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
