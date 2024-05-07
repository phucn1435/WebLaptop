<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm mới đơn hàng bán</title>";
?>
<style>

.custom-button {
    background-color: #3498db; /* Màu nền */
    border: none;
    color: white; /* Màu chữ */
    padding: 10px 17px; /* Kích thước nút */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    border-radius: 25px; /* Độ cong góc */
    cursor: pointer;
    overflow: hidden;
    position: relative;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.custom-button:hover {
    background-color: #2980b9; /* Màu nền khi di chuột qua */
    transform: scale(1.1); /* Hiệu ứng phóng to khi di chuột qua */
}

.custom-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #3498db, #2ecc71); /* Độ chệch màu */
    opacity: 0.5;
    z-index: -1;
    transition: opacity 0.3s ease;
}

.custom-button:hover::before {
    opacity: 1;
}


.delete-button {
    background-color: #e74c3c;
    border: none;
    color: white;
    padding: 10px 17px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.delete-button:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

.delete-button:active {
    background-color: #922b21;
    transform: scale(0.95);
    box-shadow: none; /* Loại bỏ bóng đổ khi nút được nhấn */
}



#productInfo:hover {
    background-color: #45a049;
}

#productInfo {
    margin-top: 50px;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}


    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
    }

    #toast-container {
      position: fixed;
      right: -100%; /* Start off-screen */
      top: 20px;
      width: 300px;
      background-color: #333;
      color: #fff;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      transition: right 0.3s ease-in-out;
     
    }

    #toast-container.show {
      right: 20px; /* Slide in from the right */
      top: 80px;
      background: green;
    }

    #toast-container button {
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }



