<?php

class PageErrorController{
    // private $model;
    // private $db;
    
    // public function __construct(){
    //     $this->model = new NhanVien();
    //     $this->db = new Database();
    // }
    
    public function e404() {
        include("Views/Errors/404.php");
    }
}