<?php
include "userAuth.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../database/connection.php";
    $userId = $_SESSION['user_id'];
    $productId = $_POST['proId'];
    $productPrize = $_POST['proPrize'];
    $sql = "SELECT * FROM cart WHERE product_id=$productId AND user_id=$userId";
    $ret = mysqli_query($conn, $sql);
    if (!$ret) {
        die();
    } else {
        $row = mysqli_fetch_array($ret);
        if (!$row) {
            $total = $productPrize;
            $sql2 = "INSERT INTO cart(user_id,product_id,total_prize) VALUES('$userId','$productId','$total')";
            $retval = mysqli_query($conn, $sql2);
            if (!$retval) {
                die();
            }
        } else {
            $qty = $row['qty'] + 1;
            $total = $productPrize*$qty;
            $sql3 = "UPDATE cart SET qty=$qty,total_prize=$total WHERE product_id=$productId AND user_id=$userId";
            $retvall = mysqli_query($conn, $sql3); 
            if (!$retvall) {
                die();
            }
        }
    }
}
