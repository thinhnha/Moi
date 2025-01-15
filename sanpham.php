<?php
// Kết nối tới database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanly";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM sanpham WHERE name LIKE '%$search%' OR type LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM sanpham";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> 
    <title>Danh Sách Sản Phẩm</title>
    <link rel="stylesheet" href="css/sanpham.css">
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
                    session_start(); // Đảm bảo session đã được khởi tạo
                    if (!empty($_SESSION['username'])): ?>
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
                <h1>Danh Sách Sản Phẩm</h1>
                
                <!-- Thanh tìm kiếm -->
                <form method="get" class="search-form">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm theo tên hoặc loại" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn">Tìm Kiếm</button>
                </form>
                
                <!-- Nút thêm sản phẩm -->
                <a href="insert.php" class="btn">Thêm Sản Phẩm</a>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Loại</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Ảnh info</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>" . number_format($row['price'], 0, ',', '.') . " VND</td>
                                        <td>{$row['type']}</td>
                                        <td><img src='{$row['img']}' alt='{$row['name']}' width='100'></td>
                                        <td>{$row['quantity']}</td>
                                        <td><img src='{$row['img_info']}' alt='{$row['name']}' width='100'></td>
                                        <td>
                                            <a href='update.php?id={$row['id']}' class='btn-edit'>Sửa</a>
                                            <a href='sell.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này không?\");'>Xóa</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
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