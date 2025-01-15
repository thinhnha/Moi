<?php
session_start();
require('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để sử dụng chức năng này'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $cart_id = intval($_GET['id']);
    $conn->query("DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id");
}

header('Location: view_cart.php');
?>
