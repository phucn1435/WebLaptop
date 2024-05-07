<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm sản phẩm</title>";
?>
<style>
    .tab {
        width: 43%;
    }
    .slick-tabs {
  display: flex;
  flex-direction: column;
  width: 800px; /* Adjust width as needed */
  margin: 0 auto;
}

.slick-tabs nav {
  display: flex;
}

.slick-tabs nav button {
  padding: 10px 20px;
  margin: 5px;
  border: 1px solid #ddd;
  border-radius: 5px;
  cursor: pointer;
}

.slick-tabs nav button.active {
  background-color: #eee;
}

.content {
  flex: 1; /* Allow content to fill remaining space */
}

.slick-tabs .slick-prev,
.slick-tabs .slick-next {
  display: none !important; /* Hide the buttons */
}

</style>
<div class="col-md-12 mt-2">
    <span class="h3 m-2">Sản Phẩm</span>
    <span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../SanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        Thêm mới
    </span>
    <hr>
    <?php if(!empty($error)) { ?>
        <p style="color: red; text-align: center;"><?= $error; ?></p>
    <?php } ?>
    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tên sản phẩm</label>
        <input type="text" name="tensanpham" class="form-control">

        <label class="h6">Loại sản phẩm</label> <br>
        <select class="form-select" name="idloaisanpham">
            <?php 
                if(!empty($result)):
                foreach ($result as $row) : extract($row)?> 
                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['TenLoaiSanPham']; ?></option>
            <?php endforeach; endif; ?>
        </select> <br>
        
        <label class="h6">Giá</label> <br>
        <input id="gia" type="text" name="gia" class="form-control"><br>

        <label class="h6">Giá khuyến mãi</label> <br>
        <input type="text" id="giaKhuyenMai" name="giakhuyenmai" class="form-control" onblur="kiemTraGia()"> <a id="up_schedule" href="">Schedule</a> <br> <br>
        
        <div style="display: none;" id="schedule">
            <label class="h6">Ngày bắt đầu</label> <br>
            <input id="ngaybatdau" type="date" onchange="validateDate()" name="ngaybatdau" class="form-control"><br>
            
            <label class="h6">Ngày kết thúc</label> <br>
            <input id="ngayketthuc" type="date" onchange="validateDate()" name="ngayketthuc" class="form-control"><br>
        </div>

        <label class="h6">Số lượng</label>
        <input type="text" name="soluong" class="form-control"><br>

        <label class="h6">Mô tả</label> <br>
        <textarea rows="9" cols="70" name="mota" placeholder="Nhập mô tả..."></textarea> <br>

        <label class="h6">Hình ảnh</label> <br>
        <input type="file" id="file-upload" name="hinhanh"><br>

        <label class="h6">Trạng thái bán</label> <br>
        <select class="form-select" name="trangthai">
           <option value="1">Kích hoạt</option>
           <option value="0">Không Kích hoạt</option>
        </select> <br>

        <label class="h6">Trạng thái sản phẩm</label> <br>
        <select class="form-select" name="trangthaisp">
        <?php foreach($trangthaisanpham as $item) { ?>
            <option value="<?=$item['ID'];?>"><?=$item['TenTrangThai'];?></option>
        <?php } ?>
        </select>
        <br>
        <!-- <div class="slick-tabs"> -->
            <!-- <nav>
                <button type="button" class="tab">Tạo thuộc tính</button>
                <button type="button" class="tab">Các sản phẩm biến thể</button>
            </nav>
            <div class="content">
                <div class="slide">
                    <button type="button" class="btn btn-primary" id="add">Add+</button>
                    <select id="select_tt" name="" class="form-select" style="display: inline; width: auto;" id="">
                        <option value="">Thêm thuộc tính có sẵn</option>
                        <?php foreach($list_ttsp as $item) { ?>
                            <option value="<?=$item['ID'];?>"><?=$item['tenthuoctinh'];?></option>
                        <?php } ?>
                    </select>
                    <div id="attribute-container"></div>

                    <div id="attribute-form" style="display: none;"> <form id="attribute-details"> <h3 id="attribute-title">Thuộc tính của Option đã chọn</h3>
                    <ul id="attribute-list"></ul> </form>
                    </div>
                    <div id="attributes" class="mt-2">
                        <div class="form-group mt-2"> -->
                            <!-- <input type="text" name="attribute[]" placeholder="Attribute">
                            <input type="text" name="value[]" placeholder="Value">
                            <button type="button" class="delete">Delete</button> -->
                        <!-- </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </div>

                <div class="slide">Slide Content 2</div>
            </div> -->
        <!-- </div> -->
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="../SanPham/DanhSach" class="btn btn-warning">Quay lại</a>
        <hr>
    </form>
