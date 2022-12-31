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
      <center>
        <div class="row">
          <?php
          include "../../database/connection.php";
          $sql = "SELECT * FROM product WHERE product_stock>0";
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
              $sql2 = "SELECT * FROM wishlist WHERE user_id=$userId AND product_id=$productId";
              $ret = mysqli_query($conn, $sql2);
              if (!$ret) {
                die();
              } else {
                $wishlistRow = mysqli_fetch_array($ret);
                if (!$wishlistRow) {
                  echo '<div class="col-md-6 col-lg-3 mb-4 mb-lg-0 pb-4">
                  <div class="card" style="width:257px">
                    <div class="text-center pt-3">
                      <img src="../../public/Product-images/' . $productId . '" class="card-img-top" style="width:75%" />
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <p class="small"><a href="#!" class="text-muted">' . $productBrand . '</a></p>
                        <p class="small"><a href="#!" class="text-muted">' . $productCategory . '</a></p>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">' . $productName . '</h5>
                        <h5 class="text-dark mb-0"><span>&#8377;</span>' . $productPrize . '</h5>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <p class="mb-0 text-justify">' . $productDesc . '</p>
                      </div>
                      <div class="row">
                        <div class="d-flex justify-content-between" id="' . $productId . '">
                          <a class="btn wishlistclass" onclick="addToWishList(' . $productId . ')"><i class="fa-regular fa-heart" id="wishlist" style="color:black;"></i></a>
                          <a class="btn btn-primary" onclick="addCart(' . $productId . ',' . $productPrize . ')">Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
                } else {
                  echo '<div class="col-md-6 col-lg-3 mb-4 mb-lg-0 pb-4">
                  <div class="card" style="width:257px">
                    <div class="text-center pt-3">
                      <img src="../../public/Product-images/' . $productId . '" class="card-img-top" style="width:75%" />
                      </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <p class="small"><a href="#!" class="text-muted">' . $productCategory . '</a></p>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">' . $productName . '</h5>
                        <h5 class="text-dark mb-0"><span>&#8377;</span>' . $productPrize . '</h5>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <p class="mb-0 text-justify">' . $productDesc . '</p>
                      </div>
                      <div class="row">
                        <div class="d-flex justify-content-between" id="' . $productId . '">
                          <a class="btn wishlistclass" onclick="addToWishList(' . $productId . ')"><i class="fa-solid fa-heart" id="wishlist" style="color:red;"></i></a>
                          <a class="btn btn-primary" onclick="addCart(' . $productId . ',' . $productPrize . ')">Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
                }
              }
            }
          }
          ?>
        </div>
      </center>
    </div>
  </section>
  <?php include "../partials/footer.php" ?>
  <script>
    function addToWishList(proId) {
      $.ajax({
        type: "POST",
        url: '../../utils/addToWishList.php',
        data: {
          proId
        },
        success: () => {
          window.location.reload();
        }
      });
    }

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