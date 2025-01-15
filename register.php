<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$db = 'quanly';
$user = 'root'; // Thay bằng username của MySQL
$pass = '';     // Thay bằng mật khẩu của MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Kiểm tra các trường dữ liệu
    if (empty($fullname) || empty($address) || empty($email) || empty($number) || empty($username) || empty($password) || empty($confirmPassword)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } elseif ($password !== $confirmPassword) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        // Kiểm tra tên người dùng đã tồn tại chưa
        $stmt = $conn->prepare("SELECT * FROM khachhang WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = "Tên đăng nhập hoặc email đã được sử dụng.";
        } else {
            // Mã hóa mật khẩu
            $hashedPassword = md5($password);

            // Thêm dữ liệu vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO khachhang (fullname, address, email, number, username, password) 
                                    VALUES (:fullname, :address, :email, :number, :username, :password)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':number', $number);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Đăng ký thành công
                header('Location: login.php'); // Chuyển hướng đến trang đăng nhập
                exit();
            } else {
                $error = "Đã xảy ra lỗi. Vui lòng thử lại.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="Css/register.css">
</head>
<body background="background2.jpg">
    <div class="main">
        <h1>Đăng ký tài khoản</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-container">
                <label for="fullname">Họ và tên</label>
                <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
            </div>
            <div class="input-container">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>
            </div>
            <div class="input-container">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" required>
            </div>
            <div class="input-container">
                <label for="number">Số điện thoại</label>
                <input type="text" id="number" name="number" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="input-container">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="input-container">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="button-container">
                <button type="submit">Đăng ký</button>
            </div>
        </form>
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
