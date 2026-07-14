<!DOCTYPE html>
<?php
@session_start();
if (isset($_SESSION['exam_id'])) {
    unset($_SESSION['exam_id']);
}

include "../connection.php";
include "assets/header.php";
include "assets/navbar.php";
?>

<script type="text/javascript">
    const home = document.querySelector('#home');
    home.classList.add('current');
</script>

<html>

<head>

    <title>index</title>

</head>

<body>
    <div class="container-fluid px-4 py-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold text-dark mb-0">Upcoming Exams</h3>
            <span class="badge bg-primary rounded-pill px-3 py-2">Active Sessions</span>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            $sql2 = "SELECT * FROM `add_student` WHERE `std_id` = '{$_SESSION["std_id"]}'";
            $result2 = mysqli_query($db, $sql2);
            $res2 = mysqli_fetch_array($result2);

            $sql1 = "SELECT * FROM `add_exam` WHERE `course` = '{$res2['course']}'";
            $result1 = mysqli_query($db, $sql1);

            foreach ($result1 as $res1) {
                $start_date = strtotime($res1['exam_date']);
                $start_time = strtotime($res1['exam_time']);
                $exam_time_limit = strtotime($res1['exam_time_limit']);
                $remaining_seconds = $res1['exam_time_limit'] * 60;
                $start_time_date = date('F j Y h:i A', strtotime($res1['exam_date'] . ' ' . $res1['exam_time']));
                $end_time_date = date('h:i A', ($start_time + $remaining_seconds));

                $selectquery3 = "SELECT * FROM `std_exam_status` WHERE `std_id` = '{$_SESSION['std_id']}' AND `exam_name` = '{$res1['exam_title']}'";
                $query3 = mysqli_query($db, $selectquery3);
                $row3 = mysqli_fetch_array($query3);
            ?>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <div class="card-header bg-primary text-white text-center py-3 border-0">
                            <h5 class="mb-0 fw-bold"><?php echo $res1['exam_title'] ?></h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <span class="small text-muted fw-bold">Start:</span>
                                    <span class="small ms-auto"><?php echo $start_time_date ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-clock text-danger me-2"></i>
                                    <span class="small text-muted fw-bold">Expires:</span>
                                    <span class="small ms-auto"><?php echo date('F j Y', $start_date) . ' ' . $end_time_date ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-question-circle text-success me-2"></i>
                                    <span class="small text-muted fw-bold">Questions:</span>
                                    <span class="small ms-auto"><?php echo $res1['total_question'] ?> MCQ</span>
                                </div>
                                <div class="d-flex align-items-center mb-0">
                                    <i class="fas fa-hourglass-half text-warning me-2"></i>
                                    <span class="small text-muted fw-bold">Duration:</span>
                                    <span class="small ms-auto"><?php echo $res1['exam_time_limit'] ?> Minutes</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <?php
                            if (mysqli_num_rows($query3) > 0) {
                                if ($row3['attendence_status'] == "Ended") {
                            ?>
                                    <button type="button" class="btn btn-secondary w-100 rounded-pill py-2" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Completed
                                    </button>
                                <?php }
                            } else if ($res1['status'] == "Ended") { ?>
                                <button type="button" class="btn btn-secondary w-100 rounded-pill py-2" disabled>
                                    <i class="fas fa-times-circle me-2"></i>Ended
                                </button>
                            <?php } else { ?>
                                <button type="button" id="<?php echo $res1['exam_id'] ?>" class="btn btn-primary exam_details_btn w-100 rounded-pill py-2">
                                    <i class="fas fa-play me-2"></i>Start Exam
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script type="text/javascript">
        $('.exam_details_btn').on('click', function(e) {
            var exam_id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'assets/data.php',
                data: {
                    'exam_details_btn': true,
                    'exam_id': exam_id
                }
            });
            onclick = window.open('exam_details.php', '_self');
        });
    </script>

    <?php
    include "assets/query_update.php"
    ?>

</body>

</html>