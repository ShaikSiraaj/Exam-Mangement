<?php
include "../connection.php";
include "assets/header.php"
?>
<!doctype html>
<html>

<head>

    <title>Admin Registration</title>

    <!--  Sweet Alert  -->
    <script src="js/sweetalert.js"></script>

</head>

<body class="bg-light">

    <section class="min-vh-100 d-flex align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row align-items-center g-0">
                                <div class="col-md-6 p-5">
                                    <h3 class="fw-bold mb-4">Admin Registration</h3>
                            <form id="reg_form" action="" enctype="multipart/form-data" method="POST">

                                <div class="profile-pic-reg position-relative mb-5 mx-auto" style="width: 120px;">
                                    <img src="img/pfp.png" id="photo">
                                    <div class="round">
                                        <input type="file" id="file" name="avatar" accept=".jpg, .jpeg, .png">
                                        <label for="file" id="uploadBtn"><i class="fa fa-camera" style="color: #fff;"></i></label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Contact No.</label>
                                    <input type="number" class="form-control" name="contact" placeholder="Enter Contact No" required value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email ID</label>
                                    <input type="email" class="form-control" name="emailid" placeholder="Enter Email ID" required value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required value="">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Special Token</label>
                                    <input type="text" class="form-control" name="specialtoken" placeholder="Enter Special Token" required value="">
                                </div>
                                <div class="text-center pt-2">
                                    <button type="submit" class="btn btn-primary w-100" name="reg_btn" id="reg_btn">Register Account</button>
                                    <p class="small fw-bold mt-3 mb-0">Already have an account? <a href="../login.php" class="text-danger text-decoration-none">Login</a></p>
                                </div>

                            </form>
                                </div>
                                <div class="col-md-6 d-none d-md-block text-center p-4">
                                    <img class="img-fluid" src="img/27799766.png" alt="Register">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['reg_btn'])) {
        $fname = $_POST['fullname'];
        $emailid = $_POST['emailid'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];
        $myToken = $_POST['specialtoken'];
        function generateRandomString($length = 10)
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }
        $pfpname = generateRandomString();
        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = "$target_dir$pfpname.$ext";

        if (!empty($_FILES["avatar"]["name"])) {
            move_uploaded_file($orig_file, $destination);
        } else {
            $destination = "";
        }

        $mailCount = 0;
        $tokenCount = 0;

        // Check for existing email and token
        $stmt_check = mysqli_prepare($db, "SELECT emailid, special_token FROM `admin_reg` WHERE emailid = ? OR special_token = ?");
        mysqli_stmt_bind_param($stmt_check, "ss", $emailid, $myToken);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);

        while ($row = mysqli_fetch_assoc($result_check)) {
            if ($row['emailid'] == $emailid) {
                $mailCount++;
            }
            if ($row['special_token'] == $myToken) {
                $tokenCount++;
            }
        }
        mysqli_stmt_close($stmt_check);

        if ($mailCount > 0) {
            echo '<script type="text/javascript">
                swal("Failed", "Email Already Registered", "error");
            </script>';
        } elseif ($tokenCount == 0) {
            echo '<script type="text/javascript">
                swal("Failed", "Token not Registered", "error");
            </script>';
        } else {
            if (!empty($destination))  //Update pfp if file uploaded
            {
                $stmt_upd = mysqli_prepare($db, "UPDATE `admin_reg` SET `image`=?, `full_name`=?, `contact`=?, `emailid`=?, `password`=? WHERE `special_token` = ?");
                mysqli_stmt_bind_param($stmt_upd, "ssssss", $destination, $fname, $contact, $emailid, $password, $myToken);
            } else  //Not update pfp if file not uploaded
            {
                $stmt_upd = mysqli_prepare($db, "UPDATE `admin_reg` SET `full_name`=?, `contact`=?, `emailid`=?, `password`=? WHERE `special_token` = ?");
                mysqli_stmt_bind_param($stmt_upd, "sssss", $fname, $contact, $emailid, $password, $myToken);
            }

            mysqli_stmt_execute($stmt_upd);
            mysqli_stmt_close($stmt_upd);

            echo '<script type="text/javascript">
                swal("Success", "Registered Successfully!", "success", {
                    timer: 2000,
                }).then(function() {
                    window.location = "../login.php";
                });
            </script>';
        }
    }
    ?>

    <!-- -------------- pfp add script ------------ -->

    <script type="text/javascript">
        const imgDiv = document.querySelector('.profile-pic-reg');
        const img = document.querySelector('#photo');
        const file = document.querySelector('#file');
        const uploadBtn = document.querySelector('#uploadBtn');

        file.addEventListener('change', function() {
            const choosedFile = this.files[0];
            if (choosedFile) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    img.setAttribute('src', reader.result);
                });
                reader.readAsDataURL(choosedFile);
            }
        })
    </script>

</body>

</html>
