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
    // Load configuration from the config.ini file
    $config = parse_ini_file('config.ini');
    // Initialize the mail service
    // $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; // Authentication enabled
    $mail->Host = $config['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['email'];
    $mail->Password = $config['password_smtp'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = $config['port'];

    $mail->SetFrom($config['email']);
} catch (\Exception $e) {
    // Handle any exceptions that may occur during the initialization
}