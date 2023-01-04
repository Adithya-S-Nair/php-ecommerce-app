<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
$userId = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php
    include "../../database/connection.php";
    $sql3 = "SELECT * FROM CART WHERE user_id=$userId";
    $retval3 = mysqli_query($conn, $sql3);
    if ($retval3) {
        $cartCount = mysqli_num_rows($retval3);
        ($cartCount > 0) ? $cartCount = $cartCount : $cartCount = null;
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="../User/index.php">
                    <span class="text-primary">Shopping</span>Cart
                </a>
                <!-- Left links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item p-1">
                        <a class="nav-link" href="../User/orders.php">Oders</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link" href="../User/wishlist">Wishlist</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                <a class="link-secondary me-3" href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge rounded-pill badge-notification bg-danger" id="cart_count"><?php echo $cartCount ?></span>
                </a>
                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <?php echo '<img src="../../public/Profile-images/' . $userId . '?t=' . time() . '" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />'; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="../User/profile">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="http://localhost:8099/php-ecommerce-app/Views/User/signout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <div class="container pt-5">
        <h1 class="text-center mt-5">Wishlist</h1>
        <table class="table align-middle mb-0 bg-white container">
            <thead class="bg-light">
                <tr>
                    <th>Product</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Prize</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM wishlist WHERE user_id=$userId";
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die();
                } else {
                    while ($row = mysqli_fetch_array($retval)) {
                        $productId = $row['product_id'];
                        $sql2 = "SELECT * FROM product WHERE product_id=$productId";
                        $ret = mysqli_query($conn, $sql2);
                        if (!$ret) {
                            die();
                        } else {
                            $productRow = mysqli_fetch_array($ret);
                            if (!$row) {
                                die();
                            } else {
                                $productName = $productRow['product_name'];
                                $productBrand = $productRow['product_brand'];
                                $productCat = $productRow['product_category'];
                                $productDesc = $productRow['product_desc'];
                                $productPrize = $productRow['product_prize'];
                                echo '
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../public/Product-images/' . $productId . '?t=' . time() . '" alt="" style="width: 45px; height: 45px"  />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">' . $productName . '</p>
                                                    <p class="text-muted mb-0">' . $productBrand . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $productCat . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $productDesc . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $productPrize . '</p>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" onclick="addCart(' . $productId . ',' . $productPrize . ')">Add to cart</a>
                                            <a class="btn btn-danger" href="../../utils/wishlistRemove.php?proid=' . $productId . '"><i class="fa-solid fa-trash-can text-light"></i> </a>
                                        </td>
                                    </tr>
                                ';
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function addCart(proId, proPrize) {
            $.ajax({
                type: "POST",
                url: '../../utils/addToCart.php',
                data: {
                    proId,
                    proPrize
                }
            });
        }
    </script>
</body>

</html>
</body>

</html>