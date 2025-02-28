<?php
    include("./Views/HomeLayout/header.php");
    echo"<title>Đăng kí tài khoản</title>";
?>
<head>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }

    
    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .section {
      margin-bottom: 20px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 20px;
    }

    .section:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .section-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    } */

    .form-group {
      margin-bottom: 10px;
    }

    label {
      /* display: block; */
      font-weight: bold;
      margin-bottom: 5px;
      text-align: left;
      width: 100%;
    }

    /* input[type="text"],
    input[type="text"],
    input[type="password"],
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    } */
/* 
    .shipping-options label,
    .payment-options label {
      font-weight: normal;
      margin-bottom: 5px;
      display: block;
    } */


    
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="POST" class="login-form">
      <div class="section">
        <h2 class=" text-center text-primary fw-bolder">Đăng kí tài khoản</h2>
        <hr>
        <div style="color: red; text-align: center;"><?php if(!is_null($mess)) {echo $mess;} ?></div>
        <div style="margin-bottom: 0;" class="form-group">
          <label for="email">Tên khách hàng</label>
          <input class="form-control" type="text" id="text" name="tenkhachhang">
        </div>
        <br>
        <div style="margin-bottom: 0;" class="form-group">
          <label for="email">Tên đăng nhập</label>
          <input class="form-control" type="text" id="email" name="tendangnhap">
        </div>
        <br>
        <div style="margin-bottom: 0;" class="form-group">
          <label for="phone">Mật khẩu</label>
          <div class="input-group">
            <input class="form-control" type="password" id="password" name="matkhau" placeholder="Password..." class="input-group form-control">
            <i class="fa fa-eye show_hide input-group-text" onclick="togglePassword()"></i>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 10px;" class="form-group">
          <label for="phone">Nhập lại mật khẩu</label>
          <div class="input-group">
            <input class="form-control" type="password" id="password2" name="matkhau2" placeholder="Password..." class="input-group form-control">
            <i class="fa fa-eye show_hide input-group-text" onclick="togglePassword2()"></i>
          </div>
        </div>

      </div>
      <div>
        <input style="width: 100%;" type="submit" value="Đăng kí" name="submit" class="btn btn-primary">
      </div>
    </form>
  </div>
  <script>
		function togglePassword() {
      var iElement = document.querySelector('i');
			var passwordInput = document.getElementById('password');
			if (passwordInput.type === 'password') {
        iElement.classList.remove('fa-eye');
        iElement.classList.add('fa-eye-slash');
				passwordInput.type = 'text';
			}
      else {
        iElement.classList.remove('fa-eye-slash');
        iElement.classList.add('fa-eye');
				passwordInput.type = 'password';
			}
		}
    function togglePassword2() {
            var iElement = document.querySelector('i');
      var passwordInput = document.getElementById('password2');
			if (passwordInput.type === 'password') {
        iElement.classList.remove('fa-eye');
        iElement.classList.add('fa-eye-slash');
				passwordInput.type = 'text';
			}
      else {
        iElement.classList.remove('fa-eye-slash');
        iElement.classList.add('fa-eye');
				passwordInput.type = 'password';
			}
		}
</script>
