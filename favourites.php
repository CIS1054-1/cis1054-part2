<?php
/**
 * Favourites
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-05-07
 * @info Me (Gioele) am going to use the SNAKE CASE for the php files
 */

    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/navbar.php';
    require_once __DIR__ . '/foodslider.php';

    $users_id;
    //This is fundamental to avoid unauthorized access to the page
    if(empty($_SESSION['ID'])){
        echo $twig->render('404.html');
    }else{
        $users_id = $_SESSION['ID'];
    }

    //Fetch all the elements in the foods table that are linked by wishlist, where users_ID is equal to current user id
    $result = $db-> query("SELECT * FROM foods WHERE id IN (SELECT foods_ID FROM wishlists WHERE users_ID = $users_id)");

    echo $twig->render('favourites.html', ['navbar_data' => $navbar_data, 'favourites' => $result]);

?>