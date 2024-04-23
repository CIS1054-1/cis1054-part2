<?php
// Start the session
session_start();

// Function to check if the user is authenticated
function is_authenticated() {
    // Check if the username, email, and password are present in the session
    return isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password']);
}
?>