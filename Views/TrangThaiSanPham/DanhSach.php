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
        <span class="h3 m-2">Trạng thái sản phẩm</span>
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
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID trạng thái, tên trạng thái,...">
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
</div>
    <hr>
    <div class="col-md-12 mt-3">
    <form action="" method="POST">
        <!-- <input type="submit" value="Excel" name="excel"> -->
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Xác nhận xóa !');" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
            <?php if(check('TrangThaiSanPham/ThemMoi') == true) { ?>
                    <a href="../TrangThaiSanPham/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
        <table class="table table-condensed table-bordered text-center">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
                <th><input checked id="checkboxAll" type="checkbox"></th>
                <th>#</th>
                <th>Tên trạng thái sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Trạng thái hoạt động</th>
                <th>Thao tác</th>
            </tr>
            <?php 
            $i = 0;
            if(!empty($list)) {
                if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['tennhanvien'])) {
                    $i = ($current * $item1) - $item1;
            } 
                foreach ($list as $row) : extract($row);$i++; ?> 
                <tr>
                    <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                    <td><?= $i ?></td>
                    <td>
                        <?= $row['TenTrangThai'] ?>
                    </td>
                  
                    <td>
                    <img src="../Assets/data/HinhAnhTTSP/<?= $row['hinhanh'] ?>" alt="TAP" height="150px" width="80%" >
                    </td>
                    <td style="text-align: center;">
                    <?php if($row['trangthai'] == 0) {  ?>
                        <i style="color: red; font-size: 18px;" class="fa-solid fa-circle-xmark"></i>
                    <?php } else { ?>
                        <i style="color: green; font-size: 18px;" class="fa-solid fa-circle-check"></i>
                    <?php } ?>
                </td>
                <td style="text-align: center; width: 25%;"> 
                    <?php if(check('TrangThaiSanPham/CapNhat&id=123') == true) { ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../TrangThaiSanPham/CapNhat&id=<?=$row['ID']?>">
                        <i class="fa-solid fa-pen-to-square"></i> Cập nhật
                    </a>
                    <?php } ?>
                    <?php if(check('TrangThaiSanPham/Xoa&id=123') == true) { ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../TrangThaiSanPham/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">
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
    <?php include("Views/TrangThaiSanPham/PhanTrang.php"); ?>

    </div>
   
            <?php if(isset($_GET['tennhanvien'])) {?>
            <a class="return" href="../NhanVien/DanhSach">Quay lại danh sách trạng thái sản phẩm</a>
            <?php }?>
        
    <?php
        include "./Views/Layout/footer.php";
    ?>