<?php

// Checking user present in session

session_start();
if (isset($_SESSION['admin_id'])) {
  header("Location:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <section style="margin-top: 10%;">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <p class="text-center h3">ADMIN LOGIN</p>
            <div class="col-md-4" style="margin-top: 2%;">
                <form class="mt-3" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form1Example1" class="form-control" />
                        <label class="form-label" for="form1Example1">Email address</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form1Example2" class="form-control" />
                        <label class="form-label" for="form1Example2">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../database/connection.php";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM userdetails WHERE u_email='$email'";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die();
        } else {
            $row = mysqli_fetch_array($retval);
            if ($row) {
                $db_uid = $row['u_id'];
                $db_uname = $row['u_name'];
                $db_pwrd = $row['u_password'];
                $isAdmin = $row['isAdmin'];
                if ($isAdmin and password_verify($password, $db_pwrd)) {
                    $_SESSION['admin_id'] = $db_uid;
                    $_SESSION['admin_name'] = $db_uname;
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