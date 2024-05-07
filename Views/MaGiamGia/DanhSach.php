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
    <span class="h3 m-2">Mã giảm giá</span>
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
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID mã giảm,  tên sản phẩm,...">
                    </div>
                    <div class="col-sm-3">
                        <select name="id_magiam" class="form-select" id="">
                            <option value="">Lọc theo loại mã giảm</option>
                            <?php foreach($loaimagiam as $item) { ?>
                            <option <?php if (isset($_GET['id_magiam']) && $_GET['id_magiam'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['name']; ?></option>   
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="trangthai" class="form-select" id="">
                            <option value="">Điều kiện</option>
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 0) { echo "selected"; } ?>  value="0">Chưa kích hoạt</option>  
                            <option <?php if (isset($_GET['trangthai']) && $_GET['trangthai'] == 1) { echo "selected"; } ?> value="1">Kích hoạt</option>
                        </select>
                    </div>  
                    <div class="col-sm-7 mt-2">
                        <div class="" style="display: flex; justify-content: center; align-items: center;">
                            <div class="col-sm-3 text-center" style="border: 1px solid #ccc; background: #fff; border-radius: 7px; padding: 5px;">Lọc theo hạn mã code: </div>
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
            <?php if(check('MaGiamGia/ThemMoi') == true) { ?>
                <a href="../MaGiamGia/ThemMoi" class="btn btn-primary">Thêm mới</a>
            <?php } ?>
        </div>
    </div>
    <table style="overflow: auto;" class="table table-condensed table-bordered">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên chương trình giảm giá</th>
            <th>Loại giảm giá</th>
            <th>Hình ảnh</th>
            <th>Mã giảm giá</th>
            <th>Mô tả</th>
            <th>Lượng giảm giá</th>
            <th>Điều kiện tối thiểu</th>
            <th>Điều kiện tối đa</th>
            <th>Được sử dụng với mã khác?</th>
            <th>Sản phẩm được áp dụng</th>
            <th>Trạng thái</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Action</th>
        </tr>

        <?php 
        $i = 0; 
        if(!empty($listCodeDiscount)):
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
            } 
           
        foreach($listCodeDiscount as $row) : extract($row); ?>
        <tr>
            <td><input checked class="checkbox1" type="checkbox" value="<?=$row['mggID']?>" name="checkboxID[]"></td>
            <td><?=++$i;?></td>
            <td><?=$row['tenma'];?></td>
            <td><?=$row['name'];?></td>
            <td><img src="../Assets/data/HinhAnhMaGiamGia/<?= $row['image1'] ?>" alt="TAP" height="50px" width="50px" ></td>
            <td><?=$row['code'];?></td>
            <td><?=$row['mota'];?></td>
            <td><?=$row['luonggiam'];?></td>
            <td><?=$row['dieukientoithieu'];?></td>
            <td><?=$row['dieukientoida'];?></td>
            <td><?php if ($row['id_sudungcode'] == 1) { echo "Không";} else { echo "Có"; }  ?></td>
            <td>
                <ul>
                    <?php $array = explode(",",$row['id_sp']);
                        foreach($array as $item) {
                            $detailProduct = $this->sanpham->ChiTiet10($item);
                            $name = $detailProduct[0]['TenSanPham'];
                            echo "<li style='list-style: square;'>$name</li>";
                        }
                    ?>
                </ul>
            </td>
            <td><?php if($row['trangthai'] == 1) {echo "Đã kích hoạt";} else {echo "Chưa kích hoạt";} ?></td>
            <td><?=$row['ngaybatdau'];?></td>
            <td><?=$row['ngayketthuc'];?></td>
            <td>
                <?php if(check('MaGiamGia/Xoa&id=123')) { ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" onclick="return confirm('Xác nhận xóa?')" href="../MaGiamGia/Xoa1?id=<?=$row['mggID'];?>">Xóa</a>
                <?php } ?>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
    </form>
    <?php include("Views/MaGiamGia/PhanTrang.php"); ?>
</div>

<?php
    include "./Views/Layout/footer.php";
?>