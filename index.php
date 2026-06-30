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
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">Online Exam Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Elevate Your Academic Performance</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">A comprehensive platform for secure, efficient, and insightful examinations. Test your boundaries and achieve your goals with our advanced testing environment.</p>
                    <a class="btn btn-primary btn-xl" href="login.php">Get Started Now</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="page-section bg-primary" id="about">
        <div class="container px-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">About This Project</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-90 mb-4">This is an in-house Project work undertaken in context of partial fulfillment in the Computer Science & Tech. Department for Exam. This Project ensures a safe and secure environment for students to test their Knowledge.</p>
                    <div class="mb-4" id="follow">Follow Me on :
                        <a id="github" href="https://github.com/itsNileshHere" target="_blank"><img src="student/img/GitHub.png"></a>
                        <a id="telegram" href="https://t.me/DsntMtter" target="_blank"><img src="student/img/Telegram.png"></a>
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
            // Shrink the navbar
            navbarShrink();
            // Shrink the navbar when page is scrolled
            document.addEventListener("scroll", navbarShrink);

            // Activate Bootstrap scrollspy on the main nav element
            const mainNav = document.body.querySelector("#mainNav");
            if (mainNav) {
                new bootstrap.ScrollSpy(document.body, {
                    target: "#mainNav",
                    offset: 74,
                });
            }

            // Collapse responsive navbar when toggler is visible
            const navbarToggler = document.body.querySelector('.navbar-toggler');
            const responsiveNavItems = [].slice.call(
                document.querySelectorAll('#navbarResponsive .nav-link')
            );
            responsiveNavItems.map(function (responsiveNavItem) {
                responsiveNavItem.addEventListener('click', () => {
                    if (window.getComputedStyle(navbarToggler).display !== 'none') {
                        navbarToggler.click();
                    }
                });
            });
        });
    </script>

</body>
</html>