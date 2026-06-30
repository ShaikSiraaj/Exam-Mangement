<?php
include "../connection.php";
include "assets/header.php";
include "assets/navbar.php"
?>

<script type="text/javascript">
    const dashboard = document.querySelector('#dashboard');
    dashboard.classList.add('active');
</script>

<!doctype html>
<html lang="en">

<head>

    <title>Dashboard</title>

</head>

<body>

    <div class="container-fluid">

        <!-- ---------------------- Dashboard Cards -------------------- -->

        <h3 class="fw-bold mb-4">System Overview</h3>
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5 g-4">

            <div class="col">
                <div class="card border-0 shadow-sm h-100 py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-center text-xl-start">
                            <div class="col-auto mx-auto mx-xl-0 mb-3 mb-xl-0">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-award fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="col ms-xl-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Result Published</div>

                                <?php
                                $dash_result_query = "SELECT * FROM `add_exam` WHERE `status`='Ended'";
                                $dash_result_query_run = mysqli_query($db, $dash_result_query);
                                $results = mysqli_num_rows($dash_result_query_run);
                                echo '<div class="h4 mb-0 font-weight-bold text-gray-800">' . ($results ?: 0) . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100 py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-center text-xl-start">
                            <div class="col-auto mx-auto mx-xl-0 mb-3 mb-xl-0">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-success"></i>
                                </div>
                            </div>
                            <div class="col ms-xl-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Exams</div>

                                <?php
                                $dash_exam_query = "SELECT * FROM `add_exam`";
                                $dash_exam_query_run = mysqli_query($db, $dash_exam_query);
                                $exam_total = mysqli_num_rows($dash_exam_query_run);
                                echo '<div class="h4 mb-0 font-weight-bold text-gray-800">' . ($exam_total ?: 0) . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100 py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-center text-xl-start">
                            <div class="col-auto mx-auto mx-xl-0 mb-3 mb-xl-0">
                                <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-user-graduate fa-2x text-info"></i>
                                </div>
                            </div>
                            <div class="col ms-xl-3">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Students
                                </div>

                                <?php
                                $dash_student_query = "SELECT * FROM `add_student`";
                                $dash_student_query_run = mysqli_query($db, $dash_student_query);
                                $student_total = mysqli_num_rows($dash_student_query_run);
                                echo '<div class="h4 mb-0 font-weight-bold text-gray-800">' . ($student_total ?: 0) . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100 py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-center text-xl-start">
                            <div class="col-auto mx-auto mx-xl-0 mb-3 mb-xl-0">
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-book fa-2x text-warning"></i>
                                </div>
                            </div>
                            <div class="col ms-xl-3">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Courses</div>

                                <?php
                                $dash_course_query = "SELECT * FROM `add_course`";
                                $dash_course_query_run = mysqli_query($db, $dash_course_query);
                                $course_total = mysqli_num_rows($dash_course_query_run);
                                echo '<div class="h4 mb-0 font-weight-bold text-gray-800">' . ($course_total ?: 0) . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100 py-2" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-center text-xl-start">
                            <div class="col-auto mx-auto mx-xl-0 mb-3 mb-xl-0">
                                <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-users fa-2x text-danger"></i>
                                </div>
                            </div>
                            <div class="col ms-xl-3">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Classes</div>

                                <?php
                                $dash_class_query = "SELECT * FROM `add_class`";
                                $dash_class_query_run = mysqli_query($db, $dash_class_query);
                                $class_total = mysqli_num_rows($dash_class_query_run);
                                echo '<div class="h4 mb-0 font-weight-bold text-gray-800">' . ($class_total ?: 0) . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>

</body>

</html>