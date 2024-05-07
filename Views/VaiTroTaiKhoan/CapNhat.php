<?php
    include "./Views/Layout/header.php";
    echo "<title>Thêm nhân viên</title>";
?>

<div class="col-md-12 mt-2">
    <span class="h3 m-2">Cập nhật vai trò tài khoản</span>
    <span>
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        <a class="title-non_active" href="../TrangThaiSanPham/DanhSach">Danh sách</a>
    </span>
    <span class="title-active">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    Thêm mới
    </span>
    
    <hr>

    <form method="post" class="form-group col-md-7" style="margin: auto;" enctype="multipart/form-data">
        <label class="h6">Tên vai trò</label>
        <input type="text" value="<?php if(isset($getName)) {echo $getName;} ?>" name="tenvaitro" class="form-control"><br>

        <label class="h6">Chọn quyền cho vai trò</label> <br>
        <input style="display: inline-block; margin-left: 12px" type="checkbox" name="test[]" value="" id="checkbox-all" onclick="checkboxall()">Chọn tất cả
        <?php 
            if(!empty($result)):
            $i = 0;
            foreach($result as $row) : extract($row);$i++; ?>
            <div class="row">
                <div class="col-sm-12">
                    <h4 style="margin-top: 10px;"><?php echo $row['tenquyen'] ?></h4>
                    <div class="row">
                        <?php 
                        if(!empty($result1)):
                        $i = 0;
                        foreach ($result1 as $row1) : extract($row1);$i++; 
                        if($row1['ID_group'] == $row['ID']) { ?> 
                        
                        <div class="col-sm-3">
                            <input onchange="updateSelectAll()" <?php foreach($dataUpdate as $item) { if ($item['ID_quyen'] == $row1['ID']) {echo "checked";}} ?> class="hehe" type="checkbox" name="privilege[]" value="<?php echo $row1['ID'] ?>" >
                            <?php echo $row1['ten'] ?>
                        </div>
                        <?php } ?> 
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        <hr>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
    </form>
</div>
<script>
   function checkboxall() {
    var mainCheckbox = document.getElementById('checkbox-all');
            var isChecked = mainCheckbox.checked;

            var checkboxes = document.getElementsByClassName('hehe');

            for (var i = 3; i < checkboxes.length; i++) {
                if (checkboxes[i].id !== 'mainCheckbox') {
                    checkboxes[i].checked = isChecked;
                } 
            }
   }
   function updateSelectAll() {
    var selectAllCheckbox = document.getElementById('checkbox-all');
    var checkboxes = document.getElementsByClassName('hehe');
    var allChecked = true;
  
    // Kiểm tra xem tất cả các ô có được chọn hay không
    for (var i = 3; i < checkboxes.length; i++) {
      if (!checkboxes[i].checked) {
        allChecked = false;
        break;
      }
    }
  
    selectAllCheckbox.checked = allChecked;
  }
   </script>
<?php
    include "./Views/Layout/footer.php";
?>