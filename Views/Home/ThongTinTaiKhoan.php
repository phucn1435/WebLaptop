<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Thông tin tài khoản</title>";
?>
<style>
    
    
    .container-address1 {
        width: 100%;
        height: 100%;
        background: red;
        /* display: none; */
        /* position: absolute; */
        /* z-index: -1; */
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-address2 {
        width: 512px;
        height: auto;
        background: yellow;
        /* display: none; */
        position: absolute;
    }
</style>
        <div class="body klkl" style="width: 80%; margin: 12px auto 0;">
            <div style="width: 100%; height: 100%;" class="">
                <div id="formInputAdress"  class="account-info--container">
                    <?php foreach($thongtin as $row) : extract ($row); ?>
                    <?php include("./Views/HomeLayout/sideleft.php"); ?>
                    <div class="account-info--container-center">
                        <div style="padding: 15px;" class="">
                            <p style="font-size: 20px; font-weight: 550;">Thông tin tài khoản</p>
                            <p style="text-align: center; color: red; margin-bottom: 0;"><?php echo $alert; ?></p>
                            <form action="" method="post" enctype="multipart/form-data">
                            <div style="text-align: center;" class="" >
                                <img style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;" src="../Assets/data/AvatarKhachHang/<?=$row['AnhDaiDien'];?>" alt="">
                                <br>
                                <input type="file" name="image">
                            </div>
                            <div class="info-user">
                                <label for="">Họ tên</label> <br>
                                <input name="nameCustomer" style="padding-left: 10px;" class="input-update-info" type="text" value="<?=$row['TenKhachHang']?>">  
                            </div>
                            <div class="info-user">
                                <label for="">Email</label> <br>
                                <input name="email" style="padding-left: 10px;" class="input-update-info" type="text" value="<?=$row['Email'];?>">  
                            </div>
                            <div class="info-user">
                                <label for="">Số điện thoại</label> <br>
                                <input name="numberPhone" style="padding-left: 10px;" class="input-update-info" type="text" value="<?=$row['SoDienThoai'];?>">  
                            </div>
                            <div class="info-user">
                                <label for="">Ngày sinh</label> <br>
                                <input name="birthday" style="padding-left: 10px;" class="input-update-info button-date" type="date" value="<?=$row['NgaySinh'];?>">  
                            </div>
                            <div class="info-user">
                                <label for="">Giới tính</label> <br>
                                <input id="nam" name="gender" type="radio" value="1"> Nam
                                <input id="nu" name="gender" class="radio" value="0" type="radio"> Nữ 
                                <input id="khac" name="gender" class="radio" type="radio"> Khác
                                
                                <?php if($row['GioiTinh'] == 1) { ?>
                                    <script>document.getElementById('nam').checked = true;</script>
                                <?php } elseif($row['GioiTinh'] == 0 ) { ?>
                                    <script>document.getElementById('nu').checked = true;</script>
                                <?php } else { ?>
                                    <script>document.getElementById('khac').checked = true;</script>
                                <?php } ?>
                            </div>
                            <div style="margin-top: 10px;" class="">
                                <a href="../TrangChu/DoiMatKhau" class="btn btn-primary">Đổi mật khẩu</a>
                            </div>
                            <div style="width: 100%; height: auto;" class="info-user">
                                <input style="margin: 0 auto; width: 100%; background: blue; color: white;"  name="submitCapNhat" class="button-update-info--user" type="submit" value="Cập nhật">
                            </div>
                            </form>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="account-info--container-right">
                        <div style="padding: 15px; box-shadow:  1px 1px 5px 2px rgb(153, 151, 151); border-radius: 7px;" class="">
                            <?php 
                                if($this->khachhang->CheckAD($_SESSION['id_user']) < 1) {
                               ?>
                                <p style="font-size: 20px; font-weight: bold;">Địa chỉ mặc định</p>
                                <p style="color: rgb(160, 159, 159); font-size: 14px;">Bạn chưa có địa chỉ nhận hàng mặc định. Vui lòng chọn Thêm địa chỉ nhận hàng.</p> 
                            <hr>
                            <div style="margin-top: 15px;" class="">
                                <button type="button" id="showFormButton" style="color: blue; border: none; background: transparent;" ><i class="fa-solid fa-plus"></i><span style="margin-left: 10px;">Thêm địa chỉ nhận hàng</span></button>
                            </div> 

                            <?php } else { 
                                foreach($getData as $row) : extract ($row); ?>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class="">
                                <div style="font-size: 20px; font-weight: bold;">Địa chỉ mặc định</div> 
                                <div class="">
                                    <button type="button" id="showFormNay" style="border: none; background: transparent;" ><i style="font-size: 22px;" class="fa-regular fa-pen-to-square"></i> </button>
                                </div>
                            </div>
                          
                            <div style="margin-top: 12px;" class="">
                                <label style="margin-bottom: 2px; font-size: 15px; font-weight: 550;" for="">Tỉnh/Thành phố</label> <br>
                                <input value="<?=$row['nameProvince'];?>" style="width: 100%; height: 40px; border-radius: 7px; border: 1px solid gray; padding-left: 10px; background: rgb(246,246,246);" disabled type="text">
                            </div>
                            <div style="margin-top: 12px;" class="">
                                <label style="margin-bottom: 2px; font-size: 15px; font-weight: 550;" for="">Quận/Huyện</label> <br>
                                <input value="<?=$row['nameDistrict'];?>" style="width: 100%; height: 40px; border-radius: 7px; border: 1px solid gray; padding-left: 10px; background: rgb(246,246,246);" disabled type="text">
                            </div>
                            <div style="margin-top: 12px;" class="">
                                <label style="margin-bottom: 2px; font-size: 15px; font-weight: 550;" for="">Phường/Xã</label> <br>
                                <input value="<?=$row['nameWard'];?>" style="width: 100%; height: 40px; border-radius: 7px; border: 1px solid gray; padding-left: 10px; background: rgb(246,246,246);" disabled type="text">
                            </div>
                            <div style="margin-top: 12px;" class="">
                                <label style="margin-bottom: 2px; font-size: 15px; font-weight: 550;" for="">Địa chỉ cụ thể</label> <br>
                                <input value="<?=$row['cuthe'];?>" style="width: 100%; height: 40px; border-radius: 7px; border: 1px solid gray; padding-left: 10px; background: rgb(246,246,246);" disabled type="text">
                            </div>
                            <?php endforeach; }  ?>
                        </div>
                    </div>
                </div>
                <script>
                    function showForm2() {
                        // event.preventDefault();
                        const formContainer = document.getElementById('inform-receiveProduct2');
                        // const overlay = document.createElement('div');
                        // overlay.classList.add('overlay');
                        const test10 = document.getElementById('container10');
                        
                        // document.body.style.opacity = '0.5'; // Làm mờ body
                        // document.body.appendChild(overlay);
                        test10.style.opacity = '0.5';
                        formContainer.style.display = 'block';
                        
                        test10.style.pointerEvents = "none";
                        document.body.style.overflow = "hidden";
                        formContainer.style.animation = 'slideDown 0.5s'; 
                    }
                    document.getElementById('showFormButton').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn reload trang mặc định
            // Hiển thị form
            
            showForm2();
            $(document).ready(function() {
          $(".wards").prop("disabled", true);
          $(".district").prop("disabled", true);
    // Listen for changes in the "province" select box
    $('.province').on('change', function() {
      var province_id = $(this).val();
      // alert(province_id);
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
            

                    function hideForm2() {
                        const formContainer = document.getElementById('inform-receiveProduct2');
                        // const overlay = document.querySelector('.overlay');
                        const test10 = document.getElementById('container10');
                        formContainer.style.animation = 'slideUp 0.5s forwards';
                        setTimeout(() => {
                        formContainer.style.display = 'none';
                        test10.style.opacity = '1';
                        document.body.style.overflow = "auto";
                        test10.style.pointerEvents = "auto";

                        formContainer.style.animation = '';
                        }, 500);

                        // document.body.removeEventListener("click", arguments.callee);
                        // overlay.parentNode.removeChild(overlay);
                    }
                </script>
                <script>
                  $('#showFormNay').click(()=>{
                    showForm2();

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
               $('#updateTT1').click(function(){
                var hoten = $('#hoten3').val();
                var email = $('#email3').val();
                var sdt = $('#sdt3').val();
                var province = $('#province3').val();
                var district = $('#district3').val();
                var wards = $('#wards3').val();
                var cuthe = $('#cuthe3').val();
               
                $.ajax({
                    url: "../TrangChu/xuli2",
                    method: "POST",
                    data: {hoten: hoten, email: email, sdt: sdt, province: province, district: district, wards: wards, cuthe: cuthe},

                    success: function(data){
                        $('#error2').html(data);
                    }
                });
            });
        </script>

<script>
               $('#updateTT3').click(function(){
                var hoten = $('#hoten4').val();
                var email = $('#email4').val();
                var sdt = $('#sdt4').val();
                var province = $('#province4').val();
                var district = $('#district4').val();
                var wards = $('#wards4').val();
                var cuthe = $('#cuthe4').val();
               
                $.ajax({
                    url: "../TrangChu/xuli3",
                    method: "POST",
                    data: {hoten: hoten, email: email, sdt: sdt, province: province, district: district, wards: wards, cuthe: cuthe},

                    success: function(data){
                        $('#error3').html(data);
                    }
                });
            });
        </script>
               
            </div>
        </div>

        
        
<?php include "./Views/HomeLayout/footer.php" ?>






