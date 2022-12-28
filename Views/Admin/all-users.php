<?php
include "../../utils/adminAuth.php";
?>


<!DOCTYPE html>
<html lang="en">
<?php include "../partials/head-section.php" ?>

<body>
    <?php include "../partials/admin-navbar.php" ?>
    <section class="pt-5">
        <h1 class="text-center mt-5 mb-5">All Users</h1>
        <table class="table align-middle mb-0 bg-white container">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/connection.php";
                $sql = "SELECT * FROM userdetails WHERE isAdmin=0";
                $retval = mysqli_query($conn, $sql);
                if (!$retval)
                    die();
                else {
                    while ($row = mysqli_fetch_array($retval)) {
                        $userId = $row['u_id'];
                        $userName = $row['u_name'];
                        $userEmail = $row['u_email'];
                        $isBlock = $row['isBlock'];
                        if ($isBlock == 0) {
                            echo '
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="../../public/Profile-images/'.$userId.'" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1" name="userName" id="' . $userName . '">' . $userName . '</p>
                                            <p class="text-muted mb-0">' . $userEmail . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success rounded-pill d-inline">Active</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger" onclick="handleBlock(0,' . $userId . ',' . $userName . ')">Block</button>
                                    <button class="btn btn-primary" onclick="handleAdmin(' . $userId . ',' . $userName . ')">Make Admin</button>
                                </td>
                            </tr>
                                ';
                            } else {
                                echo '
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="../../public/Profile-images/'.$userId.'" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1" name="userName" id="' . $userName . '">' . $userName . '</p>
                                            <p class="text-muted mb-0">' . $userEmail . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger rounded-pill d-inline">Blocked</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success" onclick="handleBlock(1,' . $userId . ',' . $userName . ')">Unblock</button>
                                    <button class="btn btn-primary" onclick="handleAdmin(' . $userId . ',' . $userName . ')">Make Admin</button>
                                </td>
                            </tr>';
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
    <script>
        function handleBlock(status, uId, uName) {
            let confirm = false;
            if (status == 0) {
                confirm = window.confirm(`Block ${uName.innerHTML}?`)
            } else {
                confirm = window.confirm(`Unblock ${uName.innerHTML}?`)
            }
            if (confirm) {
                $.ajax({
                    type: "POST",
                    url: "../../utils/handleBlock.php",
                    data: {
                        uId,
                        status
                    },
                    success: () => {
                        window.location.reload();
                    }
                });
            }
        }

        function handleAdmin(uId, uName) {
            let confirm = false;
            confirm = window.confirm(`Make ${uName.innerHTML} an Admin?`)
            if (confirm) {
                $.ajax({
                    type: "POST",
                    url: "../../utils/handleAdmin.php",
                    data: {
                        uId
                    },
                    success: () => {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
</body>

</html>