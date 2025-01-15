<?php
include 'header.php';
require('connect.php');
$id = (int) $_GET['id'];
$sql = "SELECT * FROM sanpham WHERE id = {$id}";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$price = number_format($row['price'], 0, ',', '.') . ' ₫';

$username = isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : "";
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : "";
$products = [];


if (!empty($username)) {
    $sql = "SELECT * FROM sanpham";
    if (isset($_POST['search'])) {
        $nd = $conn->real_escape_string($_POST['noidung']);
        $sql = "SELECT * FROM sanpham WHERE name LIKE '%$nd%'";
    }
} else header("Location:index.php");
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/products.css">
    <title>Cửa hàng game giá rẻ</title>
</head>

<body>

    <div id="wrapper">
        <!-- sp -->
        <section class="product">
            <div class="container">
                <div class="product-content-row" style="display: flex; flex-wrap: swrap">
                    <div class="product-content-left">
                        <div class="product-item">
                            <img src="<?php echo $row["img"]; ?>" alt="ảnh sản phẩm">
                        </div>
                    </div>
                    <div class="product-content-right ">
                        <div class="product-name">
                            <h1><?php echo $row["name"]; ?></h1>
                        </div>
                        <div class="product-price">
                            <p>Giá: <?php echo $price = number_format($row['price'], 0, ',', '.') . " ₫"; ?></p>
                        </div>
                        <div class="quantity">
                            <div id="buy-amount">
                                <button id="btn-minus" class="minus-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    </svg>
                                </button>
                                <input type="text" name="display_amount" id="amount" value="1">
                                <button id="btn-plus" class="plus-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                            <form action="cart.php" method="POST" onsubmit="updateHiddenAmount()">
                                <input type="hidden" name="amount" id="hidden-amount" value="1">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <h2>Số lượng: <?php echo $row["quantity"]; ?></h2>
                        </div>
                        <div class="test">
                            <?php if($row['quantity']<1): ?>
                                <h5>Hết hàng</h5>
                            <?php else: ?>
                                <h4>Còn hàng </h4>
                        </div>
                        <button type="submit" class="shopping-cart"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
                            <?php endif; ?>
                        <div class="info">
                            <div class="product-information">
                                <p>Thông tin chi tiết sản phẩm</p>
                            </div>
                            <div class="information">
                                <?php echo $row['info']; ?>
                            </div>
                            <div class="img-info">
                                <img src="<?php echo $row["img_info"]; ?>" alt="ảnh sản phẩm">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- end -->
    </div>
    <div id="footer">
        <div class="col-1">
            <h3>GAME GIÁ RẺ</h3>
            <p align="left">Đây là sản phẩm đầu tay của team bọn em, ít nhiều sẽ có những sai sót.
                Mong sẽ nhận được sự chỉ bào và góp ý của mọi người ạ. Những góp ý của mọi người hãy
                gửi qua số hotline hoặc các nền tảng mạng xã hội ạ!
            </p>
        </div>
        <div class="col-2">
            <h3>HOTLINE</h3>
            <p>0349314078 | 0339844871</p>
        </div>
        <div class="col-3">
            <h3>FOLLOW US</h3>
            <div class="sotical-icons">
                <a href="https://www.facebook.com/profile.php?id=100045314842701"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/hthinh2201/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://discord.com/channels/1237314368417300501/1237314369126400031"><i class="fa-brands fa-discord"></i></a>
            </div>
        </div>
    </div>
    <script>
        const amountInput = document.getElementById('amount');
        const hiddenAmount = document.getElementById('hidden-amount');

        function updateHiddenAmount() {
            hiddenAmount.value = amountInput.value; // Cập nhật giá trị trước khi gửi form
        }

        const maxQuantity = <?php echo $row['quantity']; ?>;
        document.getElementById('btn-plus').addEventListener('click', function() {
            let number = parseInt(amountInput.value);
            if (!isNaN(number) && number < maxQuantity) {
                amountInput.value = number + 1;
            }
        });

        document.getElementById('btn-minus').addEventListener('click', function() {
            let number = parseInt(amountInput.value);
            if (!isNaN(number) && number > 1) {
                amountInput.value = number - 1;
            }
        });
    </script>
</body>

</html>