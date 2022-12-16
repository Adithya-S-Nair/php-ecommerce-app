<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
?>

<!doctype html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
  <?php include "../partials/user-navbar.php" ?>
  <section class="pt-5" style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
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
            echo '<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card">
              <img src="" class="card-img-top" alt="Laptop" />
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="small"><a href="#!" class="text-muted">' . $productCategory . '</a></p>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <h5 class="mb-0">' . $productName . '</h5>
                  <h5 class="text-dark mb-0"><span>&#8377;</span>' . $productPrize . '</h5>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <p class="mb-0">' . $productDesc . '</p>
                </div>
                <div class="row">
                  <div class="d-flex justify-content-between">
                    <a class="mt-2" href="#">Wishlist</a>
                    <a class="btn btn-primary" onclick="addCart(' . $productId . ',' . $productPrize . ')">Add to cart</a>
                  </div>
                </div>
              </div>
            </div>
          </div>';
          }
        }
        ?>
      </div>
    </div>
  </section>
  <?php include "../partials/footer.php" ?>
  <script>
    function addCart(proId,proPrize) {
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