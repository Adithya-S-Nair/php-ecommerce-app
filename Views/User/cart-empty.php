<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php" ?>

<body>
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
</body>

</html>