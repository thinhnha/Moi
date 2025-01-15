<?php
session_start();

// Kết nối cơ sở dữ liệu
$host = 'localhost';
$db = 'quanly';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Kiểm tra đăng nhập cho quản lý
        $stmtAdmin = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmtAdmin->bindParam(':username', $username);
        $stmtAdmin->execute();
        $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

        if ($admin && $admin['password'] == md5($password)) { // So sánh với MD5
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = 'admin';
            header('Location: index_admin.php');
            exit();
        }

        // Kiểm tra đăng nhập cho khách hàng
        $stmtCustomer = $conn->prepare("SELECT * FROM khachhang WHERE username = :username");
        $stmtCustomer->bindParam(':username', $username);
        $stmtCustomer->execute();
        $customer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);

        if ($customer && $customer['password'] == md5($password)) { // So sánh với MD5
            $_SESSION['user'] = $customer['username']; // Gán session cho người dùng
            $_SESSION['user_id'] = $customer['id'];
            $_SESSION['role'] = 'customer';
            header('Location: index.php'); // Chuyển hướng đến trang chủ
            exit();
        }

        $error = "Tên người dùng hoặc mật khẩu không đúng.";
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="Css/login.css">
</head>
<body background="images/background2.jpg">
    <div class="main">
        <h1>Đăng nhập</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-container">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="input-container">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="button-container">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Tạo tài khoản</a></p>
    </div>
</body>
</html>
