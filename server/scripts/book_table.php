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
    $table_number = $_POST['table-number'];
    $datetime = $_POST['date'] . ' ' . $_POST['time'];
    $user_id = $_SESSION['ID'];

    $reservation_query = "SELECT * FROM reservations WHERE table_number = $table_number AND ('$datetime' BETWEEN time AND DATE_ADD(time, INTERVAL book_duration HOUR))'";
    $reservation_result = $db->query($reservation_query);

    if (mysqli_num_rows($reservation_result) == 0) {
            // The table is available, proceed with the booking
            $insert_query = "INSERT INTO reservations (table_number, time, users_ID) VALUES ($table_number, '$datetime', $user_id)";
            $db->query($insert_query);
    
            // Redirect the user to the confirmation page or the home page
            header('Location: confirmation.php');
            exit;
    } else {
        // The table is not available, show an error message
        echo "Sorry, the selected table is no longer available for the chosen date/time.";
    }
} else {
    // If the request method is not POST, return an error response
    $arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}
?>