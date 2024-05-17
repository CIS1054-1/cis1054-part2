<?php
/**
 * send_favourites
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-05-17
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

 require_once __DIR__ . '/../autoload.php';
 require __DIR__ . '/../smtp.php';
 require_once __DIR__ . '/send_email.php';


 $users_id = $_SESSION['ID']; 
 $name = $_SESSION['name'];
 $surname = $_SESSION['surname'];
 $email = $_SESSION['email'];
 
 if(!empty($users_id) && !empty($name) && !empty($surname) && !empty($email)){
    $result = $db-> query("SELECT * FROM foods WHERE id IN (SELECT foods_ID FROM wishlists WHERE users_ID = $users_id)");

    $logo_path = '../../assets/img/logo.png';
    $logo_cid = 'logo_image';

    // Add the logo as an attachment and create CID
    $mail->AddEmbeddedImage($logo_path, $logo_cid);

    $email_html = "<img src='cid:" . $logo_cid . "' alt='Los Pollos Hermanos' style='max-width: 200px; margin-bottom: 20px;'>";
    
    $email_html .= "<h1>This is Your Favourites List, $name!</h1>";

    $i = 0;

    while ($row = $result->fetch_assoc()) {
        // Add the image of food as an attachment and create the ID
        $food_path = '../../assets/img/menu/' . $row['image'];
        $food_cid = 'food_image' . $i;
        $mail->AddEmbeddedImage($food_path, $food_cid);

        $email_html .= "<div style='background-color: #f2f2f2; border-radius: 10px; padding: 20px; margin-bottom: 20px; display: flex;'>";
        $email_html .= "<img src='cid:" . $food_cid . "' alt='" . $row['name'] . "' style='max-width: 100px; margin-right: 20px;'>";
        $email_html .= "<div style='flex-grow: 1; width: 80%;'>";
        $email_html .= "<h2 style='font-weight: bold;'>" . $row['name'] . "</h2>";
        $email_html .= "<p>" . $row['ingredients'] . "</p>";
        $email_html .= "</div>";
        $email_html .= "<div style='text-align: right; font-weight: bold;'>EUR: " . $row['price'] . "</div>";
        $email_html .= "</div>";
        $i++;
    }

    send_email($email, "Your Favourites Food List!", $email_html, "Favourites List!", $mail);

    header('Location: ../../favourites.php');

 }else{
     echo "ALARM 405: ACTIVE PROTECTION IP SERVER";
 }


?>