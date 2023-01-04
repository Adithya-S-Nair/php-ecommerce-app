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
$productId = $params['proId'];
include "../../database/connection.php";
$sql = "SELECT * FROM product WHERE product_id=$productId";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die();
} else {
    $row = mysqli_fetch_array($retval);
    if (!$row)
        die();
    else {
        $productName = $row['product_name'];
        $productPrize = $row['product_prize'];
        $productCategory = $row['product_category'];
        $productBrand = $row['product_brand'];
        $productDesc = $row['product_desc'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <section class="container mt-5">
        <p class="h1 text-center">Edit Product</p>
        <form enctype="multipart/form-data" class="container mt-5" id="myForm" action="<?php echo $_SERVER["PHP_SELF"] . '?proId=' . $productId; ?>" method="POST">
            <div class="row text-center mb-2">
                <div class="col-md-12">
                    <img src="../../public/Product-images/<?php echo $productId ?>?t=<?php echo time(); ?>" class="img-fluid" id="product-img" style="width: 15%;">
                </div>
            </div>
            <!-- File input -->
            <div class="row text-center mb-5">
                <div class="col-md-12">
                    <input type="file" id="upload-file" name="image" onchange="changeImage(event)" style="display: none;">
                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('upload-file').click()">Choose File</button>
                </div>
            </div>
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-5">
                <div class="col">
                    <div class="input-group">
                        <div class="form-outline">
                            <input value="<?php echo "$productName" ?>" type="text" id="name" name="product-name" class="form-control" readonly />
                            <label class="form-label" for="name">Product Name</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" onclick="editField('name')"><i class="fa-solid fa-pen"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="form-outline">
                            <input value="<?php echo "$productPrize" ?>" type="number" id="prize" class="form-control" name="prize" readonly />
                            <label class="form-label" for="prize">Prize</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" onclick="editField('prize')"><i class="fa-solid fa-pen"></i></span>
                        </div>
                    </div>
                </div>
                <!-- Text input -->
                <div class="row mt-5">
                    <div class="col">
                        <div class="input-group">
                            <div class="form-outline">
                                <input value="<?php echo "$productCategory" ?>" type="text" id="category" class="form-control" name="category" readonly />
                                <label class="form-label" for="category">Category</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" onclick="editField('category')"><i class="fa-solid fa-pen"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Text input -->
                    <div class="col">
                        <div class="input-group">
                            <div class="form-outline">
                                <input value="<?php echo "$productBrand" ?>" type="text" id="brand" class="form-control" name="company-name" readonly />
                                <label class="form-label" for="brand">Company name</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" onclick="editField('brand')"><i class="fa-solid fa-pen"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Message input -->
                <div class="input-group  mt-5">
                    <div class="form-outline">
                        <textarea class="form-control" id="desc" rows="4" name="product-desc" readonly><?php echo "$productDesc" ?></textarea>
                        <label class="form-label" for="desc">Product Description</label>
                    </div>
                    <div class="input-group-prepend my-auto">
                        <span class="input-group-text" onclick="editField('desc')"><i class="fa-solid fa-pen"></i></span>
                    </div>
                </div>
                <!-- Submit button -->
                <div class="container">
                    <button type="submit" class="btn btn-primary btn-block mt-5" id="button" disabled>Save Changes</button>
                </div>
        </form>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prodName = $_POST['product-name'];
        $prodPrize = $_POST['prize'];
        $prodCategory = $_POST['category'];
        $prodBrand = $_POST['company-name'];
        $prodDesc = $_POST['product-desc'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $sql2 = "UPDATE product SET product_name='$prodName',product_prize='$prodPrize',product_category='$prodCategory',product_brand='$prodBrand',product_desc='$prodDesc' WHERE product_id=$productId";
        $ret = mysqli_query($conn, $sql2);
        if (!$ret) {
            die("<script>alert('Something went wrong!!!')</script>");
        } else {
            if ($file_name && $file_size && $file_tmp && $file_type) {
                // Validate the file type
                $allowed_types = array('image/jpeg', 'image/png');
                if (in_array($file_type, $allowed_types)) {
                    if (file_exists('../../public/Product-images/' . $productId . '.jpeg'))  // For deleting existing file
                        unlink('../../public/Product-images/' . $productId . '.jpeg');
                    else
                        unlink('../../public/Product-images/' . $productId . '.png');
                    // Move the uploaded file to the desired location
                    if ($file_type == 'image/jpeg') {
                        move_uploaded_file($file_tmp, '../../public/Product-images/' . $productId . '.jpeg');
                    } else {
                        move_uploaded_file($file_tmp, '../../public/Product-images/' . $productId . '.png');
                    }
                } else {
                    die("<script>alert('File type not allowed')</script>");
                }
            }
            echo "<script>alert('Changes saved successfully.');window.location.href='index'</script>";
        }
    }
    ?>
    <script>
        function changeImage(event) {
            var img = document.getElementById("product-img");
            var button = document.getElementById('button');
            img.src = URL.createObjectURL(event.target.files[0]);
            button.removeAttribute('disabled');
        }

        function editField(field) {
            var input = document.getElementById(field);
            var button = document.getElementById('button');
            input.removeAttribute('readonly');
            button.removeAttribute('disabled');
        }

        document.getElementById('myForm').addEventListener('submit', (event) => {
            event.preventDefault();
            let confirm = false;
            confirm = window.confirm("Save Changes?");
            if (confirm)
                document.getElementById("myForm").submit();
        });
    </script>
</body>

</html>