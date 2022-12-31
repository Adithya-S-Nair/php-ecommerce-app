<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
?>

<!doctype html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
  <?php
  $userId = $_SESSION['user_id'];
  include "../../database/connection.php";
  $sql3 = "SELECT * FROM CART WHERE user_id=$userId";
  $retval3 = mysqli_query($conn, $sql3);
  if ($retval3) {
    $cartCount = 0;
    while ($row = mysqli_fetch_array($retval3)) {
      $cartCount += 1;
    }
    ($cartCount > 0) ? $cartCount = $cartCount : $cartCount = null;
  }
  $sql2 = "SELECT * FROM wishlist WHERE user_id=$userId";
  $ret = mysqli_query($conn, $sql2);
  if ($ret) {
    $wishListCount = 0;
    while ($row = mysqli_fetch_array($ret)) {
      $wishListCount += 1;
    }
    ($wishListCount > 0) ? $wishListCount = $wishListCount : $wishListCount = null;
  }
  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="../User/index.php">
          <span class="text-primary">Shopping</span>Cart
        </a>
        <!-- Left links -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item p-1">
            <a class="nav-link" href="../User/orders.php">Oders</a>
          </li>
          <li class="nav-item p-1">
            <a class="nav-link" href="../User/wishlist">Wishlist<span id="wishlist_count" class="badge rounded-pill badge-notification bg-danger"><?php echo $wishListCount ?></span></a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <a class="link-secondary me-3" href="cart.php">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge rounded-pill badge-notification bg-danger" id="cart_count"><?php echo $cartCount ?></span>
        </a>
        <!-- Avatar -->
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <?php echo '<img src="../../public/Profile-images/' . $userId . '" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />'; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <li>
              <a class="dropdown-item" href="../User/profile">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="http://localhost:8099/php-ecommerce-app/Views/User/signout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
  <section class="pt-5" style="background-color: #eee;">
    <div class="container py-5">
      <center>
        <div class="row">
          <?php
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
                  <div class="card" style="width:300px">
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
                  <div class="card" style="width:300px">
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
                        <p class="mb-0 text-left">' . $productDesc . '</p>
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
        },
        success: () => {
          var cartCount = document.getElementById("cart_count").innerText;
          cartCount++;
          document.getElementById("cart_count").innerHTML = cartCount;
        }
      });
    }
  </script>
</body>

</html>