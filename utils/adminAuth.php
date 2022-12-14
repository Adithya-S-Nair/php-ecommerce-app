<?php
session_start();
if (!$_SESSION['admin_name']) {
  header('Location: admin-login.php');
}
?>