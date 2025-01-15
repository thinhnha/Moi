<?php
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
$result = $conn->query($sql);
?>  
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <style>
            /* Đặt lại một số kiểu mặc định cho các phần tử HTML */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                padding: 20px;
            }

            h2 {
                text-align: center;
                margin-bottom: 30px;
            }

            form {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: 0 auto;
            }

            form div {
                margin-bottom: 15px;
            }

            form label {
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }

            form input[type="text"],
            form input[type="email"],
            form input[type="number"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
            }

            form input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                width: 100%;
                margin-top: 20px;
            }

            form input[type="submit"]:hover {
                background-color: #45a049;
            }

            form input[type="submit"]:focus {
                outline: none;
            }
        </style>
        <div>
        <form method="post">
            <div>
                <label for="username">Tên khách hàng: </label>
                <input type="text" name="username" id="username" value="<?= $row['username'] ?>">
            </div>
            <div>
                <label for="product_name">Tên sản phẩm: </label>
                <input type="text" name="product_name" id="product_name" value="<?= $row['product_name'] ?>">
            </div>
            <div>
                <label for="quantity">Số lượng: </label>
                <input type="number" name="quantity" id="quantity" value="<?= $row['quantity'] ?>">
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="text" name="email" id="email" value="<?= $row['email'] ?>">
            </div>
            <div>
                <label for="phone">Số điện thoại: </label>
                <input type="text" name="phone" id="phone" value="<?= $row['phone'] ?>">
            </div>
            <div>
                <label for="address">Địa chỉ: </label>
                <input type="text" name="address" id="address" value="<?= $row['address'] ?>">
            </div>
            <div>
                <label for="date_order">Ngày: </label>
                <input type="date" name="date_order" id="date_order" value="<?= $row['date_order'] ?>">
            </div>
            <input type="submit" name="update" id="update" value="Lưu">
        </form>
    </div>
    </body>
</html>