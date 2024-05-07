<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
    echo "<title>Vai trò tài khoản</title>";
    ?>
    <style>
        
        .return {
            text-align: right;
            margin: 10px 20px 0 0;
            display: block;
            font-weight: bold;
            font-size: 18px;
        }

        .modal1 {
  display: none; /* Ẩn modal ban đầu */
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
  max-height: 65vh;
  overflow-y: auto;
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
        <span class="h3 m-2">Vai trò tài khoản</span>
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
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID vai trò, tên vai trò,...">
                    </div>
                    <div class="col-sm-12 text-center mt-3">
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
        <!-- <input type="submit" value="Excel" name="excel"> -->
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
            <?php if(check('VaiTroTaiKhoan/ThemMoi') == true) { ?>
                    <a href="../VaiTroTaiKhoan/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
        <table class="table table-condensed table-bordered text-center">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
                <th><input checked id="checkboxAll" type="checkbox"></th>
                <th>#</th>
                <th>Tên vai trò</th>
                <th>Thao tác</th>    
            </tr>
            <?php 
            $i = 0;
            if(!empty($list_role)) {
                if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                    $i = ($current * $item1) - $item1;
                } 
           
                foreach ($list_role as $row) : extract($row);$i++;?> 
                <tr>
                    <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                    <td><?= $i ?></td>
                    <td>
                        <?= $row['tenvaitro'] ?>
                    </td>
                  
                <td style="text-align: center; width: 25%;"> 
                    
                       
                <a class="click_view" data-id_vt="<?=$row['ID'];?>" style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="javascript:void(0);">
                        <i class="fa-solid fa-eye"></i> Chi tiết
                    </a> 
                    <!-- <a class="" style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="javascript:void(0);" onclick="openModal()">Xem chi tiết</a> -->
                    <div id="myModal1" class="modal1">
                       
                    </div>
                    <?php if(check('VaiTroTaiKhoan/CapNhat&id=123') == true) { ?>
                        <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../VaiTroTaiKhoan/CapNhat&id=<?=$row['ID']?>">
                            <i class="fa-solid fa-pen-to-square"></i> Cập nhật
                        </a>
                    <?php } ?>
                    <?php if(check('VaiTroTaiKhoan/Xoa&id=123') == true) { ?>
                        <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../VaiTroTaiKhoan/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </a>
                   <?php } ?>
                </td>
                </tr>
                <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>
        </table>
        </form>
        <?php include("Views/VaiTroTaiKhoan/PhanTrang.php"); ?>
    </div>
   
            <?php if(isset($_GET['tennhanvien'])) {?>
            <a class="return" href="../NhanVien/DanhSach">Quay lại danh sách trạng thái sản phẩm</a>
            <?php }?>
        
        <script>
            $('.click_view').on('click',function(){
        var a = $(this).data('id_vt');
        
        // var b = $(this).text().trim();
        
        $.ajax({
            url: '../VaiTroTaiKhoan/view_quyen',
            method: 'POST',
            data: { token: a },
            success: function(data){
                // alert('Sửa phí ship thành công');
                openModal();
                $('#myModal1').html(data);
                
            }
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
      document.getElementById("myModal1").addEventListener('click', function(event) {
        if (event.target === this) { // Kiểm tra xem sự kiện click có xảy ra trên modal không
          closeModal(); // Nếu click xảy ra trên nền mờ, đóng modal
        }
      });
      
        </script>
    <?php
        include "./Views/Layout/footer.php";
    ?>