<?php
/**
* session
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
// Start the session
session_start();

// Function to check if the user is authenticated
function is_authenticated() {
    // Check if the email, and password are present in the session
    return (isset($_SESSION['email']) && isset($_SESSION['password']));
}
?>