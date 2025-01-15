<?php
require ('connect.php');
if(isset($_POST['add']))
{
    $name = $conn->real_escape_string($_POST['name']);
    $price = intval($_POST['price']);
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $info = $_POST['info']; 
    $upload_dir = 'images/';
    $img_info = $upload_dir . basename($_FILES["img_info"]["name"]);
    $upload_file= $upload_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    $imgaeinfoFileType = strtolower(pathinfo($img_info,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
{
    $message = "Chỉ nhận tệp có định dạng JPG, JPEG, PNG";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
if($imgaeinfoFileType != "jpg" && $imgaeinfoFileType != "png" && $imgaeinfoFileType != "jpeg") 
{
    $message = "Chỉ nhận tệp có định dạng JPG, JPEG, PNG";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
  else { 
    move_uploaded_file($_FILES["img"]["tmp_name"], $upload_file); 
    move_uploaded_file($_FILES["img_info"]["tmp_name"], $img_info);
    $sql = "INSERT INTO `sanpham` (`name`, `price`, `type`,`quantity`, `img`,`info`,`img_info`)
            VALUES ('$name', '$price', '$type', '$quantity', '$upload_file','$info','$img_info')";
    if($conn->query($sql) === TRUE )
             {
                 $message = "Thêm sản phẩm thành công";
                 echo "<script type='text/javascript'>alert('$message');
                 window.location.href='sanpham.php';</script>";
             }
  }
}

$sql1 = "SELECT * FROM sanpham";
$result = $conn->query($sql1);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="css/insert.css">
    </head>
    <body>
        <div>
            <form enctype="multipart/form-data" method="post">
                <div>
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name">
                </div>
                <div>
                    <label for="price">Giá: </label>
                    <input type="number" name="price" id="price">
                </div>
                <div>
                    <label for="">Thể loại:</label>
                    <select id="type" name="type">
                    <option value="0">PS5</option>
                    <option value="1">PS4</option>
                    <option value="2">Nintendo Switch</option>
                    <option value="3">XBOX ONE</option>
                    </select>
                </div>
                <div>
                    <label for="quantity">Số lượng: </label>
                    <input type="number" name="quantity" id="quantity">
                </div>
            <div>
                <label for="img">Hình ảnh</label>
                <input type="File" name="img" id="img">
            </div> 
            <div>
                <label for="img_info">Ảnh info</label>
                <input type="file" name="img_info" id="img_info">
            </div>
            <div>
                <label for="img">Thông tin sản phẩm: </label>
                <textarea name="info" id="info"></textarea>
            </div>
                <input type="submit" name="add" value="Lưu">
            </form>
        </div>
        <div>
        </div>
</body>
</html>