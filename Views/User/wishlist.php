<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
$userId = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php include "../partials/user-navbar.php" ?>
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
                include "../../database/connection.php";
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
                                                <img src="../../public/Product-images/' . $productId . '" alt="" style="width: 45px; height: 45px"  />
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