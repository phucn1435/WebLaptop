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

    .container_img {
      position: relative;
      width: 60px; /* Adjust the width and height as needed for your image */
      height: 60px;
      overflow: hidden; /* Hide overflowing content */
    }

    .image_1 {
      width: 100%; /* Ensure the image takes the full width of the container */
      height: 100%; /* Ensure the image takes the full height of the container */
      object-fit: cover; /* Maintain the aspect ratio and cover the container */
    }

    .badge {
      position: absolute;
      top: 0;
      right: 0;
      background-color: black;
      color: white;
      padding: 5px 10px;
      border-radius: 50%;
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
        Chi tiết đơn hàng bán
    </span>
    <hr>
        <div class="wrapper-info--order" style="margin-top: 20px;">
        <div style="display: flex; justify-content: space-between;" class="">
            <div style="font-size: 20px;font-weight: bold;" class="">Chi tiết đơn hàng</div>
            <div class=""><a href="../DonHangBan/DanhSachTQ" class="btn btn-primary">Quay lại</a></div>
        </div>

        <div style="background: #fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" class="mt-3">
            <div class="" style="display: flex; justify-content: space-between;padding: 10px;">
                <div style="width: 60%;border-right: 1px solid #ccc; padding: 10px;" class="">
                    <div style="display: flex; justify-content: space-between; padding: 0 0 10px 0;" class="">
                        <div class="">Mã đơn hàng: <?=$info[0]['ID_ordersTQ'];?></div>
                        <div class="">Thời gian: <?=$info[0]['NgayLap'];?></div>    
                    </div>
                    <div class="" style="border: 1px solid #ccc; border-radius: 10px;">
                        <div class="" style="padding: 5px;">
                            <div class="" style="border-bottom: 1px solid #ccc;padding: 15px 0;">
                                Tên khách hàng: <?=$info[0]['TenKhachHang'];?>
                            </div>
                            <div class="" style="border-bottom: 1px solid #ccc;padding: 15px 0;">
                                Địa chỉ: <?=$info[0]['DiaChi'];?> 
                            </div>
                            <div class="" style="border-bottom: 1px solid #ccc;padding: 15px 0;">
                                Số điện thoại: <?=$info[0]['SoDienThoai'];?>
                            </div>
                            <div class="" style="padding: 15px 0;">
                                Phương thức thanh toán: <?=$info[0]['name'];?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary">In hóa đơn</button>
                        <a class="btn btn-danger" href="../DonHangBan/ThemMoi">Tiếp tục đơn hàng mới</a>
                    </div>
                </div>
                <div class="" style="width: 40%;">
                    <div class="" style="padding: 10px;">
                        <table class="table">
                            <?php $tamtinh = 0; foreach($list_details as $row) : extract($row); ?>
                            <tr>
                                <td>
                                    <div class="container_img">
                                        <img src="../Assets/data/HinhAnhSanPham/<?= $row['HinhAnh'] ?>" alt="Circular Image" class="image_1">
                                        <div class="badge"><?=$row['SoLuong'];?></div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle;"><?=$row['TenSanPham'];?></td>
                                <td style="vertical-align: middle;"><?=$row['DonGiaApDung'];?></td>
                            </tr>
                            <?php $tamtinh += $row['SoLuong'] * $row['DonGiaApDung']; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2">Giảm giá</td>
                                <td style="color: red;">-<?=$row['giamgia']?>%</td>
                            </tr>
                            <tr>
                                <td colspan="2">Tạm tính</td>
                                <?php print_r($tamtinh); ?>
                                <td><?=$tamtinh - ($tamtinh * $row['giamgia'] / 100);?> </td>
                            </tr>
                            <tr>
                                <td colspan="2">Phí vận chuyển</td>
                                <td>Miễn phí</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;" colspan="2">Tổng tiền</td>
                                <td><?=$info[0]['TongTien'];?></td>
                            </tr>
                        </table>
                    <hr>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<?php
    include "./Views/Layout/footer.php";
?>