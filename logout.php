<?php
session_start(); // Khởi tạo session

// Hủy tất cả các biến session
session_unset(); 

// Hủy session
session_destroy(); 

// Quay lại trang chủ (index.php)
header('Location: index.php'); 
exit();
?>