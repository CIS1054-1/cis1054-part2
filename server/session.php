<?php
/**
 * session
 *
 * @author Gioele Giunta
 * @version 1.2
 * @since 2023-04-29
 * @info Me (Gioele) am going to use the SNAKE_CASE for the php files
 */

class Session
{
    /**
     * Initializes the session if it hasn't been started already.
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            //Check if the cookies are loaded
            if($cookies->is_authenticated()){
                //Catch all the elements from the cookies and put inside session
                $_SESSION['ID'] = $_COOKIE['ID'];
                $_SESSION['name'] = $_COOKIE['name'];
                $_SESSION['surname'] = $_COOKIE['surname'];
                $_SESSION['email'] = $_COOKIE['email'];
                $_SESSION['password'] = $_COOKIE['password'];
            }
        }
    }

    /**
     * Checks if the user is authenticated in session.
     *
     * @return bool True if the user is authenticated, false otherwise.
     */
    public static function is_authenticated()
    {
        // Check if the email and password are present in the session
        return (isset($_SESSION['email']) && isset($_SESSION['password']));
    }

    /**
     * Saves data to the session.
     *
     * @param array $data An associative array with keys as the session variable names and values as the corresponding values.
     */
    public static function save_data(array $data)
    {
        // Ensure the session is started
        self::start();

        // Save the data to the session
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
}