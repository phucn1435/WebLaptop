<?php
    include "./Views/Layout/header.php";
    echo "<title>Thống kê</title>";
    include("Controllers/KiemTraQuyen.php");
?>
<?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);

?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="w-100" style="border-radius: 7px;border: 2px solid #ccc;">
                <div style="padding: 10px;" class="">
                    <h1 style="text-align: center; padding: 5px 0; font-weight: bold;">BIỂU ĐỒ THỐNG KÊ TRUY CẬP</h1>
                    <select name="" class="test form-select">
                        <option value="0">365 ngày qua</option>
                        <option value="1">90 ngày qua</option>
                        <option value="2">28 ngày qua</option>
                    </select>
                    <div class="text" style="padding: 5px; color: red;"></div>
                    <div id="chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6" style="border: 2px solid #ccc; border-radius: 7px;">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($_SESSION['error_thongke'])) {echo $_SESSION['error_thongke'];} ?>
<!-- <div id="chartContainer1" style="height: 370px; width: 100%; margin-top: 50px;"></div> -->

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    thongke();
     var chart = new Morris.Area({
  // ID of the element in which to draw the chart.
    element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
    data: <?php echo json_encode($char_data); ?>,
  // The name of the data record attribute that contains x-values.  
    xkey: 'date',
  // A list of names of data record attributes that contain y-values.
    ykeys: ['nguoitc', 'luottc'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
    labels: ['Người truy cập','Lượt truy cập']
    }); 
    function thongke() {
        $('.test').on('change', ()=> {
            var thoigian = $('.test').val();
            if (thoigian == 0) {
                text = "Thống kê 365 ngày qua";
            } else if (thoigian == 1) {
                text = "Thống kê 90 ngày qua";
            } else {
                text = "Thống kê 28 ngày qua";
            }
            $('.text').text(text);
            $.ajax({
                url : "../ThongKe/xuli_thongke",
                method: "POST",
                dataType: "JSON",
                data: {thoigian:thoigian},
                success: function(data) {
                    chart.setData(data);
                }
            });
        });
    }
});
</script>

<!-- <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> -->
                            <script>
                                window.onload = function () {
                                var chart = new CanvasJS.Chart("chartContainer", {
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
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });
                                chart.render();
                                
                                }
                                </script>
