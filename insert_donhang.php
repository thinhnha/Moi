<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="css/insert_donhang.css">
    </head>
    <body>
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