<?php
require('connect.php');

$username = isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : "";
$products = [];

// Lấy giá trị 'type' từ URL nếu có
$type = isset($_GET['type']) ? (int)$_GET['type'] : '';

// Lấy giá trị tìm kiếm nếu có
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Lấy trang hiện tại từ URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Đảm bảo trang không nhỏ hơn 1

$items_per_page = 16;
$offset = ($page - 1) * $items_per_page;

// Bắt đầu truy vấn SQL
$sql = "SELECT * FROM sanpham WHERE 1"; // Sử dụng WHERE 1 để dễ dàng thêm điều kiện lọc

// Nếu có lọc theo type
if ($type !== '') {
    $sql .= " AND type = $type";
}

// Nếu có tìm kiếm
if (!empty($search)) {
    $search = $conn->real_escape_string($search);  // Đảm bảo an toàn với SQL Injection
    $sql .= " AND name LIKE '%$search%'";
}

// Thêm phân trang vào truy vấn
$sql .= " LIMIT $items_per_page OFFSET $offset";

// Truy vấn tổng số sản phẩm để tính số trang
$total_products_result = $conn->query("SELECT COUNT(*) as total FROM sanpham WHERE 1");

if ($type !== '') {
    $total_products_result = $conn->query("SELECT COUNT(*) as total FROM sanpham WHERE type = $type");
}

if (!empty($search)) {
    $total_products_result = $conn->query("SELECT COUNT(*) as total FROM sanpham WHERE name LIKE '%$search%'");
}

$total_products_row = $total_products_result->fetch_assoc();
$total_products = $total_products_row['total'];
$total_pages = ceil($total_products / $items_per_page);

// Thực hiện truy vấn lấy sản phẩm
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/app.css">
    <title>Danh sách sản phẩm</title>
</head>
<?php include('header.php'); ?>
<body onload="showSlides()">
    <!-- Lọc theo loại sản phẩm -->
    <div class="product-filters">
        <a href="dia.php?type=0">PS5</a>
        <a href="dia.php?type=1">PS4</a>
        <a href="dia.php?type=2">Nintendo Switch</a>
        <a href="dia.php?type=3">Xbox One</a>
        <a href="dia.php">Tất cả</a> <!-- Lọc lại tất cả sản phẩm -->
    </div>

    <div id="wrapper">
        <div id="main-content">
            <div id="sidebar">
                <h2>SẢN PHẨM NỔI BẬT</h2>
                <div class="canle">
                    <div class="product-item" style="box-sizing: border-box;">
                        <li><a class="item-1" href="products.php?id=1">
                                <img src="images/6c05bddcc3ba48c19de3e054fec8334c_c6255738a81d46ef99831d19d33040d7_master.webp" alt="Game nổi bật" height="200px" width="100%">
                            </a></li>
                        <li><a class="item-2" href="products.php?id=1"> CRISIS CORE FINAL FANTASY VII REUNION cho PS5</a></li>
                        <p class="item-3"><b>1,200,000 ₫</b></p>
                    </div>
                    <div class="product-item" style="box-sizing: border-box;">
                        <li><a class="item-1" href="products.php?id=35">
                                <img src="images/dia-game-myth-wukong---ps5-P859-1734568252866.jpg" alt="Game nổi bật" height="200px" width="100%">
                            </a></li>
                        <li><a class="item-2" href="products.php?id=35">BLACK MYTH: WUKONG DELUX EDITION</a></li>
                        <p class="item-3"><b>1,580,000 ₫</b></p>
                    </div>
                    <div class="product-item" style="box-sizing: border-box;">
                        <li><a class="item-1" href="products.php?id=38">
                                <img src="images/game-pokemon-lets-go-pikachu---nintendo-switch-2nd-P1359-1732916306741.jpg" alt="Game nổi bật" height="200px" width="100%">
                            </a></li>
                        <li><a class="item-2" href="products.php?id=38">POKEMON: LET'S GO, PIKACHU! - Nintendo Switch</a></li>
                        <p class="item-3"><b>748,000 ₫</b></p>
                    </div>
                    <div class="product-item" style="box-sizing: border-box;">
                        <li><a class="item-1" href="products.php?id=6">
                                <img src="images/one_piece_pirate_warriors_4_ps4_b605f347a21b4448809ff4678f3d5134_master.webp" alt="Game nổi bật" height="200px" width="100%">
                            </a></li>
                        <li><a class="item-2" href="products.php?id=6">One Piece Pirate Warriors 4 cho PS4 PS5</a></li>
                        <p class="item-3"><b>990,000 ₫</b></p>
                    </div>
                    <div class="product-item" style="box-sizing: border-box;">
                        <li><a class="item-1" href="products.php?id=5">
                                <img src="images/it_takes_two_ps4_38c5cb5de360488992de856604558033_master.webp" alt="Game nổi bật" height="200px" width="100%">
                            </a></li>
                        <li><a class="item-2" href="products.php?id=5">It Takes Two cho PS4</a></li>
                        <p class="item-3"><b>880,000 ₫</b></p>
                    </div>
                </div>
            </div>
            <div style="background-color: #f5f5f5; text-align:center;">
            <div id="content" style="display: flex; flex-wrap: wrap;">
                <?php if (!empty($username)): ?>
                    <?php while ($product = $result->fetch_assoc()): ?>
                        <div class="headline">
                            <ul class="products">
                                <li>
                                    <div class="products-item">
                                        <div class="product-top">
                                            <a href="products.php?id=<?= $product['id'] ?>" class="product-thumb">
                                                <img src="<?php echo $product['img']; ?>" alt="sample picture">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="products.php?id=<?= $product['id'] ?>" class="product-name"><?php echo $product['name']; ?></a>
                                            <div class="product-price"><?php echo number_format($product['price'], 0, ',', '.') . " ₫"; ?></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <?php while ($product = $result->fetch_assoc()): ?>
                        <div class="headline">
                            <ul class="products">
                                <li>
                                    <div class="products-item">
                                        <div class="product-top">
                                            <a href="login.php" class="product-thumb">
                                                <img src="<?php echo $product['img']; ?>" alt="sample picture">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="login.php" class="product-name"><?php echo $product['name']; ?></a>
                                            <div class="product-price"><?php echo number_format($product['price'], 0, ',', '.') . " ₫"; ?></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <button onclick="window.location.href='?page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?><?= isset($_GET['type']) ? '&type=' . $_GET['type'] : '' ?>'" 
                        class="<?= ($i == $page) ? 'active' : '' ?>">
                        <?= $i ?>
                    </button>
                <?php endfor; ?>
            </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>