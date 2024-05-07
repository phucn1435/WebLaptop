<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm nhân viên</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Tài khoản nhân viên</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
      <a class="title-non_active" href="../TaiKhoanNhanVien/DanhSach"> Danh Sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Thêm mới
    </span>
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">

    <label class="h6">Chọn nhân viên muốn cung cấp tài khoản</label> <br>
    <?php print_r($this->model->DanhSachActive(1)); ?>
        <select class="form-select" name="idnhanvien">
        <?php 
        
        if(!empty($result)):
            foreach ($result as $row) : extract($row);$i++; if ($row['ID'] > 0) { ?> 
            <option value="<?php echo $row['ID']; ?>"><?php echo $row['TenNhanVien']; ?></option>
            <?php } endforeach ; endif;  ?>
    </select> <br>
        <label class="h6">Tên đăng nhập</label>
        <input type="text" name="tendangnhap" class="form-control">
        
        <label class="h6">Mật khẩu</label>
        <input type="password" name="matkhau" class="form-control"><br> 

        <label class="h6">Chọn quyền</label>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <?php foreach($danhsachvaitro as $item) { ?> 
                        <div class="col-sm-3">
                            <input type="checkbox" name="vaitro[]" value="<?=$item['ID'];?>"> <?=$item['tenvaitro'];?>
                        </div>   
                    <?php } ?>
                </div>
            </div>
        </div>
        <label class="h6">Trạng thái</label>
        <select class="form-select" name="trangthai">
            <option value="1">Active</option>
            <option value="0">Non-Active</option>
        </select>

        <label class="h6">Hình ảnh</label> <br>
        <input type="file" id="file-upload" name="anhdaidien"><br>
         <?php
            echo $alert;
         ?>

        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../TaiKhoanNhanVien/DanhSach" class="btn btn-warning">Quay lại</a>
    </form>
</div>
<?php
    include "./Views/Layout/footer.php";
?>