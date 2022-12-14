<?php
include "../../utils/adminAuth.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <section class="container mt-5">
        <p class="h3 text-center">Add Product</p>
        <form class="container mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-5">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example1" name="product-name" class="form-control" required />
                        <label class="form-label" for="form6Example1">Product Name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="number" id="form6Example2" class="form-control" name="prize" required />
                        <label class="form-label" for="form6Example2">Prize</label>
                    </div>
                </div>
            </div>
            <!-- Text input -->
            <div class="row mb-5">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example3" class="form-control" name="category" required />
                        <label class="form-label" for="form6Example3">Category</label>
                    </div>
                </div>
                <!-- Text input -->
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example3" class="form-control" name="company-name" required />
                        <label class="form-label" for="form6Example3">Company name</label>
                    </div>
                </div>
            </div>
            <!-- File input -->
            <div class="mb-5">
                <label class="form-label" for="customFile">Product Image</label>
                <input type="file" class="form-control" id="customFile" name="product-image" required />
            </div>

            <!-- Message input -->
            <div class="form-outline mb-5">
                <textarea class="form-control" id="form6Example7" rows="4" name="product-desc" required></textarea>
                <label class="form-label" for="form6Example7">Product Description</label>
            </div>
            <!-- Submit button -->
            <div class="container">
                <button type="submit" class="btn btn-success btn-block mb-4">Add</button>
            </div>
        </form>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../database/connection.php";
        $productName = $_POST['product-name'];
        $productPrize = $_POST['prize'];
        $productCategory = $_POST['category'];
        $productBrand = $_POST['company-name'];
        $productImage = $_POST['product-image'];
        $productDesc = $_POST['product-desc'];
        $sql = "INSERT INTO product(product_name,product_prize,product_category,product_brand,product_desc) VALUES ('$productName','$productPrize','$productCategory','$productBrand','$productDesc')";
        echo "$sql";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die("<script>alert('Something went wrong!!!')</script>");
        } else {
            echo "<script>alert('Product added successfully.')</script>";
            header('location:index.php');
        }
    }
    ?>
</body>

</html>