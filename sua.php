<?php
require('connect.php');
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `khachhang` WHERE `id` = {$id}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($_SERVER['REQUEST_METHOD']==='POST')
{  
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $number = $_POST['number'];     
    if(strpos($email, '@gmail.com') !== FALSE)
    $update = ("UPDATE khachhang SET fullname = '$fullname', address = '$address', email = '$email', number = '$number' WHERE id={$id}");
    if($conn->query($update) === TRUE)
    {
        header("Location:khachhang.php");
    }
}
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
                    <label for="fullname">Họ và tên: </label>
                    <input type="text" name="fullname" id="fullname" value="<?=$row['fullname']?>">
                </div>
                <div>
                    <label for="address">Địa chỉ: </label>
                    <input type="text" name="address" id="address" value="<?=$row['address']?>">
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" value="<?=$row['email']?>">
                </div>
                <div>
                    <label for="number">Số điện thoại: </label>
                    <input type="number" name="number" id="number" value="<?=$row['number']?>">
                </div>
                <div>
                <input type="submit" value="Lưu">
            </form>
        </div>
    </body>
</html>