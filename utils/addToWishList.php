<?php
include "userAuth.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../database/connection.php";
    $userId = $_SESSION['user_id'];
    $productId = $_POST['proId'];
    $sql1 = "SELECT * FROM wishlist WHERE product_id=$productId AND user_id=$userId";
    $ret1 = mysqli_query($conn, $sql1);
    if (!$ret1)
        die();
    else {
        $row1 = mysqli_fetch_array($ret1);
        if ($row1) {
            $sql2 = "DELETE FROM wishlist WHERE product_id=$productId AND user_id=$userId";
            mysqli_query($conn, $sql2);
        } else {
            $sql2 = "INSERT INTO wishlist(user_id,product_id) VALUES($userId,$productId)";;
            mysqli_query($conn, $sql2);
        }
    }
}
