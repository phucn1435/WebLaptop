<?php
    include "./Views/Layout/header.php";
    echo "<title>Thống kê</title>";
    include("Controllers/KiemTraQuyen.php");
?>
<?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);
?>

<?php
$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3 = array();
$y = 40;   
for($i = 0; $i < 1000; $i++){
	$y += rand(0, 10) - 5; 
	array_push($dataPoints3, array("x" => $i, "y" => $y));
}

if ($tongluotnam != null && $tongnguoinam != null && ($_POST['year1'] == 0)) {
    foreach ($tongluotnam as $item) {
        array_push($dataPoints1 ,["label"=> $item['ngay'].'-'.$item['thang'], "y"=> $item['tongphien']]);
    }
    foreach ($tongnguoinam as $item) {
        array_push($dataPoints2 ,["label"=> $item['ngay'].'-'.$item['thang'], "y"=> $item['tongnguoi']]);
    }
} elseif($tongnguoingay != null && $tongluotngay != null) {
    foreach ($tongluotngay as $item) {
        array_push($dataPoints1 ,["label"=> $item['ngay'], "y"=> $item['tongphien']]);
    }
    foreach ($tongnguoingay as $item) {
        array_push($dataPoints2 ,["label"=> $item['ngay'], "y"=> $item['tongnguoi']]);
    }
} else {
foreach ($thongketruycaptheonam as $item) {
    array_push($dataPoints1 ,["label"=> $item['nam'], "y"=> $item['tongphien']]);
}
foreach ($thongketruycaptheonam as $item) {
    array_push($dataPoints2 ,["label"=> $item['nam'], "y"=> $item['tongnguoi']]);
}
}

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Thống kê truy cập của khách hàng <?php if(isset($title)) {echo $title;} ?>"
	},
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Lượt truy cập",
		indexLabel: "{y}",
		yValueFormatString: "#0.## phiên",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}
    ,{
		type: "column",
		name: "Người truy cập",
		indexLabel: "{y}",
		yValueFormatString: "#0.## người",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}
    ]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}


var chart1 = new CanvasJS.Chart("chartContainer1", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	animationEnabled: true,
	zoomEnabled: true,
	title: {
		text: "Try Zooming and Panning"
	},
	data: [{
		type: "area",     
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
 
 
}
</script>
<script>
    $(document).ready(function() {
        $('#select').on('change', function() {
            var value = $(this).val();
            if (value == 1) {
                $("#month").css('display', 'none');
                    $.ajax({
                        url: "../ThongKe/test10",
                        method: "POST",
                        data: { year: value },
                        success: function(data) {
                            $("#year").css("display", "block");               
                        }
                    }); 
                    $("#year").on('change', () => {
                    var value1 = $("#year").val();
                    $.ajax({
                        url: "../ThongKe/test10",
                        method: "POST",
                        data: { year1: value1 },
                        success: function(data) {
                            $("#input").val(data);
                        }
                    }); 
                }); 
            } else if (value == 2) {
                $(document).ready(function(){
                // Sự kiện khi thay đổi tháng
                    $("#year").css('display', 'block');
                    $("#month").css('display', 'block');
                });
            }
        }); 
        
    });
</script>

</head>
<body>
<div class="w-100" style="border-radius: 7px;border: 2px solid #ccc;">
<div style="padding: 10px;" class="">
    <h1 style="text-align: center; font-weight: bold;">BIỂU ĐỒ THỐNG KÊ TRUY CẬP</h1>
        <select class="form-select" name="" id="select">
            <option value="0">Chọn</option>
            <option value="1">Thống kê theo tháng</option>
            <option value="2">Thống kê theo ngày</option>
        </select>

        <select class="form-select" id="day" style="display: none;" name="selectDay">
            
        </select>

        <div id="hello">

        </div>
        <form class="text-center p-3" action="" method="POST">
            <select class="form-select" style="display: none;" name="year" id="year">
                <option value="0">Select Year</option>
                    <?php for($i = $khoangNam[0]['namNhoNhat']; $i <= $khoangNam[0]['namLonNhat']; $i++) { ?>
                        <option value="<?=$i?>"><?=$i;?></option>
                    <?php } ?>
            </select>

            <select class="form-select" style="display: none;" name="year1" id="month">
                <option  option value="0">Select Month</option>
                    <?php for($i = 1; $i <=12; $i++) { ?>
                        <option value="<?=$i?>"><?=$i;?></option>
                    <?php } ?>
            </select>
            
            <input class="btn btn-danger mt-3 w-50" type="submit" name="selectYear" value="Submit">
        </form>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
</div>

<select name="" class="test">
    <option value="0">Chon</option>
    <option value="1">Chon</option>
    <option value="2">Chon</option>
</select>
<?php if(isset($koko1)) {echo $koko1;} ?>
<div id="chartContainer1" style="height: 370px; width: 100%; margin-top: 50px;"></div>
<script>
    $(".test").on('change', ()=> {
        var thoigian = $(".test").val();
        $.ajax({
            url: "../ThongKe/xuli_thongke",
            method: "POST",
            data: {data:thoigian},
            success: function(data) {
                
            }
        });
    });
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</body>
</html>