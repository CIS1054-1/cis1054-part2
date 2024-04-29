<?php
/**
* log_user
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
require_once __DIR__.'../autoload.php';

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    $email = mysqli_real_escape_string($conn, $input['email']);
    $password = mysqli_real_escape_string($conn, $input['password']);

    
    if (!empty($email) && !empty($password)) {


        //Check EMAIL
        $email_query = "SELECT id FROM users WHERE email='$email'";
        $email_result = mysqli_query($conn, $email_query);
        if (mysqli_num_rows($email_result) == 0) {
            $arr = ["status" => "wrong", "message" => "Oops! Wrong email!"];
    		echo json_encode($arr);
        } else {
            //Check PASSWORD
            $password_query = "SELECT * FROM users WHERE email = '$email' AND password = " . hash_crypt($password) . "";

            $password_result = mysqli_query($conn, $password_query);
            if (mysqli_num_rows($password_result) == 0) {
                 $arr = ["status" => "wrong", "message" => "Oops! Wrong password!"];
    			 echo json_encode($arr);
            } else {
                $user_row = mysqli_fetch_array($password_result);
                $tmp_id = hash_crypt($user_row['ID']);
                $users_sessions_zero = mysqli_query($conn, "UPDATE users_sessions SET session_id='0' WHERE user_id = $tmp_id");
                if (mysqli_affected_rows($conn) > 0) {
                    $users_sessions_set = mysqli_query($conn, "UPDATE users_sessions SET session_id='" . session_id() . "' WHERE user_id = $tmp_id");
                    if (mysqli_affected_rows($conn) > 0) {
                        $_SESSION['id'] = $user_row['ID'];
                        $_SESSION['name'] = $user_row['name'];
                        $_SESSION['username'] = $user_row['username'];
                        $_SESSION['email'] = $user_row['email'];
                        $_SESSION['password'] = $user_row['password'];
                        $_SESSION['age'] = $user_row['age'];
                        $_SESSION['img_url'] = $user_row['img_url'];
                        $_SESSION['description'] = $user_row['description'];
                        $_SESSION['referral_id'] = $user_row['referral_id'];
                        if ($user_row['referral_user'] != null && $user_row['referral_user'] != "null" && $user_row['referral_user'] != undefined && $user_row['referral_user'] != 'undefined') {
                            $_SESSION['referral_user'] = $user_row['referral_user'];
                        } else {
                            $_SESSION['referral_user'] = "null";
                        }
                        $arr = ["status" => "true", "message" => "Success", "name" => $user_row['name'], "username" => $user_row['username'], "age" => $user_row['age'], "imgURL" => $user_row['img_url'], "sessionID" => session_id()];
    				 	echo json_encode($arr);
                    } else {
                     		$arr = ["status" => "false", "message" => "Error 304, retry in a few minutes :("];
    				 		echo json_encode($arr);
                    }
                }else{
                     $arr = ["status" => "false", "message" => "Error 303, retry in a few minutes :("];
    				 echo json_encode($arr);
                }
            }
        }
    }else{
        	$arr = ["status" => "false", "message" => "ALARM 406: ACTIVE PROTECTION, IP SAVED"];
    		echo json_encode($arr);
    }
}
else{
	$arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}

?>
