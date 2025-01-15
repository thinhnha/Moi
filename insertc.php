<?php
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

// Xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($fullname) || empty($address) || empty($email) || empty($number) || empty($username) || empty($password)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM khachhang WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = "Tên đăng nhập hoặc email đã được sử dụng.";
        } else {
            $hashedPassword = md5($password); // Mã hóa bằng md5 như yêu cầu
            $stmt = $conn->prepare("INSERT INTO khachhang (fullname, address, email, number, username, password) 
                                    VALUES (:fullname, :address, :email, :number, :username, :password)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':number', $number);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                header('Location: khachhang.php');
                exit();
            } else {
                $error = "Đã xảy ra lỗi khi thêm dữ liệu.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="css/insertc.css">
    </head>
    <body>
    <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <div>
            <form method="post">
                <div>
                    <label for="fullname">Họ và tên: </label>
                    <input type="text" name="fullname" id="fullname" required>
                </div>
                <div>
                    <label for="address">Địa chỉ: </label>
                    <input type="text" name="address" id="address" required>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div>
                    <label for="number">Số điện thoại: </label>
                    <input type="number" name="number" id="number" required>
                </div>
                <div>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="text" name="password" id="password" required>
                </div>
                <input type="submit" name="insert" value="Lưu" required>
            </form>
        </div>
    </body>
</html>