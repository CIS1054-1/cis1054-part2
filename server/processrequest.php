<?php
/**
 * This function processes a client request, reading the submitted parameters (username, firstname, surname, age, and bio)
 * and storing them in session variables.
 * 
 * It supports both GET and POST requests.
 *
 * @author Gioele Giunta
 * @version 1.0
 * @since 2023-04-12
 */
session_start();

    // Determine the request method
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    if ($requestMethod === 'GET') {
        if(!empty($_GET['username']) && !empty($_GET['firstname']) && !empty($_GET['surname']) && !empty($_GET['age']) && !empty($_GET['bio'])){
            //In case of GET method return a page
            $_SESSION['username'] = $_GET['username'];
            $_SESSION['firstname'] = $_GET['firstname'];
            $_SESSION['surname'] = $_GET['surname'];
            $_SESSION['age'] = $_GET['age'];
            $_SESSION['bio'] = $_GET['bio'];
            header('location:../saved.html');
        }else{
            header('location:../404.html');
        }
    } elseif($requestMethod === 'POST') {
        if(!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['surname']) && !empty($_POST['age']) && !empty($_POST['bio'])){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['surname'] = $_POST['surname'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['bio'] = $_POST['bio'];
            //Return the status of the operation via JSON 
            $res = ['status' => "true", "message" => "Success"];
            echo json_encode($res);
        }else{
            header('location:../404.html');
        }
    } else {
        //Anti Attacker
        header('location:../404.html');
        return;
    }
?>