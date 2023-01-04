<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php" ?>

<body>
    <?php
    include "../../database/connection.php";
    $sql = "SELECT * FROM CART WHERE user_id=$userId";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die();
    } else {
        $cartCount = mysqli_num_rows($retval);
        if ($cartCount == 0) {
            echo '
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid mx-auto d-block" src="../../public/Assets/Images/Cart_empty.jpg" style="width: 40%;"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Cart is empty</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <a class="btn btn-primary" href="index.php">Go Home</a>
                    </center>
                </div>
            </div>
        </div>
            ';
        } else {
            echo("<script>window.location.href='cart'</script>");
        }
    }
    ?>
</body>

</html>