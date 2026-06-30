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
    <div class="container-fluid px-4">
        <h3 class="my-4 fw-bold text-gray-800">Your Examinations</h3>
        <div class="row">
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
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-3 h-100 exams-view-card">
                    <div class="card-header bg-primary text-white text-center py-3 border-0">
                        <h5 class="mb-0 fw-bold"><?php echo $res1['exam_title'] ?></h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar-alt text-primary fa-lg"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Start Time</small>
                                <span class="fw-bold"><?php echo $start_time_date ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-danger fa-lg"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Expires At</small>
                                <span class="fw-bold"><?php echo date('M j, Y', $start_date) . ' ' . $end_time_date ?></span>
                            </div>
                        </div>
                        <div class="row mt-4 pt-3 border-top g-0 text-center">
                            <div class="col-6 border-end">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Questions</small>
                                <span class="h5 fw-bold text-dark mb-0"><?php echo $res1['total_question'] ?></span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Duration</small>
                                <span class="h5 fw-bold text-dark mb-0"><?php echo $res1['exam_time_limit'] ?>m</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0 text-center">
                        <?php
                        if (mysqli_num_rows($query3) > 0) {
                            if ($row3['attendence_status'] == "Ended") {
                        ?>
                                <button type="button" id="<?php echo $res1['exam_id'] ?>" class="btn btn-info w-100 rounded-pill text-white fw-bold show_results_btn">
                                    <i class="fa fa-list-alt me-2"></i>View Results
                                </button>
                            <?php }
                        } else if ($res1['status'] == "Ended") { ?>
                            <button type="button" id="<?php echo $res1['exam_id'] ?>" class="btn btn-secondary w-100 rounded-pill fw-bold show_results_btn">
                                <i class="fa fa-list-alt me-2"></i>View Results
                            </button>
                        <?php } else {
                        ?>
                            <button type="button" id="<?php echo $res1['exam_id'] ?>" class="btn btn-primary w-100 rounded-pill fw-bold exam_details_btn">
                                <i class="fas fa-play me-2"></i>Take Exam
                            </button>
                        <?php
                        }
                        ?>
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

        $('.show_results_btn').on('click', function(e) {
            var exam_id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'assets/data.php',
                data: {
                    'show_results_btn': true,
                    'exam_id': exam_id
                }
            });
            onclick = window.open('result.php', '_self');
        });
    </script>

    <?php
    include "assets/query_update.php"
    ?>

</body>

</html>