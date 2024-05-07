
<h1>Test Biểu Đồ Đơn Hàng Bán</h1>
<select name="" id="select">
    <option value="0">Chọn</option>
    <option value="1">Thống kê theo năm</option>
</select>
<select style="display: none;" name="" id="year">
    <?php for($i = 2015; $i < 2024; $i++) { ?>
        <option value="<?=$i?>"><?=$i;?></option>
    <?php } ?>
</select>
<div id="hello"></div>
<?php $test1 = $this->login->TongTruyCap(); 
// print_r($thongketruycaptheonam);s
// print_r($test1);?>
<?php
$dataPoints1 = array();
$dataPoints2 = array();

foreach ($test1 as $item) {
    array_push($dataPoints1 ,["label"=> $item['ngay'], "y"=> $item['tongphien']]);
}

foreach ($test1 as $item) {
    array_push($dataPoints2 ,["label"=> $item['ngay'], "y"=> $item['tongnguoi']]);
}
// $dataPoints2 = array(
// 	array("label"=> "2010", "y"=> 64.61),
// 	array("label"=> "2011", "y"=> 70.55),
// 	array("label"=> "2012", "y"=> 72.50),
// 	array("label"=> "2013", "y"=> 81.30),
// 	array("label"=> "2014", "y"=> 63.60),
// 	array("label"=> "2015", "y"=> 69.38),
// 	array("label"=> "2016", "y"=> 98.70)
// );
	
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
		text: "Thống kê truy cập của khách hàng"
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
 
}
</script>
<script>
    $(document).ready(function() {
        $('#select').on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "../ThongKe/test10",
                method: "POST",
                data: { year: value },
                success: function(data) {
                    $("#year").css("display", "block");               
                    // $("#hello").html(data);
                }
            }); 

            // if (value != 0) {
            //     alert(2);
            // }
        }); 
        $("#year").on('change', () => {
            var value = $("#year").val();
            $.ajax({
                url: "../ThongKe/test11",
                method: "POST",
                data: { year: value },
                success: function(data) {
                    // $("#year").css("display", "block");               
                    $("#hello").html(data);
                }
            }); 
        }); 
    });
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>        