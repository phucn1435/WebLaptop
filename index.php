<?php
    session_start();
    //gọi hàm kết nối sql(connect) từ class Database trong Models
    // unset($_SESSION['soluongsanpham']);
    unset($_SESSION['huydon']);

    // unset($_SESSION['reloaded']); 
    include "./Models/loginAdmin.php";
    include "./Models/Database.php";
    // include "./Models/ThongBao.php";

    $db =  new Database();
   
    $nameController = ucfirst(($_REQUEST['url'] ?? 'TrangChu').'Controller');
    $action = $_REQUEST['action'] ?? header('Location: ./TrangChu/Index');
    // $action = $_REQUEST['action'];
    // if (empty($action)) {
    //     header("Location: ./TrangChu/Index");
    //     include "./Controllers/TrangChuController.php";
    //     $controller = new $nameController();
    //     $controller->$action();
    // } else {
    //     // $flag = 0;
    //     $dir = "Controllers";

    //     // Sử dụng glob để lấy danh sách tệp trong đường dẫn đã chỉ định
    //     $files = glob($dir . '/*');
        
    //     // Lọc ra chỉ các tệp (loại bỏ thư mục)
    //     $files = array_filter($files, 'is_file');
    
    //     $result = [];
    
    //     foreach ($files as $file) {
    //         $baseName = basename($file, '.php');
    //         $result[] = $baseName;
    //     }

    //     if (in_array($nameController,$result)) {
    //         $fileContent = file_get_contents("Controllers/$nameController.php");
    //         $pattern = '/\bfunction\s+([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*\(/';
    //         preg_match_all($pattern, $fileContent, $matches);
    //         $functionNames = $matches[1];
    //         if (in_array($action,$functionNames)) {
    //             include "./Controllers/$nameController.php";
    //             $controller = new $nameController();
    //             $controller->$action();
    //             // $flag = 1;
    //         } 
    //         else {
    //             header("Location: ../PageError/e404");
    //             // $flag = 0;
    //         }
    //     } 
    //     else {
    //         header("Location: ../PageError/e404"); 
    //         // $flag = 0;
    //     }
    // }

   
    include "./Controllers/$nameController.php";
                $controller = new $nameController();
                $controller->$action(); 
    
    
?>