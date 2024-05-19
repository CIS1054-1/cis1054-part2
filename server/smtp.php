<?php
/**
 * @file smtp.php
 * @brief Provides a class for sending emails using SMTP.
 * @author Gioele Giunta
 * @version 1.2
 * @date 2023-05-17
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require (__DIR__ . '/vendor/PHPMailer-master/src/Exception.php');
require (__DIR__ . '/vendor/PHPMailer-master/src/PHPMailer.php');
require (__DIR__ . '/vendor/PHPMailer-master/src/SMTP.php');

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();

try {
    // Initialize the mail service
    // $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; // Authentication enabled
    $mail->SMTPSecure = 'ssl'; // Secure transfer enabled, required for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "giuntagioele3@gmail.com";
    $mail->Password = "hxffrodggpiwzgcn";
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->SetFrom('giuntagioele3@gmail.com');
} catch (\Exception $e) {
    // Handle any exceptions that may occur during the initialization
}