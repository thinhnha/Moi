<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <link rel="stylesheet" href="css/admin.css"> <!-- Đường dẫn tới file CSS -->
    <title>Trang chủ - Cửa hàng game giá rẻ</title>
</head>
<body>
    <div id="all-content">
            <div id="title"> 
                <a href="index_admin.php">
                    <img src="images/logomenu.png" alt="logo" style="height: 60px; width: 60px; margin: 0px; margin-left: 200px;">
                </a>
                <a href="index_admin.php" id="admin"><p>ADMIN</p></a>
                <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                <div class="form-login">
                <?php if (!empty($username)): ?>
                    <div class="user-info-container">
                    <span class="user-info">Xin chào, <?php echo htmlspecialchars($username); ?>!</span>
                    <a href="logout.php" class="logout-btn">Đăng xuất</a>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="donhang.php"><i class="fa-solid fa-list"></i> Quản lý đơn hàng</a></li>
                    <li><a href="sanpham.php"><i class="fa-solid fa-gamepad"></i> Quản lý sản phẩm</a></li>
                    <li><a href="khachhang.php"><i class="fa-solid fa-user"></i> Quản lý người dùng</a></li>
                </ul>
            </div>
            <div id="background">
                    <img src="images/hinh-nen-desktop.jpg" alt="back">
            </div>
    </div>
</body>
</html>