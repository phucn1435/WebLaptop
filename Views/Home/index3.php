<?php
include_once("Models/Database.php");
//Checklist
/*
    1. Chuẩn bị Có sở dữ liệu
    2. Tạo giao diện
    3. Connect Db
    4. Get Province
    5. Ajax show District
    6. Ajax show Awards
    7. Show kết quả
    */
    $this->db = new Database();

$sql = "SELECT * FROM province";
$result = mysqli_query($this->db->conn, $sql);


if (isset($_POST['add_sale'])) {
    echo "<pre>";
    print_r($_POST);
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   
    <title>Document</title>
</head>

<body>

    <div class="container">
        <form id="myForm" class="mt-5" method="POST">
            <h1 class="py-5">Chọn địa chỉ khi đặt hàng trong website</h1>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành phố</label>
                        <select id="province" name="province" class="form-control">
                            <option value="">Chọn một tỉnh</option>
                            <!-- populate options with data from your database or API -->
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district">Quận/Huyện</label>
                        <select id="district" name="district" class="form-control">
                            <option value="">Chọn một quận/huyện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wards">Phường/Xã</label>
                        <select id="wards" name="wards" class="form-control">
                            <option value="">Chọn một xã</option>
                        </select>
                    </div>
                    <input type="submit" name="add_sale" class="btn btn-primary w-100 form-input my-3" value="Đặt hàng">

                </div>
            </div>
        </form>
    </div>
   
    <script>
       $(document).ready(function() {
    // Listen for changes in the "province" select box
    $('#province').on('change', function() {
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
            $('#district').empty();

            // Add the new options for the districts for the selected province
            $.each(data, function(i, district) {
              // console.log(district);
              $('#district').append($('<option>', {
                value: district.id,
                text: district.name
              }));
            });
            // Clear the options in the "wards" select box
            $('#wards').empty();
          },
          error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
          }
        });
        $('#wards').empty();
      } else {
        // If no province is selected, clear the options in the "district" and "wards" select boxes
        $('#district').empty();
      }
    });
    
    // Listen for changes in the "district" select box
    $('#district').on('change', function() {
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
            $('#wards').empty();
            // Add the new options for the awards for the selected district
            $.each(data, function(i, wards) {
              $('#wards').append($('<option>', {
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
        $('#wards').empty();
      }
    });
  });
  
    </script>
</body>

</html>