<?php
include "../../connection.php";

if (isset($_POST['exam_details_btn'])) {
    @session_start();
    $_SESSION['exam_id'] = $_POST['exam_id'];
    die();
}

if (isset($_POST['exam_start_btn'])) {
    @session_start();
    $_SESSION['exam_id'] = $_POST['exam_id'];
    die();
}

if (isset($_POST['show_results_btn'])) {
    @session_start();
    $_SESSION['exam_id'] = $_POST['exam_id'];
    die();
}

// ########## Paginate php code ##########
if (isset($_POST['get_paginate'])) {
    $exam_title = $_POST['exam_title'];
    $std_id = isset($_POST['std_id']) ? $_POST['std_id'] : "";

    $limit = 1;
    $selectquery2 = "SELECT * FROM `add_question` WHERE `exam_title` = ?";
    $stmt2 = mysqli_prepare($db, $selectquery2);
    mysqli_stmt_bind_param($stmt2, "s", $exam_title);
    mysqli_stmt_execute($stmt2);
    $query2 = mysqli_stmt_get_result($stmt2);
    $total_records = mysqli_num_rows($query2);
    $total_pages = ceil($total_records / $limit);
    $res_array = [];

    // Get current student's answers for this exam to determine status
    $status_array = [];
    if (!empty($std_id)) {
        $selectquery_status = "SELECT `question`, `answered`, `review_status` FROM `exam_answers` WHERE `exam_title` = ? AND `std_id` = ?";
        $stmt_status = mysqli_prepare($db, $selectquery_status);
        mysqli_stmt_bind_param($stmt_status, "si", $exam_title, $std_id);
        mysqli_stmt_execute($stmt_status);
        $query_status = mysqli_stmt_get_result($stmt_status);
        while ($row = mysqli_fetch_assoc($query_status)) {
            $status_array[$row['question']] = [
                'answered' => $row['answered'],
                'review_status' => $row['review_status']
            ];
        }
    }

    $i = 1;
    while ($row_q = mysqli_fetch_assoc($query2)) {
        $q_text = $row_q['question'];
        $status = "NotSelected";
        if (isset($status_array[$q_text])) {
            if ($status_array[$q_text]['review_status'] == 'true') {
                $status = "Review";
            } else if ($status_array[$q_text]['answered'] != "") {
                $status = "Attempted";
            } else {
                $status = "NotAnswered";
            }
        }
        $res_array[] = [
            'page' => $i,
            'status' => $status
        ];
        $i++;
    }

    header('Content-type: application/json');
    echo json_encode($res_array);
    die();
}

// ########## Answer Submit ##########
if (isset($_POST['exam_ans_submit'])) {
    $std_id = $_POST['std_id'];
    $std_name = $_POST['std_name'];
    $std_email = $_POST['std_email'];
    $question = $_POST['question'];
    $exam_title = $_POST['exam_title'];
    $answered = isset($_POST['answered']) ? $_POST['answered'] : "";
    $review_status = isset($_POST['review_status']) ? $_POST['review_status'] : "false";

    $selectquery3 = "SELECT `question` FROM `exam_answers` WHERE `exam_title` = ? AND `question` = ? AND `std_email` = ?";
    $stmt3 = mysqli_prepare($db, $selectquery3);
    mysqli_stmt_bind_param($stmt3, "sss", $exam_title, $question, $std_email);
    mysqli_stmt_execute($stmt3);
    $query3 = mysqli_stmt_get_result($stmt3);

    if (mysqli_num_rows($query3) != 0) {
        if (isset($_POST['review_status_only'])) {
            $selectquery4 = "UPDATE `exam_answers` SET `review_status`=? WHERE `exam_title` = ? AND `question` = ? AND `std_id` = ?";
            $stmt4 = mysqli_prepare($db, $selectquery4);
            mysqli_stmt_bind_param($stmt4, "sssi", $review_status, $exam_title, $question, $std_id);
        } else {
            $selectquery4 = "UPDATE `exam_answers` SET `std_name`=?, `answered`=?, `review_status`=? WHERE `exam_title` = ? AND `question` = ? AND `std_id` = ?";
            $stmt4 = mysqli_prepare($db, $selectquery4);
            mysqli_stmt_bind_param($stmt4, "sssssi", $std_name, $answered, $review_status, $exam_title, $question, $std_id);
        }
        mysqli_stmt_execute($stmt4);
    } else {
        $selectquery5 = "INSERT INTO `exam_answers`(`std_id`, `std_name`, `std_email`, `exam_title`, `question`, `answered`, `review_status`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt5 = mysqli_prepare($db, $selectquery5);
        mysqli_stmt_bind_param($stmt5, "issssss", $std_id, $std_name, $std_email, $exam_title, $question, $answered, $review_status);
        mysqli_stmt_execute($stmt5);
    }
    die();
}

