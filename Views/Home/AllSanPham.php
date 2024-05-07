<?php
    include "./Views/HomeLayout/header.php";
?>
<style>
    .red {
        color: red;
    }

    .wrapper-select-price, .wrapper-select-brands, .wrapper-select-demand {
        display: block;
    }

    .range-input{
    position: relative;
    }

    #selectPrice:hover, #selectBrands, #selectDemands:hover, .fa-circle-xmark {
        cursor: pointer;
    }
.range-input input{
  position: absolute;
  width: 100%;
  height: 5px;
  top: -10px;
  background: none;
  pointer-events: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}
input[type="range"]::-webkit-slider-thumb{
  height: 17px;
  width: 17px;
  border-radius: 50%;
  background: #17A2B8;
  pointer-events: auto;
  -webkit-appearance: none;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}

input[type="range"]::-moz-range-thumb{
  height: 17px;
  width: 17px;
  border: none;
  border-radius: 50%;
  background: #17A2B8;
  pointer-events: auto;
  -moz-appearance: none;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}

.delete_filter:hover {
    cursor: pointer;;
}
</style>
<div class="body" style="width: 80%; margin: 20px auto 20px; ">
            <div class="body-allproduct">
                <div style="height: auto;" class="body-allproduct-left">
                <h4>Bộ lọc</h4>
    
                <div style="padding: 10px;" class="" id="selectPrice">
                    <span class="selectPrice-element" style="padding: 5px 10px; background: #ccc; border-radius:  10px;"><i class="fa-solid fa-money-bill"></i> Giá</span>
                </div>
                <div class="">
                    <input id="min1" type="range" min="0" max="<?=$giacaonhat[0]['GiaCaoNhat'] + 3000000;?>" value="<?=isset($_GET['price_gte']) ? $_GET['price_gte'] : 0 ;?>" step="500000">
                    <input id="max1" type="range" min="0" max="<?=$giacaonhat[0]['GiaCaoNhat'] + 3000000;?>" value="<?=isset($_GET['price_lte']) ? $_GET['price_lte'] : $giacaonhat[0]['GiaCaoNhat'] + 3000000 ;?>" step="500000">
                </div>
                <!-- <div style="box-shadow: 1px 2px 3px 4px #ccc; border-radius:5px; padding: 10px;" class="wrapper-select-price"> -->
                        <!-- <div style="" class="price-input">
                            <div class="field">
                                <span>Thấp nhất</span>
                                <input class="form-control" type="number" class="input-min" value="<?=$giathapnhat[0]['GiaThapNhat'] - 2500000; ?>">
                            </div>
                           
                            <div class="field">
                                <span>Cao nhất</span>
                                <input class="form-control" type="number" class="input-max" value="<?=$giacaonhat[0]['GiaCaoNhat'] + 2500000; ?>">
                            </div>
                        </div> -->
                        <!-- <div style="margin-top: 10px;" class=""> -->
                        <!-- <div style="margin-top: 10px;" class="slider">
                            <div class="progress"></div>
                        </div> -->

                        <!-- <div style="" class="range-input"> -->

                                <!-- <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                                <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">         -->
                                
                                <!-- <input type="range" id="max" class="range-min" min="0" max="<?=$giacaonhat[0]['GiaCaoNhat'] + 3000000;?>" value="1000000" step="500000"> -->
                                <!-- <input type="range" id="min" class="range-max" min="0" max="<?=$giacaonhat[0]['GiaCaoNhat'] + 3000000;?>" value="7500000" step="500000">  -->
                        <!-- </div> -->
                        <!-- <div style="display: flex; justify-content: space-between;" class="mt-3">
                            <button class="btn btn-primary" type="button" id="clickPrice3">Xem</button>
                            <button class="btn btn-danger" type="button" id="clickPrice4">Hủy bỏ</button>
                        </div> -->
                       
                    <!-- </div> -->    
                <!-- </div> -->

                <div style="padding: 10px;" class="" id="selectBrands">
                    <span class="selectBrand-element" style="padding: 5px 10px; background: #ccc; border-radius:  10px;"><i class="fa-solid fa-money-bill"></i> Hãng sản xuất</span>
                </div>

                <?php
                //  $array12 = null;
                //  $array11 = null;
                if (isset($_GET['array_brands'])) {
                // $array10 = $_GET['hang'];
                // $array11 = implode(',', $array10);
                // print_r($array11);
                // $unwantedChars1 = "' ";
                // $cleanString1 = str_replace("'", '', $array11); print_r($cleanString1); 
                // print_r($_GET['array_brands']);
                // $array11 = explode(',', $_GET['array_brands']);
                // print_r($array11);
                // foreach($array11 as $item) {echo $item; }
                }
              
                if (isset($_GET['nhucau'])) {
                    // $array10 = $_GET['hang'];
                    // $array11 = implode(',', $array10);
                    // print_r($array11);
                    // $unwantedChars1 = "' ";
                    // $cleanString1 = str_replace("'", '', $array11); print_r($cleanString1); 
                    // print_r($_GET['array_brands']);
                    // $array12 = explode(',', $_GET['nhucau']);
                    // print_r($array11);
                }?>

                <?php 
                if(isset($_GET['array_brands'])) {
                    // print_r(gettype($_GET['array_brands']));
                 $array11 = explode(',', $_GET['array_brands']);
                //  print_r(gettype($array11));
                //  print_r($array11);
                }

                if(isset($_GET['nhucau'])) {
                    // print_r(gettype($_GET['nhucau']));
                 $array12 = explode(',', $_GET['nhucau']);
                //  print_r(gettype($array12));
                //  print_r($array11);
                }

                if(isset($_GET['mausac'])) {
                    // print_r(gettype($_GET['nhucau']));
                 $array13 = explode(',', $_GET['mausac']);
                //  print_r(gettype($array12));
                //  print_r($array11);
                }
                ?>
                <div style="box-shadow: 1px 2px 3px 4px #ccc; border-radius:5px; padding: 10px;" class="wrapper-select-brands">
                    <form action="" method="GET">
                        <?php foreach($loaisanpham as $row) : extract($row); ?>
                            <input data-id_loaisp="<?=$row['ID']?>" class="form-check-input nhucau1" <?php if(isset($_GET['array_brands'])) { foreach($array11 as $item) { if ($item == $row['TenLoaiSanPham']) {echo 'checked';} } } ?>  name="array_brands[]" type="checkbox" value="<?=$row['TenLoaiSanPham'];?>"> <?=$row['TenLoaiSanPham'];?> <br>
                        <?php endforeach; ?>
                      
                        <!-- <div style="display: flex; justify-content: space-between;" class="">
                            <input type="submit" class="btn btn-primary" value="Xem">
                            <button class="btn btn-danger" type="button" id="clickPrice5">Hủy bỏ</button>
                        </div> -->
                    </form>
                </div>
                <div id="text" class=""><?php if(isset($_GET['price'])) {echo $_GET['price'];} ?></div>
                <div style="padding: 10px;" class="" id="selectDemands">
                    <span class="selectDemans-element" style="width: 100%;padding: 5px 10px; background: #ccc; border-radius:  10px;"><i class="fa-solid fa-money-bill"></i> Nhu cầu dùng</span>
                </div>
                <div style="box-shadow: 1px 2px 3px 4px #ccc; border-radius:5px; padding: 10px;" class="wrapper-select-demand">
                    <form action="" method="GET">
                        <?php foreach($nhucaunguoidung as $row) : extract($row); ?>
                            <input <?php if(isset($_GET['nhucau'])) { foreach($array12 as $item) { if ($item == $row['name']) {echo 'checked';} } } ?>   class="form-check-input nhucau" name="array_demands[]"  type="checkbox" value="<?=$row['name'];?>"> <?=$row['name'];?> <br>
                        <?php endforeach; ?>
                        <!-- <div style="display: flex; justify-content: space-between;" class="">
                            <input type="submit" class="btn btn-primary" value="Xem">
                            <button class="btn btn-danger" type="button" id="clickPrice5">Hủy bỏ</button>
                        </div>  -->
                    </form>
                </div>
                <div class="fb-comments" data-href="http://localhost/DemoWeb5/TrangChu/ChiTietSP?id=40" data-width="100%" data-numposts="5"></div>
                <div style="box-shadow: 1px 2px 3px 4px #ccc; border-radius:5px; padding: 10px;" class="">
                    <form action="" method="GET">
                        <?php foreach($mausac as $row) : extract($row); ?>
                            <input <?php if(isset($_GET['mausac'])) { foreach($array13 as $item) { if ($item == $row['name']) {echo 'checked';} } } ?>   class="form-check-input mausac" name="array_colors[]"  type="checkbox" value="<?=$row['name'];?>"> <?=$row['name'];?> <br>
                        <?php endforeach; ?>
                        <!-- <div style="display: flex; justify-content: space-between;" class="">
                            <input type="submit" class="btn btn-primary" value="Xem">
                            <button class="btn btn-danger" type="button" id="clickPrice5">Hủy bỏ</button>
                        </div>  -->
                    </form>
                </div>
                <!-- <button type="button" id="removeMausacButton">Xóa Mausac</button>
                <?php foreach($mess1 as $key=>$item) { print_r($key);} ?> -->
                </div>
                
                <div class="body-allproduct-right">
                    <?php if(isset($_GET['array_brands']) || isset($_GET['nhucau']) || isset($_GET['nhucau']) || isset($_GET['price_gte']) || isset($_GET['price_lte'])) { ?>
                    <div style="padding: 10px;"  class="filter-follow">
                        <h4>Đang lọc theo</h4>

                        <?php if (isset($_GET['mausac'])) { ?> 
                            <span style="font-size: 14px; padding: 5px 7px; background: #f5e9e9; border: 1px solid red; color: red; border-radius: 7px;"><?= 'Màu sắc: ' .$_GET['mausac'] ?><i id="deleteColors" style="margin-left: 5px;" class="fa-regular fa-circle-xmark"></i></span>
                        <?php } ?>

                        <?php if (isset($_GET['array_brands'])) { ?> 
                            <span style="font-size: 14px; padding: 5px 7px; background: #f5e9e9; border: 1px solid red; color: red; border-radius: 7px;"><?= 'Hãng: ' .$_GET['array_brands'] ?><i id="deleteBrands" style="margin-left: 5px;" class="fa-regular fa-circle-xmark"></i></span>
                        <?php } ?>

                        <?php if (isset($_GET['nhucau'])) { ?> 
                            <span style="font-size: 14px; padding: 5px 7px; background: #f5e9e9; border: 1px solid red; color: red; border-radius: 7px;"><?= 'Nhu cầu: ' .$_GET['nhucau'] ?><i id="deleteDemands" style="margin-left: 5px;" class="fa-regular fa-circle-xmark"></i></span>
                        <?php } ?>

                        <?php if (isset($_GET['price_lte']) && isset($_GET['price_gte'])) { ?> 
                            <span style="font-size: 14px; padding: 5px 7px; background: #f5e9e9; border: 1px solid red; color: red; border-radius: 7px;"><?= 'Giá từ: ' .$_GET['price_gte'] .' - ' .$_GET['price_lte'] ?><i id="deletePrices" style="margin-left: 5px;" class="fa-regular fa-circle-xmark"></i></span>
                        <?php } ?>
                    </div> 
                    <div style="padding: 10px 10px 0 10px;" class="">
                        <p id="delete_filters" style="color: red;" class="delete_filter">Xóa bộ lọc</p>
                    </div>
                    <?php } ?>
            
                   
                   
                    <div class="body-allproduct-right--contain">
                         
                        <div class="body-allproduct-right--header"> 
                            <div style="font-weight: bold;" class="">Sắp xếp theo</div>
                            <a href="#" class="body-allproduct-right--header_input">Mới về</a>
                            <a style="position: relative;" href="?sort=SORT_BY_PRICE&order=DESC"  class="body-allproduct-right--header_input price_DESC">Giá giảm dần
                                <?php if (isset($_GET['sort']) && isset($_GET['order']) && $_GET['order'] == "DESC") { ?>
                                    <div class="show-check"></div>
                                    <i class="fa-solid fa-check fa-check1"></i>
                                    <script>
                                        document.querySelector('.price_DESC').style.border = "1px solid blue";
                                    </script>
                                <?php } ?>
                            </a>
                            <a style="position: relative;" href="?sort=SORT_BY_PRICE&order=ASC" class="body-allproduct-right--header_input price--ASC">Giá tăng dần
                                <?php if (isset($_GET['sort']) && isset($_GET['order']) && $_GET['order'] == "ASC") { ?>
                                    <div class="show-check"></div>
                                    <i class="fa-solid fa-check fa-check1"></i>
                                    <script>
                                        document.querySelector('.price--ASC').style.border = "1px solid blue";
                                    </script>
                                <?php } ?>
                            </a>
                            
                        </div>
                        <div style="display: flex; flex-wrap: wrap;" class="body-allproduct-right--body">
                            <?php if(is_array($result2)) foreach($result2 as $row) : extract ($row); ?>
                            <a href="../TrangChu/ChiTietSP?id=<?=$row['ID']?>" style="text-decoration: none; cursor: pointer;" class="body-allproduct-right--body--component">
                                <div style="width: 100%; height: 150px;" class=""><img style="width: 100%; height: auto;" src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt=""></div>
                                <div class="product-list--li__brand">
                                    <span><?=$row['TenLoaiSanPham']?></span>
                                </div>
                                <div style="width: 100%; overflow:hidden;" class="product-list--li__describe2">
                                    <span style="display: -webkit-box;
                                    -webkit-line-clamp: 3; /* Số dòng hiển thị trước khi hiển thị dấu ba chấm */
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;"><?=$row['TenSanPham']?></span> 
                                </div>                                 
                                <div class="hehe"><?=number_format($row['Gia'], 0, '.', '.')?>đ</div>
                                <div class=""><span class="xoa">25.990.990 đ</span> <span class="css-1f8jk2s">-23.09%</span></div>
                                <div class="xoa"><img style="width: 20px; height: 20px;" src="https://lh3.googleusercontent.com/hYoola60_2KWUpom1Rqr5QJ-3laSN_vzI_mwEZq2UUh5qbZSWbVZcK5ZxcrNDAO1wImarNL1Vq0EdDZj1Q=rw" alt=""></div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
  var minRange = document.getElementById("min1");
  var maxRange = document.getElementById("max1");

  // Lưu giá trị ban đầu của minRange
  var initialMinValue = parseInt(minRange.value);

  // Kiểm tra khi giá trị của minRange thay đổi
  minRange.addEventListener("input", function() {
    // Chắc chắn rằng giá trị của minRange luôn nhỏ hơn hoặc bằng giá trị của maxRange
    if (parseInt(minRange.value) > parseInt(maxRange.value)) {
      minRange.value = maxRange.value;
    }
    // Lưu lại giá trị hiện tại của minRange
    initialMinValue = parseInt(minRange.value);
  });

  // Kiểm tra khi giá trị của maxRange thay đổi
  maxRange.addEventListener("input", function() {
    // Chắc chắn rằng giá trị của maxRange luôn lớn hơn hoặc bằng giá trị của minRange
    if (parseInt(maxRange.value) < parseInt(minRange.value)) {
      maxRange.value = initialMinValue;
    }
  });
