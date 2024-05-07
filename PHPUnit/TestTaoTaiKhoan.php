<?php 
class TaoTaiKhoan {
    private $tenkhachhang;
    private $username;
    private $password;
    private $re_password;

    public function __construct($tenkhachhang,$username,$password,$re_password) {
        $this->tenkhachhang =  $tenkhachhang;
        $this->username =  $username;
        $this->password =  $password;
        $this->re_password =  $re_password;
    }
}

?>