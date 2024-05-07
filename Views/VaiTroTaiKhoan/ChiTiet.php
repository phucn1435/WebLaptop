<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Sản Phẩm</span>
    <span>
        <a href="../VaiTroTaiKhoan/DanhSach" style="text-decoration: none; color: #000000;" >Danh sách</a>
    </span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    <span>
        Chi tiết
    </span>

</div>
<hr>
<div class="row">
    <?php print_r($detail); print_r($getName) ;?>
</div>
    
<?php
    include "./Views/Layout/footer.php";
?>