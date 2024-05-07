<?php include("./Views/HomeLayout/header.php"); ?>
<?php if(isset($_SESSION['id_user'])) { 
    // print_r($test3);
                if(is_array($test3) ){ ?>
<div class="body" style="width: 80%; margin: 0 auto;">

            <form action="" method="POST" enctype="application/x-www-form-urlencoded">
            <div class="" style="width: 100%; display: flex; margin-top: 20px; margin-bottom: 20px;">
                <div class="body-left">
                    <div class="body-left--header">
                        <div style="font-size: 17px; font-weight: bold;" class="">Nhận hàng tại nhà</div>
                        <div class=""></div>
                    </div>
                    <div style="box-shadow:  2px 4px 5px rgb(153, 151, 151); font-weight: 550; color: rgb(99, 98, 98);
                    border-bottom-left-radius: 7px; border-top-bottom-radius: 7px;" class="body-left--body">
                        <div class="info-recieved">
                            <div class="">Thông tin nhận hàng</div>
                            <!-- <input type="text" name="mon1" value="<?=$row['ID']?>"> -->
                            <p style="margin-bottom: 0; color: red; text-align: center;"><?php if(!empty($thongbao)) { echo $thongbao;} ?></p>
                           
                            <input type="hidden" value="<?= $mon  ?? $row['ID'] === $_SESSION['cart']['id_dc'] ?>" id="mon1" name="mon1">
                            <input type="hidden" value="<?=$phantramgiam;?>" name="phantram">
                            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; width: 100%;" class="">
                          
                            <?php
                            if (is_array($getData)) {
                            
                            foreach($getData as $row) : extract($row); ?>
                                <div style="<?php if($row['ID'] === $mon ) { echo "border: 1px solid blue;";} ?>position: relative; height: auto;display: flex; align-items: center; justify-content: center;border-radius: 7px;" class="add-info" >
                                    <!-- <button style="width: 100%; height: 100%; background: transparent; border: none;" id="buttonnay" type="button"> -->
                                        <button id="test_nha" value="<?=$row['ID']?>" type="submit" name="selectAD" style="padding: 10px; text-align: center; font-size: 20px; border: none; background:transparent; width: 100%; height: 100%;" class="">
                                            <div style="text-align: left;" class="">
                                                <div style="line-height: 1;"  class="">
                                                    <span style="font-size: 14px;"><?=$row['hoten']?></span>
                                                </div>   
                                                <div style="line-height: 1;" class="">
                                                    <span style="font-size: 14px; "><?=$row['SDT']?></span>
                                                </div> 
                                                <?php $diachi = $row['nameProvince'] . "," . $row['nameDistrict'] . "," . $row['nameWard'] . "," . $row['cuthe']; ?>
                                                <div style="line-height: 1;" class="">
                                                    <span style="font-size: 14px; "><?=$diachi;?></span>
                                                </div>
                                            </div>
                                            <button data-trash_value="<?=$row['ID']?>" class="trash" type="button" style="border: none; background: transparent; display: <?php if( $row['ID'] === $mon ) { echo "inline-block";} else { echo "none";} ?>;"><i style="font-size: 20px; bottom: 0; position: absolute; right: 40px; margin-bottom: 15px;" class="fa-solid fa-trash"></i> </button>

                                            <!-- <input type="hidden" name="sub" value="<?=$row['ID']?>"> -->
                                            <button class="showFormButton1" type="button" style="border: none; background: transparent; display: <?php if( $row['ID'] === $mon ) { echo "inline-block";} else { echo "none";} ?>;"><i style="font-size: 20px; bottom: 0; position: absolute; right: 10px; margin-bottom: 15px;" class="fa-regular fa-pen-to-square"></i></button>
                                        </button>
                                       
                                    <!-- </button> -->
                                   
                                    <?php if($mon !== 0 && $row['ID'] === $mon ) { ?>
                                    <div class="show-check"></div>
                                    <i class="fa-solid fa-check fa-check1"></i>
                                    <?php } elseif($mon === 0 && (isset($_SESSION['cart']) && ($_SESSION['cart']['id_dc']) === $row['ID'])) { ?>
                                        <div class="show-check"></div>
                                        <i class="fa-solid fa-check fa-check1"></i>
                                    <?php } ?>   
                                </div>
                               
                            <?php endforeach; } ?>
                                        
                                <div style="display: flex; align-items: center; justify-content: center;border-radius: 7px; height: 100px;" class="add-info">
                                    <!-- <button style="width: 100%; height: 100%;" type="submit" name="themdiachi">  -->
                                        <button id="showFormButton" style="font-size: 20px; border: none; background:transparent;" class="">
                                            <i class="fa-solid fa-plus"></i> <br> 
                                            <span>Thêm địa chỉ</span>
                                        </button>
                                    <!-- </button> -->
                                </div> 
                            </div>
                           
                                        
                            <div class="">Nhận hóa đơn qua email</div>
                            <div class="receive-through-email">
                                <?php  ?>
                                <input value="<?php if (isset($_SESSION['cart']['id_dc'])) {$LayEmail = $this->khachhang->getEmail($_SESSION['cart']['id_dc']); echo $LayEmail[0]['Email'];}  ?>" class="form-control" style="padding: 0 10px;" placeholder="Nhập email nhận thông tin" name="email" type="text">
                            </div>
                                <?php if(isset($_SESSION['error'])) { ?>
                                    <span style="color: red;"><?=$_SESSION['error'];?></span>
                                <?php } ?>
                        </div>
                    </div>
                    <div style="margin-top: 15px; box-shadow:  2px 4px 5px rgb(153, 151, 151); font-weight: 550; color: rgb(99, 98, 98); border-radius: 7px;
                    " class="">
                        <div style="margin-left: 20px; padding: 10px;" class="notice-bill">Ghi chú cho đơn hàng</div>
                        <!-- <form action="" method="POST"> -->
                            <div style="margin: 0px 20px;" class="notice-bill-input">
                                <input value="<?= isset($_SESSION['cart']['ghi_chu']) ? $_SESSION['cart']['ghi_chu'] : false; ?>" class="form-control" name="ghichu" placeholder="Nhập thông tin ghi chú cho bán hàng" style="padding: 0 10px;" type="text">
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
                
                <div style="width: 31%; margin-left: 15px;" class="body-right">
                    <div style="width: 100%; padding: 10px 20px; box-shadow:  2px 4px 5px rgb(153, 151, 151); border-radius: 7px;
                    " class="">
                        <div style="display: flex; justify-content: space-between; padding-bottom: 10px;" class="">
                            <div style="font-size: 20px; font-weight: 600;" class="">Thông tin đơn hàng</div>
                            <div class=""><a style="text-decoration: none;" href="../TrangChu/Giohang1">Chỉnh sửa</a></div>
                        </div>
                        <div style="padding-bottom: 20px;" class="">
                            <?php $thanhtien = 0; $all = 0; $tamtinh = 0;?>
                            <?php foreach($test3 as $row) : extract ($test3); ?>
                            <div style="display: flex; align-items: center; width: 100%; margin-top: 15px;" class="">
                                <div style="border: 1px solid gray; border-radius: 7px; overflow: hidden; padding-right: 25px;" class="">
                                    <img style="width: 78.4px; height: 78.4px; " src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh']?>" alt="">
                                </div>
                                <div style="margin-left: 15px; width: 100%;" class="">
                                    <div style="color: rgb(101, 101, 101); font-size: 15px;" class="name-product--bill"><span><?=$row['TenSanPham']?></span></div>
                                    <div style="color: rgb(152, 152, 152); font-size: 14px;" class="">Số lượng <?=$row['SoLuong1']?></div>
                                    <?php if($row['GiaKhuyenMai'] != 0) { $phantram = round(( ($row['Gia'] - $row['GiaKhuyenMai']) / $row['Gia']) * 100,2); ?>
                                      
                                      <span class="hehe"><?= number_format($row['GiaKhuyenMai'], 0, '.', '.')?> đ</span> <br>
                                      <span class="xoa"><?= number_format($row['Gia'], 0, '.', '.')?> đ</span> <span class="css-1f8jk2s"><?=$phantram;?>%</span> 
                                    <?php } else { ?>
                                      <div style="color: 16px; font-weight: 550; " class=""><?=number_format($row['Gia'], 0, '.', '.');?>đ</div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php $tamtinh += $row['ThanhTien']; if($row['ThanhTienCoMaGiam'] != 0) {$thanhtien += $row['ThanhTienCoMaGiam'] ;} else {$thanhtien += $row['ThanhTien'];} $all += $thanhtien; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div style="width: 100%; margin-top: 30px; box-shadow:  2px 4px 5px rgb(136, 136, 136); border-radius: 7px;
                    " class="">
                        <table style="width: 100%; padding: 10px 20px;">
                            <tr>
                                <th style="text-align: left; color: rgb(165, 161, 161); font-weight: 400; padding: 10px; ">Tổng tạm tính</th>
                                <th style="text-align: right; padding: 10px;"><?=number_format($tamtinh, 0, '.', '.');?>đ</th>
                            </tr>
                            <?php foreach($test3 as $row) : extract($row); ?>
                           
                          
                           <?php if(($row['code_giam']) != "") { ?>
                               <?php $mang = explode(",", $row['code_giam']); 
                               
                               for ($i = 0; $i < count($mang); $i++) { ?>  
                               <?php if ($this->magiam->LuongGiam($mang[$i])[0]['ID_loai'] == 1) { $donvi = '%';} else { $donvi = 'VND'; } ?>
                               <tr style="background: pink;">
                                   <td style="padding: 10px 5px;">Mã giảm: <span style="font-size: 14px; font-weight: bold;"><?=$mang[$i];?></span></td>
                                   <td style="text-align: right; font-size: 14px; font-weight: bold;">- <?php echo $this->magiam->LuongGiam($mang[$i])[0]['luonggiam'] . $donvi; ?></td>
                               <input type="hidden" id="tongtamtinh" name="tongtamtinh" value="<?=$all;?>">
                           </tr>
                           <?php } } endforeach; ?>
                            <tr>
                                <td style="color: rgb(165, 161, 161); font-weight: 400; padding: 10px;">Phí vận chuyển</td>
                                <td style="text-align: right; padding: 10px;font-weight: 700; font-size: 15px;"><?php if(isset($_SESSION['cart'])) {echo number_format($_SESSION['cart']['fee'], 0, '.', '.');} ?>đ</td>
                            </tr>
                            <tr>
                                <td style="color: rgb(165, 161, 161); font-weight: 400; padding: 10px;">Thành tiền</td>
                                <?php if(isset($_SESSION['cart'])) {$thanhtien = $thanhtien - $_SESSION['cart']['fee'];} ?>
                                <td style="text-align: right; padding: 10px 10px 0 10px; color: rgb(235, 33, 1); font-weight: 700; font-size: 24px;"><?=number_format($thanhtien, 0, '.', '.');?>đ</td>
                            </tr>
                            <tr>
                                <td style="text-align: right; color: rgb(165, 161, 161); font-weight: 400;" colspan="2">(Đã bao gồm VAT)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="2">
                                  <input class="btn btn-primary" style="width: 100%;" type="submit" name="submitDH" value="Tiếp tục">
                                </td>
                            </tr>
                        </table>
                        <div style="padding: 10px 20px;" class="">
                            <p>Nhấn "Thanh toán" đồng nghĩa với việc bạn đọc và đồng ý tuân theo <a href="#">Điều khoản và Điều kiện</a></p>
                        </div>
                        
                    </div>
                </div>
            </div> 
            </form>
            <!-- <?php echo $_SESSION['cart']['id_dc']; ?> -->
        </div>
        <?php } else {  ?>
            <div class="body" style="width: 100%; background: #f8f8f8; height: 70vh; position: relative;">
                <div style="position: absolute; bottom: 0; left: 50%;">
                    <a href="../TrangChu/Index" class="btn btn-primary">Mua sắm ngay</a>
                </div>
            </div>

            <?php } } ?> 
        <script>
              document.getElementById('showFormButton').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn reload trang mặc định
            // Hiển thị form
            
            showForm1();
            $(document).ready(function() {
          $(".wards").prop("disabled", true);
          $(".district").prop("disabled", true);
    // Listen for changes in the "province" select box
    $('.province').on('change', function() {
      var province_id = $(this).val();
      
      // console.log(province_id);
      if (province_id) {
        // If a province is selected, fetch the districts for that province using AJAX
        $.ajax({
          url: '../TrangChu/ajax1',
          method: 'GET',
          dataType: "json",
          data: {
            province_id: province_id
          },
          success: function(data) {
            // Clear the current options in the "district" select box
            $('.district').empty();
            $(".district").prop("disabled", false);
           
            
            // Add the new options for the districts for the selected province
            $.each(data, function(i, district) {
              // console.log(district);
              $('.district').append($('<option>', {
                value: district.id,
                text: district.name
              }));
            });
            // Clear the options in the "wards" select box
            $('.wards').empty();
            

          },
          error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
          }
        });
        $('.wards').empty();
        
      } else {
        // If no province is selected, clear the options in the "district" and "wards" select boxes
        $('.district').empty();
      }
    });

    // Listen for changes in the "district" select box
    $('.district').on('change', function() {
      var district_id = $(this).val();
      // console.log(district_id);
      if (district_id) {
        // If a district is selected, fetch the awards for that district using AJAX
        $.ajax({
          url: '../TrangChu/ajax2',
          method: 'GET',
          dataType: "json",
          data: {
            district_id: district_id
          },
          success: function(data) {
            // console.log(data);
            // Clear the current options in the "wards" select box
            $('.wards').empty();
            $(".wards").prop("disabled", false);  
            // Add the new options for the awards for the selected district
            $.each(data, function(i, wards) {
              $('.wards').append($('<option>', {
                value: wards.id,
                text: wards.name
              }));
            });
          }, 
          error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
          }
        });
      } else {
        // If no district is selected, clear the options in the "award" select box
        $('.wards').empty();
      }
    });
  });
            
            });


           
        </script>
        <script>
            var radioButtons = document.querySelectorAll('input[type=radio]');

