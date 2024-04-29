<?php
/**
* register_us
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
    $name = mysqli_real_escape_string($conn, $input['name']);
    $username = mysqli_real_escape_string($conn, $input['username']);
    $email = mysqli_real_escape_string($conn, $input['email']);
    $password = mysqli_real_escape_string($conn, $input['password']);
    $age = mysqli_real_escape_string($conn, $input['age']);
    $referral_user = mysqli_real_escape_string($conn, $input['referral_user']);

    if (!empty($name) && !empty($username) && !empty($email) && !empty($password) && !empty($age) && !empty($referral_user)) {

        $referral_id = strval(time()) + strval(rand(0, 9));

        if ($referral_user != null && $referral_user != "null") {
            $signup_query = "INSERT INTO users (name, username, email, password, age, referral_id, referral_user)
            VALUES('$name', '$username', '$email', " . hash_crypt($password) . ", '$age', $referral_id, $referral_user)";
        } else {
            $signup_query = "INSERT INTO users (name, username, email, password, age, referral_id)
            VALUES('$name', '$username', '$email', " . hash_crypt($password) . ", '$age', $referral_id)";
        }
        //Verifica username
        $username_query = "SELECT ID FROM users WHERE username='$username'";
        $username_result = mysqli_query($conn, $username_query);
        if (mysqli_num_rows($username_result) == 0) {
            //Verifica email
            $email_query = "SELECT ID FROM users WHERE email='$email'";
            $email_result = mysqli_query($conn, $email_query);
            if (mysqli_num_rows($email_result) == 0) {
                //Registrazione utente

                $signup_result = mysqli_query($conn, $signup_query);
                if ($signup_result) {
                    $password_query = "SELECT * FROM users WHERE username = '$username' AND password = " . hash_crypt($password) . "";

                    $password_result = mysqli_query($conn, $password_query);
                    if (mysqli_num_rows($password_result) == 0) {
                     	$arr = ["status" => "false", "message" => "Error 404, retry in a few minutes :("];
    				 	echo json_encode($arr);
                    } else {

                        $user_row=mysqli_fetch_array($password_result);
                        $id = $user_row['ID'];
                        $id = hash_crypt($id);
                        $register_users_session_result= mysqli_query($conn, "INSERT INTO users_sessions (user_id, session_id) VALUES($id, '" . session_id() . "')");

                        if(/*$register_cash_wallet_result && $register_network_wallet_result &&*/ $register_users_session_result){
                            $_SESSION['id'] = $user_row['ID'];
                            $_SESSION['name'] = $user_row['name'];
                            $_SESSION['username'] = $user_row['username'];
                            $_SESSION['email'] = $user_row['email'];
                            $_SESSION['password'] = $user_row['password'];
                            $_SESSION['img_url'] = $user_row['img_url'];
                            $_SESSION['description'] = $user_row['description'];
                            $_SESSION['referral_id'] = $user_row['referral_id'];
                            if($referral_user != null && $referral_user != "null"){
                                $_SESSION['referral_user'] = $user_row['referral_user'];
                            }else{
                                $_SESSION['referral_user'] = "null";
                            }
                     		$arr = ["status" => "true", "message" => "Success", "sessionID" => session_id()];
    				 		echo json_encode($arr);
                        }else{
                            $delete_result = mysqli_query($conn, "DELETE FROM users where id= $id");
                     		$arr = ["status" => "false", "message" => "Error 404, retry in a few minutes :("];
    				 		echo json_encode($arr);
                        }
                    }
                } else {
                     $arr = ["status" => "false", "message" => "Error 404, retry in a few minutes :("];
    				 echo json_encode($arr);
                }
            } else {
                $arr = ["status" => "false", "message" => "Email in use: Try logging in"];
    			echo json_encode($arr);
            }
        } else {
            $arr = ["status" => "false", "message" => "Username already taken :("];
    		echo json_encode($arr);
        }
    } else {
        	$arr = ["status" => "false", "message" => "ALARM 406: ACTIVE PROTECTION, IP SAVED"];
    		echo json_encode($arr);
    }
}else{
	$arr = ["status" => "false", "message" => "ALARM 405: ACTIVE PROTECTION, IP SAVED"];
    echo json_encode($arr);
}

?>
