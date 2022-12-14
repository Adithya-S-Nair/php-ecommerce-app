<?php

// Checking user present in session

session_start();
if (isset($_SESSION['user_id'])) {
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example13">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example23" name="password">Password</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
              </div>
              <a href="#!">Forgot password?</a>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            <p class="small mt-2 pt-1 mb-0">Don't have an account? <a href="register.php" class="link-danger">Register</a></p>
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
            </div>

            <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!" role="button">
              <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
            </a>
            <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!" role="button">
              <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>

          </form>
        </div>
      </div>
    </div>
  </section>

  <?php
  if (isset($_COOKIE['PQIx5JKXI1'])) {
    $_SESSION['user_id'] = $_COOKIE['PQIx5JKXI1'];
    $_SESSION['user_name'] = $_COOKIE['68iXvUSHe7'];
    echo "<script>location.reload()</script>";
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../../database/connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM userdetails WHERE u_email='$email'";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die("<script>alert('Invalid Credentials')</script>");
    } else {
      $row = mysqli_fetch_array($retval);
      if ($row) {
        $db_uid = $row['u_id'];
        $db_uname = $row['u_name'];
        $db_email = $row['u_email'];
        $db_pwrd = $row['u_password'];
        if (($email == $db_email) and (password_verify($password, $db_pwrd))) {
          $_SESSION['user_id'] = $db_uid;
          $_SESSION['user_name'] = $db_uname;
          if (isset($_POST['remember'])) {
            setcookie("PQIx5JKXI1", $db_uid, time() + (86400 * 30));
            setcookie("68iXvUSHe7", $db_uname, time() + (86400 * 30));
          }
          header("Location:index.php");
        } else {
          echo "<script>alert('Invalid Credentials')</script>";
        }
      } else {
        echo "<script>alert('Invalid Credentials')</script>";
      }
    }
  }
  ?>
</body>

</html>