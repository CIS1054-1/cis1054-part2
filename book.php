<?php
// Recupera la data/ora dalla richiesta GET
$datetime = $_GET['datetime'];

// Query per recuperare le prenotazioni per la data/ora specificata
$reservations = $db->query("SELECT * FROM reservations WHERE time = '$datetime'");

// Passa i dati al template Twig
echo $twig->render('book.html', ['reservations' => $reservations]);
?>