// Lặp qua từng radio button và gán sự kiện onchange
radioButtons.forEach(function(radioButton) {
  radioButton.addEventListener('change', function() {
    // Xử lý khi có sự thay đổi trong radio button được chọn
    var selectedValue = this.value;
    console.log('Đã chọn: ' + selectedValue);
  });
});
        </script>
        <script>
            $('#saveAddress1').click(function(){
                var hoten = $('#hoten').val();
                var email = $('#email').val();
                var sdt = $('#sdt').val();
                var province = $('#province').val();
                var district = $('#district').val();
                var wards = $('#wards').val();
                var cuthe = $('#cuthe').val();
               
                $.ajax({
                    url: "../TrangChu/xuli",
                    method: "POST",
                    data: {hoten: hoten, email: email, sdt: sdt, province: province, district: district, wards: wards, cuthe: cuthe},

                    success: function(data){
                        $('#error').html(data);
                    }
                });
            });
        </script>

        <script>
            $('#updateTT').click(function(){
                var hoten = $('#hoten1').val();
                var email = $('#email1').val();
                var sdt = $('#sdt1').val();
                var province = $('#province1').val();
                var district = $('#district1').val();
                var wards = $('#wards1').val();
                var cuthe = $('#cuthe1').val();
               
                $.ajax({
                    url: "../TrangChu/xuli1",
                    method: "POST",
                    data: {hoten: hoten, email: email, sdt: sdt, province: province, district: district, wards: wards, cuthe: cuthe},

                    success: function(data){
                        $('#error1').html(data);
                    }
                });
            });
        </script>
        <script>
            $('.trash').click(function(){
                var a = $(this).data('trash_value');
                $.ajax({
                    url: "../TrangChu/trash_ad",
                    method: "POST",
                    data: {data: a},

                    success: function(data){
                        window.location.href = "../TrangChu/DatHang";
                    }
                });
            });
        </script>
        <script>
            $('.showFormButton1').click( ()=> {
                showForm();
                $(document).ready(function() {
          $(".wards").prop("disabled", true);
          $(".district").prop("disabled", true);
    // Listen for changes in the "province" select box
    $('.province').on('change', function() {
      var province_id = $(this).val();
      
      // console.log(province_id);
      if (province_id) {
        // If a province is selected, fetch the districts for that province using AJAX
        $.ajax({
          url: '../TrangChu/ajax1',
          method: 'GET',
          dataType: "json",
          data: {
            province_id: province_id
          },
          success: function(data) {
            // Clear the current options in the "district" select box
            $('.district').empty();
            $(".district").prop("disabled", false);
           
            
            // Add the new options for the districts for the selected province
            $.each(data, function(i, district) {
              // console.log(district);
              $('.district').append($('<option>', {
                value: district.id,
                text: district.name
              }));
            });
            // Clear the options in the "wards" select box
            $('.wards').empty();
            

          },
          error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
          }
        });
        $('.wards').empty();
        
      } else {
        // If no province is selected, clear the options in the "district" and "wards" select boxes
        $('.district').empty();
      }
    });

    // Listen for changes in the "district" select box
    $('.district').on('change', function() {
      var district_id = $(this).val();
      // console.log(district_id);
      if (district_id) {
        // If a district is selected, fetch the awards for that district using AJAX
        $.ajax({
          url: '../TrangChu/ajax2',
          method: 'GET',
          dataType: "json",
          data: {
            district_id: district_id
          },
          success: function(data) {
            // console.log(data);
            // Clear the current options in the "wards" select box
            $('.wards').empty();
            $(".wards").prop("disabled", false);  
            // Add the new options for the awards for the selected district
            $.each(data, function(i, wards) {
              $('.wards').append($('<option>', {
                value: wards.id,
                text: wards.name
              }));
            });
          }, 
          error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
          }
        });
      } else {
        // If no district is selected, clear the options in the "award" select box
        $('.wards').empty();
      }
    });
  });
            
            });
            //  document.getElementsByClassName('showFormButton1').addEventListener('click', function(event) {
            // event.preventDefault(); // Ngăn chặn reload trang mặc định
            // // Hiển thị form
            
            //   showForm();
            //  });
        </script>
        <!-- <script>
              $('#test_nha').click(function(){
            // const loaitruyen = $(this).val();
            var truyen_id = $(this).data('value_button');
            alert(truyen_id);
            // var _token = $('input[name="_token"]').val();
            // $.ajax({
            //     url: "{{ url('/loai-truyen') }}",
            //     method: "POST",
            //     data: {loaitruyen: loaitruyen, truyen_id: truyen_id, _token: _token},
            //     success:function() {
            //         alert('Thanh cong');
            //     }
            // });
        });
        </script> -->

        <!-- <script>
            $.ajax(function(){
                var a = $('#mon1').val();

                url: "../TrangChu/CNDC",
                method: "POST",
                data: {data: a},
                success: function() {
                    alert("OKE");
                }
            });
        </script> -->
<?php include("./Views/HomeLayout/footer.php"); ?>

