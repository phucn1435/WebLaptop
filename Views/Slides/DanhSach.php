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
    <span class="h3 m-2">Slides</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Danh sách
    </span>

</div>
<hr>
<div class="">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div style="float: right;">
                    <?php if(check('Slides/ThemMoi')) {?>
                    <a href="../Slides/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3">
    <select style="margin-bottom: 10px;" class="form-select" name="" id="selectListSlide">
        <!-- <option value="0">Chọn trang</option> -->
        <?php if (is_array($loai_slide)) foreach($loai_slide as $row) : extract($row); ?>
        <option value="<?=$row['ID'];?>"><?=$row['TenLoaiSlide'];?></option>
        <?php endforeach; ?>
    </select>
    <form class="" action="" method="POST">
    <div class="form-slide">
        <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
        <table class="table table-condensed table-bordered text-center">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
                <th><input checked id="checkboxAll" type="checkbox"></th>
                <th>#</th>
                <th>Hình ảnh Banner</th>
                <th>Action</th>
            </tr>
            <?php 
                $i = 0;
                if (is_array($result1))           
                foreach ($result1 as $row) : extract($row);$i++; ?> 
                <tr>
                    <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                    <td><?= $i ?></td>
                    <td>
                        <a href="../Slides/CapNhatHinhAnh&id=<?=$row['ID']?>">
                            <img src="../Assets/data/Slides/<?=$row['hinhanh'];?>" alt="TAP" height="50px" width="50px" >
                        </a>
                    </td>
                    <td>
                        <a style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="../Slides/ChiTiet&id=<?=$row['ID']?>">Chi tiết</a>
                        <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../Slides/CapNhat&id=<?=$row['ID']?>">Cập nhật</a> 
                        <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../Slides/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
    
    <div  style="display: none;" class="form-slide1">
        <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        <table class="table table-condensed table-bordered">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
                <th><input checked id="checkboxAll" type="checkbox"></th>
                <th>#</th>
                <th>Tên loại sản phẩm</th>
                <th>Hình ảnh Banner</th>
                <th>Action</th>
            </tr>
            <?php 
                $i = 0;
                if (is_array($result))           
                foreach ($result as $row) : extract($row);$i++; ?> 
                <tr>
                    <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                    <td><?= $i ?></td>
                    <td>
                        <?=$row['TenLoaiSanPham'];?>
                    </td>
                    <td>
                        <a href="../Slides/CapNhatHinhAnh&id=<?=$row['ID']?>">
                            <img src="../Assets/data/Slides/<?=$row['hinhanh'];?>" alt="TAP" height="50px" width="50px" >
                        </a>
                    </td>
                    <td>
                        <a style="padding: 7px 5px; font-size: 14px; background: #25539e; color: #fff; border-radius: 5px;" href="../Slides/ChiTiet&id=<?=$row['ID']?>">Chi tiết</a> 
                        <a style="margin: 0px 7px 0px 7px;padding: 7px 5px; font-size: 14px; background: green; color: #fff; border-radius: 5px;" href="../Slides/CapNhat&id=<?=$row['ID']?>">Cập nhật</a>
                        <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../Slides/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
    </form>
</div>
<?php
        include("Views/Slides/PhanTrang.php");
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
        });

        // console.log(checkbox);
        checkbox.change(function(){
        var isChecked = checkbox.length === $('.checkbox1:checked').length;
        // console.log(isChecked);
        checkboxAll.prop('checked', isChecked);
        });
    });

    document.querySelector("#selectListSlide").onchange = () => {
        var a = document.querySelector('#selectListSlide').value;

        if (a == 0) {
            document.querySelector('.form-slide').style.display = "none";
            document.querySelector('.form-slide1').style.display = "none";
        }
        if (a == 2) {
            document.querySelector('.form-slide').style.display = "none";
            document.querySelector('.form-slide1').style.display = "block";
        }
        if (a == 1) {
            // if (document.querySelector('.form-slide').style.display == "none") {
            //     document.querySelector('.form-slide').style.display = "block";
            // } else {
            //     document.querySelector('.form-slide').style.display = "none";
            // }   
            document.querySelector('.form-slide1').style.display = "none";
            document.querySelector('.form-slide').style.display = "block";    
        }
    }
</script>
<?php
    include "./Views/Layout/footer.php";
?>
