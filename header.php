<?php
session_start();
require ('connect.php');
// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user'])) {
    $username = htmlspecialchars($_SESSION['user']);
} else {
    $username = "";
}

$doanhthu = "SELECT * FROM doanhthu WHERE id=1";
$ketqua = $conn->query($doanhthu);
$tong = $ketqua->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <link rel="stylesheet" href="Css/app.css"> <!-- Đường dẫn tới file CSS -->
    <title>Trang chủ - Cửa hàng game giá rẻ</title>
</head>
<body>
<header id="header">
    <nav class="container-menu">
        <div class="head">
            <a href="index.php" id="logomenu">
                <img src="images/logomenu.png" alt="logomenu">
            </a>
           <!-- Thanh tìm kiếm -->
           <div class="form-search">
                <form class="example" style="margin:auto;max-width:300px" method="GET" action="index.php">
                    <input type="text" placeholder="Nhập thông tin để tìm kiếm" name="noidung">
                    <button type="submit" name="search"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <ul id="main-menu">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="dia.php">Đĩa</a></li>
            <li><a href="view_cart.php">Giỏ hàng</a></li>
        </ul>
        
        <!-- Kiểm tra nếu người dùng đã đăng nhập -->
        <div class="form-login">
            <?php if (!empty($username)): ?>
                <span class="user-info">Chào, <?php echo $username; ?>!</span>
                <a href="logout.php" class="logout-btn">Đăng xuất</a>
            <?php else: ?>
                <button type="button" class="login-btn" onclick="window.location.href='login.php';">Đăng nhập</button>
            <?php endif; ?>
        </div>
    </nav>
</header>
</body>
</html>