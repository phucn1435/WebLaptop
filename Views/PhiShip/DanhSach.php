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
        <span class="h3 m-2">Phí ship</span>
        <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            Danh sách
        </span>

    </div>
    <hr>
    <div class="">
     
    <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <form method="get">
                        <div style="display: flex; justify-content: space-around; width: 100%;" class="">
                        <div class="">
                            <select id="province" name="tinh" class="form-control province">
                                <option value="">Chọn một tỉnh</option>
                                <?php foreach($province as $row) : extract($row); ?>
                                <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="">
                            <select id="district" name="quan" class="form-control district">
                                <option value="">Chọn một quận/huyện</option>
                            </select>
                        </div>
                        <div class="">
                            <select id="wards" name="xa" class="form-control wards">
                                    <option value="">Chọn một phường/xã</option>
                            </select>
                        </div> 
                        <hr>
                        <input type="submit" value="Lọc kết quả" class="btn btn-primary">
                        </div>
                    </form>
                    <div class="mt-3" style="text-align: center; color: red;">
                        <?php if(isset($output)) {echo $output;} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-5">
    <form action="" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <input onclick="return confirm('Bạn muốn xóa?')" type="submit" name="delete" value="Delete" class="btn btn-danger">
            </div>
            <div style="text-align: right;" class="col-sm-6">
            <?php if(check('PhiShip/ThemMoi') == true) { ?>
                    <a href="../PhiShip/ThemMoi" class="btn btn-primary">Thêm mới</a>
                    <?php } ?>
            </div>
        </div>
        <table class="table table-condensed table-bordered text-center">
            <tr style="background-color: whitesmoke; color: black; " class="col-6 align-self-center">
              <th><input checked id="checkboxAll" type="checkbox"></th>
              <th>#</th>
              <th>Tỉnh/thành phố</th>
              <th>Quận/huyện</th>
              <th>Phường/xã</th>
              <th>Phí ship</th>
              <th>Action</th>
            </tr>
            <?php 
            $i = 0;
              if(!empty($list)) {
                  if (isset($_GET['page']) && $_GET['page'] == $current || isset($_GET['tennhanvien'])) {
                      $i = ($current * $item1) - $item1;
              } 
                foreach ($list as $row) : extract($row);$i++; ?> 
                <tr>
                  <td><input checked class="checkbox1" type="checkbox" value="<?=$row['ID']?>" name="checkboxID[]"></td>
                  <td><?= $i ?></td>
                  <td>
                    <?= $row['nameProvince'] ?>
                  </td>
                  <td>
                    <?= $row['nameDistrict'] ?>
                  </td>
                  <td>
                    <?= $row['nameWard'] ?>
                  </td>
                  <td <?php if(check('PhiShip/CapNhat&id=123') == true) { ?>  contenteditable="true" <?php  } ?> data-fee_id="<?=$row['ID']?>" class="test1">
                    <?= $row['fee'] ?>
                  </td>
                  <td>
                    <a style="padding: 7px 5px; font-size: 14px; background: red; color: #fff; border-radius: 5px;" href="../PhiShip/Xoa&id=<?=$row['ID']?>" onclick="return confirm('Xác nhận xóa !');">Xóa</a>
                  </td>
                </tr>
                <?php endforeach; } ?>
        </table>
        </form>
        <?php include("Views/PhiShip/PhanTrang.php"); ?>
    </div>
    <script>
    $(document).on('blur', '.test1',function(){
        var a = $(this).data('fee_id');
        var b = $(this).text().trim();
        
        $.ajax({
            url: '../PhiShip/Update',
            method: 'POST',
            data: { token: a,fee:b },
            success: function(data){
                alert('Sửa phí ship thành công');
            }
        });
    });
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
</script>
    <?php
        include "./Views/Layout/footer.php";
    ?>