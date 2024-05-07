<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách loại sản phẩm</title>";
    include("Controllers/KiemTraQuyen.php");

?>
<style>
     .return {
        text-align: right;
        margin: 10px 20px 0 0;
        display: block;
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Loại sản phẩm</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a href="./DanhSach">Danh sách</a>
    </span>
</div>
<div class="row">
        <div style="color: blue;" class="col-sm-12">
            <i class="fa-solid fa-filter"></i> Filter
        </div>
        <form action="" method="get">
            <div class="col-sm-12">
            <!-- $tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon -->
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID danh mục, tên danh mục,...">
                    </div>
                    <div class="col-sm-2">
                        <select name="trangthai" class="form-select" id="">
                            <option value="">Điều kiện</option>
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 0) { echo "selected"; } ?>  value="0">Chưa kích hoạt</option>
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 1) { echo "selected"; } ?> value="1">Kích hoạt</option>
                        </select>
                    </div>
                    <div class="col-sm-7">
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
                    <div class="col-sm-12 text-center mt-3">
                        <input type="submit" class="btn btn-primary" value="Lọc kết quả">
                    </div>
                </div>
            </div>
        </form>
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
            <?php if(check('SanPham/ThemMoi') == true) { ?>
                    <a href="../LoaiSanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên loại sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Kích hoạt</th>
            <th>Action</th>
        </tr>
        <?php 
       $i = 0;
       if(!empty($result)) {
           if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
               $i = ($current * $item1) - $item1;
       } 
            foreach ($result as $row) : extract($row);$i++; ?> 
            <tr>
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i ?></td>
                <td>
                    <?= $row['TenLoaiSanPham'] ?>
                </td>
                <td>
                    <a href="../LoaiSanPham/CapNhatHinhAnh&id=<?=$row['ID']?>">
                        <img src="../Assets/data/HinhAnhLoaiSanPham/<?= $row['hinhanh'] ?>" alt="TAP" height="50px" width="50px">
                    </a>
                </td>
                <td style="text-align: center;">
                    <?php if($row['trangthai'] == 0) {  ?>
                        <i style="color: red; font-size: 18px;" class="fa-solid fa-circle-xmark"></i>
                    <?php } else { ?>
                        <i style="color: green; font-size: 18px;" class="fa-solid fa-circle-check"></i>
                    <?php } ?>
                </td>
                <td>
                    <?php if(check('LoaiSanPham/CapNhat&id=123') == true) {  ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../LoaiSanPham/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> 
                    <?php } ?>

                    <?php if(check('LoaiSanPham/Xoa&id=123') == true) {  ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../LoaiSanPham/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
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
</div>
<?php
        include("Views/LoaiSanPham/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tenloaisanpham'])) {?>
        <a class="return" href="../LoaiSanPham/DanhSach">Quay lại danh sách loại sản phẩm</a>
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
<?php
    include "./Views/Layout/footer.php";
?>