<?php
include "adminAuth.php";
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
include "../database/connection.php";
$sql = "UPDATE orders SET order_status='shipped' WHERE order_id=$orderId";
$retval = mysqli_query($conn,$sql);
if(!$retval){
    die();
}else{
    header("Location:../Views/Admin/all-orders");
}
