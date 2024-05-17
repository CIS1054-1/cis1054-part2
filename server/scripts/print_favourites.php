<?php
/**
 * print_favourites
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-05-17
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

require_once __DIR__ . '/../autoload.php';

// Set the Content-Type header to indicate that the response is in JSON format
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the request body as JSON
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    // Escape the email and password values to prevent SQL injection
    $email = $db->quote($input['email']);
    $password = $db->quote($input['password']);

    // Check if email and password are not empty
    if (!empty($email) && !empty($password)) {
        //Server side check
        if (preg_match('/^(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-zA-Z])./', $password) && preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            // Check if the email exists in the users table
            $email_query = "SELECT * FROM users WHERE email='$email'";
            $email_result = $db->query($email_query);
            if (mysqli_num_rows($email_result) == 0) {
                // If the email does not exist, return an error response
                $arr = ["status" => "wrong", "message" => "Oops! Wrong email!"];
                echo json_encode($arr);
            } else {
                // Check if the password is correct
                $user_row = mysqli_fetch_assoc($email_result);
                if ("'" . $user_row['password'] . "'" == hash_crypt($password)) {
                    // If the email and password are correct, set the session variables using methods
                    $session->save_data($user_row);
                    $cookies->save_data($user_row);
                    $arr = ["status" => "true", "message" => "Success"];
                    echo json_encode($arr);
                } else {
                    // If the password is incorrect, return an error response
                    $arr = ["status" => "wrong", "message" => "Oops! Wrong password!"];
                    echo json_encode($arr);
                }
            }
        } else {
            //Email or password doesn't respect critera, return an error responde
            $arr = ["status" => "false", "message" => "Please check your email and password!"];
            echo json_encode($arr);
        }
    } else {
        // If the email or password is empty, return an error response
        $arr = ["status" => "false", "message" => "ALARM 406: ACTIVE PROTECTION, IP SAVED"];
        echo json_encode($arr);
    }
} else {
    // If the request method is not POST, return an error response
    $arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}