<?php
// Kết nối tới database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanly";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start(); // Bắt đầu phiên
require('connect.php');

// Lấy tên người dùng từ session
$name = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM khachhang WHERE fullname LIKE '%$search%' OR address LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM khachhang";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Danh Sách Khách Hàng</title>
    <link rel="stylesheet" href="css/khachhang.css">
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
                    <?php 
                    if (!empty($name)): ?>
                <div class="user-info-container">
                    <span class="user-info">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
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
            <div class="container">
        <h1>Danh Sách Khách Hàng</h1>
            <!-- Thanh tìm kiếm -->
            <form method="get" class="search-form">
                <input type="text" name="search" placeholder="Tìm kiếm khách hàng theo tên hoặc địa chỉ" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn">Tìm kiếm</button>
            </form>
            <!-- Nút thêm khách hàng -->
            <a href="insertc.php" class="btn">Thêm Khách Hàng</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>Địa Chỉ</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['number']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['password']}</td>
                                <td>
                                    <a href='sua.php?id={$row['id']}' class='btn-edit'>Sửa</a>
                                    <a href='xoa.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa khách hàng này không?\");'>Xóa</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có khách hàng nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>