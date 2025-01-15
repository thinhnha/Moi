<?php
session_start(); // Bắt đầu phiên
require('connect.php');

// Lấy tên người dùng từ session
$name = isset($_SESSION['username']) ? $_SESSION['username'] : '';

require('connect.php');
$sql = "SELECT * FROM donhang";
if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date_order = $_POST['date_order'];

    $sql_product = "SELECT * FROM sanpham WHERE name = '$product_name'";
    $result_product = $conn->query($sql_product);

    if ($result_product && $result_product->num_rows > 0) {
        $product = $result_product->fetch_assoc();
        $total_bill = $product['price'] * $quantity;

        if (strpos($email, '@gmail.com') !== FALSE) {
            if ($product_name == $row['name']) {
                $sql_insert = "INSERT INTO `donhang` (`username`, `product_name`, `total_bill`, `quantity`, `email`, `phone`, `address`, `date_order`) 
                VALUES ('$username', '$product_name', '$total_bill', '$quantity', '$email', '$phone', '$address', '$date_order')";
                if ($conn->query($sql_insert) === TRUE) {
                    header("Location: donhang.php");
                }
            }
         else {
            $message = "Không có sản phẩm nào tên '$product_name'.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            }
    } else {
        $message = "Hãy nhập địa chỉ email cụ thể";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
}

if (isset($_GET['action']) == 'delete') {
    $id = (int) $_GET['id'];
    $sql = "DELETE FROM donhang WHERE id={$id}";
    $result = $conn->query($sql);
    if ($result) {
        header("Location:donhang.php");
    }
}
if (isset($_GET['action']) == 'update') {
    $id = (int) $_GET['id'];
    $username = $_POST['username'];
    $product_name = $_POST['product_name'];
    $sql = "SELECT * FROM hoadon WHERE id={$id}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $quantity = $_POST['quantity'];
    $total_bill = $row['price'] * $quantity;
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date_order = $_POST['date_order'];
    if (strpos($email, '@gmail.com') !== FALSE) {
        $sql = "UPDATE donhang WHERE username = '$username', product_name = '$product_name', quantity = '$quantity', total_bill = '$total_bill', email = '$email', phone = '$phone', address= '$address',date_order = '$date_order' ";
        if ($conn->query($sql) === TRUE) {
            header("Location:donhang.php");
        }
    } else echo "Hãy nhập địa chỉ email cụ thể";
}
// Xử lý tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM donhang WHERE username LIKE '%$search%' OR product_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM donhang";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> 
    <title>Danh Sách Đơn Hàng</title>
    <link rel="stylesheet" href="css/donhang.css">
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
                <h1>Danh Sách Đơn Hàng</h1>
                
                <!-- Thanh tìm kiếm -->
                <form method="get" class="search-form">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm theo tên hoặc loại" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn">Tìm Kiếm</button>
                </form>
                
                <!-- Nút thêm sản phẩm -->
                <a href="insert_donhang.php" class="btn">Thêm Đơn Hàng</a>
        <!-- Hiển thị đơn hàng -->
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0):
                while ($row = mysqli_fetch_array($result)):
                    // Xử lí thông tin về định dạng ngày sinh, giói tính, trình độ học vấn
                    $date_order = date("d/m/Y", strtotime($row['date_order']));

            ?> <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['total_bill'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['address'] ?></td>
                        <td><?php echo $date_order ?></td>
                        <td>
                            <a href="sua_donhang.php" class="btn-edit">Sửa</a>
                            <a href="?action=delete&id=<?php echo $row['id'] ?>" class="btn-delete">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
        </table>
    </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>