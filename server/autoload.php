<?php
/**
 * @file autoload.php
 * @brief Handles the autoloading of classes and the initialization of the database connection.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-04-29
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

require_once __DIR__ . '/utilis.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/cookies.php';
$cookies = new Cookies();
require_once __DIR__ . '/session.php';
$session = new Session();
$session->start();

// Initialize the database connection
$db = new dbData();
$initialise_connection = json_decode($db->connect(), true);

// Check if the database connection was successful
if (!$initialise_connection['status']) {   
    // If the connection failed, render the 'connerror.html' template and exit the script
    echo $twig->render('connerror.html');
    exit;
    // The error message can be found in $initialise_connection['message']
}