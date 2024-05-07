<?php

// Chuỗi hash thực tế được lưu trữ trong cơ sở dữ liệu
// $storedHashedPassword = '$2y$12$6zGQ5o3Rj65bXdpnsXa.vuJQ6Z8DJwWfcAZUe5Y.0NVhnCJnp6B8C';
$password = "123123123";
$en = password_hash($password, PASSWORD_BCRYPT);

// Mật khẩu mà người dùng nhập vào khi đăng nhập
// $userEnteredPassword = 'user-entered-password';
// $ec = password_hash($userEnteredPassword, PASSWORD_BCRYPT);
// echo $ec;
// Kiểm tra mật khẩu
if (password_verify($password, $en)) {
    echo 'Đăng nhập thành công!';
} else {
    echo 'Sai mật khẩu!';
}

?>
