<?php
require_once __DIR__ . '/../../vendor/autoload.php';
include "../../connection.php";
require_once "faculty_pdf.php";
require_once "faculty_mail.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['import_faculty_btn'])) {
    if (isset($_FILES['faculty_file']['name']) && $_FILES['faculty_file']['error'] == 0) {
        $file_name = $_FILES['faculty_file']['tmp_name'];
        $ext = pathinfo($_FILES['faculty_file']['name'], PATHINFO_EXTENSION);

        try {
            $spreadsheet = IOFactory::load($file_name);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $header = array_shift($rows);
            $nameIdx = -1;
            $emailIdx = -1;

            foreach ($header as $idx => $val) {
                if (strcasecmp(trim($val), 'Name') == 0) $nameIdx = $idx;
                if (strcasecmp(trim($val), 'Email') == 0) $emailIdx = $idx;
            }

            if ($nameIdx == -1 || $emailIdx == -1) {
                die("Invalid Excel format. columns 'Name' and 'Email' are required.");
            }

            $successCount = 0;
            foreach ($rows as $row) {
                $name = $row[$nameIdx];
                $email = $row[$emailIdx];

                if (empty($name) || empty($email)) continue;

                // Insert or ignore if duplicate email
                $stmt = mysqli_prepare($db, "INSERT INTO `faculty` (`name`, `email`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `name` = ?");
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Generate PDF
                $pdfContent = generateFacultyPDF($name, $email);

                // Send Email
                sendFacultyEmail($email, $name, $pdfContent);
                $successCount++;
            }

            echo "<script>
                alert('Successfully imported $successCount faculty members and triggered emails.');
                window.location.href = '../import_faculty.php';
            </script>";

        } catch (Exception $e) {
            die("Error loading file: " . $e->getMessage());
        }
    } else {
        die("Please upload a valid file.");
    }
}
?>
