<?php
include "../../utils/adminAuth.php";
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
if (!$params) {
    header("Location:all-orders.php");
} else {
    $productId = $params['proId'];
    $userId = $params['userId'];
    $orderId = $params['orderId'];
}
include "../../database/connection.php";
$sql1 = "SELECT * FROM userdetails WHERE u_id=$userId";
$ret1 = mysqli_query($conn, $sql1);
if ($ret1) {
    $row1 = mysqli_fetch_array($ret1);
    if ($row1) {
        $userName = $row1['u_name'];
        $userEmail = $row1['u_email'];
        $userMobile = $row1['u_mobile'];
        $userAddr = $row1['u_addr'];
        $isAdmin = $row1['isAdmin'];
        if ($isAdmin == 1)
            $userType = "Admin";
        else
            $userType = "User";
    }
}
$sql2 = "SELECT * FROM product WHERE product_id=$productId";
$ret2 = mysqli_query($conn, $sql2);
if ($ret2) {
    $row2 = mysqli_fetch_array($ret2);
    if ($row2) {
        $productName = $row2['product_name'];
        $productBrand = $row2['product_brand'];
        $productCat = $row2['product_category'];
        $productPrize = $row2['product_prize'];
        $productDesc = $row2['product_desc'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../partials/head-section.php" ?>

<body>
    <?php include "../partials/admin-navbar.php" ?>
    <section class="pt-3">
        <div class="container py-5">
            <?php
            echo '<div class="row">
                    <div class="col-lg-6">
                        <h1 class="text-center text-dark">User Details</h1>
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="../../public/Profile-images/' . $userId . '" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">' . $userName . '</h5>
                                <p class="text-muted mb-1">' . $userType . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="text-center text-dark">Product Details</h1>
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="../../public/Product-images/' . $productId . '" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">' . $productName . '</h5>
                                <p class="text-muted mb-1">' . $productBrand . '</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $userName . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $userEmail . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $userMobile . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $userAddr . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Product Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $productName . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Prize</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">₹' . $productPrize . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Category</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $productCat . '</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Description</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">' . $productDesc . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            ?>
            <a href="../../utils/shipOrder?orderId=<?php echo $orderId; ?>" name="btn" class="text-center btn btn-success" onclick="return confirm('Ship Order?')">Ship Order</a>
        </div>
        </div>
    </section>
</body>

</html>