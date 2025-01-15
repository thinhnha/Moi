<?php
    require 'connect.php';

    // Kiểm tra nếu `id` được truyền qua URL và hợp lệ
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];

        // Câu lệnh SQL xóa sản phẩm
        $sql = "DELETE FROM sanpham WHERE id = {$id}";

        // Thực hiện lệnh xóa
        if ($conn->query($sql) === TRUE) {
            // Xóa thành công, chuyển hướng về danh sách sản phẩm
            header("Location: sanpham.php");
            exit();
        } else {
            // Nếu xảy ra lỗi trong câu lệnh SQL
            echo "Lỗi khi xóa sản phẩm: " . $conn->error;
        }
    } else {
        // Nếu ID không hợp lệ hoặc không được cung cấp
        echo "ID không hợp lệ hoặc không tồn tại.";
    }
?>