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
    </style>
    <div class="col-md-12 mt-2">
        <span class="h3 m-2">Nhân viên</span>
        <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            Danh sách
        </span>
    </div>
    <div class="mt-12">
    <div class="row">
        <div style="color: blue;" class="col-sm-12">
            <i class="fa-solid fa-filter"></i> Filter
        </div>
        <form action="" method="get">
            <div class="col-sm-12">
            <!-- $tensanpham,$trangthai,$idloaisanpham,$idTrangThaiSanPham,$gianho,$gialon -->
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID nhân viên,email,SDT,...">
                    </div>
                    <div class="col-sm-2">
                        <select name="gioitinh" id="" class="form-select">
                            <option value="" class="form-control">Chọn giới tính</option>
                            <option <?php echo isset($_GET['gioitinh']) && $_GET['gioitinh'] == 1 ? "selected" : "" ?> value="1" >Nam</option>
                            <option <?php echo isset($_GET['gioitinh']) && $_GET['gioitinh'] == 0 ? "selected" : "" ?> value="0" >Nữ</option>
                        </select>
                    </div>
                    <div class="col-sm-7 ">
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

    <div class="col-md-12 mt-3">
        <form action="" method="POST">

        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
                <?php if(check('NhanVien/ThemMoi') == true) { ?>
                    <a href="../NhanVien/ThemMoi" class="btn btn-primary">Thêm mới</a>
                <?php } ?>
            </div>
        </div>
        <table class="table table-condensed table-bordered text-center">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
                <th><input checked id="checkboxAll" type="checkbox"></th>
                <th>#</th>
                <th>Tên nhân viên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Lương / 1 ngày</th>
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
                        <?= $row['TenNhanVien'] ?>
                    </td>
                    <td>
                        <?php if($row['GioiTinh'] == 0) {
                            echo "Nữ"; 
                        } else {
                            echo "Nam";
                        } ?>
                    </td>
                    <td>
                        <?= $row['NgaySinh'] ?>
                    </td>
                    <td>
                        <?= $row['SoDienThoai'] ?>
                    </td>
                    <td>
                        <?= $row['Email'] ?>
                    </td>
                    <td>
                        <?= $row['DiaChi'] ?>
                    </td>
                    <td>
                        <?= number_format($row['luong'], 0, '.', '.')?> đ
                    </td>
                    <td>
                        <?php if(check('NhanVien/CapNhat&id=123')) { ?>
                        <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../NhanVien/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> 
                        <?php } ?>

                        <?php if(check('NhanVien/Xoa&id=123')) { ?>
                        <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../NhanVien/Xoa?id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
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
            include("Views/NhanVien/PhanTrang.php");
        ?>
            <?php if(isset($_GET['tennhanvien'])) {?>
            <a class="return" href="../NhanVien/DanhSach">Quay lại danh sách sản phẩm</a>
            <?php }?>
        <script>

        </script>
    <?php
        include "./Views/Layout/footer.php";
    ?>