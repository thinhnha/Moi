<?php
session_start();
require('connect.php');
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem giỏ hàng'); window.location.href='login.php';</script>";
    exit;
}
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : "";
if(isset($_POST['update']))
{
    $id = (int) $_POST['id'];
}
    $product_id = intval($_POST['id']);
    $quantity = intval($_POST['amount']);
    $result = $conn->query("SELECT * FROM sanpham WHERE id = $product_id");
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $total_bill = $product['price'] * $quantity;
        $existing_cart = $conn->query("SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id");
        if ($existing_cart->num_rows > 0) {
            $conn->query("UPDATE cart SET quantity=quantity + $quantity WHERE user_id=$user_id AND product_id=$product_id");
        } else {
            $conn->query("INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `total_bill`) VALUES ('$user_id', '$product_id', '$quantity','$total_bill')");
        }
    }
    header('Location: view_cart.php');
?>
