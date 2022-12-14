<?php
include "userAuth.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../database/connection.php";
    $userId = $_SESSION['user_id'];
    $productId = $_POST['proId'];
    $sql = "SELECT * FROM cart WHERE product_id=$productId AND user_id=$userId";
    $ret = mysqli_query($conn, $sql);
    if (!$ret) {
        die();
    } else {
        $row = mysqli_fetch_array($ret);
        if (!$row) {
            $sql2 = "INSERT INTO cart(user_id,product_id) VALUES('$userId','$productId')";
            $retval = mysqli_query($conn, $sql2);
            if (!$retval) {
                die();
            }
        } else {
            $qty = $row['qty'] + 1;
            $sql3 = "UPDATE cart SET qty=$qty,total_prize=$total WHERE product_id=$productId AND user_id=$userId";
            $retvall = mysqli_query($conn, $sql3); 
            if (!$retvall) {
                die();
            }
        }
    }
}
