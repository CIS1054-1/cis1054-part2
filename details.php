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

    //MockUp
    $details = 
        [
            'id' => 1,
            'name' => 'Pizza Margharita',
            'image'=> 'senior_chicken.png',
            'ingredients' => 'Pizza with tomato souce, mozzarella fiordilatte & basilic powder',
            'category' => 'Pizza',
            'allergies' => ['Nuts', 'Milk'],    
            'price' => 10.99,
            'timeOfPreparation' => 10,
        ];
    
        echo $twig->render('details.html', ['navbar_data' => $navbar_data, 'details'=> $details]);

    /*
    if(isset($_GET['id'])){
    $db = new Db();
    $selectedCategories = $db-> quote($_GET['id']);
    $selectedCategories = json_decode($selectedCategories);
    $result = $db-> select("SELECT i.*,c.name as type FROM item i inner join category c on i.type=c.id WHERE i.id=". $selectedCategories);
    
        
    if(count($result) > 0){
        $details = [
            'id'                => $result[0]['id'],
            'category'          => $result[0]['category'],
            'image'             => $result[0]['image'],
            'name'              => $result[0]['name'],
            'ingredients'       => $result[0]['ingredients'],
            'price'             => $result[0]['price'],
            'bio'               => $result[0]['bio'],
            'allergies'         => $result[0]['allergies'],
            'timeOfPreparation' => $result[0]['time'],
        ];
             echo $twig->render('details.html', ['navbar_data' => $navbar_data, 'details'=> $details]);
         }else{
             echo $twig->render('404.html');
        }
    }  else{
        echo $twig->render('404.html');
    }
*/

?>
