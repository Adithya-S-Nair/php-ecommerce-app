<?php
include "adminAuth.php";
include "../database/connection.php";
$userId = $_POST['uId'];
$status = $_POST['status'];
if ($status == 1) {
    $sql = "UPDATE userdetails SET isBlock=0 WHERE u_id=$userId";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    }
} else if ($status == 0) {
    $sql = "UPDATE userdetails SET isBlock=1 WHERE u_id=$userId";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    }
}
