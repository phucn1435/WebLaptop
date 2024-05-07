
  <style>
    /* CSS cho form thêm địa chỉ */
    .add-address-form {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      /* display: none; */
      display: block;
    }

    /* CSS cho lớp mờ */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* display: none; */
      display: block;
    }
  </style>
  <h1>Thông tin tài khoản</h1>
  <!-- Nút "Thêm địa chỉ" -->
  <button id="add-address-btn">Thêm địa chỉ</button>

  <!-- Form thêm địa chỉ -->
  <div class="overlay"></div>
  <div class="add-address-form">
    <h2>Form thêm địa chỉ</h2>
    <!-- Nội dung form thêm địa chỉ -->
    <!-- Ví dụ: -->
    <form action="" method="post">
      <label for="address">Ho ten:</label>
      <input type="text" id="hoten" name="hoten">
      <br>

      <label for="address">SDT:</label>
      <input type="text" id="sdt" name="sdt">
      <br>

      <label for="address">Email:</label>
      <input type="text" id="email" name="email">
      <br>

      <label for="address">Địa chỉ:</label>
      <input type="text" id="address" name="address">
      <br>


      
      <input type="submit" value="Thêm" name="submitAD">
    </form>
  </div>

  <script>
    const addAddressBtn = document.getElementById('add-address-btn');
    const addAddressForm = document.querySelector('.add-address-form');
    const overlay = document.querySelector('.overlay');

    // Hiển thị form thêm địa chỉ khi nhấn vào nút "Thêm địa chỉ"
    addAddressBtn.addEventListener('click', function() {
      addAddressForm.style.display = 'block';
      overlay.style.display = 'block';
    });

    // Ẩn form thêm địa chỉ khi nhấn nút "Đóng" hoặc click bên ngoài form
    overlay.addEventListener('click', function() {
      addAddressForm.style.display = 'none';
      overlay.style.display = 'none';
    });
  </script>
