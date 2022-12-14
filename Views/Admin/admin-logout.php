<?php

// Handling logout
session_start();
if ($_SESSION['admin_id']) {
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    header('Location: admin-login.php');
}