</script>
<script>
    $('#delete_filters').click(()=>{
        window.location.href = "AllSanPham";
    });
</script>
<script>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="uNwVBJZO"></script>
</script>
</script>



<!-- <script>
    // Bắt sự kiện click trên nút "Xóa Mausac"
document.getElementById("deleteColors").addEventListener("click", function() {
  // Lấy URL hiện tại
var currentURL = window.location.href;

// Sử dụng Regular Expression (Regex) để thay thế chuỗi "&mausac=..." bằng chuỗi rỗng
var updatedURL = currentURL.replace(/&mausac=[^&]*/, '');

var span = link.parentElement;
               
span.remove();

// Chuyển hướng tới URL đã được chỉnh sửa
window.location.href = updatedURL;
});

</script> -->

<script>
    $('#deleteColors').click(()=> {
        var currentURL = window.location.href;
        // Sử dụng Regular Expression (Regex) để thay thế chuỗi "&mausac=..." bằng chuỗi rỗng
        var updatedURL = currentURL.replace(/&mausac=[^&]*/, '');

        // Chuyển hướng tới URL đã được chỉnh sửa
        window.location.href = updatedURL;
    });

    $('#deleteDemands').click(()=> {
        var currentURL = window.location.href;
        // Sử dụng Regular Expression (Regex) để thay thế chuỗi "&mausac=..." bằng chuỗi rỗng
        var updatedURL = currentURL.replace(/&nhucau=[^&]*/, '');

        // Chuyển hướng tới URL đã được chỉnh sửa
        window.location.href = updatedURL;
    });

    $('#deleteBrands').click(()=> {
        var currentURL = window.location.href;
        // Sử dụng Regular Expression (Regex) để thay thế chuỗi "&mausac=..." bằng chuỗi rỗng
        var updatedURL = currentURL.replace(/array_brands=[^&]*/, '');

        // Chuyển hướng tới URL đã được chỉnh sửa
        window.location.href = updatedURL;
    });

    $('#deletePrices').click(()=> {
        var currentURL = window.location.href;
        // Sử dụng Regular Expression (Regex) để thay thế chuỗi "&mausac=..." bằng chuỗi rỗng
        var updatedURL = currentURL.replace(/&price_gte=[^&]*&price_lte=[^&]*/, '');

        // Chuyển hướng tới URL đã được chỉnh sửa
        window.location.href = updatedURL;
    });
