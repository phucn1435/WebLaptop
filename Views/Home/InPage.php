<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phong Vũ | Laptop, Điện thoại, Phụ kiện</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        height: 100%;
    }
</style>
<body>
<div style="padding: 10px 20px;" class="container">
       
       <div style="text-align: center;" class="">
           <img style="width: 150px; height: 80px" src="https://tse3.mm.bing.net/th?id=OIP.BfcTHyffFuM7zsZ55ln5CgHaEo&pid=Api&P=0&h=180" alt="">
           <br> <br>
           <span style="font-size: 20px; color: red; font-weight: 550;">BÁO GIÁ SẢN PHẨM</span>
       </div>
       <br> <br>
       <?php if(isset($_SESSION['id_user'])) { 
        $all = 0;
        foreach($test3 as $row):extract($row); 
        ?>
       <div style="display: flex;align-items: center; justify-content:space-between;" class="">
               <div style="display: flex; align-items:center; width: 30%;" class="">
                   <div class="">
                       <img style="height: 40px; height: 40px;" src="https://tse1.mm.bing.net/th?id=OIP.HvOh4bzeUClbRAK5yUK_ZwHaFU&pid=Api&P=0&h=180" alt="">
                   </div>
                   <div style="margin-left: 20px;" class="">
                       <?= $row['TenSanPham'] ?>
                   </div>
               </div>
               <div style="margin-left: 20px; width: 30%;" class="">x<?=$row['SoLuong1']?></div>
               <div style="color: blue; font-weight: 550;" class=""><?=number_format($row['Gia'], 0, '.', '.')?>đ</div>
       </div>
       <?php $all += $row['ThanhTien']; ?>
       <br> <br> <br>
       <?php endforeach; }  ?>
       <div style="display: flex;align-items: center; justify-content:space-between;" class="">
           <div class="">Tổng tạm tính</div>
           <div class=""><?=number_format($all, 0, '.', '.')?><span style="text-decoration: underline;">đ</span></div>
       </div>
       <div style="display: flex;align-items: center; justify-content:space-between; margin-top: 10px;" class="">
           <div class="">Thành tiền</div>
           <div style="color: blue; font-weight: 550;" class=""><?=number_format($all, 0, '.', '.')?>đ</div>
       </div>
       <div style="text-align: right; font-size: 12px;" class="">(Đã bao gồm VAT)</div>
   </div>  
       
              <script type="text/javascript">
                window.onload = function() {
                window.print();
        };
    </script>
    

</body>
</html>