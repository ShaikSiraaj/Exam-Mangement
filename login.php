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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Javascript -->
    <script src="admin/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light">

    <section class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <!-- Pills navs -->
                            <div class="login-pill mt-4 px-4">
                                <ul class="nav nav-pills nav-fill bg-light p-1 rounded-pill" id="ex1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-pill" id="tab-student" role="tab" aria-selected="true">Student</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link rounded-pill" id="tab-admin" role="tab" aria-selected="false">Admin</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="std_login row align-items-center g-0">
                                <div class="col-md-6 d-none d-md-block text-center p-4">
                                    <img class="img-fluid" src="admin/img/draw2.png" alt="Student Login">
                                </div>
                                <div class="col-md-6 p-5">
                                    <h3 class="fw-bold mb-4">Student Login</h3>
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

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <input class="btn btn-primary w-100" type="submit" name="std_login_btn" id="std_login_btn" value="Login">
                                    <p style='font-size: .875em;' class='fw-700 mt-3 pt-1 mb-0'>
                                        <span class="text-muted">Can't Login?</span>
                                        <a href="#" class="text-danger text-decoration-none">Contact Admin</a>
                                    </p>
                                </div>
                            </form>
                                </div>
                            </div>

                            <div class="adm_login row align-items-center g-0" style="display: none;">
                                <div class="col-md-6 p-5">
                                    <h3 class="fw-bold mb-4">Admin Login</h3>
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

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <input class="btn btn-primary w-100" type="submit" name="adm_login_btn" id="adm_login_btn" value="Login">
                                    <p style='font-size: .875em;' class='fw-700 mt-3 pt-1 mb-0'>
                                        Don't have an account?
                                        <a href='admin/admin_reg.php' class='text-danger text-decoration-none'>Register</a>
                                    </p>
                                </div>
                            </form>
                                </div>
                                <div class="col-md-6 d-none d-md-block text-center p-4">
                                    <img class="img-fluid" src="student/img/27799766.png" alt="Admin Login">
                                </div>
                            </div>
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
            $('.container-log li a#tab-admin').removeClass('active')
            $(this).addClass('active');
            $('.adm_login').fadeOut(300).css("display", "none");
            $('.std_login').fadeIn(300).css("display", "");
        })

        $(document).on("click", "#tab-admin", function() {
            $('.container-log li a#tab-student').removeClass('active')
            $(this).addClass('active');
            $('.std_login').fadeOut(300).css("display", "none")
            $('.adm_login').fadeIn(300).css("display", "")
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