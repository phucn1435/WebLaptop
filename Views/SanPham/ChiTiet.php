<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Sản Phẩm</span>
    <span>
        <a href="../SanPham/DanhSach" style="text-decoration: none; color: #000000;" >Danh sách</a>
    </span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    <span>
        Chi tiết
    </span>

</div>
<hr>
<div class="row">
    <!-- <?php print_r($detail); ?> -->
<?php foreach ($detail as $row){?> 
    <div class="col-md-4">
        <div class="card">
            <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="Hình ảnh không tồn tại">
        </div>
    </div>
    <div class="col-md-8">
        <h5><?=$row['TenSanPham']?></h5>   
        <h6>Trạng thái sản phẩm: <span style="font-weight: bold; color: red;"><?=$row['TenTrangThai']?></span></h6><br>    
        <h5 class="text-primary"><?=number_format($row['GiaKhuyenMai'],0,'.', '.')?> đ <?php   
        $output = "";
        if ($row['NgayBatDau_KM'] != "0000-00-00" && $row['NgayHetHan_KM'] != "0000-00-00") {
            $output .= "<span style='font-size: 15px;'>( Giá khuyến mãi được áp dụng từ ngày " .$row['NgayBatDau_KM']. " đến ngày " .$row['NgayHetHan_KM']. " )</span>";
        } elseif($row['NgayBatDau_KM'] != "0000-00-00" && $row['NgayHetHan_KM'] == "0000-00-00") {
            $output .= "<span style='font-size: 15px;'>( Giá khuyến mãi được áp dụng từ ngày " .$row['NgayBatDau_KM']. " cho đến khi có thông báo mới )</span>";
        } elseif($row['NgayBatDau_KM'] == "0000-00-00" && $row['NgayHetHan_KM'] != "0000-00-00") {
            $output .= "<span style='font-size: 15px;'>( Giá khuyến mãi được áp dụng từ ngày " .$row['NgayBatDau_KM']. " cho đến khi có thông báo mới )</span>";
        }
        echo "<span style='font-weight: bold; color: red;'>$output</span>";
        ?>

        
    
        </h5>
        <h6 class="" style="color: gray;text-decoration: line-through;"><?=number_format($row['Gia'],0,'.', '.')?> đ</h6><br>
        <h6>Mô tả: </h6>
        <div style="padding: 15px;" class="card">
            <?=$row['MoTa']?>
        </div>
    </div>
<?php }?>
</div>
    
<?php
    include "./Views/Layout/footer.php";
?>