</script>


        <script>
            document.getElementById('clickPrice4').onclick = () => {
                document.querySelector('.wrapper-select-price').style.display = "none";
            }
            document.getElementById('clickPrice5').onclick = () => {
                document.querySelector('.wrapper-select-brands').style.display = "none";
            }

            document.getElementById('selectPrice').onclick = () => {
                var test = document.querySelector('.wrapper-select-price');
                var test1 = document.querySelector('.selectPrice-element');
                if (test.style.display == "block") {
                    test.style.display = "none";
                } else {
                    test.style.display = "block";
                    test1.style.border = "1px solid blue";
                    test1.style.color = "blue";
                    test1.style.background = "#e0e0e0";
                }
            }

            

            document.getElementById('selectBrands').onclick = () => {
                var test2 = document.querySelector('.wrapper-select-brands');
                var test3 = document.querySelector('.selectBrand-element');
                if (test2.style.display == "block") {
                    test2.style.display = "none";
                } else {
                    test2.style.display = "block";
                    test3.style.border = "1px solid blue";
                    test3.style.color = "blue";
                    test3.style.background = "#e0e0e0";
                }

            }

            document.getElementById('selectDemands').onclick = () => {
                var test2 = document.querySelector('.wrapper-select-demand');
                var test3 = document.querySelector('.selectDemans-element');
                if (test2.style.display == "block") {
                    test2.style.display = "none";
                } else {
                    test2.style.display = "block";
                    test3.style.border = "1px solid blue";
                    test3.style.color = "blue";
                    test3.style.background = "#e0e0e0";
                }

            }

        //     document.getElementById('clickPrice').onclick = () => {
        //     var a = document.querySelector('.range-min').value;
        //     var b = document.querySelector('.range-max').value;

        //     window.location.href = "OKE="+a+"-"+b;
        // }
        </script>
        <script>
            function deleteMess(link, url) {
                var span = link.parentElement;
               
        // Xóa thẻ span
            span.remove();

            window.location.href = "AllSanPham";
            }
        </script>
         <script>
        // Lấy phần tử input range và phần tử hiển thị giá trị
        var rangeInput = document.getElementById("range");
        var demo = document.getElementById("demo");

        // Thêm một trình nghe sự kiện cho phần tử input range
        rangeInput.addEventListener("input", function() {
            // Lấy giá trị hiện tại của thanh trượt
            var value = rangeInput.value;

            // Hiển thị giá trị trên trang
            demo.innerHTML = "Giá trị: " + value;
        });

        // rangeInput.addEventListener("mouseup", function() {
        //     // Lấy giá trị đã chọn sau khi thả thanh trượt
        //     var selectedValue = rangeInput.value;

        //     // Chuyển hướng đến URL với giá trị đã chọn
        //     window.location.href = "http://example.com/?value=" + selectedValue;
        // });
        rangeInput.addEventListener("mouseup", function(){
            updateURL();
        });

        
    </script>
    <script>
        $('#min1').change(function() {
           updateURL();
        });

        $('#max1').change(function() {
           updateURL();
        });
    </script>
    <script>
          var queryString = window.location.search;
            console.log(queryString);
    </script>
    
