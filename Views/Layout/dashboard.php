

<?php
    include("Controllers/KiemTraQuyen.php");
?>
<?php
    include_once "./Views/Layout/header.php";
    echo "<title>Trang chủ</title>";
?>
<style>
    .canvasjs-chart-canvas {
        position: relative;
    }
</style>
<?php 
$danhsach = $this->donhangban->DanhSach(100,0);
$danhsach1 = $this->donhangban->DanhSachTQ(100,0);

$count_tq = 0;
$count_online = 0;

if (is_array($danhsach)) {  
    $count_online = count($danhsach);
}

if (is_array($danhsach1)) {
    $count_tq = count($danhsach1);
}

$dataPoints = array(
	array("label"=> "Đơn hàng tại quầy", "y"=> $count_tq),
	array("label"=> "Đơn hàng online", "y"=> $count_online)
);
?>
<form action="" method="POST">
<div class="row" style="height: auto;">
    <div class="col-sm-12" style="border: 2px solid #ccc; padding: 10px; border-radius: 10px; background: #fff;">
        <div class="row"  style="margin: 0 auto; gap: 20px 10%;">
            <div class="col-sm-12">
                <input type="submit" name="export_excel_1" value="Export" class="btn btn-info">
            </div>
            <div class="col-sm-3" style="padding: 10px;  border-radius: 10px; background: white;box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
                <div style=" height: auto;" class="content-contain--header">
                    <p style="text-transform: uppercase;font-weight: bold;">Sản phẩm</p>
                    <hr>
                    <div class="content-contain--body">
                        <p style="margin-bottom: 10px; color: #e6280e; font-weight:bold; font-size: 20px;"><?=$sp_dangban;?></p>
                        <p style="font-size: 13px; color: #a9a9a9; font-weight: bold; ">Sản phẩm đang bán</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="padding: 10px; border-radius: 10px; background: white;box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
                <div style=" height: auto;" class="content-contain--header">
                    <p style="text-transform: uppercase;font-weight: bold;">Số đơn hàng mới</p>
                    <hr>
                    <div class="content-contain--body">
                        <p style="margin-bottom: 10px; color: blue;font-weight:bold; font-size: 20px;"><?= $count_donhang; ?></p>
                        <p style="font-size: 13px; color: #a9a9a9; font-weight: bold; ">Đơn hàng trong ngày</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="padding: 10px; border-radius: 10px; background: white;box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
                <div style=" height: auto;" class="content-contain--header">
                    <p style="text-transform: uppercase;font-weight: bold;">Số khách hàng mới</p>
                    <hr>
                    <div class="content-contain--body">
                        <p style="margin-bottom: 10px; color: orange;font-weight:bold; font-size: 20px;"><?=$count_kh; ?></p>
                        <p style="font-size: 13px; color: #a9a9a9; font-weight: bold; ">Khách hàng của tháng</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="padding: 10px; border-radius: 10px; background: white;box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
                <div style=" height: auto;" class="content-contain--header">
                    <p style="text-transform: uppercase;font-weight: bold;">Doanh thu hôm nay</p>
                    <hr>
                    <div class="content-contain--body">
                        <p style="margin-bottom: 10px; color: aqua;font-weight:bold; font-size: 20px;"><?=number_format($tongtien, 0, ',') ;?> VND</p>
                        <p style="font-size: 13px; color: #a9a9a9; font-weight: bold; ">Thống kê ngày hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mt-3">
        <div class="row" style="gap: 20px 6%;">
            <div class="col-sm-5">
                <div id="chartContainer" style="height: auto;"></div>
            </div>

            <div class="col-sm-5" style="background: #fff; border-radius: 20px; padding: 15px; width: 50%; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
                <div class="row">
                    <div style="font-size: 20px; font-weight: bold;" class="col-sm-6">
                        Thống kê doanh số
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <select name="koko1" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset; " class="form-select test" id="">
                            <option value="0">Thống kê 365 ngày qua</option>
                            <option value="1">Thống kê 90 ngày qua</option>
                            <option value="2">Thống kê 28 ngày qua</option>
                            <option value="3">Thống kê 7 ngày qua</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text" style="margin-left: 10px; color: red; font-size: 13px; font-weight: bold;"></div>
                            </div>
                            <div class="col-sm-6 export" style="text-align: right;">
                                <input type="submit" name="export_excel_2" value="Export" class="btn btn-info">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="chart" style="height: 100%;"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div id="chartContainer1"></div>
            </div>

            <div class="col-sm-5" style="background: #fff; border-radius: 20px; padding: 15px; width: 50%; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
                    <div class="row">
                        <div style="font-size: 20px; font-weight: bold;" class="col-sm-6">
                            Thống kê trạng thái đơn hàng
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <select name="koko2" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset; " class="form-select test1" id="">
                                <option value="0">Thống kê 365 ngày qua</option>
                                <option value="1">Thống kê 90 ngày qua</option>
                                <option value="2">Thống kê 28 ngày qua</option>
                                <option value="3">Thống kê 7 ngày qua</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text1" style="margin-left: 10px; color: red; font-size: 13px; font-weight: bold;"></div>
                                </div>
                                <div class="col-sm-6 export" style="text-align: right;">
                                    <input type="submit" name="export_excel_3" value="Export" class="btn btn-info">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div id="chart1" style="height: 100%;"></div>
                        </div>
                    </div>
                </div>
        </div>
       
        <div class="row">
            <div class="col-sm-12">
            <div style="overflow: hidden; border-radius: 7px;width: 100%; height: auto; margin-top: 20px; border:1px solid #ccc; background: white;" class="">
                <div class="content" style="padding: 15px 20px; height: auto; border-bottom: 1px solid gray; font-weight: bold; font-size: 15px;">
                    Đơn hàng mới
                </div>
                <div class="content" style="padding: 10px 20px; max-height: 100vh; overflow: auto;">
                    <table class="table">
                        <thead style="display: <?php if(!isset($donhangmoi)) {echo "none";}?>">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Chi tiết </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (isset($donhangmoi)) {
                                    $i = 0;
                                    foreach($donhangmoi as $row) : extract ($row); $i++; ?>
                                    <tr>
                                        <th scope="row"><?=$i;?></th>
                                        <td><?=$row['ID']?></td>
                                        <td><?=$row['TenKhachHang']?></td>
                                        <td><?=$row['TongTien']?></td>
                                        <td>
                                            <span style="font-size: 14px; display: inline-block; padding: 5px; background: yellow; color: blue; font-weight: bold; border-radius: 5px;"><?=$row['TenTrangThai']?></span>
                                        </td>
                                        <td><?=$row['NgayLap']?></td>
                                        <td>
                                            <a href="../ChiTietDonHangBan/DanhSach&id=<?=$row['ID']?>"><i class="fa-solid fa-pen-fancy"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; } else { ?>
                                        <p>Hôm nay không có đơn hàng nào mới cả.</p>
                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
</form>                        

                            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                            <script>
                                window.onload = function () {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    title:{
                                        text: "Order Statistics"
                                    },
                                    subtitles: [{
                                        text: "Currency Used: VietNam(VND)"
                                    }],
                                    data: [{
                                        type: "pie",
                                        showInLegend: "true",
                                        legendText: "{label}",
                                        indexLabelFontSize: 16,
                                        indexLabel: "{label} - #percent%",
                                        yValueFormatString: "฿#,##0",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });
                                chart.render();

                                var chart1 = new CanvasJS.Chart("chartContainer1", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    title:{
                                        text: "WhistList Statistics"
                                    },
                                    subtitles: [{
                                        text: "Currency Used: lượt"
                                    }],
                                    data: [{
                                        type: "pie",
                                        showInLegend: "true",
                                        legendText: "{label}",
                                        indexLabelFontSize: 16,
                                        indexLabel: "{label} - #percent%",
                                        yValueFormatString: "฿#,##0",
                                        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });
                                chart1.render();
                                
                                }
                                </script>
                                
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function() {
            <?php $this->sanpham->CapNhatGiaKhuyenMai(); ?>
    });
    
    
    
    $(document).ready(function() {
    thongke1();
    thongke();
    var chart2 = new Morris.Area({
        // ID of the element in which to draw the chart.
        element: 'chart1',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: <?php echo json_encode($char_data); ?>,
        // The name of the data record attribute that contains x-values.  
        xkey: 'date',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['count_ctt','count_dtt','count_dn','count_ht','count_dh','count_dxl','count_dvc'],
        // ykeys: ['count_dtt'],

        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Số lượng đơn hàng chưa thanh toán','Số lượng đơn hàng đã thanh toán','Số lượng đơn hàng đã nhận',
                'Số lượng đơn hàng đã hoàn thành', 'Số lượng đơn hàng đã hủy','Số lượng đơn hàng đang xử lí',
                'Số lượng đơn hàng đang vận chuyển']
    }); 

    var chart = new Morris.Area({
    // ID of the element in which to draw the chart.
    element: 'chart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: <?php echo json_encode($char_data); ?>,
    // The name of the data record attribute that contains x-values.  
    xkey: 'date',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['doanhthu'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Doanh thu']
    }); 

    function thongke() {
        $('.test').on('change', ()=> {
            var thoigian = $('.test').val();
            if (thoigian == 0) {
                text = "Thống kê 365 ngày qua";
            } else if (thoigian == 1) {
                text = "Thống kê 90 ngày qua";
            } else if (thoigian == 2) {
                text = "Thống kê 28 ngày qua";
            } else {
                text = "Thống kê 7 ngày qua";
            }
            $('.text').text(text);
            $.ajax({
                url : "../Home/xuli_doanhthu",
                method: "POST",
                dataType: "JSON",
                data: {thoigian:thoigian},
                success: function(data) {
                    chart.setData(data);
                    // $('.export').css('display','block');
                }
            });
        });
    }

    function thongke1() {
        $('.test1').on('change', ()=> {
            $('.test1').on('change', ()=> {
            var thoigian = $('.test1').val();
            if (thoigian == 0) {
                text = "Thống kê 365 ngày qua";
            } else if (thoigian == 1) {
                text = "Thống kê 90 ngày qua";
            } else if (thoigian == 2) {
                text = "Thống kê 28 ngày qua";
            } else {
                text = "Thống kê 7 ngày qua";
            }
            $('.text1').text(text);
            $.ajax({
                url : "../Home/xuli_thongkedonhang",
                method: "POST",
                dataType: "JSON",
                data: {thoigian:thoigian},
                success: function(data) {
                    chart2.setData(data);
                }
            });
        });
        });
    }
    
});
</script> 
<script>
   
</script>
                                  
<?php
    include "./Views/Layout/footer.php";
?>