</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Đơn hàng bán</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../DonHangBan/DanhSach" style="text-decoration: none; color: #000000;" >Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Tạo đơn hàng
    </span>
    <hr>
    <div id="toast-container">Order created successfully!</div>
    <div class="wrapper-info--order" style="margin-top: 20px;">
        <div style="display: flex; justify-content: space-between;" class="">
            <div style="font-size: 20px;font-weight: bold;" class="">Thông tin đơn hàng</div>
            <div class=""><a href="../DonHangBan/DanhSachTQ" class="btn btn-primary">Quay lại</a></div>
        </div>

        <div style="display: flex; justify-content: space-between;" class="mt-3">
            <div style="width: 60%; border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;" class="">
                <div style="padding: 10px; font-size: 14px; text-align: center; background: #fff; border-radius: 15px;" class="">
                    <p style="font-size: 18px; font-weight: bold; margin-bottom: 0;">Đơn hàng</p>
                    <p style="margin-bottom: 0;">Mã đơn hàng: <?=$this->model->Max_ID()[0]['max'] + 1;?></p>
                    <p style="margin-bottom: 0;">Tên nhân viên lập: <?=$this->nhanvienlap->find($_SESSION['dangnhap1'])[0]['TenNhanVien'];?></p>
                    <?php print_r($_SESSION['dangnhap1']); ?>
                    <p>Ngày lập: <?=date('Y-m-d');?></p>
                    <form action="" method="POST">
                        <div style="padding: 10px; border: 1px solid #ccc; border-radius: 15px;" class="text-center">
                            <div style="text-align: left;" class="row row-cols-2">
                                <div class="col mb-3">
                                    <label for="name">Tên khách hàng</label>
                                    <input id="name" type="text" name="name_kh" class="form-input" placeholder="Nhập tên khách hàng...">
                                    <div style="color: red; text-align: center;" id="error_kh"></div>
                                    <!-- <select name="kh" class="form-select" id="">
                                        <option value="1"></option>
                                    </select> -->
                                </div>
                                <div class="col mb-3">
                                    <label for="sdt">Số điện thoại</label>
                                    <input id="sdt" type="number" name="sdt" class="form-input" placeholder="Nhập số điện thoại...">
                                    <div style="color: red; text-align: center;" id="error"></div>
                                </div>
                                <div class="col mb-3">
                                    <label for="dc">Địa chỉ</label>
                                    <input id="dc" type="text" name="dc" class="form-input" placeholder="Nhập địa chỉ...">
                                    <div style="color: red; text-align: center;" id="error_dc"></div>
                                </div>
                            </div>
                        </div>
                        <?php print_r($_SESSION['items']); ?>
                        <div style="padding: 10px; border: 1px solid #ccc; border-radius: 15px;" class="mt-4">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div class="tr">
                                        <?php if(isset( $_SESSION['items_temp'])) { ?>
                                            <?php print_r(( $_SESSION['items_temp'])); ?>
                                            <tr>
                                                <th scope="row"></th> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4" id="show_1">
                            
                        </div>
                        <div style="color: red;" id="error_sp"></div>
                        
                        <div class="mt-4" style="display: flex; justify-content: space-between;">
                            <div class="">
                                <button id="create_order" name="create_order" type="submit" class="custom-button">Tạo Đơn Hàng</button>
                            </div>
                            <div class="">
                                <button type="submit" class="delete-button" name="reset">Xóa Tất Cả</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           
            <div style="width: 37%; border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;" class="">
                <div style="padding: 10px; font-size: 14px ;background: #fff; border-radius: 15px;" class="">
                    <p style="font-size: 18px; font-weight: bold; margin-bottom: 0;">Tên sản phẩm</p>
                    <form class="mt-2" action="" method="POST">
                        <p>Sản phẩm</p>
                        <select name="sp" class="form-select select_sp" id="select_sp">
                            <option value="0">Chọn sản phẩm</option>
                            <?php foreach($list_sp as $item) : extract($item); ?>
                                <option value="<?=$item['ID']?>"><?=$item['TenSanPham']?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="noti_sl p-3" style="color: red;"></div> <br>
                        <p>Số lượng</p>
                        
                        <input type="number" name="sl" id="sl" class="form-control">
                    </form>
                    <button type="submit" name="submit_them" id="productInfo">Thêm sản phẩm</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

        $('.select_sp').on('change', ()=> {
            var a = $('.select_sp').val();
            if (a != 0) {
                $.ajax({
                    url: "../DonHangBan/xuli_chonsp",
                    method: "POST",
                    data: {data:a},
                    success: function(data) {
                        $('.noti_sl').html(data);
                    }
                }); 
            } else {
                $('.noti_sl').text('');
            }
        }); 
        
        $('#productInfo').on('click', ()=> {
            var id_sp = $('#select_sp').val();
            var sl = $('#sl').val();

            $.ajax({
                url: '../DonHangBan/add_orders',
                method: "POST",
                data: {id_sp:id_sp, sl: sl},
                success: function(data) {
                    $('#myTable tbody').html(data);
                }
            });
        })
</script>
<script>
    // Function to show the toast message
    function showToast() {
      var toastContainer = document.getElementById('toast-container');
      toastContainer.classList.add('show');

      // Hide the toast after 3 seconds (adjust as needed)
      setTimeout(function() {
        toastContainer.classList.remove('show');
      }, 3000);
    }
  </script>
  <script>
    function validatePhoneNumber(phoneNumber) {
        // Sử dụng biểu thức chính quy để kiểm tra định dạng số điện thoại
        var phoneRegex = /^0\d{9}$/; // Bắt đầu bằng số 0, theo sau bởi chính xác 9 chữ số

        // Kiểm tra xem chuỗi đầu vào có khớp với biểu thức chính quy hay không
        return phoneRegex.test(phoneNumber);
    }

    function validateName(name) {
      // Kiểm tra nếu tên trống
      if (name.trim() === '') {
        return false;
      }
      // Kiểm tra nếu tên có chứa ký tự đặc biệt hoặc số (ví dụ: /^[a-zA-Z ]*$/ sẽ chỉ chấp nhận chữ cái và khoảng trắng)
      else if (!/^[a-zA-Z ]*$/.test(name)) {
        return false;
      }
      // Nếu không có lỗi
      else {
        return true;
      }
    }

  </script>
  <script>
    $('#create_order').on('click',(e)=> {
        e.preventDefault();
        var name = $('#name').val();
        var sdt = $('#sdt').val();
        var dc = $('#dc').val();
        if (name == "") {
            $('#error_kh').text('Kiểm tra lại dữ liệu');
            $('#name').css('border-color', 'red');
            $('#name').css('border-width', '1px');
        } 
        if(sdt == "") {
            $('#error').text('Kiểm tra lại dữ liệu');
            $('#sdt').css('border-color', 'red');
            $('#sdt').css('border-width', '1px');
        }  
        if (dc == "") {
            $('#error_dc').text('Kiểm tra lại dữ liệu');
            $('#dc').css('border-color', 'red');
            $('#dc').css('border-width', '1px');
        }   

        <?php if(!isset($_SESSION['items'])) { ?>
            $('#error_sp').text('Không có dữ liệu để tạo đơn hàng');
        <?php } ?>

        if (name != "" && sdt != "" && dc != "" && <?php isset($_SESSION['items']) ?>) {
            // window.location.href = "../ChiTietDonHangBan/DanhSachTQ?id=<?=$this->model->Max_ID()[0]['max'];?>";
            $.ajax({
                method: "POST",
                url: "../DonHangBan/create_orders",
                data: {name:name, sdt: sdt, dc:dc},
                success: function(data) {
                }
            });
    }
        
    });
    // $('#sdt').on('input', ()=> {
    //     var a = $('#sdt').val();
    //     if (a == " ") {
    //         $('#sdt').css('border-color','red');
    //         $('#create_order').prop("disabled", true);
    //     } else if(!validatePhoneNumber(a)) {
    //         $('#error').text('Sai định dạng số điện thoại');
    //         $('#sdt').css('border-color','red');
    //         $('#create_order').prop("disabled", true);
    //     } else {    
    //         var b = document.getElementById("tongtien").innerHTML;
    //         // alert(b);
    //         $('#error').text('');
    //         $('#sdt').css('border-color','black');
    //         $.ajax({
    //             url: '../DonHangBan/CheckSDT',
    //             method: "POST",
    //             data: {sdt:a, tongtien: b},  
    //             success: function(data) {
    //                 $('#show_1').html(data);
    //                 <?php unset($_SESSION['items_temp']); ?>
    //             }
    //         });
    //     }
    // });

    
  </script>
    
<?php
    include "./Views/Layout/footer.php";
?>