<script>
  var minRange = document.getElementById("min");
  var maxRange = document.getElementById("max");

  // Kiểm tra khi giá trị của minRange thay đổi 
  var initialMinValue = parseInt(minRange.value);

// Kiểm tra khi giá trị của minRange thay đổi
minRange.addEventListener("input", function() {
  // Chắc chắn rằng giá trị của minRange luôn nhỏ hơn hoặc bằng giá trị của maxRange
  if (parseInt(minRange.value) > parseInt(maxRange.value)) {
    minRange.value = maxRange.value;
  }
  // Lưu lại giá trị hiện tại của minRange
  initialMinValue = parseInt(minRange.value);
});

// Kiểm tra khi giá trị của maxRange thay đổi
maxRange.addEventListener("input", function() {
  // Chắc chắn rằng giá trị của maxRange luôn lớn hơn hoặc bằng giá trị của minRange
  if (parseInt(maxRange.value) < parseInt(minRange.value)) {
    maxRange.value = initialMinValue;
  }
});
</script>

  
        <script>
  const checkboxesHang = document.querySelectorAll('.nhucau1'); // Checkbox chọn theo hãng
  const checkboxesNhuCau = document.querySelectorAll('.nhucau'); // Checkbox chọn theo nhu cầu
  const checkboxesMauSac = document.querySelectorAll('.mausac'); // Checkbox chọn theo nhu cầu

