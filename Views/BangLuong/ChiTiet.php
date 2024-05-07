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



<?php 

$result = array();
$result1 = array();

foreach ($bangluong1 ?? [] as $item) {
    $key = $item['year'] . '-' . $item['month'];
    if (!isset($result[$key])) {
        $result[$key] = array(
            'year' => $item['year'],
            'month' => $item['month'],
            'title' => "BL-" .$item['month'] ."-".$item['year'],
            'data' => array()
        );
    }
    $result[$key]['data'][] = array(
        'ID_user' => $item['ID_user'],
        'work_days' => $item['work_days']
    );
}

// Chuyển kết quả thành mảng liên tục
$result = array_values($result);


foreach ($bangluong2 ?? [] as $item) {
    $key = $item['year'] . '-' . $item['month'];
    if (!isset($result1[$key])) {
        $result1[$key] = array(
            'year' => $item['year'],
            'month' => $item['month'],
            'title' => "BL-" .$item['month'] ."-".$item['year'],
            'data' => array()
        );
    }
    $result1[$key]['data'][] = array(
        'ID_user' => $item['ID_user'],
        'work_days' => $item['work_days']
    );
}

// Chuyển kết quả thành mảng liên tục
$result1 = array_values($result1);
// print_r($result1);
// Hiển thị kết quả
// foreach($result as $item1) {
//     print_r($item1['data']);
// }
?>
<?php

 $getInfo = $this->taikhoan->find($_SESSION['dangnhap1']);
 $getRole = $getInfo[0]['role'];
 // print_r($_SESSION['dangnhap1']);
 // $getQuyen1 = [];
 $array_role = explode(",", $getRole);
 $flag = 0;
 foreach($array_role as $item) {
    if($item == 9) {
        $flag = 1;
        break;
    }
 }

 print_r($flag);
?>
<div class="col-md-12 mt-4">
    <form action="" method="POST">
    <!-- <input type="submit" onclick="return confirm('Bạn muốn xóa?')" name="delete" value="Delete" class="btn btn-danger"> -->
    <table class="table table-condensed table-bordered">
        <?php if($flag == 1) { ?>
        <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <!-- <th><input checked id="checkboxAll" type="checkbox"></th> -->
            <th>#</th>
            <th>Tên bảng lương</th>
            <th>Bảng lương theo tháng/năm</th>
            <th>Action</th>
        </tr>
        <?php $i = 0;foreach($result as $item) { ?>    
        <tr class="text-center">
            <td>
                <?=++$i;?>
            </td>
            <td>
                <?=$item['title'];?>
            </td>
            <td>
                Tháng <?=$item['month'];?> Năm <?=$item['year'];?>
            </td>
            <td>
                <?php 
                $currentYear = date('Y'); // Năm hiện tại
                $currentMonth = date('n'); // Tháng hiện tại (không có số 0 đứng trước                
                
                $yearToCheck = $item['year']; // Năm muốn kiểm tra
                $monthToCheck = $item['month']; // Tháng muốn kiểm tra
                
                if ($currentYear > $yearToCheck || ($currentYear == $yearToCheck && $currentMonth > $monthToCheck)) { ?>
                    <a href="../BangLuong/XemChiTiet?BL=<?=$monthToCheck;?>-<?=$yearToCheck;?>">Xem chi tiết</a>
                <?php } else { ?>
                    <a href="../BangLuong/XemChiTiet?BL=<?=$monthToCheck;?>-<?=$yearToCheck;?>&tt=0"><span style="color: red;">Chưa hoàn chỉnh.</span> Vẫn xem?</a>
                <?php }?>                  
            </td>
        </tr>   
        <?php } } else { ?>
            <tr style="text-align: center;background-color: whitesmoke; color: black; " class="col-6 align-self-center">
            <!-- <th><input checked id="checkboxAll" type="checkbox"></th> -->
            <th>#</th>
            <th>Tên bảng lương</th>
            <th>Bảng lương theo tháng/năm</th>
            <th>Action</th>
        </tr>
        <?php $i = 0;foreach($result1 as $item) { ?>    
        <tr class="text-center">
            <td>
                <?=++$i;?>
            </td>
            <td>
                <?=$item['title'];?>
            </td>
            <td>
                Tháng <?=$item['month'];?> Năm <?=$item['year'];?>
            </td>
            <td>
                <?php 
                $currentYear = date('Y'); // Năm hiện tại
                $currentMonth = date('n'); // Tháng hiện tại (không có số 0 đứng trước                
                
                $yearToCheck = $item['year']; // Năm muốn kiểm tra
                $monthToCheck = $item['month']; // Tháng muốn kiểm tra
                
                if ($currentYear > $yearToCheck || ($currentYear == $yearToCheck && $currentMonth > $monthToCheck)) { ?>
                    <a href="../BangLuong/XemChiTiet?BL=<?=$monthToCheck;?>-<?=$yearToCheck;?>&id=<?=$_SESSION['dangnhap1'];?>">Xem chi tiết</a>
                <?php } else { ?>
                    <a href="../BangLuong/XemChiTiet?BL=<?=$monthToCheck;?>-<?=$yearToCheck;?>&tt=0&id=<?=$_SESSION['dangnhap1'];?>"><span style="color: red;">Chưa hoàn chỉnh.</span> Vẫn xem?</a>
                <?php }?>                  
            </td>
        </tr>   
        <?php } }?>
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
