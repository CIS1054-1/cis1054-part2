<?php
/**
 * @file book_table.php
 * @brief Handles the booking of a table.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-05-14
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require_once __DIR__ . '/../autoload.php';
require __DIR__ . '/../smtp.php';
require_once __DIR__ . '/send_email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $table_number = $db->quote($_POST['table-number']);
    $datetime = $db->quote($_POST['datetime']);
    $user_id = $db->quote($_SESSION['ID']);
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];

    echo $table_number;

    if ((!empty($table_number) && !empty($datetime) && !empty($user_id) && !empty($name) && !empty($email))) {
        // Server-side check
        if ($table_number > 0 && $table_number <= 10) {
            $reservation_query = "SELECT * FROM reservations WHERE table_number = $table_number AND ('$datetime' BETWEEN time AND DATE_ADD(time, INTERVAL book_duration HOUR))";
            $reservation_result = $db->query($reservation_query);

            if (mysqli_num_rows($reservation_result) == 0) {
                // The table is available, proceed with the booking
                $insert_query = "INSERT INTO reservations (table_number, time, users_ID) VALUES ($table_number, '$datetime', $user_id)";
                $db->query($insert_query);

                //Send the book details via email
                // Set the paths and cids for the logo and food images
                $logo_path = '../../assets/img/logo.png';
                $logo_cid = 'logo_image';
                $mail->AddEmbeddedImage($logo_path, $logo_cid);
                // Build the HTML content for the email
                $email_html = "<img src='cid:" . $logo_cid . "' alt='Los Pollos Hermanos' style='max-width: 200px; margin-bottom: 20px;'>";
                $email_html .= "<h1>Here is your reservation, $name!</h1>";



                // Build the HTML content for the food item
                $email_html .= "<div style='background-color: #f2f2f2; border-radius: 10px; padding: 20px; margin-bottom: 20px; display: flex;'>";
                $email_html .= "<div style='flex-grow: 1; width: 100%;'>";
                $email_html .= "<h2 style='font-weight: bold;'>We are waiting for you on: " . $datetime . "</h2>";
                $email_html .= "<h2 style='font-weight: bold;'>Your table is: " . $table_number . " for 4 people</h2>";
                $email_html .= "</div>";
                $email_html .= "</div>";

                send_email($email, "Your reservation!", $email_html, "Reservation!", $mail);

                // Redirect the user to the confirmation page or the home page
                header('Location: ../../done.php?fill=Your reservation has been saved!&details=Reservation Time: '. $datetime . '   Table: ' . $table_number . '!   Check your email!');
                exit;
            } else {
                // The table is not available, show an error message
                echo "Sorry, the selected table is no longer available for the chosen date/time.";
            }
        } else {
            echo "Error in loaded Data!";
        }
    } else {
        echo "ALARM 406: ACTIVE PROTECTION, IP SAVED";
    }
} else {
    // If the request method is not POST, return an error response
    echo "ALARM 405: ACTIVE PROTECTION, IP SAVED";
}
?>