</div>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace('mota');
</script>
<script>
    function kiemTraGia() {
      // Lấy giá trị từ ô input
      var gia = parseFloat(document.getElementById('gia').value);
      var giaKhuyenMai = parseFloat(document.getElementById('giaKhuyenMai').value);

      // Kiểm tra nếu giá khuyến mãi lớn hơn giá
      if (giaKhuyenMai > gia) {
        // Hiển thị thông báo
        alert('Giá khuyến mãi lớn hơn giá!');

        // Đổi màu chữ của ô khuyến mãi thành đỏ
        document.getElementById('giaKhuyenMai').value = '';
      } else {
        // Nếu giá khuyến mãi không lớn hơn giá, đảm bảo màu chữ của ô khuyến mãi là màu đen
        document.getElementById('giaKhuyenMai').style.color = 'black';
      }
    }
    document.getElementById('add').addEventListener('click', function() {
            var attributesContainer = document.getElementById('attributes');
            var newAttribute = document.createElement('div');
            newAttribute.className = 'form-group';
            newAttribute.innerHTML = `
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="attribute[]" placeholder="Attribute">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="value[]" placeholder="Value">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="delete btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            attributesContainer.appendChild(newAttribute);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete')) {
                e.target.parentNode.remove();
            }
        });
       

    $("#up_schedule").on('click', (e)=> {
        e.preventDefault();
        // $('#schedule').css('display', 'block');

            var $schedule = $("#schedule");
        if ($schedule.css("display") === "block") {
            $schedule.css("display", "none");
        } else {
            $schedule.css("display", "block");
        }
    });

    function validateDate() {
      // Lấy giá trị ngày hiện tại
      var ngaybatdau = new Date(document.getElementById("ngaybatdau").value);

      // Lấy giá trị ngày được chọn từ trường input date
      var ngayketthuc = new Date(document.getElementById("ngayketthuc").value);

      // So sánh ngày được chọn với ngày hiện tại
      if (ngayketthuc < ngaybatdau) {
        // Nếu ngày được chọn nhỏ hơn ngày hiện tại, báo lỗi
        alert("Ngày không hợp lệ. Vui lòng chọn một ngày trong tương lai.");
        // Xoá giá trị ngày đã chọn
        document.getElementById("ngayketthuc").value = "";
      }
    }
</script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
    $(document).ready(function(){
  $('.content').slick({
    slidesToShow: 1, /* Show one slide at a time */
    slidesToScroll: 1, /* Scroll one slide at a time */
  });

  $('.tab').click(function(){
    var tabIndex = $(this).index(); // Get the index of the clicked tab
    $('.tab').removeClass('active'); // Deactivate all tabs
    $(this).addClass('active'); // Activate the clicked tab
    $('.content').slick('slickGoTo', tabIndex); // Go to the corresponding slide
  });
});

</script>
<script>
    function create() {
        let count_items = document.querySelectorAll('.oke').length - 1;
        count_items++;
        console.log(count_items);

        $('.add_tt').append(`
        <div class="row mt-2 oke">
            <div class="col-sm-4">
                <input type="text" name="tenthuoctinh[${count_items}][name]" placeholder="Tên thuộc tính" class="form-control">
            </div>
            <div class="col-sm-6">
                <input type="text" name="tenthuoctinh[${count_items}][value]" placeholder="Giá trị" class="form-control">
            </div>
            <button type="button" onclick="delete_(this)" class="col-sm-1 btn btn-danger">Xóa</button>
        </div>
        `);
    }
    
    function delete_(__this) {
        let count_items = document.querySelectorAll('.oke').length - 1;
        count_items--;
        $(__this).closest('.oke').remove();
    }

   
        function populateOptions() {
            var optionsData = [
                { id: 1, tenthuoctinh: "Option 1" },
                { id: 2, tenthuoctinh: "Option 2" },
                { id: 3, tenthuoctinh: "Option 3" },
                // Add more options as needed
            ];

            optionsData.forEach(function(option) {
                $("#select_tt").append("<option value='" + option.id + "'>" + option.tenthuoctinh + "</option>");
            });
        }

        // Function to retrieve attribute data (replace with your actual implementation)
        function getAttributeData(optionId) {
            // Replace with your logic to fetch attribute data based on optionId
            // For example, using AJAX or accessing data structures
            console.log("Fetching attribute data for option:", optionId);
            // Return the fetched attribute data as an object (e.g., { color: "red", size: "M" })
            return { color: "red", size: "M" }; // Example data
        }

        $(document).ready(function() {
            populateOptions(); // Populate options on page load

            $("#select_tt").change(function() {
                var selectedId = $(this).val();

                if (selectedId) {
                    alert("Selected Option ID: " + selectedId);

                    // Send AJAX request to PHP script
                    $.ajax({
                        url: '../SanPham/process_option_id', // Replace with your PHP script URL
                        type: 'POST',
                        data: { optionId: selectedId },
                        success: function(response) {
                            $("#attribute-container").html(response); // Replace with actual data display logic

                            // Create and append delete button
                            var deleteButton = "<button class='delete-button'>Xóa</button>";
                            $("#attribute-container").append(deleteButton);

                            // Attach delete button event listener
                            $("#attribute-container .delete-button").click(function() {
                                $(this).parent().remove(); // Remove the form containing the delete button
                                $("#select_tt option[value='" + selectedId + "']").prop('disabled', false); // Re-enable the option
                            });

                            // Disable the selected option
                            $(this).find("option[value='" + selectedId + "']").prop('disabled', true);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX Error:", textStatus, errorThrown);
                        }
                    });
                } else {
                    // Clear attribute container when no option is selected
                    $("#attribute-container").empty();
                }
            });
        });






</script>
<?php
    include "./Views/Layout/footer.php";
?>