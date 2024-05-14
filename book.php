<?php
/**
 * Book a table
 *
 * @author Your Name
 * @version 1.0
 * @since 2023-05-14
 */

// Load necessary files
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/navbar.php';

// Get the datetime parameter from the request
$datetime = $_GET['datetime'];

// Query the reservations table for the given datetime
$reservations = $db->query("SELECT * FROM reservations WHERE ('$datetime' BETWEEN time AND DATE_ADD(time, INTERVAL book_duration HOUR))");

// Render the book.html template and pass the reservations data
echo $twig->render('book.html', [
    'navbar_data' => $navbar_data,
    'reservations' => $reservations,
    'datetime' => $datetime
]);
?>