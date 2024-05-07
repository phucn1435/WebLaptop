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
</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Bảng lương nhân viên</span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Chi Tiết
    </span>

</div>
<!-- <div class="">
    <div class="row">
        <div style="color: blue;" class="col-sm-12">
            <i class="fa-solid fa-filter"></i> Filter
        </div>
        <form action="" method="get">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="text" value="<?php if(isset($_GET['keyword'])) {echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập ID nhân viên, tên nhân viên,...">
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
</div> -->
<hr>


<!-- <div class="col-md-12 mt-4">
    <form action="" method="POST">
    <input type="submit" onclick="return confirm('Bạn muốn xóa?')" name="delete" value="Delete" class="btn btn-danger">
    <table class="table table-condensed table-bordered">
        <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <th><input checked id="checkboxAll" type="checkbox"></th>
            <th>#</th>
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Số ngày làm</th>
            <th>Lương/1 ngày</th>
            <th>Tổng tiền lương</th>
        </tr>
        <?php 
           
            $i = 0;
            if(!empty($user_salary)){
                if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['keyword'])) {
                    $i = ($current * $item1) - $item1;
                } 
            foreach ($user_salary as $row) : extract($row);$i++; ?> 
            <tr style="text-align: center;" class="row-sp">
                <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                <td><?= $i ?></td>
                
                <td>
                    <a href="../NhanVien/DanhSach?id_nhanvien=<?= $row['ID_user']?>"><?= $row['ID_user'] ?></a>
                </td>

                <td>
                    <?= $row['TenNhanVien'] ?>
                </td>
            
                <td>
                    <?= $row['countUser'] ?>
                </td>
                
                <td>
                    <?=number_format($row['luong'], 0, '.', '.');?> đ
                </td>

                <td>
                    <?=number_format($row['luong'] * (int)$row['countUser'], 0, '.', '.');?> đ
                </td>
            </tr>
            <?php endforeach; } else { ?>
                <tr>
                    <td colspan="10" class="text-center" style="color: red;">Không tìm thấy dữ liệu.</td>
                </tr>
            <?php } ?>
    </table>
    </form>
    <?php include("Views/BangLuong/PhanTrang.php"); ?>
</div> -->
<div class="col-md-12 mt-4">
    <form action="" method="POST">
    <!-- <input type="submit" onclick="return confirm('Bạn muốn xóa?')" name="delete" value="Delete" class="btn btn-danger"> -->
    <table class="table table-condensed table-bordered">
        <?php if(!isset($_GET['id']))  { ?>
        <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <!-- <th><input checked id="checkboxAll" type="checkbox"></th> -->
            <th>#</th>
            <th>ID nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Lương cơ bản</th>
            <?php if(!isset($_GET['tt'])) { ?>
            <th>Số ngày nghỉ</th>
            <?php } ?>
            <th>Số ngày làm</th>
            <?php if(!isset($_GET['tt'])) { ?>
            <th>Tổng lương</th>
            <?php } ?>
        </tr>
        <?php $i = 0;foreach($filteredData as $item) { ?>    
        <tr class="text-center">
            <td>
                <?=++$i;?>
            </td>
            <td>
                <?=$item['ID_user'];?>
            </td>
            <td>
                <?=$this->nhanvien->find($item['ID_user'])[0]['TenNhanVien'];?>
            </td>
            <td>
                <?= number_format($this->nhanvien->find($item['ID_user'])[0]['luong'], 0, '.', '.');?>
            </td>
            <?php if(!isset($_GET['tt'])) { ?>
            <td>
                <?= $off_days = $daysInMonth - $item['work_days']; ?>
            </td>
            <?php } ?>
            <td>
                <?=$item['work_days'];?>
            </td>
            <?php if(!isset($_GET['tt'])) { ?>
            <td>
                
                <?php 
                    $salary_base = $this->nhanvien->find($item['ID_user'])[0]['luong'] * $daysInMonth;
                    $salary_workDays = $item['work_days'] * $this->nhanvien->find($item['ID_user'])[0]['luong'];
                    if($off_days >= 3 && $off_days <= 5) {
                        $salary_base = $salary_workDays - 200000;
                    } elseif($off_days > 5 && $off_days <= 10) {
                        $salary_base = $salary_workDays - 500000;
                    } elseif($off_days > 10) {
                        $salary_base = $salary_workDays - ($salary_base * 20 / 100);
                    }
                ?>
                <?php  
                    if ($salary_base < 0) { ?>
                        0
                    <?php } else { ?>
                        <?= number_format($salary_base, 0, '.', '.'); ?>
                    <?php } ?>
            </td>
            <?php } ?>
        </tr>   
        <?php } } else { ?>
            <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <!-- <th><input checked id="checkboxAll" type="checkbox"></th> -->
            <th>#</th>
            <th>ID nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Lương cơ bản</th>
            <?php if(!isset($_GET['tt'])) { ?>
            <th>Số ngày nghỉ</th>
            <?php } ?>
            <th>Số ngày làm</th>
            <?php if(!isset($_GET['tt'])) { ?>
            <th>Tổng lương</th>
            <?php } ?>
        </tr>
        <?php $i = 0;foreach($filteredData1 as $item) { ?>    
        <tr class="text-center">
            <td>
                <?=++$i;?>
            </td>
            <td>
                <?=$item['ID_user'];?>
            </td>
            <td>
                <?=$this->nhanvien->find($item['ID_user'])[0]['TenNhanVien'];?>
            </td>
            <td>
                <?= number_format($this->nhanvien->find($item['ID_user'])[0]['luong'], 0, '.', '.');?>
            </td>
            <?php if(!isset($_GET['tt'])) { ?>
            <td>
                <?= $off_days = $daysInMonth - $item['work_days']; ?>
            </td>
            <?php } ?>
            <td>
                <?=$item['work_days'];?>
            </td>
            <?php if(!isset($_GET['tt'])) { ?>
            <td>
                
                <?php 
                    $salary_base = $this->nhanvien->find($item['ID_user'])[0]['luong'] * $daysInMonth;
                    $salary_workDays = $item['work_days'] * $this->nhanvien->find($item['ID_user'])[0]['luong'];
                    if($off_days >= 3 && $off_days <= 5) {
                        $salary_base = $salary_workDays - 200000;
                    } elseif($off_days > 5 && $off_days <= 10) {
                        $salary_base = $salary_workDays - 500000;
                    } elseif($off_days > 10) {
                        $salary_base = $salary_workDays - ($salary_base * 20 / 100);
                    }
                ?>
                <?php  
                    if ($salary_base < 0) { ?>
                        0
                    <?php } else { ?>
                        <?= number_format($salary_base, 0, '.', '.'); ?>
                    <?php } ?>
            </td>
            <?php } ?>
        </tr> 
        <?php } } ?>
    </table>
    </form>
    <!-- <?php include("Views/BangLuong/PhanTrang.php"); ?> -->
</div>
<?php
        // include("Views/SanPham/PhanTrang.php");
    ?>
        <?php if(isset($_GET['tensanpham'])) {?>
        <a class="return" href="../SanPham/DanhSach">Quay lại danh sách sản phẩm</a>
        <?php }?>


<?php
    include "./Views/Layout/footer.php";
?>
