<?php
/**
* NavBar the objective of the script is to detect the url and understand with page is active
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-12
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
require_once __DIR__ . '/server/autoload.php';

    $current_url = $_SERVER['REQUEST_URI'];
    
    $url_parts = explode('/', $current_url);
    $page_name = end($url_parts);
    
    // Remove any query parameters from the page name
    $page_name = strtok($page_name, '?');

    //MockUp 
    $navbar_elements = [
        [
            'id' => 0,
            'href' => 'index',
            'name' => 'Home',
            'signed' => false,
        ],
        [
            'id' => 1,
            'href' => 'about',
            'name' => 'About us',
            'signed' => false,
        ],
        [
            'id' => 2,
            'href' => 'signin',
            'name' => 'Sign In',
            'signed' => false,
        ],
        [
            'id' => 3,
            'href' => 'favourites',
            'name' => 'Your Favourites',
            'signed' => true
        ],
        [
            'id' => 4,
            'href' => 'book',
            'name' => 'Book a Table',
            'signed' => true
        ],
        [
            'id' => 5,
            'href' => 'complaints',
            'name' => 'Help',
            'signed' => true
        ],
        [
            'id' => 6,
            'href' => 'logout',
            'name' => 'Log Out',
            'signed' => true
        ],
    ];

    $user_acronym = "";
    if($session->is_authenticated()){
        $user_acronym = strtoupper(substr($_SESSION['name'], 0, 1)) . strtoupper(substr($_SESSION['surname'], 0, 1));
    }
    
    $navbar_data = [
        'navbar_elements' => $navbar_elements,
        'page_name' => $page_name,
        'is_authenticated' => $session->is_authenticated(),
        'user_acronym' => $user_acronym
        ];
    



?>