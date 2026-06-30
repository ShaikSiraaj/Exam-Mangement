<?php
include "connection.php";
session_start();
?>
<!doctype html>
<html>

<head>

    <title>Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="admin/img/favicon.png">

    <!-- stylesheet -->
    <link href="admin/css/style.css?version=1" rel="stylesheet" type="text/css">
    <link href="admin/css/bootstrap.css?version=1" rel="stylesheet" type="text/css">
    <link href="admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Javascript -->
    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light">

    <section class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-primary p-5">
                                <div class="text-center">
                                    <img src="admin/img/draw2.png" class="img-fluid mb-4" style="max-height: 300px;" id="login_img">
                                    <h3 class="text-white fw-bold">Welcome Back!</h3>
                                    <p class="text-white-50">Please login to access your dashboard and manage your exams.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-4 p-md-5 bg-white">
                                <!-- Pills navs -->
                                <div class="login-pill mb-5 d-flex justify-content-center">
                                    <ul class="nav nav-pills p-1 bg-light rounded-pill" id="ex1" role="tablist" style="width: fit-content;">
                                        <li class="nav-item">
                                            <a class="nav-link active rounded-pill px-4" id="tab-student" role="tab" aria-selected="true" style="cursor:pointer">Student</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link rounded-pill px-4" id="tab-admin" role="tab" aria-selected="false" style="cursor:pointer">Admin</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="std_login">
                                    <div class="log-form-container">
                            <form id="std_login_form" action="" method="POST">
                                <?php
                                $cookieEmail_std = "";
                                $cookiePass_std = "";
                                if (isset($_COOKIE['Semailid'])) {
                                    $cookieEmail_std = $_COOKIE['Semailid'];
                                }
                                if (isset($_COOKIE['Spassword'])) {
                                    $cookiePass_std = $_COOKIE['Spassword'];
                                }
                                ?>
                                <div style="padding-bottom: 5px;">
                                    <label style="font-size:12px; font-weight:600">Email ID</label>
                                    <input type="email" class="form-control" id="std_emailid" autocomplete="std_emailid" placeholder="Enter Email ID" required value="<?php echo $cookieEmail_std ?>">
                                </div>
                                <div style="padding-bottom: 20px;">
                                    <label style="font-size:12px; font-weight:600">Password</label>
                                    <input type="password" class="form-control" name="std_password" id="std_password" autocomplete="std_password" placeholder="Enter Password" required value="<?php echo $cookiePass_std ?>">
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="rememberme_std" name="rememberme_std" />
                                        <label class="form-check-label" for="rememberme_std">
                                            Remember me
                                        </label>
                                    </div>
                                    <!-- <a href="#!" class="forgot_pass">Forgot password?</a> -->
                                </div>

                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary w-100 py-3 fw-bold" type="submit" name="std_login_btn" id="std_login_btn" value="Login as Student">
                                    <p style='font-size: .875em;' class='fw-600 mt-3 text-center mb-0 text-muted'>
                                        Can't Login? Ask your administrator to add you.
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="adm_login" style="display: none;">
                        <div class="log-form-container">
                            <form id="adm_login_form" action="" method="POST">
                                <?php
                                $cookieEmail_adm = "";
                                $cookiePass_adm = "";
                                if (isset($_COOKIE['Aemailid'])) {
                                    $cookieEmail_adm = $_COOKIE['Aemailid'];
                                }
                                if (isset($_COOKIE['Apassword'])) {
                                    $cookiePass_adm = $_COOKIE['Apassword'];
                                }
                                ?>
                                <div style="padding-bottom: 5px;">
                                    <label style="font-size:12px; font-weight:600">Email ID</label>
                                    <input type="email" class="form-control" id="adm_emailid" autocomplete="adm_emailid" placeholder="Enter Email ID" required value="<?php echo $cookieEmail_adm ?>">
                                </div>
                                <div style="padding-bottom: 20px;">
                                    <label style="font-size:12px; font-weight:600">Password</label>
                                    <input type="password" class="form-control" name="adm_password" id="adm_password" autocomplete="adm_password" placeholder="Enter Password" required value="<?php echo $cookiePass_adm ?>">
                                </div>
                                <script src="admin/js/password_icon.js"></script>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="rememberme_adm" name="rememberme_adm" />
                                        <label class="form-check-label" for="rememberme_adm">
                                            Remember me
                                        </label>
                                    </div>
                                    <!-- <a href="#!" class="forgot_pass">Forgot password?</a> -->
                                </div>

                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary w-100 py-3 fw-bold" type="submit" name="adm_login_btn" id="adm_login_btn" value="Login as Admin">
                                    <p style='font-size: .875em;' class='fw-600 mt-3 text-center mb-0 text-muted'>
                                        Don't have an account?
                                        <a href='admin/admin_reg.php' class='text-danger'>Register Now</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ------------------ Scripts -------------- -->

    <script src="admin/js/sweetalert.js"></script>
    <script>
        $(document).on("click", "#tab-student", function() {
            $('.login-pill li a#tab-admin').removeClass('active')
            $(this).addClass('active');
            $('.adm_login').fadeOut(300).css("display", "none");
            $('.std_login').fadeIn(300).css("display", "");
            $('#login_img').attr('src', 'admin/img/draw2.png');
        })

        $(document).on("click", "#tab-admin", function() {
            $('.login-pill li a#tab-student').removeClass('active')
            $(this).addClass('active');
            $('.std_login').fadeOut(300).css("display", "none")
            $('.adm_login').fadeIn(300).css("display", "")
            $('#login_img').attr('src', 'student/img/27799766.png');
        })

        $(document).ready(function() {

            // ######### student login #########
            $(std_login_form).submit(function(e) {
                e.preventDefault();
                var rememberme_std_check = "false";
                if ($('#rememberme_std').is(':checked'))
                    rememberme_std_check = "true";

                var std_emailid = $('#std_emailid').val();
                var std_password = $('#std_password').val();
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: {
                        'got_std': true,
                        'std_emailid': std_emailid,
                        'std_password': std_password,
                        'rememberme_std_check': rememberme_std_check,
                    },
                    success: function(response) {
                        if (response) {
                            swal(response, "Redirecting in 2 seconds", "success", {
                                timer: 2000,
                                button: false,
                            }).then(function() {
                                window.location = "student/home.php";
                                $('#std_emailid').val("");
                                $('#std_password').val("");
                            });
                        } else {
                            $('#std_emailid').val("");
                            $('#std_password').val("");
                            swal("Failed", "Invalid Email ID or Password", "error");
                        }
                    }
                });
            });

            // ######### admin login #########
            $(adm_login_form).submit(function(e) {
                e.preventDefault();
                var rememberme_adm_check = "false";
                if ($('#rememberme_adm').is(':checked'))
                    rememberme_adm_check = "true";
                var adm_emailID = $('#adm_emailid').val();
                var adm_password = $('#adm_password').val();
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: {
                        'got_adm': true,
                        'adm_emailID': adm_emailID,
                        'adm_password': adm_password,
                        'rememberme_adm_check': rememberme_adm_check,
                    },
                    success: function(response) {
                        if (response) {
                            swal(response, "Redirecting in 2 seconds", "success", {
                                timer: 2000,
                                button: false,
                            }).then(function() {
                                window.location = "admin/dashboard.php";
                                $('#adm_emailid').val("");
                                $('#adm_password').val("");
                            });
                        } else {
                            $('#adm_emailid').val("");
                            $('#adm_password').val("");
                            swal("Failed", "Invalid Email ID or Password", "error");
                        }
                    }
                });
            });

        });
    </script>

</body>

</html>