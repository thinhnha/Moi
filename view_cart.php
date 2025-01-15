<?php
include 'header.php';
require('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem giỏ hàng'); window.location.href='login.php';</script>";
    exit;
}
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : "";
$result = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_bill = $quantity * $price;
    $sua=$conn->query("UPDATE cart SET quantity = '$quantity', total_bill = '$total_bill'  WHERE id = {$id}"); 
    if($sua)
    {
        header('Location:view_cart.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/view_cart.css">
</head>

<body>
    <h2 class="text-center">Giỏ hàng của bạn</h2>
    <div class="container">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Tên sản phẩm</th>
                        <th style="width:10%">Giá</th>
                        <th style="width:8%">Số lượng</th>
                        <th style="width:22%" class="text-center">Thành tiền</th>
                        <th style="width:10%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($row = $result->fetch_assoc()):
                        $product_id = $row['product_id'];
                        $result1 = $conn->query("SELECT * FROM sanpham WHERE id = $product_id");
                        $row1 = $result1->fetch_assoc();

                    ?>

                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs"><img src="<?php echo $row1['img']; ?>" alt="Sản phẩm 1" class="img-responsive" width="100">
                                    </div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?php echo $row1['name']; ?></h4>
                                    </div>
                                </div>
                            </td>
                            <?php $subtotal = $row1['price'] * $row['quantity']; ?>

                            <td data-th="Price"><?php echo number_format($row1['price'], 0, ',', '.') . " ₫" ?></td>
                            <form method="post">
                                <td data-th="Quantity"><input class="form-control text-center" name="quantity" value="<?php echo $row['quantity']; ?>" type="number"></td>
                                <td data-th="Subtotal" class="text-center"><?php echo number_format($subtotal, 0, ',', '.') . " ₫"; ?></td>
                                <td class="actions" data-th="">
                                <input type="hidden" name="price" value="<?php echo $row1['price']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </form>
                            <a href='remove_from_cart.php?id=<?php echo $row['id']; ?>' class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $total += $subtotal; ?>



                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
                        </td>
                        <td colspan="2" class="hidden-xs"> </td>
                        <td class="hidden-xs text-center"><strong>Tổng tiền <?php echo number_format($total, 0, ',', '.') . " ₫"; ?></strong>
                        </td>
                        <td><a href="#" class="btn btn-success btn-block">Thanh toán <i class="fa fa-angle-right"></i></a>
                        </td>
                    </tr>
                </tfoot>
</body>

</html>