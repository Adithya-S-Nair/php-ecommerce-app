<?php
include "adminAuth.php";
include "../database/connection.php";
$prodId = $_POST['proId'];
$prodName = $_POST['name'];
$prodPrize = $_POST['prize'];
$prodCategory = $_POST['category'];
$prodBrand = $_POST['brand'];
// $prodImage = $_POST['product-image'];
$prodDesc = $_POST['desc'];
$sql = "UPDATE product SET product_name='$prodName',product_prize='$prodPrize',product_category='$prodCategory',product_brand='$prodBrand',product_desc='$prodDesc' WHERE product_id=$prodId";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die();
}
