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
        ],
        [
            'id' => 1,
            'href' => 'about',
            'name' => 'About us',
        ],
        [
            'id' => 2,
            'href' => 'signin',
            'name' => 'Sign In',
        ]
    ];

    $navbar_data = [
        'navbar_elements' => $navbar_elements,
        'page_name' => $page_name,
        'is_authenticated' => is_authenticated()
        ];
    



?>