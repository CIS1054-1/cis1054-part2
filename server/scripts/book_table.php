<?php
/**
 * book_table
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-05-14
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */
require_once __DIR__ . '/../autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the data from the form
    $table_number = $db->quote($_POST['table-number']);
    $datetime = $db->quote($_POST['datetime']);
    $user_id = $db->quote($_SESSION['ID']);

    echo $table_number;

    if ((!empty($table_number) && !empty($datetime) && !empty($user_id))) {

        //Server side check
        if($table_number > 0 && $table_number <=10) {
            $reservation_query = "SELECT * FROM reservations WHERE table_number = $table_number AND ('$datetime' BETWEEN time AND DATE_ADD(time, INTERVAL book_duration HOUR))";
            $reservation_result = $db->query($reservation_query);
    
            if (mysqli_num_rows($reservation_result) == 0) {
                    // The table is available, proceed with the booking
                    $insert_query = "INSERT INTO reservations (table_number, time, users_ID) VALUES ($table_number, '$datetime', $user_id)";
                    $db->query($insert_query);
        
                    // Redirect the user to the confirmation page or the home page
                    header('Location: ../../done.php?fill=reservation&details=Reservation Time: '. $datetime . ' Table: ' . $table_number);
                    exit;
            } else {
                // The table is not available, show an error message
                echo "Sorry, the selected table is no longer available for the chosen date/time.";
            }
        }else{
            echo "Error in loaded Data!";
        }

    }else{
        echo "ALARM 406: ACTIVE PROTECTION, IP SAVED";
    }
} else {
    // If the request method is not POST, return an error response
    echo "ALARM 405: ACTIVE PROTECTION, IP SAVED";
}
?>