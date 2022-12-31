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
    $sql5 = "SELECT * FROM cart WHERE user_id=$userId AND product_id=$id";
    $ret5 = mysqli_query($conn, $sql5);
    if (!$ret5) {
        die();
    } else {
        $cartRow = mysqli_fetch_array($ret5);
        if (!$cartRow)
            die();
        else {
            $qty = $cartRow['qty'];
        }
        $sql = "INSERT INTO orders(user_id,product_id,qty,payment_method,delivery_addr,order_date,final_prize) VALUES($userId,$id,$qty,'$paymentMethod','$deliveryAddr','$date',$finalPrize)";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die();
        } else {
            session_start();
            $_SESSION['orders'] = true;
            $sql3 = "SELECT product_stock FROM product WHERE product_id=$id";
            $return = mysqli_query($conn, $sql3);
            if (!$return)
                die();
            else {
                $stockRow = mysqli_fetch_row($return);
                $stockAvail = $stockRow[0];
                if ($stockAvail > 0) {
                    $stockAvail = $stockAvail - $qty;
                    $sql4 = "UPDATE product SET product_stock=$stockAvail WHERE product_id=$id";
                    $ret4 = mysqli_query($conn, $sql4);
                    if (!$ret4)
                        die();
                }
            }
        }
    }
}
$sql2 = "DELETE FROM cart WHERE user_id=$userId";
$ret = mysqli_query($conn, $sql2);
if (!$ret)
    die();
