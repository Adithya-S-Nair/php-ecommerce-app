<?php
include "userAuth.php";
$userId = $_SESSION['user_id'];
$proId = $_POST['proId'];
$count = $_POST['count'];
$prize = $_POST['prize'];
include "../database/connection.php";
$sql = "SELECT * FROM cart WHERE product_id=$proId";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die();
} else {
    $row = mysqli_fetch_array($retval);
    if (!$row) {
        die();
    } else {
        $cartId = $row['cart_id'];
        $qty = $row['qty'] + $count;
        $total = $prize * $qty;
        $sql2 = "UPDATE cart SET qty=$qty,total_prize=$total WHERE product_id=$proId AND user_id=$userId";
        $ret = mysqli_query($conn, $sql2);
        if (!$ret) {
            die();
        } else {
            $sql3 = "SELECT * FROM cart WHERE user_id=$userId";
            $returnval = mysqli_query($conn, $sql3);
            if (!$returnval) {
                die();
            } else {
                $totalPrize = 0;
                while ($row2 = mysqli_fetch_array($returnval)) {
                    $totalPrize += $row2['total_prize'];
                }
                $return_arr[] = array(
                    "cart_id" => $cartId,
                    "qty" => $qty,
                    "total" => $totalPrize
                );
                exit(json_encode($return_arr));
            }
        }
    }
}
