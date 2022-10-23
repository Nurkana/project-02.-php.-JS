<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
   
    date_default_timezone_set('Asia/Almaty');
   
    $con = mysqli_connect("localhost", "root", "", "project01" );
    mysqli_set_charset($con, "utf8");

    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

?>