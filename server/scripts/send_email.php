<?php
/**
 * send_email
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-05-17
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

function send_email($to, $subject, $body, $alt_body, $mail){
    try{
        //Recipient
        $mail->AddAddress($to);
    
        //Content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $alt_body;
    
        $mail->send();
        return true;
    } catch(\Exception $e) {
        return false;
    }
}
?>