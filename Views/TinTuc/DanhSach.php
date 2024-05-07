<?php
    include "./Views/Layout/header.php";
    include("Controllers/KiemTraQuyen.php");
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
    <span class="h3 m-2">Tin tức</span>
   
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a href="./DanhSach">Danh sách</a>
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
                    <div class="col-sm-2">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập tên tin tức, ID tin tức,...">
                    </div>
                    <div class="col-sm-3">
                        <select name="id_tt" class="form-select" id="">
                            <option value="">Lọc theo loại tin tức</option>
                            <?php foreach($list_LoaiTT as $item) { ?>
                            <option <?php if (isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == $item['ID']) { echo "selected"; } ?> value="<?=$item['ID'];?>"><?=$item['TenLoaiTinTuc']; ?></option>   
                            <?php } ?>
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
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
                <?php if(check('TinTuc/ThemMoi') == true) { ?>
                    <a href="../TinTuc/ThemMoi" class="btn btn-primary">Thêm mới</a>
                <?php } ?>
            </div>
        </div>
    <table class="table table-condensed table-bordered text-center">
        <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Tên tin tức</th>
            <th>Loại tin tức</th>
            <th>Nội dung</th>
            <th>Ngày đăng tin</th>
            <th>Hình ảnh</th>
            <th style="width: 17%;">Action</th>
        </tr>
        <?php 
        $i=0;
        if(!empty($result)) {
            if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                $i = ($current * $item1) - $item1;
            } 
          
            foreach ($result as $row) : extract($row);$i++;?> 
            <tr>
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td>
                    <?= $i;?>
                </td>
                <td>
                    <?= $row['TenTinTuc'] ?>
                </td>
                <td>
                    <?= $row['TenLoaiTinTuc'] ?>
                </td>
                <td>
                    <?= $row['NoiDung'] ?>
                </td>
                <td>
                    <?= $row['NgayDang'] ?>
                </td>
                <td>
                    <a href="TinTuc/CapNhatHinhAnh&id=<?=$row['ID']?>">
                        <img src="../Assets/data/HinhAnhTinTuc/<?=$row['hinhanh'];?>" alt="TAP" height="50px" width="50px" >
                    </a>
                </td>
                <td>
                <a style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="../TinTuc/ChiTiet&id=<?=$row['ID']?>">Chi tiết</a>
                    <?php if(check('TinTuc/CapNhat&id='.$row['ID'])) { ?>
                    <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../TinTuc/CapNhat&id=<?=$row['ID']?>">Cập nhật</a>
                    <?php } ?>

                    <?php if(check('TinTuc/Xoa&id='.$row['ID'])) { ?>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../TinTuc/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
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
        include("Views/TinTuc/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tentintuc'])) {?>
        <a class="return" href="../TinTuc/DanhSach">Quay lại danh sách sản phẩm</a>
        <?php }?>
    
<?php
    include "./Views/Layout/footer.php";
?>
