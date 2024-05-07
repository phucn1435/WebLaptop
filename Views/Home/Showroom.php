<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Danh sách sản phẩm theo loại sản phẩm</title>";
?>
<div class="container p-3">
    <div class="row">
        <div class="col-md-6 p-3">
            <form action="" method="POST">
                
                <div class="p-5" style="background: blue;">
                    <h5 style="color: #fff; font-weight: bold; ">Chọn Showroom theo tỉnh/thành phố</h5>
                    <select name="province_showroom" class="form-select mt-3 province" id="" >
                        <option selected value="0">Chọn tỉnh/thành phố</option>
                        <?php foreach($province as $row) : extract($row); ?>
                        <option value="<?=$row['province_id']?>"><?= $row['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="district_showroom" class="form-select mt-4 district" id="">
                        <option selected value="">Chọn quận/huyện</option>
                    </select>
                    <div class="text-center mt-3">
                        <input type="submit" value="Xem kết quả" name="show_kq" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
        <!-- <?php print_r($show); ?> -->
        <div style="border: 1px solid blue;" class="col-md-6 p-3">
            <div class="row">
                <?php $i = 0; ?>
                <?php if (is_array($show)) { foreach($show as $row) : extract($row) ; ?>
                <div class="col-md-12 p-3">
                    <h4 style="text-transform: uppercase;"><?=$row['ten']?></h4>
                    <div class="row">
                        <div class="col-md-12">Địa chỉ: <?=$row['cuthe'] .', '. $row['ward'] .', '. $this->donhangban->nameDistrict($row['district'])[0]['name'] .', '. $this->donhangban->nameCity($row['province'])[0]['name']?> </div>
                        <div class="col-md-12"><?=$row['mota'];?></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">Giờ mở cửa: 09h00 - 18h00</div>
                                <div class="col-md-6" style="text-align: right;">
                                    <button type="button" data-test="<?=$row['ID']?>" class="show_showroom btn btn-primary w-50">Tìm đường <i style="font-size: 13px;" class="fa-solid fa-arrow-up"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div style="display: none;" class="show_sr_<?=$row['ID']?>">
                    <?=$row['iframe'];?><!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7049.320805691968!2d106.69720240135653!3d10.742027284480546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f9f2353ffb9%3A0x6ab49da47594ce7b!2sLOTTE%20Mart%20Qu%E1%BA%ADn%207!5e0!3m2!1svi!2s!4v1699254753933!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                </div>
                <?php endforeach; } else { ?>
                    <p style="text-align: center; color: red; font-size: 18px; font-weight: bold;">Không có showroom ở khu vực bạn chọn</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    

    $(document).ready(function() {
            $(".show_showroom").click(function() {
                // Lấy trạng thái hiện tại của phần tử
                const a = $(this).data('test');
                // alert(a);
                var currentDisplay = $(".show_sr_"+a).css("display");

                if (currentDisplay === "block") {
                    // Nếu đang hiển thị (block), thì chuyển sang ẩn (none)
                    $(".show_sr_"+a).css("display", "none");
                } else {
                    // Nếu đang ẩn (none), thì chuyển sang hiển thị (block)
                    $(".show_sr_"+a).css("display", "block");
                }
            });

        //     $(".wards").prop("disabled", true);
        //   $(".district").prop("disabled", true);
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
                    // $(".district").prop("disabled", false);
                
                    
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
                    // $('.wards').empty();
                    // $(".wards").prop("disabled", false);  
                    // Add the new options for the awards for the selected district
                    // $.each(data, function(i, wards) {
                    // $('.wards').append($('<option>', {
                    //     value: wards.id,
                    //     text: wards.name
                    // }));
                    // });
                }, 
                error: function(xhr, textStatus, errorThrown) {
                    console.log('Error: ' + errorThrown);
                }
                });
            } 
            // else {
            //     // If no district is selected, clear the options in the "award" select box
            //     $('.wards').empty();
            // }
            });
        });
</script>

<?php
    include "./Views/Layout/footer.php";
?>
