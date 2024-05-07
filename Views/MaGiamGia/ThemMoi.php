<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm nhân viên</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Thêm mã giảm giá</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../MaGiamGia/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Thêm mới
    </span>
    
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Nhập tên chương trình ưu đãi</label>
        <input type="text" value=""name="tenuudai" class="form-control"> <br>

        <label class="h6">Hình ảnh đại diện chương trình ưu đãi</label> <br>
        <input type="file" id="file-upload" name="hinhanh"><br>

        <label class="h6">Mã ưu đãi</label>
        <input type="text" id="tenma" value=""name="mauudai" class="form-control">
        <button id="createCode" class="btn btn-warning text-white mt-2">Tạo mã ưu đãi ngẫu nhiên</button> <br>
       
        <label class="h6">Mô tả</label>
        <textarea class="form-control" name="mota" id="" cols="30" rows="3">

        </textarea> <br>
        
       
        <label class="h6">Loại ưu đãi</label>
        <select class="form-select" name="loaiuudai" id="">
            <option value="0">Chọn</option>
            <?php foreach($listTypeCodeDiscount as $item) { ?>
                <option value="<?=$item['ID']?>"><?=$item['name'];?></option>
            <?php } ?>
        </select> <br>
        <!-- <input type="text" value=""name="loaiuudai" class="form-control"><br> -->
        <label class="h6">Mức ưu đãi</label>
        <input type="text" value=""name="luuluong" class="form-control"><br>
        
        <label class="h6">Ngày hết hạn mã ưu đãi</label>
        <input type="date" id="inputDate" onchange="validateDate()" value=""name="ngayhethan" class="form-control"><br>

        <label class="h6">Chi tiêu tối thiểu</label>
        <input type="text" value=""name="toithieu" class="form-control"><br>
        
        <label class="h6">Chi tiêu tối đa</label>
        <input type="text" value=""name="toida" class="form-control"><br>

        <label class="h6">Chỉ dùng cho cá nhân</label> <br>
        <input type="checkbox" value="1" name="onlyUse" class="form-checkbox"> Đánh dấu vào ô này nếu như mã ưu đãi không được sử dụng với các mã khác <br>
        <br>
        <label class="h6">Chọn sản phẩm cần giảm (Nếu muốn)</label> <br>
        <select class="form-select" name="arrayProduct" id="selectProduct">
            <option value="0">Chọn</option>
            <?php foreach($listProduct as $row) : extract($row); ?>
                <option value="<?=$row['ID']?>"><?=$row['TenSanPham']?></option>
            <?php endforeach; ?>
        </select>
        
        <div style="background: #ccc; border: 1px solid gray; width: 100%; height: 15vh; border-radius: 7px; margin-top: 10px; overflow: auto;">
            <div style="padding: 8px;" class="">
                <div style="text-align: center; font-weight: bold;" class="">Các sản phẩm đã chọn</div>
            </div>   
            <div id="test">
            
            </div>
        </div>
        
      
        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary w-100">
       
    </form>
</div>

<script>
    function generateRandomCode() {
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let code = '';

    for (let i = 0; i < 6; i++) {
        let randomIndex = Math.floor(Math.random() * characters.length);
        code += characters.charAt(randomIndex);
    }

    return code;
}

    $('#createCode').on('click', (e)=> {
        $('#tenma').val(generateRandomCode());
        e.preventDefault();
    });

    $('#selectProduct').on('change', ()=> {
        var a = $('#selectProduct').val();
        if (a > 0) {
        $.ajax({
            url: "../MaGiamGia/xuli",
            method: "POST",
            data: {data: a},

            success: function(data){
                $('#test').html(data);
                }
            });
        }
    })

    // $('#oke').on('click', (e)=> {
    //     var c = $('#oke').data('id_sp');
    //     alert(c);
        
    // });

    $(document).on('click', '.fa-circle-xmark', function() {
        var id_sp = $(this).data('id_sp');
        alert('Giá trị của data-id_sp: ' + id_sp);
        $.ajax({
            url: "../MaGiamGia/xoa",
            method: "POST",
            data: {data: id_sp},

            success: function(data){
                $('#test').html(data);
                        // window.location.href = "../TrangChu/GioHang1";
            }
        });
    // Nếu bạn muốn thực hiện thêm hành động sau khi alert, bạn có thể thêm mã JS tại đây.
    });

    
    function validateDate() {
      // Lấy giá trị ngày hiện tại
      var currentDate = new Date();

      // Lấy giá trị ngày được chọn từ trường input date
      var selectedDate = new Date(document.getElementById("inputDate").value);

      // So sánh ngày được chọn với ngày hiện tại
      if (selectedDate < currentDate) {
        // Nếu ngày được chọn nhỏ hơn ngày hiện tại, báo lỗi
        alert("Ngày không hợp lệ. Vui lòng chọn một ngày trong tương lai.");
        // Xoá giá trị ngày đã chọn
        document.getElementById("inputDate").value = "";
      }
    }
        
</script>
<?php
    include "./Views/Layout/footer.php";
?>