// ########## Exam start Entry ##########
if (isset($_POST['exam_started'])) {
    $std_id = $_POST['std_id'];
    $std_name = $_POST['std_name'];
    $std_email = $_POST['std_email'];
    $exam_name = $_POST['exam_name'];
    $attendence_status = 'Ended';

    $selectquery1 = "SELECT * FROM `std_exam_status` WHERE `std_id` = ? AND `exam_name` = ?";
    $stmt1 = mysqli_prepare($db, $selectquery1);
    mysqli_stmt_bind_param($stmt1, "is", $std_id, $exam_name);
    mysqli_stmt_execute($stmt1);
    $query1 = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($query1) == 0) {
        $selectquery2 = "INSERT INTO `std_exam_status`(`std_id`, `std_name`, `std_email`, `exam_name`, `attendence_status`) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($db, $selectquery2);
        mysqli_stmt_bind_param($stmt2, "issss", $std_id, $std_name, $std_email, $exam_name, $attendence_status);
        mysqli_stmt_execute($stmt2);
    } else {
        die();
    }
    die();
}

// ########## Show Results ##########
if (isset($_POST['show_results'])) {
    $output = "";
    $exam_id = $_POST['exam_id'];
    $std_id = $_POST['std_id'];

    // add_exam Table
    $sql1 = "SELECT * FROM `add_exam` WHERE `exam_id` = ?";
    $stmt1 = mysqli_prepare($db, $sql1);
    mysqli_stmt_bind_param($stmt1, "i", $exam_id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $res1 = mysqli_fetch_array($result1);
    $exam_date = date('F j Y', strtotime($res1['exam_date']));

    // add_student Table
    $sql3 = "SELECT * FROM `add_student` WHERE `std_id` = ?";
    $stmt3 = mysqli_prepare($db, $sql3);
    mysqli_stmt_bind_param($stmt3, "i", $std_id);
    mysqli_stmt_execute($stmt3);
    $result3 = mysqli_stmt_get_result($stmt3);
    $res3 = mysqli_fetch_array($result3);

    // Joining add_exam with exam_answers
    $sql2 = "SELECT exam_answers.question, exam_answers.answered, add_question.correct_answer, add_exam.correct, add_exam.wrong
            FROM `exam_answers`
            INNER JOIN `add_exam`
            ON exam_answers.exam_title = add_exam.exam_title
            INNER JOIN `add_question`
            ON exam_answers.question = add_question.question
            AND exam_answers.exam_title = add_question.exam_title
            WHERE exam_answers.exam_title = ? AND exam_answers.std_id = ?";
    $stmt2 = mysqli_prepare($db, $sql2);
    mysqli_stmt_bind_param($stmt2, "si", $res1['exam_title'], $std_id);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);

    $marks = 0;
    foreach ($result2 as $res2) {
        if ($res2['answered'] == $res2['correct_answer'])
            $marks = $marks + $res2['correct'];
        else if ($res2['answered'] != $res2['correct_answer']) {
            if (empty($res2['answered'])) {
                echo NULL;
            } else {
                $marks = $marks - $res2['wrong'];
            }
        }
    }

    $output .= '<div id="result-wrapper"  style="user-select: none; -moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none; -o-user-select: none;">
                    <div class="result-box" id="result-box">
                        <P id="exam_title">' . htmlspecialchars($res1['exam_title']) . '</P>
                        <div id="head">
                            <div class="left">
                                <p><span>Student Name : </span>' . htmlspecialchars($res3['std_name']) . '</p>
                                <p><span>Email ID : </span>' . htmlspecialchars($res3['email']) . '</p>
                                <p><span>Your Score : </span>' . $marks . ' Marks</p>
                            </div>
                            <div class="right">
                                <p><span>Exam Date : </span>' . $exam_date . '</p>
                                <p><span>Exam Duration : </span>' . htmlspecialchars($res1['exam_time_limit']) . ' Minutes</p>
                            </div>
                        </div>

                        <div class="devider"></div>

                        <div id="ribbon">
                            <a class="ribbonA"></a>
                            <p>Answer Analysis</p>
                            <a class="ribbonB"></a>
                        </div>

                        <div id="marks_body">';

    $pos_mrk = "Marks";
    if ($res1['correct'] == '1')
        $pos_mrk = "Mark";
    $neg_mrk = "Marks";
    if ($res1['wrong'] == '1')
        $neg_mrk = "Mark";

    $output .= '<p id="pos"><span>Positive Marks per Question : </span>' . htmlspecialchars($res1['correct']) . ' ' . $pos_mrk . '</p>
                <p id="neg"><span>Negative Marks per Question : </span>' . htmlspecialchars($res1['wrong']) . ' ' . $neg_mrk . '</p>
            </div>
        <div id="table_body">';

    // add_questions Table
    $sql4 = "SELECT * FROM `add_question` WHERE `exam_title` = ?";
    $stmt4 = mysqli_prepare($db, $sql4);
    mysqli_stmt_bind_param($stmt4, "s", $res1['exam_title']);
    mysqli_stmt_execute($stmt4);
    $result4 = mysqli_stmt_get_result($stmt4);
    $total_records = mysqli_num_rows($result4);

    // exam_answers Table
    $sql5 = "SELECT * FROM `exam_answers` WHERE `std_id` = ? AND `exam_title` = ?";
    $stmt5 = mysqli_prepare($db, $sql5);
    mysqli_stmt_bind_param($stmt5, "is", $std_id, $res1['exam_title']);
    mysqli_stmt_execute($stmt5);
    $result5 = mysqli_stmt_get_result($stmt5);

    $i = 0;
    foreach ($result5 as $res5) {
        if ($res5['answered'] != '')
            $i = $i + 1;
    }
    $notAttempted = $total_records - $i;

    $correct_counter = 0;
    $incorrect_counter = 0;
    // reset result2 pointer
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    foreach ($result2 as $res2) {
        if ($res2['answered'] == $res2['correct_answer'])
            $correct_counter = $correct_counter + 1;
        if ($res2['answered'] != $res2['correct_answer']) {
            if (empty($res2['answered'])) {
                // echo NULL;
            } else {
                $incorrect_counter = $incorrect_counter + 1;
            }
        }
    }

    $output .= '<div class="table-responsive">
                    <table class="mb-0">
                        <thead>
                            <tr>
                                <th>Topic</th>
                                <th style="padding-right: 10px;">Total Questions</th>
                                <th>Attempted Questions</th>
                                <th id="NA">Non Attempted Questinos</th>
                                <th>Correct Answers</th>
                                <th>Incorrect Answers</th>
                                <th>Max Marks</th>
                                <th>Marks Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . htmlspecialchars($res1['exam_title']) . '</td>
                                <td>' . $total_records . '</td>
                                <td>' . $i . '</td>
                                <td>' . $notAttempted . '</td>
                                <td>' . $correct_counter . '</td>
                                <td>' . $incorrect_counter . '</td>
                                <td>' . $total_records * $res1['correct'] . '</td>
                                <td>' . $marks . '</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>';

    echo $output;
}
