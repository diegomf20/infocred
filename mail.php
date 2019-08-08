<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.fishti.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@fishti.com';                     // SMTP username
    $mail->Password   = 'stunsd18@';                               // SMTP password
    $mail->SMTPSecure = 'SMTP';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@fishti.com', 'Fishti Info');
    $mail->addAddress('diegomf.mendoza@gmail.com');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    header('Content-Type: application/json');    
    if (!$mail->send()) {
        echo json_encode([
            "status"    => "ERROR",
            "data"      => $mail->ErrorInfo
        ]);
    }else {
        echo json_encode([
            "status"    => "OK",
            "data"      => "Mensaje enviado."
        ]);
    }
} catch (Exception $e) {
    header('Content-Type: application/json');    
    echo json_encode([
        "status"    => "ERROR",
        "data"      => $mail->ErrorInfo
    ]);
}