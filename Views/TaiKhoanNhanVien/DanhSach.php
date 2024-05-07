<?php
    include "./Views/Layout/header.php";
    echo "<title>Danh sách tài khoản nhân viên</title>";
    include("Controllers/KiemTraQuyen.php");
?>
<?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);
?>
<style>
    .btn-primary:hover{
        transform: scale(1.2);
        transition: all .2s ease-in-out;
        margin-left: 10px;
    }
    
    .btn-find {
        width: 90px;
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
    <span class="h3 m-2">Tài Khoản Nhân Viên</span>
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
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập tên đăng nhập, ID nhân viên,...">
                    </div>
                    <!-- <div class="col-sm-3">
                        <select name="id_vt" class="form-select" id="">
                            <option value="">Lọc theo vai trò tài khoản</option>
                            <?php foreach($danhsachvaitro as $item) { ?>
                            <option <?php if (isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['tenvaitro']; ?></option>   
                            <?php } ?>
                        </select>
                    </div> -->
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
</div>
<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div style="float: right;">
                    <?php if(check('TaiKhoanNhanVien/ThemMoi') == true) { ?>
                    <a href="../TaiKhoanNhanVien/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3">
<form action="" method="POST">
        <!-- <input type="submit" value="Excel" name="excel"> -->
        <div class="row">
            <div class="col-sm-6">
                <input type="submit" onclick="return confirm('Bạn muốn xóa?')" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
            <?php if(check('TaiKhoanNhanVien/ThemMoi') == true) { ?>
                    <a href="../TaiKhoanNhanVien/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên nhân viên</th>
            <th>Tên đăng nhập</th>
            
            <th>Trạng thái</th>
            <th>Ảnh đại diện</th>
            <th>Action</th>
            <!-- <th>Phan quyen</th> -->
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
                <?= $row['TenNhanVien'] ?>
                </td>
            
                <td>
                    <?= $row['TenDangNhap'] ?>
                </td>
               
                <td>
                    <?php if($row['TrangThai'] == 1) { ?>
                        <span style="padding: 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;">Active</span>
                     <?php } else { ?>
                        <span style="padding: 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;">Non-Acitve</span>
                    <?php } ?>
                </td>
                <td>
                <img src="../Assets/AvatarNhanVien/<?= $row['AnhDaiDien'] ?>" alt="img" height="50px" width="50px" >
                </td>
              
                <td>
                    <!-- <a href="../TaiKhoanNhanVien/PhanQuyen&id=<?=$row['IDNhanVien']?>">Phân quyền</a> | -->
                    <?php if(check('TaiKhoanNhanVien/CapNhat&id=123') == true) { ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../TaiKhoanNhanVien/CapNhat&id=<?=$row['TenDangNhap']?>">Cập nhật</a>
                    <?php } ?>
                    <?php if(check('TaiKhoanNhanVien/CapNhat&id=123') == true) { ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../TaiKhoanNhanVien/Xoa&id=<?=$row['IDNhanVien']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
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
<script>
    
function validateDate() {
      // Lấy giá trị ngày hiện tại
      var ngaybatdau = new Date(document.getElementById("ngaybatdau").value);

      // Lấy giá trị ngày được chọn từ trường input date
      var ngayketthuc = new Date(document.getElementById("ngayketthuc").value);

      // So sánh ngày được chọn với ngày hiện tại
      if (ngayketthuc < ngaybatdau) {
        // Nếu ngày được chọn nhỏ hơn ngày hiện tại, báo lỗi
        alert("Ngày không hợp lệ. Vui lòng chọn một ngày trong tương lai.");
        // Xoá giá trị ngày đã chọn
        document.getElementById("ngayketthuc").value = "";
      }
    }
</script>
<?php include("Views/TaiKhoanNhanVien/PhanTrang.php"); ?>
<?php if(isset($_GET['tennhanvien'])) {?>
        <a class="return" href="../TaiKhoanNhanVien/DanhSach">Quay lại danh sách tài khoản nhân viên</a>
        <?php }?>

<?php
    include "./Views/Layout/footer.php";
?>