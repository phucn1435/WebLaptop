<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Danh sách sản phẩm</title>";
?>
<style>
    .modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  animation: appear .7s linear;
}

@keyframes appear {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    75% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);

    }

}

.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* Close button style */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-align: right;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
        <div class="body" style="width: 80%; margin: 0 auto;">
            <form action="" method="POST">
            <div class="body-title">
                <a href="#">Trang chủ</a> <i style="margin-left: 10px;" class="fa-solid fa-arrow-right"></i> <span style="margin-left: 10px;">Giỏ hàng</span> <br>
            </div>
            
            <div class="cate-container">
                <?php
                    if (is_array( isset($_SESSION['id_user']) ? $test3 : $test )) { ?>
                <div style="width: 64%;" class="">
                    <div class="cate-table--title">
                        <div class="">Giỏ hàng</div>
                        <input id="openModalBtn" class="btn btn-danger" type="submit" value="DELETE"></input>
                    </div>
                    <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p style="font-size: 30px; color: blue; font-weight: bold; text-align: center;">Bạn chắc chưa?</p>
                                    <div style="display: flex; justify-content: space-between;" class="">
                                        <div style="display: flex; justify-content: center; width: 100%;" class="">
                                            <div class="">
                                                <input style="color: white; font-weight: bold;" class="btn btn-warning" type="submit" value="YES" name="delete">
                                            </div>
                                            <div style="margin-left: 10px;" class="">
                                                <button id="button1" style="width: auto; font-weight: bold;" class="btn btn-danger">No</button>
                                            </div>
                                        </div>
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                    <div class="cate-table">
                        <div class=""></div>
                        <div style="font-weight: 550;" class="cate-table--header">
                            <div style="width: 5%; text-align: center;" class=""><input checked id="checkboxAll" type="checkbox"></div>
                            <div style="width: 60%;" class="">
                                <span>CÔNG TY CỔ PHẦN THƯƠNG MẠI DỊCH VỤ HP</span>
                                <?php ?>
                            </div>
                            <div style="width: 15%;" class="">
                                <span>Đơn giá</span>
                            </div>
                            <div style="width: 15%;" class="">
                                <span>Số lượng</span>
                            </div>
                            <div style="width: 18%;"class="">
                                <span>Thành tiền</span>
                            </div>
                        </div>

                        <div class="cate-table--body">
                            <?php 
                            $i = 0;
                           
                            $tong1 = 0;
                            $all = 0;
                            foreach( isset($_SESSION['id_user']) ? $test3 : $test as $row) : extract ($row);
                            $tong = 0;
                            $all += $row['ThanhTien'];
                            ?>
                            <div class="cate-table--body--contain">
                                <div class="checkbox">
                                    <input value="<?=$row['ID']?>" name="checkboxID[]" checked class="checkbox1" type="checkbox">
                                </div>
                                <div style="width: 60%; text-align: left;" class="cate-img">
                                    <div style="border: 1px solid gray;" class="">
                                        <img style="width: 50px; height: 50px; object-fit: contain;" src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh']?>"  alt="">
                                    </div>
                                    <div style="margin-left: 5px;" class="cate-img--span">
                                        <span><?=$row['TenSanPham'];?></span>
                                    </div>
                                </div>
                                <div style="width: 15%;" class="">
                                    <?php if($row['GiaKhuyenMai'] != 0) { ?>
                                        <span><?=number_format($row['GiaKhuyenMai'], 0, '.', '.')?></span> <br>
                                        <span class="price-through"><?=number_format($row['Gia'], 0, '.', '.')?> đ</span>
                                    <?php } else { ?>
                                        <span><?=number_format($row['Gia'], 0, '.', '.')?></span> <br>
                                    <?php } ?>
                                </div>
                            
                                <div style="width: 15%; position:relative;" class="">
                                    <div style="padding: 2px 0;" class="quantity">
                                        <a style="cursor: <?php if($row['SoLuong1'] == 1) { echo "not-allowed";} ?> ;" href="../TrangChu/GioHang1?test=tru&id=<?=$row['ID_sanpham']?>"><i class="fa-solid fa-minus"></i></a>
                                        <div class=""><?=$row['SoLuong1']?></div>
                                        <a href="../TrangChu/GioHang1?test=cong&id=<?=$row['ID_sanpham']?>"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                    <div style="margin: 0 auto; position:absolute; bottom: 0; left: 40%" class="">
                                        <a style="text-decoration: none; top: 5px;" href="../TrangChu/Xoa&id=<?=$row['ID'];?>&idkh=<?= isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;?>" >Xóa</a>
                                    </div>
                                </div>
                                
                               
                                <div style="width: 18%;" class="">
                                    <?php if($row['code_giam'] !== "") { ?>
                                        <span style="font-size: 14px; text-decoration: line-through;"><?php echo number_format($row['ThanhTien'], 0, '.', '.'); ?></span>
                                        <div style="font-size: 12px;">
                                            Mã giảm: <span style="color: red; font-weight: bold;"><?= $row['code_giam'] ?></span>
                                        </div>
                                        <span><?php $tong+=$row['ThanhTien']; echo number_format($row['ThanhTienCoMaGiam'], 0, '.', '.');?></span>
                                    <?php } else { ?>
                                        <span><?php echo number_format($row['ThanhTien'], 0, '.', '.'); ?></span>
                                    <?php } ?>
                                </div> 
                            </div> 
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div style="width: 36%; padding: 10px 0 10px 10px; height: 100%;" class="">
                    <div style="padding: 10px 15px 9px 0;" class="flex1">
                        <div class=""></div>
                        <div class="predictPrice">
                            <span>Tải báo giá</span> <i style="margin-left: 5px; font-size: 10px;" class="fa-solid fa-arrow-down fa-arrow-down1"></i>
                            <button onclick="printPage()" class="pdf-predictPrice">
                                <i class="fa-solid fa-file-pdf"></i> <span style="margin-left: 5px;">PDF</span>
                            </button>
                        </div>
                       
                    </div>
                    <div style="padding: 13px 10px;" class="flex">
                        <div class=""><span style="font-weight: 550; font-size: 17px;">Khuyến mãi</span></div>
                        <div id="clickKM" class=""><a style="text-decoration: none; color: blue;" href="#"> <i style="font-size: 12px; margin-right: 8px;" class="fa-solid fa-tag"></i> Chọn hoặc nhập khuyến mãi</a></div>
                    </div>
                   
                     
                    <div style="" class="mt-3">
                        <table style="display: none;" id="form_km" style="width: 100%;">
                            <tr>
                                <td style=""><input name="ma_code"  id="ma_code" class="form-control w-100" type="text" placeholder="Nhập mã khuyến mãi..."></td>
                                <td style=""><button style="margin-left: 10px;" type="button" id="submit_km" name="submitKM" class="btn btn-primary">Áp dụng</button></td>
                            </tr>
                            <tr style="margin-top: 10px;">
                                <td class="text-left">
                                    <span style="color: red;" id="show_km"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="cart-continue">
                        <table style="width: 100%;">
                            <tr style="text-align: left;">
                                <th style="padding: 15px 0;" colspan="2">Thanh toán</th>
                            </tr> 
                            <tr>
                                <td>Tổng tạm tính</td>
                                <td style="text-align: right; font-size: 17px;"><?=number_format($all, 0, '.', '.');?>đ</td>
                                <input type="hidden" id="tongtamtinh" name="tongtamtinh" value="<?=$all;?>">
                            </tr>
                            
                            <?php $tt = 0; ?>
                            <?php $donvi = ''; ?>
                            <!-- Test Here -->
                            <?php $array_code = null; 
                            foreach(isset($_SESSION['id_user']) ? $test3 : $test as $row) : extract($row);
                                $array_code[] = [
                                    "name_code" => $row['code_giam'],
                                    "ThanhTien" => $row['ThanhTien']
                                ];
                            endforeach;
                            $uniqueArray = array();
                            foreach ($array_code as $item) {
                                $nameCode = $item['name_code'];

                                // Nếu chưa tồn tại trong mảng mới, thêm vào mảng mới
                                if (!isset($uniqueArray[$nameCode])) {
                                    $uniqueArray[$nameCode] = $item;
                                }
                            }
                            // Chuyển mảng kết quả về dạng danh sách
                            $uniqueArray = array_values($uniqueArray);
                            ?>


                            <?php foreach(isset($_SESSION['id_user']) ? $test3 : $test as $row) : extract($row); ?>
                           
                            <?php $tt += $row['ThanhTienCoMaGiam']; ?>
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
                            <?php if(isset($_SESSION['magiam_giohang'])) { ?>
                            <tr style="background: pink;">
                                    <td style="padding: 10px 5px;">Mã giảm: <span style="font-size: 14px; font-weight: bold;"><?php echo $_SESSION['magiam_giohang']['code_giam'];?> <span style="font-size: 10px; font-weight: 600; color: red;">(áp dụng đối với cả giỏ hàng)</span></span></td>
                                    <td style="text-align: right; font-size: 14px; font-weight: bold;">- <?php echo number_format($_SESSION['magiam_giohang']['Luonggiam'], 0, '.', '.'); ?> VND</td>
                                <input type="hidden" id="tongtamtinh" name="tongtamtinh" value="<?=$all;?>">
                            </tr>
                            <tr></tr>
                            <?php } ?>
                            

                           
                            <tr>
                                <?php if(isset($_SESSION['id_user'])) { 
                                $giohang = $this->giohang->DanhSach4($_SESSION['id_user']); 
                                // print_r($giohang);
                                $thanhtien_gh = 0;
                                if (!empty($giohang)) 
                                    foreach($giohang as $item) {
                                        if ($item['code_giam'] != "" ) {
                                            $thanhtien_gh += $item['ThanhTienCoMaGiam'];
                                        } else {
                                            $thanhtien_gh += $item['ThanhTien'];
                                        }
                                    }
                                } else {
                                    $giohang = $this->giohang->DanhSach(); 
                                // print_r($giohang);
                                    $thanhtien_gh = 0;
                                    if (!empty($giohang)) 
                                        foreach($giohang as $item) {
                                            if ($item['code_giam'] != "" ) {
                                                $thanhtien_gh += $item['ThanhTienCoMaGiam'];
                                            } else {
                                                $thanhtien_gh += $item['ThanhTien'];
                                            }
                                        }
                                    }
                                ?>
                                <td style="padding-top: 5px ;">Thành tiền</td>
                                <?php if(isset($_SESSION['magiam_giohang'])) { ?>
                                <td style="text-align: right; color: rgb(20, 53, 195); font-weight: 700; font-size: 17px; margin-top: 10px;"><?=number_format($thanhtien_gh - $_SESSION['magiam_giohang']['Luonggiam'], 0, '.', '.');?>đ</td>
                                <?php } else { ?>
                                    <td style="text-align: right; color: rgb(20, 53, 195); font-weight: 700; font-size: 17px; margin-top: 10px;"><?=number_format($thanhtien_gh, 0, '.', '.');?>đ</td>
                                <?php } ?>
                                <input type="hidden" name="thanhtien" value="<?=$all;?>">
                            </tr>
                            <?php if(isset($_SESSION['magiam_giohang'])) {
                                print_r($_SESSION['magiam_giohang']);
                            } ?>
                            <tr>    
                                <td style="text-align: right; color: rgb(130, 134, 158); font-size: 13px; font-weight: 550;" colspan="2">(Đã bao gồm VAT)</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <!-- <input type="submit" value="TIẾP TỤC"> -->
                                    <?php if(isset($_SESSION['id_user'])) { ?>
                                        <!-- <a href="../TrangChu/DatHang" class="btn btn-primary" style="width: 100%;">Tiếp tục</a> -->
                                        <input type="submit" name="tieptuc" class="btn btn-primary" value="Tiếp tục">
                                        
                                    <?php } else { ?>
                                        <a href="../TrangChu/DangNhap" class="btn btn-primary" style="width: 100%;">Đăng nhập để tiếp tục</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </form>
            </div> 
            <?php } else { 
                unset($_SESSION['soluongsanpham']); ?>
                <div style="width: 100%; height: 80vh; position: relative;  background-image: url('https://tse2.mm.bing.net/th?id=OIP.khN_DM0iSdR7EFP6IJUljwHaDf&pid=Api&P=0&h=180'); background-repeat: no-repeat; background-size: cover; background-position: center center; padding-bottom: 10px;"> 
                    <div style="position: absolute; bottom: 0; left: 45%;">
                        <a href="../TrangChu/Index" class="btn btn-primary">Mua sắm ngay</a>
                    </div>
                </div>
                <?php } ?>
        </div>

        <script>
            window.addEventListener('popstate', function(event) {
  // Xử lý sự kiện back trang tại đây
  // Ví dụ: Hiển thị thông báo, chuyển hướng, tải lại dữ liệu, vv.
                window.location.href = "../TrangChu/ChiTietSP";
});
        </script>
        <script>
               // Get the modal element
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function (e) {
    e.preventDefault();
    
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
        </script>
        <script>
            $('#submit_km').click(()=>{
                var a = $('#ma_code').val();
                // alert(a);
                var b = $('#tongtamtinh').val();

                $.ajax({
                    url: "../TrangChu/xuli_magiam",
                    method: "POST",
                    data: {data: a, tongtamtinh: b},

                    success: function(data){
                        $('#show_km').html(data);
                        // window.location.href = "../TrangChu/GioHang1";
                    }
                });
            });
        </script>
        <script>
            function printPage() {
                var pricingWindow = window.open('../TrangChu/InPage', '_blank');
            pricingWindow.addEventListener('load', function() {
                pricingWindow.print();
            });
            }
        </script> 
        <script>
            $('#clickKM').click((e)=>{
                e.preventDefault();
                var a = document.getElementById('form_km').style.display;
                if (a  == "block") {
                    $('#form_km').css('display', 'none');
                } else {
                    $('#form_km').css('display', 'block');
                }
            });
        </script>
   
    <?php include('./Views/HomeLayout/footer.php'); ?>
