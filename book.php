<?php
/**
 * Book a table
 *
 * @author Your Name
 * @version 1.0
 * @since 2023-05-14
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/navbar.php';


// Get the datetime parameter from the request
if(empty($_GET['datetime'])){
    $datetime = date('Y-m-d H:i:s');
}else{
    $datetime = $db->quote($_GET['datetime']);
}

// Query the reservations table for the given datetime
$reservations = $db->query("SELECT * FROM reservations WHERE ('$datetime' BETWEEN time AND DATE_ADD(time, INTERVAL book_duration HOUR))");


// Render the book.html template and pass the reservations data
echo $twig->render('book.html', [
    'navbar_data' => $navbar_data,
    'reservations' => $reservations,
    'datetime' => $datetime,
    'is_authenticated' => $session->is_authenticated()
]);
?>