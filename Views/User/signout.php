<?php

// Handling logout
session_start();
if ($_SESSION['user_name']) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    setcookie("PQIx5JKXI1", $db_uid, time() - 3600);
    setcookie("68iXvUSHe7", $db_uname, time() - 3600);
    header('Location: signin.php');
}
