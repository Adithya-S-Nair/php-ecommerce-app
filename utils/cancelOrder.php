<?php
include "userAuth.php";
$userId = $_SESSION['user_id'];
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$orderId = $params['orderId'];
$action = $params['action'];
include "../database/connection.php";
if ($action == 'cancel') {
    $sql = "UPDATE orders SET order_status='cancelled' WHERE user_id=$userId AND order_id=$orderId";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    } else {
        echo ("<script>alert('Order Cancelled.')</script>");
        header('location:../Views/User/orders');
    }
} else {
    $sql = "DELETE FROM orders WHERE order_id=$orderId AND user_id=$userId";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    } else {
        header('location:../Views/User/orders');
    }
}
