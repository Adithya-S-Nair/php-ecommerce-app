<?php
include "../../utils/adminAuth.php";
$userId = $_SESSION['user_id'];
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
        <p class="h3 text-center">Add Product</p>
        <form class="container mt-5" id="myForm">
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
                <!-- File input -->
                <div class="mt-5">
                    <label class="form-label" for="customFile">Product Image</label>
                    <input value="<?php echo "$productName" ?>" type="file" class="form-control" id="customFile" name="product-image" readonly />
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
    <script>
        // Get the current URL  (From open ai chat bot)
        const currentUrl = new URL(window.location.href);

        // Get the value of a specific parameter
        const paramValue = currentUrl.searchParams.get('paramName');

        // Get all the parameters as an iterable object

        // The URLSearchParams object allows you to easily get the value of a specific URL parameter, or iterate over all the parameters in the URL.

        // Here's an example of how to iterate over all the parameters:
        const params = currentUrl.searchParams;
        for (const [key, value] of params) {
            proId = value;
        }

        function editField(field) {
            var input = document.getElementById(field);
            var button = document.getElementById('button');
            input.removeAttribute('readonly');
            button.removeAttribute('disabled');
        }
        
        document.getElementById('myForm').addEventListener('submit', (event) => {
            event.preventDefault();
            var name = document.getElementById('name').value;
            var prize = document.getElementById('prize').value;
            var category = document.getElementById('category').value;
            var brand = document.getElementById('brand').value;
            var desc = document.getElementById('desc').value;
            console.log(proId);
            $.ajax({
                type: "POST",
                url: "../../utils/editProduct.php",
                data: {
                    proId,
                    name,
                    prize,
                    category,
                    brand,
                    desc
                },
                success: () => {
                    alert('Changes saved');
                    window.location.href = "index.php";
                }
            });
        });
    </script>
</body>

</html>