//   var rangeInput = document.getElementById("range");
  checkboxesHang.forEach(checkbox => {
    checkbox.addEventListener('change', updateURL);
  });

  checkboxesNhuCau.forEach(checkbox => {
    checkbox.addEventListener('change', updateURL);
  });

  checkboxesMauSac.forEach(checkbox => {
    checkbox.addEventListener('change', updateURL);
  });

  
  
  function updateURL() {
    const selectedHang = Array.from(checkboxesHang).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(',');
    const selectedNhuCau = Array.from(checkboxesNhuCau).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(',');
    const selectedMauSac = Array.from(checkboxesMauSac).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(',');

    // const selectPrice = document.getElementById('text').text;
    // console.log(selectPrice );
    // console.log(selectedHang);
    // var value = rangeInput.value;

    var min = $('#min1').val();
    var max = $('#max1').val();

    if (parseInt(min) > parseInt(max)) {
        min = parseInt(max) - 10000;
    }

    
    // if (parseInt(min.value) > parseInt(max.value)) {
    //     min.value = max.value;
    // }

    // if (parseInt(max.value) < parseInt(min.value)) {
    //   max.value = min.value;
    // }

    
    // console.log(selectedNhuCau);
    // // const newURL = 'AllSanPham?array_brands=' + selectedHang + '&nhucau=' + selectedNhuCau;
    // var newURL = 'AllSanPham?array_brands=' + selectedHang;

    // if (selectedNhuCau !== " ")  {
    //     newURL = 'AllSanPham?array_brands=' + selectedHang + '&nhucau=' + selectedNhuCau;
    // }

    // // Chuyển hướng đến URL mới
    // window.location.href = newURL;

    var newURL = "AllSanPham?";

    if (selectedHang) {
        // if (max) {
        //     $newURL += '&';
        // }
        newURL += 'array_brands=' + selectedHang;
    } 

  
     
     
    if (min != 0) {
        if (selectedHang) {
            newURL += '&';
        }  
        newURL += 'price_gte=' + min + "&price_lte=" + max;
    }

    
    if (max <= 100000 && min == 0) {
        newURL += "&price_lte=" + max;
    }



    // if (value !== 0) {
    //     newURL += "price=0-" + value;
    // }

    
    // if (value !== "") {
    //     newURL += 'price=0-' + value;
    // }
      
    

    // if (selectedNhuCau) {
    // if (selectedHang) {
    //   newURL += '&';
    // }
    // newURL += 'nhucau=' + selectedNhuCau;
    if (selectedMauSac) {
        if (selectedHang) {
            newURL += '&';
            newURL += 'mausac=' + selectedMauSac;
        } else if (selectedNhuCau) {
            newURL += 'mausac=' + selectedMauSac + "&";
        } else {
            newURL += 'mausac=' + selectedMauSac;
        } 
    }
  
    if (selectedNhuCau) {
        if (selectedHang) {
            newURL += '&';
        } 
        // if (selectedNhuCau) {
        //     newURL += '&';
        // }
        newURL += 'nhucau=' + selectedNhuCau;
    }


    // if (selectedHang) {
    //     if (selectedHang) {
    //         newURL += '&';
    //     } 
    //     newURL += 'array_brands=' + selectedHang;
    // }

  // Chuyển hướng đến URL mới nếu có chọn ít nhất một checkbox
  if (selectedHang || selectedNhuCau || min || max) {
    window.location.href = newURL;
  } else {
    window.location.href = "AllSanPham";
  }
  }
