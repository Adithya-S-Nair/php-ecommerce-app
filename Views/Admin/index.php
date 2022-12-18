<?php
include "../../utils/adminAuth.php";
$adminName = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php include "../partials/admin-navbar.php"; ?>
    <section class="container">
        <div class="row postion-fixed">
            <div class="col-md-6 mt-5">
                <p class="h6 ms-3">Admin : <?php echo "$adminName"; ?></p>
            </div>
            <div class="col-md-6">
                <a href="add_product.php" class="btn btn-success mt-5 mb-2 float-end me-5">Add Product</a>
            </div>
        </div>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Prize</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/connection.php";
                $sql = "SELECT * FROM product";
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die();
                } else {
                    while ($row = mysqli_fetch_array($retval)) {
                        $productId = $row['product_id'];
                        $productName = $row['product_name'];
                        $productPrize = $row['product_prize'];
                        $productCategory = $row['product_category'];
                        $productBrand = $row['product_brand'];
                        $productDesc = $row['product_desc'];
                        echo '<tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../../public/Product-images/'.$productId.'" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1" id="' . $productId . '">' . $productName . '</p>
                                        <p class="text-muted mb-0">' . $productBrand . '</p>
                                    </div>
                                </div>
                            </td>
                            <td class="pt-2 ">' . $productCategory . '</td>
                            <td>
                                <p class="pt-2">
                                    <span>&#8377;</span>
                                    ' . $productPrize . '
                                <p>
                            </td>

                            <td>
                                <p class="fw-normal mb-1">' . $productDesc . '</p>
                            </td>
                            <td class="text-center">
                            <a class="btn btn-primary" href="edit-product.php?proId=' . $productId . '">Edit</a>
                            <button class="btn btn-danger" onclick="deleteProduct(' . $productId . ')">Delete</button>

                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
    <script>
        function deleteProduct(productId) {
            let productName = document.getElementById(productId).innerHTML;
            let confirm = false;
            confirm = window.confirm(`Delete ${productName} from the store ?`)
            if (confirm) {
                window.location.href = `../../utils/deleteProduct.php?proId=${productId}`;
            }
        }
    </script>
</body>

</html>