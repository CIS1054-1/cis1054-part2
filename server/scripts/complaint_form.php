<?php
/**
 * Complaint form
 *
 * @author Carlos Alvarez, Gioele Giunta
 * @version 1.0
 * @since 2023-05-14
 */
require_once __DIR__ . '/../autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the data from the form
    $users_id = $_SESSION['ID']; 
    $subject = $db->quote($_POST['subject']);
    $description = $db->quote($_POST['description']);
    
    if(!empty($users_id) && !empty($subject) && !empty($description)){
        //Server side check
        if(strlen($subject) >= 8 && strlen($subject) <= 25 && strlen($description) >= 30 && strlen($description) <= 200){
            $insert_query = "INSERT INTO complaints (users_id, subject, description) VALUES ($users_id, '$subject', '$description' )";
            $db->query($insert_query);
            header('Location: ../../done.php?fill=complaint');
            exit;
        }else{
            echo "Error in loaded Data!";
        }

    }else{
        echo "ALARM 405: ACTIVE PROTECTION IP SERVER";
    }
    
} else {
    // If the request method is not POST, return an error response
    echo "ALARM 405: ACTIVE PROTECION IP SERVED";
}
?>