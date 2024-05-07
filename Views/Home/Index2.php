<?php
    include "./Views/HomeLayout/header.php";
?>
<?php
    $i=0;
      foreach ($result2 as $row) : extract($row); $i++?> 
              <!-- <form action="" method="POST"> -->
              <form action="../TrangChu/ChiTietSP" method="POST">
        <li class="col-md-3 list-unstyled" style="height: 450px;">
            <?php if($row['SoLuong'] != 0) { ?>
            <a href="../TrangChu/ChiTietSP?id=<?=$row['ID']?>" class="card" id="myLink">
            <!-- <a href="../TrangChu/ChiTietSP" class="card"> -->
              
                    <!-- <input type="text" name="hidden" value="<?php echo $row['ID']?>"> -->
                </form>

                <div class="" style="height:270px; width: auto; padding: 1rem;">
                <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" style="width:90%; height:90%;" alt="<?= $row['TenSanPham'] ?>">
                </div>
                <div class="card-body">
                <h5 class="card-title" style="font-size: 18px; font-weight: normal; height: 54px;" ><?= $row['TenSanPham'] ?></h5>
                <b><small class="text-primary" style="font-weight: bold; font-size: 15px;" > <?= number_format($row['Gia'], 0, ',', '.') ?> VNĐ</small></b>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button id="test" onclick="test()">Thêm vào giỏ hàng</button>
                        <a href="../TrangChu/ChiTietSanPhamTheoTrangThai?id=<?=$row['ID']?>&index=<?=$i-1?>" class="btn btn-sm btn-outline-secondary">Xem chi tiết</a>
                    </div>
                </div>
                </div>
            </a>
<?php } else { ?> 
    <a href="javascript:void(0)" class="card">
            <!-- <a href="../TrangChu/ChiTietSP" class="card"> -->
              
                    <!-- <input type="text" name="hidden" value="<?php echo $row['ID']?>"> -->
                </form>

                <div class="" style="height:270px; width: auto; padding: 1rem;">
                <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>"  style="width:90%; height:90%;" alt="<?= $row['TenSanPham'] ?>">
                </div>
                <div class="card-body">
                <h5 class="card-title" style="font-size: 18px; font-weight: normal; height: 54px;" ><?= $row['TenSanPham'] ?></h5>
                <b><small class="text-primary" style="font-weight: bold; font-size: 15px;" > <?= number_format($row['Gia'], 0, ',', '.') ?> VNĐ</small></b>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button disabled type="submit" name="add-to-cart" id="addcart" class="btn btn-sm btn-outline-secondary add-to-cart">Hết hàng</button>                  
                        <a href="../TrangChu/ChiTietSanPhamTheoTrangThai?id=<?=$row['ID']?>&index=<?=$i-1?>" class="btn btn-sm btn-outline-secondary">Xem chi tiết</a>
                    </div>
                </div>
                </div>
            </a>
<?php } ?>
            <!-- <input type="submit" name="submitNN" value="submit"> -->
        </li>
            </form>
           
<!-- </form> -->

    <?php endforeach;?>
<script>
//     document.addEventListener("DOMContentLoaded", function () {
//     // Lấy đối tượng liên kết theo ID
//     const myLink = document.getElementById("myLink");

//     // Gắn trình xử lý sự kiện "click" cho liên kết
//     myLink.addEventListener("click", function (event) {
//     //   event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết (chuyển hướng trang)
//     event.preventDefault();
//       // Xử lý hành động khi liên kết được click
//       alert(1);

//       // Thêm mã xử lý khác tại đây nếu cần
//     });
//   });
    function test(){
        window.location.href = "../TrangChu/ChiTietSP";
    }
</script>

    
