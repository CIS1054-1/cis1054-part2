<?php
/**
 * @file complaint_form.php
 * @brief Handles the submission of a complaint form.
 * @author Gioele Giunta, Carlos Alvarez
 * @version 1.0
 * @date 2023-05-14
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require_once __DIR__ . '/../autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $users_id = $_SESSION['ID']; 
    $subject = $db->quote($_POST['subject']);
    $description = $db->quote($_POST['description']);

    if (!empty($users_id) && !empty($subject) && !empty($description)) {
        // Server-side check
        if (strlen($subject) >= 8 && strlen($subject) <= 25 && strlen($description) >= 25 && strlen($description) <= 200) {
            $insert_query = "INSERT INTO complaints (users_id, subject, description) VALUES ($users_id, '$subject', '$description' )";
            $db->query($insert_query);
            header('Location: ../../done.php?fill=Your complaint has been saved!&details=We will reply to you shortly!');
            exit;
        } else {
            echo "Error in loaded Data!";
        }
    } else {
        echo "ALARM 405: ACTIVE PROTECTION IP SERVER";
    }
} else {
    // If the request method is not POST, return an error response
    echo "ALARM 405: ACTIVE PROTECION IP SERVED";
}
?>