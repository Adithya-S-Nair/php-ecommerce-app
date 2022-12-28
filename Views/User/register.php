<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                                    <form class="mx-1 mx-md-4" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" name="username" id="form3Example1c" class="form-control" required />
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" name="email" id="form3Example3c" class="form-control" required />
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="password" id="form3Example4c" class="form-control" required />
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="cpassword" id="form3Example4cd" class="form-control" onchange="checkPassword()" required />
                                                <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" checked />
                                            <label class="form-check-label" for="form2Example3">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../database/connection.php";
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cPassword = $_POST['cpassword'];
        if ($password == $cPassword) {
            $timeTarget = 0.05; // 50 milliseconds 
            $cost = 8;
            do {
                $cost++;
                $start = microtime(true);
                $hashPass = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
                $end = microtime(true);
            } while (($end - $start) < $timeTarget);
            $query = "SELECT * FROM userdetails WHERE u_email='$email'";
            $return = mysqli_query($conn, $query);
            if (!$return)
                die("<script>alert('Something went wrong!!!')</script>");
            else {
                $row = mysqli_fetch_array($return);
                if ($row) {
                    echo "<script>console.log('Email already registerd')</script>";
                    echo "<script>alert('Email already registerd')</script>";
                    
                } else {
                    $sql = "INSERT INTO userdetails(u_name,u_email,u_password) VALUES ('" . $userName . "','" . $email . "','" . $hashPass . "')";
                    $retval = mysqli_query($conn, $sql);
                    if (!$retval) {
                        die("<script>alert('Something went wrong!!!')</script>");
                    } else {
                        $fileName = mysqli_insert_id($conn);
                        $tmpAvatar = "../../public/Assets/Images/temp-avatar.jpg";
                        copy($tmpAvatar, '../../public/Profile-images/' . $fileName . '.jpeg');
                        echo "<script>alert('Account created successfully');window.location.href='signin'</script>";
                    }
                }
            }
        }
    }
    ?>
</body>

</html>