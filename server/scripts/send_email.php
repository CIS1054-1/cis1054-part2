<?php
/**
 * @file send_email.php
 * @brief Handles the process of sending an email.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-05-17
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

/**
 * @brief Sends an email using the provided parameters.
 * @param string $to The email address of the recipient.
 * @param string $subject The subject of the email.
 * @param string $body The HTML content of the email.
 * @param string $alt_body The alternative text-only content of the email.
 * @param PHPMailer $mail The PHPMailer instance to use for sending the email.
 * @return bool True if the email was sent successfully, false otherwise.
 */
function send_email($to, $subject, $body, $alt_body, $mail) {
    try {
        // Set the recipient
        $mail->AddAddress($to);

        // Set the email content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $alt_body;

        // Send the email
        $mail->send();
        return true;
    } catch (\Exception $e) {
        return false;
    }
}