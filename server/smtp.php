<?php
/**
 * smtp
 *
 * @author Gioele Giunta
 * @version 1.2
 * @since 2023-05-17
 * @info Me (Gioele) am going to use the SNAKE_CASE for the php files
 */

require (__DIR__ . '/vendor/PHPMailer-master/src/Exception.php');
require (__DIR__ . '/vendor/PHPMailer-master/src/PHPMailer.php');
require (__DIR__ . '/vendor/PHPMailer-master/src/SMTP.php');

$mail = new PHPMailer\PHPMailer\PHPMailer(); 
$mail->IsSMTP(); 

try{
    //Inizialing Mail Service
    //$mail->SMTPDebug = 1; N
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true; 
    $mail->Username = "giuntagioele3@gmail.com";
    $mail->Password = "hxffrodggpiwzgcn";
    $mail->SMTPSecure = 'tls'; 
    //$mail->Port = 587; 
    $mail->Port = 587; 

    $mail->SetFrom('giuntagioele3@gmail.com');

} catch(\Exception $e) {}

?>