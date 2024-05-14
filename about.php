<?php
    require_once __DIR__ ."/bootstrap.php";
    require_once __DIR__ ."/navbar.php";

    $query = "SELECT * FROM business";

    $result = $db->query($query);

    // Check if the query was successful and if there are any results
    if($result && $result->num_rows > 0) {
        // Fetch the business as an associative array
        $business = $result->fetch_assoc();

        // Render the business page with the fetched data
        echo $twig->render('about.html', ['navbar_data' => $navbar_data, 'business'=> $business]);
    } else {
        // If no results were found, render the 404 page
        echo $twig->render('404.html');
    }
