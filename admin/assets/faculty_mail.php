<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendFacultyEmail($email, $name, $pdfContent) {
    $mail = new PHPMailer(true);

    try {
        // Since I don't have actual SMTP credentials, I'll use a mock approach
        // or assume the user will configure this later.
        // For now, I'll set it up to use a local mail server if available,
        // or just simulate the process.

        $mail->isSMTP();
        $mail->Host       = 'localhost'; // Placeholder
        $mail->SMTPAuth   = false;
        $mail->Port       = 1025; // Often used for MailHog or similar dev tools

        //Recipients
        $mail->setFrom('admin@exam-system.com', 'Admin EMS');
        $mail->addAddress($email, $name);

        //Attachments
        $mail->addStringAttachment($pdfContent, 'Faculty_Info.pdf');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Faculty Information PDF';
        $mail->Body    = "Hello $name,<br><br>Please find your faculty information attached as a PDF.<br><br>Regards,<br>Admin Team";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
