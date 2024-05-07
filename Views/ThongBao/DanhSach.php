<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
    echo "<title>Danh sách sản phẩm</title>";
?>
<style>
    
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

    .thongbao--component:hover {
        background: #ccc;
        cursor: pointer;
    }

    .modal1 {
  display: block; /* Ẩn modal ban đầu */
  position: fixed; /* Hiển thị modal dựa trên vị trí tuyệt đối */
  z-index: 999; /* Đảm bảo modal luôn hiển thị phía trên cùng */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5); /* Tạo background mờ */
  animation: appear1 .7s linear;
}

.modal-content1 {
  background-color: #fefefe;
  margin: 15% auto; /* Hiển thị modal giữa màn hình */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px; /* Đảm bảo modal không quá rộng */
  border-radius: 5px;
  position: relative;
}

.close1 {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Thông báo</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Danh sách
    </span>

</div>
<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <form method="get" class="row">
                    <div class="col-md-8">
                        <input type="text" name="tensanpham" class="form-control" placeholder="Nhập tên sản phẩm..." >
                    </div>
                    <div class="col-md-4" style="padding:0;margin-left:-7px;">
                        <button class="btn btn-primary">Tìm</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div style="float: right;">
                <form action="" method="POST">
                    <button class="btn btn-danger">Import</button>
                    <button type="submit" name="export" class="btn btn-success">Export</button>
                    <?php if(check('SanPham/ThemMoi') == true) { ?>
                    <a href="../SanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3" style="padding: 10px;">
<div class="body klkl" style=";width: 100%; margin: 12px auto 0;">
            <div style="width: 100%; height: 100%; " class="">
                
                <div style="display: flex;">
                    <?php if(isset($thongtin)) { foreach($thongtin as $row) : extract ($row); ?>
                    <?php include("./Views/HomeLayout/sideleft.php"); ?>
                    <?php endforeach; }?>
                    
                    <div style="width: 100%;" class="">
                        <div style="padding-bottom: 5px;display: flex; justify-content: space-between;" class="">
                            <div style="font-size: 20px; color: black; font-weight: 550;" class="">Thông báo của bạn</div>
                            <div class=""><a style="text-decoration: none;" href="?xemthongbaoall">Đánh dấu tất cả là đã đọc</a></div>
                        </div>
                        <?php unset($_SESSION['number_notice_admin']); ?>
                        <div style=" box-shadow: 1px 2px 3px 4px gray; max-height: 100vh; overflow: auto;" class="">
                        <?php if (is_array($thongbao1)) foreach($thongbao1 as $row) : extract ($row); ?>
                                <?php if($row['action'] == 0) {  ?>
                                    
                                <div data-id_tb="<?=$row['ID'];?>" style="padding: 5px; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="see_detail thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: blue; font-size: 14px; font-weight: 550;" class="">
                                            <?=$row['ngay']?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background: blue;" class=""></div>
                                    </div>
                                </div>
                                <?php } else { ?> 
                                 <!-- <a id="link2" class="linkk" style="text-decoration: none;" href="#">Chưa đọc</a>  -->
                                 <!-- <input type="submit" name="OKE" value="SUBMIT">  -->
                                <div data-id_tb="<?=$row['ID'];?>" style="padding: 5px; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="see_detail thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: #c0c0c0; font-size: 14px; font-weight: 550;" class="">
                                            <?=$row['ngay'];?>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                                <?php endforeach; ?>
                        </div>

                        <div style="display: none;" id="myModal1" class="modal1">
                            <!-- <div class="modal-content1">
                                <span class="close1" onclick="closeModal()">&times;</span>
                                <p style="font-size: 20px; font-weight: bold; text-align: center; color: red; margin: 0;">ĐƠN HÀNG BÁN</p>
                                <div style="color: red;font-size: 15px; margin: 0; text-align: center;">Mã đơn hàng: 12</div>
                                <div style="font-weight: bold;" class="">Mã khách hàng: <a href="">1</a></div>
                                <div style="font-weight: bold; margin-top: 5px;" class="">Chi tiết đơn hàng</div>
                                <table class="table text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0 ;$tongcong = 0; $tt = 0;
                                        foreach($ctdh as $row) :extract($row);
                                        ?>
                                        
                                        <tr>
                                            <th scope="row"><?=++$i;?></th>
                                            <td><?=$row['TenSanPham'];?></td>
                                            <td><?=$row['SoLuong'];?></td>
                                            <td><?=number_format($row['DonGiaApDung'], 0, '.', '.') ;?>VND</td>
                                            <td><?=number_format($row['ThanhTien'], 0, '.', '.') ;?>VND</td>
                                        </tr>
                                        <?php endforeach; ?>

                                        
                                    </tbody>
                                </table>
                            </div> -->
                        </div>
                       
                    </div>
                    
                </div>
            </div>
        </div>
</div>
<?php
        // include("Views/SanPham/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tensanpham'])) {?>
        <a class="return" href="../SanPham/DanhSach">Quay lại danh sách sản phẩm</a>
        <?php }?>
    
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
<script>
    $(document).ready(function() {
        // Bind click event to elements with class 'see_detail'
        $('.see_detail').click(function() {
            // Retrieve the value of 'data-id_tb' attribute
            var id = $(this).data('id_tb');
            // alert(id);
            // Alert the ID
            $.ajax({
            url: '../ThongBao/ChiTiet',
            method: 'POST',
            data: { id: id},
            success: function(data){
                // alert('Sửa phí ship thành công');
                $('#myModal1').html(data);
                openModal();
            }
        });
        });
    });

    function openModal() {
        var modal = document.getElementById("myModal1");
        
        modal.style.display = "block";
      }
      
      function closeModal() {
        var modal = document.getElementById("myModal1");
        modal.style.display = "none";
      }
      
      // Thêm sự kiện click cho nền mờ (vùng bên ngoài modal)
      document.getElementById("myModal1").addEventListener('click', function(event) {
        if (event.target === this) { // Kiểm tra xem sự kiện click có xảy ra trên modal không
          closeModal(); // Nếu click xảy ra trên nền mờ, đóng modal
        }
      });

    
</script>
<?php
    include "./Views/Layout/footer.php";
?>
