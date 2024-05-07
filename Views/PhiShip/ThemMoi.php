<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm phí ship</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Thêm phí ship</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../PhiShip/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Thêm mới
    </span>
    
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tỉnh/thành phố</label>
        <select id="province" name="tinh" class="form-control province">
            <option value="">Chọn một tỉnh</option>
            <?php foreach($province as $row) : extract($row); ?>
            <option value="<?=$row['province_id']?>"><?=$row['name']?></option>
            <?php endforeach; ?>
        </select> <br>  
        <label class="h6">Quận/huyện</label>
        <select id="district" name="quan" class="form-control district">
            <option value="">Chọn một quận/huyện</option>
        </select>
        <label class="h6">Phường/xã</label>
        <select id="wards" name="xa" class="form-control wards">
            <option value="">Chọn một phường/xã</option>
        </select>
        <label class="h6">Phí ship</label>
        <input type="text" value=""name="feeShip" class="form-control"><br>
        <div class="" style="text-align: center; color: green; font-weight: bold;">
            <?php if(isset($notice)) {echo $notice;} ?>
        </div>
        <hr>
        <input type="submit" value="Submit" name="saveFee" class="btn btn-primary">
        <a class="btn btn-warning" href="../PhiShip/DanhSach">Return</a>
    </form>
</div>
<script>
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