<?php
include "../../utils/userAuth.php";
$userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php include "../partials/user-navbar.php" ?>
    <div class="container pt-5">
        <h1 class="text-center mt-5">Orders</h1>
        <table class="table align-middle mb-0 bg-white container">
            <thead class="bg-light">
                <tr>
                    <th>Prooduct</th>
                    <th class="text-center">Ordered Quantity</th>
                    <th class="text-center">Payment Method</th>
                    <th class="text-center">Delivery Adress</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/connection.php";
                $sql = "SELECT * FROM ORDERS WHERE user_id=$userId";
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die();
                } else {
                    while ($row = mysqli_fetch_array($retval)) {
                        $orderId = $row['order_id'];
                        $productId = $row['product_id'];
                        $orderDate = $row['order_date'];
                        $orderStatus = $row['order_status'];
                        $orderQty = $row['qty'];
                        $paymentMethod = $row['payment_method'];
                        $deliveryAddr = $row['delivery_addr'];
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
                            }
                        }
                        if ($orderStatus == "placed") {
                            $orderStatusMsg = "Order Placed";
                            echo '
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../public/Product-images/' . $productId . '" alt="" style="width: 45px; height: 45px"  />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">' . $productName . '</p>
                                                    <p class="text-muted mb-0">' . $productBrand . '</p>
                                                    <p class="text-muted mb-0">' . $productCat . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $orderQty . '</p>
                                        </td>
                                        <td class="text-center">    
                                             <p class="fw-normal mb-1">' . $paymentMethod . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $deliveryAddr . '</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-warning rounded-pill d-inline">' . $orderStatusMsg . '</span>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0 text-center">' . $orderDate . '</p>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" onclick=handleCancelOrder(' . $orderId . ')><i class="fa-regular fa-x text-light"></i></a>
                                        </td>
                                    </tr>
                                ';
                        } else if ($orderStatus == "shipped") {
                            $orderStatusMsg = "Product Shipped";
                            echo '
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../public/Product-images/' . $productId . '?t=' . time() . '" alt="" style="width: 45px; height: 45px" />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">' . $productName . '</p>
                                                    <p class="text-muted mb-0">' . $productBrand . '</p>
                                                    <p class="text-muted mb-0">' . $productCat . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $orderQty . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $paymentMethod . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $deliveryAddr . '</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success rounded-pill d-inline">' . $orderStatusMsg . '</span>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0 text-center">' . $orderDate . '</p>
                                        </td>
                                    </tr>
                                ';
                        } else {
                            $orderStatusMsg = "Cancelled";
                            echo '
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../public/Product-images/' . $productId . '" alt="" style="width: 45px; height: 45px" />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">' . $productName . '</p>
                                                    <p class="text-muted mb-0">' . $productBrand . '</p>
                                                    <p class="text-muted mb-0">' . $productCat . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $orderQty . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $paymentMethod . '</p>
                                        </td>
                                        <td class="text-center">    
                                            <p class="fw-normal mb-1">' . $deliveryAddr . '</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-danger rounded-pill d-inline">' . $orderStatusMsg . '</span>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0 text-center">' . $orderDate . '</p>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" href="../../utils/cancelOrder.php?orderId=' . $orderId . '&action=delete"><i class="fa-solid fa-trash-can text-light"></i></button>
                                        </td>
                                    </tr>
                                ';
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function handleCancelOrder(orderId) {
            let confirm = false;
            confirm = window.confirm("Cancel this order?");
            if (confirm)
                window.location.href = `../../utils/cancelOrder.php?orderId=${orderId}&action=cancel`;
        }
    </script>
</body>

</html>