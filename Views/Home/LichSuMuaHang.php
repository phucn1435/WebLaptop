<?php
include "./Views/HomeLayout/header.php";
?>

<div class="container rounded mt-4">
    
    <div class="row">
    
                    <?php foreach($thongtin as $row) : extract ($row); ?>
                    <?php include("./Views/HomeLayout/sideleft.php"); ?>
                    <?php endforeach; ?>
        <div class="col-md-9 bg-light rounded row">
            <p style="margin-bottom: 10px; color: black; font-weight: 550; font-size: 20px;">Quản lý đơn hàng</p>
            <div class="container">
                <div class="btn-group col-md-12 row mx-0 mt-3">
                    <div class="">
                        <div style="width: 100%; text-align: right; margin-top: 10px;" class="">
                            <div class="row">
                                <?php foreach($trangthaiban as $item) { ?>
                                    <div class="col-md-3 p-2"><a style="width: 100%; <?php if (isset($_GET['tab']) && $item['ID'] == $_GET['tab']) { echo "background: red; color: #fff"; } ?>" id="hello1" class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=<?=$item['ID']?>"><?=$item['TenTrangThai'];?></a></div>
                                <?php } ?>
                            </div>
                            <!-- <a id="hello6" class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=chothanhtoan">Chưa thanh toán</a>
                            <a id="hello7" class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=dathanhtoan">Đã thanh toán</a>
                            <a id="hello2" class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=chogiaohang">Đang xử lí</a>
                            <a id="hello3"  class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=dangvanchuyen">Đang vận chuyển</a>
                            <a id="hello4"  class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=dahoanthanh">Đã hoàn thành</a>
                            <a id="hello5"  class="btn btn-outline-primary col-md-2" href="../TrangChu/LichSuMuaHang?id=<?=$_SESSION['id_user']?>&tab=dahuy">Đã hủy</a>                  -->
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-outline-primary col-md-2">Chờ xác nhận</button> -->
                   
                </div>
                <hr>
                <div class="mt-4">
                
                <?php
                // print_r($list_dh);
                if (isset($_GET['tab'])) {
                    $id_tab = $_GET['tab'];
                    foreach($list_dh as $item) {
                        if ($item['idTrangThai'] == $id_tab) { ?>
                            <div style="border-radius: 7px; overflow: hidden;" class="rounded mt-3 bg-gradient-99CCFF-CCFFFF row">
                                <table class="table">
                                    <tr>
                                        <th class="text-bg-danger"><?= date('d-m-Y', strtotime($item['NgayLap'])) ?></th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php
                                        foreach ($result as $row) {
                                            // extract($row);
                                            if ($item['ID_DH'] == $row['idDonHangBan']) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="Hình ảnh sản phẩm" height="70px" width="70px">
                                                    </td>
                                                    <td><?= $row['TenSanPham'] ?></td>
                                                    <td>
                                                        <?= number_format($row['DonGiaApDung'], 0, '.', '.') ?>
                                                    </td>
                                                    <td><?= $row['SoLuong'] ?></td>
                                                    <td>
                                                        <?= number_format($row['ThanhTien'], 0, '.', '.') ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    
                                    ?>
                                    <tr>
                                        <th colspan="4">Mã giảm giá đã áp dụng</th>
                                        <th><?= number_format($item['giamgia'], 0, '.', '.') ?>%</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Tổng tiền</th>
                                        <th><?= number_format($item['TongTien'], 0, '.', '.') ?> đ</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Action</th>
                                        <th><a style="color: #fff; background: red; padding: 5px 15px; border-radius: 7px;" href="../TrangChu/LichSuMuaHang?id=<?=$item['ID']?>&test=huy">Hủy</a></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Hình thức thanh toán</th>
                                        <th><?=$item['name']?> <?php if($item['id_tttt'] != 4) { ?> <a style="background: transparent;" href="../TrangChu/LichSuCongThanhToan?id=<?=$item['ID']?>"> (Lịch sử thanh toán)</a> <?php } ?></th>
                                    </tr>
                                </table>
                                
                            </div>
                       <?php }
                    }
                } 
                ?>
                                 <br>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    a {
        text-decoration: none;
        background: white;
    }

    .bg-gradient-99CCFF-CCFFFF {
        background: linear-gradient(to right, #99CCFF, #CCFFFF);
    }

    a.clicked{
        background: red;
        color: white;
        font-weight: 550;
    }
</style>
<?php if(isset($_GET['tab']) && $_GET['tab'] === "chothanhtoan") { ?>
    <script>
        var links = document.getElementById('hello1');
        links.classList.add('clicked');
    </script>
    <?php } elseif(isset($_GET['tab']) && $_GET['tab'] === "chogiaohang") { ?>
        <script>
        var links = document.getElementById('hello2');
        links.classList.add('clicked');
    </script>
    
    <?php } elseif(isset($_GET['tab']) && $_GET['tab'] === "danhan") {?>
        <script>
    var links = document.getElementById('hello6');
    links.classList.add('clicked');
    </script>

    </script>
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] === "dathanhtoan") {?>
            <script>
        var links = document.getElementById('hello7');
        links.classList.add('clicked');
    </script>
    
    </script>
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] === "dangvanchuyen") {?>
            <script>
        var links = document.getElementById('hello3');
        links.classList.add('clicked');
    </script>
        <?php } elseif(isset($_GET['tab']) && $_GET['tab'] === "dahoanthanh") { ?>
        <script>
        var links = document.getElementById('hello4');
        links.classList.add('clicked');
    </script>
                <?php } else { ?>
                    <script>
        var links = document.getElementById('hello5');
        links.classList.add('clicked');
    </script>
                    <?php } ?>
<script>
    function makeBold(link) {
        var links = document.getElementsByTagName('a');
  for (var i = 0; i < links.length; i++) {
    links[i].classList.remove('clicked');
  }
  
  // Thêm lớp 'clicked' vào liên kết vừa được nhấp vào
  link.classList.add('clicked');
}

</script>