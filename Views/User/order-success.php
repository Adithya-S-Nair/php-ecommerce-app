<?php

// Redirecting to login if user is not in session

include "../../utils/userAuth.php";
if (!isset($_SESSION['orders'])) {
    echo "<script>window.location.href='orders.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php" ?>

<body>
    <div class="container mt-5">
        <div class="row pt-3">
            <div class="col-md-12">
                <img class="img-fluid mx-auto d-block" src="../../public/Assets/Images/Order_success.jpg" style="width: 40%;" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Your order placed successfully</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <a class="btn btn-primary" href="orders.php" onclick="handleOrderSession()">View Orders</a>
                </center>
            </div>
        </div>
    </div>
</body>
<script>
    function handleOrderSession() {
        $.ajax({
            type: "GET",
            url: "../../utils/clearOrderSession.php"
        });
    }
</script>

</html>