<?php
/**
 * Complaint form
 *
 * @author Carlos Alvarez
 * @version 1.0
 * @since 2023-05-14
 */
require_once __DIR__ . '/../autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the data from the form
    $complaint_id = $db->quote($_SESSION['ID']); 
    $subject = $db->quote($_POST['subject']);
    $email = $db->quote($_POST['email']);
    $name = $db->quote($_SESSION['name']);
    $description = $db->quote($_SESSION['description']);
    
    if(!empty($complaint_id) && !empty($subject) && !empty($email) && !empty($name) && !empty($description)){

        $insert_query = "INSERT INTO complaints (ID, subject, email, name, description) VALUES ($complaint_id, $subject, $email, $name, $description )";
        $db->query($insert_query);
        header('Location: confirmation.php');
        exit;
    }else{
        echo "ALARM 405: ACTIVE PROTECTION IP SERVER";
    }
    
} else {
    // If the request method is not POST, return an error response
    echo "ALARM 405: ACTIVE PROTECION IP SERVED";
}
?>