<?php
include "../../utils/adminAuth.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php include "../partials/admin-navbar.php"; ?>
    <section class="container mt-5">
        <div class="pt-5">
            <p class="h3 text-center">Add Product</p>
            <form enctype="multipart/form-data" class="container mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                    <input type="file" class="form-control" id="customFile" name="image" required />
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
        </div>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../database/connection.php";
        $productName = $_POST['product-name'];
        $productPrize = $_POST['prize'];
        $productCategory = $_POST['category'];
        $productBrand = $_POST['company-name'];
        $productDesc = $_POST['product-desc'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $sql = "INSERT INTO product(product_name,product_prize,product_category,product_brand,product_desc) VALUES ('$productName','$productPrize','$productCategory','$productBrand','$productDesc')";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die("<script>alert('Something went wrong!!!')</script>");
        } else {
            $fileName = mysqli_insert_id($conn);
            // Validate the file type
            $allowed_types = array('image/jpeg', 'image/png');
            if (in_array($file_type, $allowed_types)) {
                // Move the uploaded file to the desired location
                if ($file_type == 'image/jpeg')
                    move_uploaded_file($file_tmp, '../../public/Product-images/' . $fileName . '.jpeg');
                if ($file_type == 'image/png')
                    move_uploaded_file($file_tmp, '../../public/Product-images/' . $fileName . '.png');
            }
            echo "<script>alert('Product added successfully.')</script>";
            header('location:index.php');
        }
    }
    ?>
</body>

</html>