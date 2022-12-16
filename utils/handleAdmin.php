<?php
include "adminAuth.php";
include "../database/connection.php";
$userId = $_POST['uId'];
$sql = "UPDATE userdetails SET isAdmin=1 WHERE u_id=$userId";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die();
}
