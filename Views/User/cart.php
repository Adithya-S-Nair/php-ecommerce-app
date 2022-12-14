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
    <section class="h-100 h-custom pt-5" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Cart</h1>
                                            <h6 class="mb-0 text-muted">3 items</h6>
                                        </div>
                                        <hr class="my-4">
                                        <?php
                                        include "../../database/connection.php";
                                        $sql = "SELECT * FROM CART WHERE user_id=$userId";
                                        $retval = mysqli_query($conn, $sql);
                                        if (!$retval) {
                                            die();
                                        } else {
                                            $i = 0;
                                            $cartId = array();
                                            while ($row = mysqli_fetch_array($retval)) {
                                                $cartId[$i] = $row['cart_id'];
                                                $productId = $row['product_id'];
                                                $qty = $row['qty'];
                                                $total[$i] = $row['total_prize'];
                                                $sql2 = "SELECT * FROM product WHERE product_id=$productId";
                                                $ret = mysqli_query($conn, $sql2);
                                                if (!$ret) {
                                                    die();
                                                } else {
                                                    $productRow = mysqli_fetch_array($ret);
                                                    if (!$productRow) {
                                                        die();
                                                    } else {
                                                        $productName = $productRow['product_name'];
                                                        $productBrand = $productRow['product_brand'];
                                                        $productCategory = $productRow['product_category'];
                                                        $productPrize = $productRow['product_prize'];
                                                    }
                                                }
                                                echo '<div class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                            <img src="" class="img-fluid rounded-3" alt="">
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h6 class="text-black mb-0">' . $productName . '</h6>
                                                            <h6 class="text-muted mb-2">' . $productBrand . '</h6>
                                                            <h6 class="text-muted mb-0">' . $productCategory . '</h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                            <button class="btn btn-link px-2" onclick="qtyChange(-1,' . $productId . ',' . $productPrize . ')">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
            
                                                            <p class="h6 mt-2 px-1" id="qty_field_' . $cartId[$i] . '">' . $qty . '</p>
            
                                                            <button class="btn btn-link px-2" onclick="qtyChange(1,' . $productId . ',' . $productPrize . ')">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0" id="prize_field_' . $cartId[$i] . '"><span>&#8377;</span>' . $productPrize * $qty . '</h6>
                                                        </div>
                                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                            <a href="../../utils/cartRemove.php?proid=' . $productId . '" class="text-muted"><i class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                    <hr class="my-4">';
                                                $i++;
                                            }
                                            $totPrize = 0;
                                            for ($i = 0; $i < count($total); $i++) {
                                                $totPrize +=$total[$i];
                                            }
                                        }
                                        ?>
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                        <hr class="my-4">
                                        <?php echo '
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            <h5>&#8377;<span id="total_field">'.$totPrize.'</span></h5>
                                        </div>';
                                        ?>
                                        <button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function qtyChange(count, proId, prize) {
            $.ajax({
                type: "POST",
                url: '../../utils/changeQuantity.php',
                data: {
                    count,
                    proId,
                    prize
                },
                success: (response) => {
                    var data = JSON.parse(response);
                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var cartId = data[i].cart_id;
                        var qty = data[i].qty;
                        var total = data[i].total;
                        prize = prize * qty;
                        document.getElementById("qty_field_" + cartId).innerHTML = qty;
                        document.getElementById("prize_field_" + cartId).innerHTML = "<span>&#8377;</span>" + prize;
                        document.getElementById("total_field").innerHTML = total;
                    }
                }
            });
        }
    </script>
</body>

</html>