<?php
/**
 * @file send_favourites.php
 * @brief Sends the user's favourites list via email.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-05-17
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require_once __DIR__ . '/../autoload.php';
require __DIR__ . '/../smtp.php';
require_once __DIR__ . '/send_email.php';

// Get the user's information from the session
$users_id = $_SESSION['ID']; 
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$email = $_SESSION['email'];

// Check if all the required user information is available
if(!empty($users_id) && !empty($name) && !empty($surname) && !empty($email)) {
    // Fetch the user's favourites from the database
    $result = $db->query("SELECT * FROM foods WHERE id IN (SELECT foods_ID FROM wishlists WHERE users_ID = $users_id)");

    // Set the paths and cids for the logo and food images
    $logo_path = '../../assets/img/logo.png';
    $logo_cid = 'logo_image';
    $mail->AddEmbeddedImage($logo_path, $logo_cid);

    // Build the HTML content for the email
    $email_html = "<img src='cid:" . $logo_cid . "' alt='Los Pollos Hermanos' style='max-width: 200px; margin-bottom: 20px;'>";
    $email_html .= "<h1>This is Your Favourites List, $name!</h1>";

    $i = 0;
    while ($row = $result->fetch_assoc()) {
        // Add the food image as an attachment and create the CID
        $food_path = '../../assets/img/menu/' . $row['image'];
        $food_cid = 'food_image' . $i;
        //UNFORTUNATELY I TESTED WITH GMAIL AND GMAIL DOESN'T SUPPORT THE WEBP FORMAT FOR THE IMAGES AND DISPLAYS A BLACK BACKGROUND AROUND SMALL PROBLEM
        $mail->AddEmbeddedImage($food_path, $food_cid);

        // Build the HTML content for the food item
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

    // Send the email using the send_email function
    send_email($email, "Your Favourites Food List!", $email_html, "Favourites List!", $mail);

    // Redirect the user to the done page
    header('Location: ../../done.php?fill=Your favorites have been sent!&details=Check your email!');
} else {
    // If the required user information is not available, display an error message
    echo "ALARM 405: ACTIVE PROTECTION IP SERVER";
}