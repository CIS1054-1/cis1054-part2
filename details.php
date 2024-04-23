<?php
    require_once __DIR__ .'database.php';

    $details = [
        [
            'id' => 1,
            'name' => 'Pizza Margharita',
            'image'=> 'pizza.jpg',
            'Category'=> 'Pizza',
            'price' => 10.99,
            'timeOfPreparation' => 10,
        ],
        [
            'id' => 2,
            'name' => 'Chicken Burger',
            'image'=> 'burger.jpg',
            'Category'=> 'Burgers',
            'price' => 13.99,
            'timeOfPreparation' => 16,
        ],
        [
            'id' => 3,
            'name' => 'Maki',
            'image'=> 'sushi.jpg',
            'Category'=> 'Sushi',
            'price' => 7.45,
            'timeOfPreparation' => 15,
        ],
        [
            'id' => 4,
            'name' => 'Paella Valenciana',
            'image'=> 'spanish.jpg',
            'Category'=> 'Spanish',
            'price' => 15.69,
            'timeOfPreparation' => 30,
        ]
    ]




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
            $products = array()
             echo $twig->render('item.html', ['item' => $items, 'categories' => $categories, 'selectedCategories' => $selectedCategories, 'details'=> $details]);
         }else{
             echo $twig->render('404.html');
        }
    }  else{
        echo $twig->render('404.html');
    }
*/

?>
