<?php
include "connection.php";
session_start();

if (isset($_POST['got_std'])) {
    $std_email = $_POST['std_emailid'];
    $std_password = $_POST['std_password'];
    $rememberme_std_check = $_POST['rememberme_std_check'];

    $stmt = mysqli_prepare($db, "SELECT std_id FROM `add_student` WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $std_email, $std_password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "";
    } else {
        $_SESSION['std_id'] = $row['std_id'];
        echo "Logged IN Successfully!";
    }

    if ($rememberme_std_check == "true") {
        setcookie('Semailid', $std_email, time() + 86400, '/');
        setcookie('Spassword', $std_password, time() + 86400, '/');
    }

    mysqli_stmt_close($stmt);
    die();
}

if (isset($_POST['got_adm'])) {
    $adm_email = $_POST['adm_emailID'];
    $adm_password = $_POST['adm_password'];
    $rememberme_adm_check = $_POST['rememberme_adm_check'];

    $stmt = mysqli_prepare($db, "SELECT adm_id FROM `admin_reg` WHERE emailid = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $adm_email, $adm_password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "";
    } else {
        $_SESSION['adm_id'] = $row['adm_id'];
        echo "Logged IN Successfully!";
    }

    if ($rememberme_adm_check == "true") {
        setcookie('Aemailid', $adm_email, time() + 86400, '/');
        setcookie('Apassword', $adm_password, time() + 86400, '/');
    }

    mysqli_stmt_close($stmt);
    die();
}
