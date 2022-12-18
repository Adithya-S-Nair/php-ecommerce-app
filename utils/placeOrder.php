<?php
include "userAuth.php";
include "../database/connection.php";
$userId = $_SESSION['user_id'];
$finalPrize = $_POST['finalPrize'];
$paymentMethod = $_POST['paymentMethod'];
$deliveryAddr = $_POST['deliveryAddr'];
$date = $_POST['date'];
$data = json_decode(stripslashes($_POST['data']));
foreach ($data as $id) {
    $sql = "INSERT INTO orders(user_id,product_id,payment_method,delivery_addr,order_date,final_prize) VALUES($userId,$id,'$paymentMethod','$deliveryAddr','$date',$finalPrize)";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    } else {
        session_start();
        $_SESSION['orders'] = true;
        $sql2 = "DELETE FROM cart WHERE user_id=$userId";
        $ret = mysqli_query($conn, $sql2);
        if (!$ret)
            die();
    }
}
