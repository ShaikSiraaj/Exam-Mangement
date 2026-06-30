<?php
include "connection.php";
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Exam Management System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="admin/img/favicon.png">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container mx-4 w-100">
            <section class="navbar-brand">Online Exam Management System</section>
            <ul class="navbar-nav my-2 mx-3">
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            </ul>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-white font-weight-bold display-4 mb-4">Test Your Knowledge and Skills</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 fs-5 mb-5">Empowering students through secure, objective, and descriptive online assessments.</p>
                    <a class="btn btn-primary btn-xl shadow-lg" href="login.php">Get Started Now</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="page-section bg-light" id="about">
        <div class="container px-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 20px;">
                        <h2 class="mt-0 fw-bold" style="color: var(--primary);">About This Project</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5 fs-5">This advanced Exam Management System ensures a robust and secure environment for academic excellence. Designed with a focus on usability and security, it streamlines the examination process for both administrators and students.</p>
                        <div class="mb-0" id="follow">
                            <span class="fw-600 text-dark">Follow Developer:</span>
                            <div class="mt-3">
                                <a id="github" href="https://github.com/itsNileshHere" target="_blank" class="mx-2"><img src="student/img/GitHub.png" style="width: 45px; height: 45px;"></a>
                                <a id="telegram" href="https://t.me/DsntMtter" target="_blank" class="mx-2"><img src="student/img/Telegram.png" style="width: 45px; height: 45px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            // Navbar shrink function
            var navbarShrink = function() {
                const navbarCollapsible = document.body.querySelector("#mainNav");
                if (!navbarCollapsible) {
                    return;
                }
                if (window.scrollY === 0) {
                    navbarCollapsible.classList.remove("navbar-shrink");
                } else {
                    navbarCollapsible.classList.add("navbar-shrink");
                }
            };
            navbarShrink();
            document.addEventListener("scroll", navbarShrink);
            const mainNav = document.body.querySelector("#mainNav");
            if (mainNav) {
                new bootstrap.ScrollSpy(document.body, {
                    target: "#mainNav",
                    offset: 74,
                });
            }
        });
    </script>

</body>
</html>