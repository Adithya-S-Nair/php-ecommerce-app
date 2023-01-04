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
          <a class="nav-link" href="../User/wishlist">Wishlist</a>
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
      </a>

      <!-- Notifications -->
      <!-- <div class="dropdown">
        <a class="link-secondary me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="#">Some news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Another news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </div> -->
      <!-- Avatar -->
      <div class="dropdown">
        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <?php echo '<img src="../../public/Profile-images/' . $userId . '?t=' . time() . '" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />'; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
          <li>
            <a class="dropdown-item" href="../User/profile">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="../User/signout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->