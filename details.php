<?php
/**
 * Details
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-04-25
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/navbar.php';
require_once __DIR__ . '/foodslider.php';

// Check if id is set in the GET parameters
if(isset($_GET['id'])){
    // Initialize the database connection
    $db = new dbData();

    $users_id;
    //This is fundamental to avoid errors in the query. PS: the id 0 is impossible to obtain for an USER
    if(empty($_SESSION['ID'])){
        $users_id = 0;
    }else{
        $users_id = $_SESSION['ID'];
    }

    // Fetch the details of the food item from the database, also fetch if the foods with users_id is in the wishlist table
    $selectedId = $db->quote($_GET['id']);
    $query = "SELECT f.*, CASE WHEN w.users_ID IS NOT NULL THEN 1 ELSE 0 END AS in_wishlist FROM foods f LEFT JOIN wishlists w ON f.id = w.foods_ID AND w.users_ID = $users_id WHERE f.id = $selectedId";

    $result = $db->query($query);

    // Check if the query was successful and if there are any results
    if($result && $result->num_rows > 0) {
        // Fetch the details as an associative array
        $details = $result->fetch_assoc();
        $details['allergies'] = json_decode($details['allergies']);

        // Render the details page with the fetched data
        echo $twig->render('details.html', ['navbar_data' => $navbar_data, 'details'=> $details]);
    } else {
        // If no results were found, render the 404 page
        echo $twig->render('404.html');
    }
} else {
    // If id is not set in the GET parameters, render the 404 page
    echo $twig->render('404.html');
}
?>
