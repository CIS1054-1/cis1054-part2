<?php
/**
 * @file add_wishlist.php
 * @brief Handles the addition of an item to the user's wishlist.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-05-07
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require_once __DIR__ . '/../autoload.php';

// Set the Content-Type header to indicate that the response is in JSON format
header('Content-Type: application/json');

// Check if the request method is POST and there is an user_ID set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the request body as JSON
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    // Escape the food id to prevent SQL injection
    $foods_id = $db->quote($input['foods_id']);
    $users_id;
    if(empty($_SESSION['ID'])){
        //Return error to ask to go to login page
        $arr = ["status" => "false", "message" => "Login"];
        echo json_encode($arr);
        die;
    }else{
        $users_id = $_SESSION['ID'];
    }

    // Check if foods_id is not empty
    if (!empty($foods_id)) {
        $foods_query = "INSERT INTO wishlists (users_ID, foods_ID) VALUES ($users_id, $foods_id)";
        $foods_result = $db->query($foods_query);
        $arr = ["status" => "true", "message" => "Success"];
        echo json_encode($arr);
    } else {
        // If the foods_id is empty, return an error response
        $arr = ["status" => "false", "message" => "ALARM 406: ACTIVE PROTECTION, IP SAVED"];
        echo json_encode($arr);
    }
} else {
    // If the request method is not POST, return an error response
    $arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}