</script>
<script>
    console.log(selectedNhuCau);
</script>
<script>
    // $('.nhucau1').change(function() {
    //     var a = $(this).val();
    //     var id_loaisp = $(this).data('id_loaisp');
      
    //     $.ajax({
    //         method: "GET",
    //         url: "../TrangChu/",
    //         data: {ten: a, id_loaisp: id_loaisp},
    //         success: function(data) {
    //             alert(data);
    //         }
    //     });
    // });
</script>






        <script>
            document.getElementById('clickPrice3').onclick = () => {
            var a = document.querySelector('.range-min').value;
            var b = document.querySelector('.range-max').value;
            window.location.href = "../TrangChu/AllSanPham?price="+a+"-"+b;
            // alert(1);
        }

        document.querySelector(".fa-circle-xmark").onclick = () => {
            document.querySelector(".filter-follow").style.display = "none";
            window.location.href = "../TrangChu/AllSanPham";
        }

        const rangeInput = document.querySelectorAll(".range-input input");
        const priceInput = document.querySelectorAll(".price-input input");
        const range = document.querySelector(".slider .progress");
        let priceGap = 5000000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100000) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100000 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
        </script>
        <!-- <script>
            var previousLink = ""; // Biến lưu trữ liên kết trước đ
            function handleCheckboxChange(link) {
                var checkbox = document.getElementById('lop');
                //   var link = document.getElementById('myLink');

                if (checkbox.checked) {
                    // Nếu checkbox được chọn, điều hướng đến link khác
                    previousLink = "../TrangChu/AllSanPham";
                    window.location.href = link;
                } else {
                    // Nếu checkbox không được chọn, trở lại link ban đầu
                    window.location.href = previousLink;
                }
            }
           

       
        </script> -->
<?php
    include "./Views/HomeLayout/footer.php";
?>

<!-- <div style="display: flex; justify-content: space-between;" class="">
                                        <div class="">
                                            <input type="checkbox" id="checkbox1">
                                            <label style="font-size: 14px; margin-bottom: 5px; display: inline-block;" for="checkbox1">Option 3</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" id="checkbox1">
                                            <label style="font-size: 14px;" for="checkbox1">Option 4</label>
                                        </div>
                                    </div>
                                    <div class="show-more">
                                      <a href="#" id="showMoreLink">Xem thêm</a>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;" class="">
                                        <div class="">
                                            <input type="checkbox" id="checkbox1">
                                            <label style="font-size: 14px; margin-bottom: 5px; display: inline-block;" for="checkbox1">Option 3</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" id="checkbox1">
                                            <label style="font-size: 14px;" for="checkbox1">Option 4</label>
                                        </div>
                                    </div> -->