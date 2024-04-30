<?php
/**
 * register_us
 *
 * This script handles the user registration process.
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-04-29
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

require_once __DIR__ . '../autoload.php';

// Set the Content-Type header to indicate that the response is in JSON format
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the request body as JSON
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    // Escape the user input values to prevent SQL injection
    $name = $db->quote($input['name']);
    $surname = $db->quote($input['surname']);
    $email = $db->quote($input['email']);
    $password = $db->quote($input['password']);

    // Check if all required fields are not empty
    if (!empty($name) && !empty($surname) && !empty($email) && !empty($password)) {


            $signup_query = "INSERT INTO users (name, surname, email, password) VALUES($name, $surname, $email, " . hash_crypt($password) . ")";

        // Check if the email is already registered
        $email_query = "SELECT ID FROM users WHERE email=$email";
        $email_result = $db->query($email_query);
        if (mysqli_num_rows($email_result) == 0) {
            // Register the user
            $signup_result = $db->query($signup_query);
            if ($signup_result) {
                // Verify the user's credentials again
                $password_query = "SELECT * FROM users WHERE email = $email AND password = " . hash_crypt($password) . "";
                $password_result = $db->query($password_query);
                if (mysqli_num_rows($password_result) == 0) {
                    // If the credentials are incorrect, return an error response
                    $arr = ["status" => "false", "message" => "Error 404, retry in a few minutes :("];
                    echo json_encode($arr);
                } else {
                    $user_row = mysqli_fetch_array($password_result);
                    // If the credentials are correct, set the session variables using methods
                    $session->save_data($user_row);
                    $cookies->save_data($user_row);
                    $arr = ["status" => "true", "message" => "Success"];
                    echo json_encode($arr);
                }
            } else {
                // If the user registration fails, return an error response
                $arr = ["status" => "false", "message" => "Error 404, retry in a few minutes :("];
                echo json_encode($arr);
            }

        } else {
                // If the email is already registered, return an error response
                $arr = ["status" => "false", "message" => "Email in use: Try logging in"];
                echo json_encode($arr);
        }
    } else {
        // If any required field is empty, return an error response
        $arr = ["status" => "false", "message" => "ALARM 406: ACTIVE PROTECTION, IP SAVED"];
        echo json_encode($arr);
    }
} else {
    // If the request method is not POST, return an error response
    $arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}
?>