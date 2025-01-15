<?php
    require 'connect.php';
        $id = (int) $_GET['id'];
        $sql = "DELETE FROM khachhang WHERE id = {$id}";
        $result = $conn->query($sql);
        if ($result)
        {
            header("Location:khachhang.php");
        }
?>