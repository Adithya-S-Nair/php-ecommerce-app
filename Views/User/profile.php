<?php
include "../../utils/userAuth.php";
$userId = $_SESSION['user_id'];
include "../../database/connection.php";
$sql1 = "SELECT * FROM userdetails WHERE u_id=$userId";
$ret1 = mysqli_query($conn, $sql1);
if ($ret1) {
    $row1 = mysqli_fetch_array($ret1);
    if ($row1) {
        $userName = $row1['u_name'];
        $userEmail = $row1['u_email'];
        $userMobile = $row1['u_mobile'];
        $userAddr = $row1['u_addr'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head-section.php"; ?>

<body>
    <?php include "../partials/user-navbar.php"; ?>
    <section class="container pt-5">
        <p class="h3 text-center pt-5">Profile</p>
        <form class="container mt-5" id="myForm" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-5">
                <div class="col">
                    <div class="input-group">
                        <div class="form-outline">
                            <input value="<?php echo "$userName" ?>" type="text" id="name" name="user-name" class="form-control" readonly />
                            <label class="form-label" for="name">Name</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" onclick="editField('name')"><i class="fa-solid fa-pen"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="form-outline">
                            <input value="<?php echo "$userEmail" ?>" type="email" id="email" class="form-control" name="user-email" readonly />
                            <label class="form-label" for="prize">Email</label>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" onclick="editField('email')"><i class="fa-solid fa-pen"></i></span>
                        </div>
                    </div>
                </div>
                <!-- Text input -->
                <div class="row mt-5">
                    <div class="col">
                        <div class="input-group">
                            <div class="form-outline">
                                <input value="<?php echo "$userMobile" ?>" type="text" id="mobile" class="form-control" name="user-mobile" readonly />
                                <label class="form-label" for="category">Mobile</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" onclick="editField('mobile')"><i class="fa-solid fa-pen"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Text input -->
                    <div class="col">
                        <div class="input-group">
                            <div class="form-outline">
                                <input value="<?php echo "$userAddr" ?>" type="text" id="addr" class="form-control" name="user-addr" readonly />
                                <label class="form-label" for="brand">Address</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" onclick="editField('brand')"><i class="fa-solid fa-pen"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- File input -->
                <div class="mt-5">
                    <label class="form-label" for="customFile">Profile Image</label>
                    <input type="file" class="form-control" id="customFile" name="profile-image" readonly />
                </div>
                <!-- Submit button -->
                <div class="container">
                    <button type="submit" class="btn btn-primary btn-block mt-5" id="button" disabled>Save Changes</button>
                </div>
        </form>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_POST['user-name'];
        $userEmail = $_POST['user-email'];
        $userMobile = $_POST['user-mobile'];
        $userAddr = $_POST['user-addr'];
        $file_name = $_FILES['profile-image']['name'];
        $file_size = $_FILES['profile-image']['size'];
        $file_tmp = $_FILES['profile-image']['tmp_name'];
        $file_type = $_FILES['profile-image']['type'];
        $sql2 = "UPDATE userdetails SET u_name='$userName',u_email='$userEmail',u_mobile='$userMobile',u_addr='$userAddr' WHERE u_id=$userId";
        $ret2 = mysqli_query($conn, $sql2);
        if (!$ret2) {
            die("<script>alert('Something went wrong!!!')</script>");
        } else {
            if ($file_name && $file_size && $file_tmp && $file_type) {
                // Validate the file type
                $allowed_types = array('image/jpeg', 'image/png');
                if (in_array($file_type, $allowed_types)) {
                    unlink('../../public/Profile-images/' . $userId . '.jpeg') || unlink('../../public/Profile-images/' . $userId . '.png');// For deleting existing file
                    // Move the uploaded file to the desired location
                    if ($file_type == 'image/jpeg') {
                        move_uploaded_file($file_tmp, '../../public/Profile-images/' . $userId . '.jpeg');
                    } else {
                        move_uploaded_file($file_tmp, '../../public/Profile-images/' . $userId . '.png');
                    }
                } else {
                    die("<script>alert('File type not allowed')</script>");
                }
            }
            echo "<script>window.location.href='index'</script>";
        }
    }
    ?>
    <script>
        function editField(field) {
            var input = document.getElementById(field);
            var button = document.getElementById('button');
            input.removeAttribute('readonly');
            button.removeAttribute('disabled');
        }
        document.getElementById('myForm').addEventListener('submit', (event) => {
            event.preventDefault();
            let confirm = false;
            confirm = window.confirm("Save Changes?");
            if (confirm)
                document.getElementById("myForm").submit();
        });
    </script>
</body>

</html>