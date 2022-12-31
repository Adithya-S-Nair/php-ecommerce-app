<?php
include "../../utils/adminAuth.php";
?>


<!DOCTYPE html>
<html lang="en">
<?php include "../partials/head-section.php" ?>

<body>
    <?php include "../partials/admin-navbar.php" ?>
    <section class="pt-5">
        <h1 class="text-center mt-5 mb-5">All Orders</h1>
        <table class="table align-middle mb-0 bg-white container">
            <thead class="bg-light">
                <thead class="bg-light">
                    <tr>
                        <th>Prooduct</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                include "../../database/connection.php";
                $sql = "SELECT * FROM ORDERS WHERE order_status='Placed'";
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die();
                } else {
                    while ($row = mysqli_fetch_array($retval)) {
                        $productId = $row['product_id'];
                        $userId = $row['user_id'];
                        $orderId = $row['order_id'];
                        $orderDate = $row['order_date'];
                        $orderStatus = $row['order_status'];
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
                                echo '
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../public/Product-images/' . $productId . '" alt="" style="width: 45px; height: 45px" />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">' . $productName . '</p>
                                                    <p class="text-muted mb-0">' . $productBrand . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">' . $productCat . '</p>
                                            <p class="text-muted mb-0">' . $productDesc . '</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning rounded-pill d-inline">Order Placed</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="order-details?proId=' . $productId . '&userId=' . $userId . '&orderId='.$orderId.'">Details</a>
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
    </section>
</body>

</html>