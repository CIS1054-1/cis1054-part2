<?php
/**
 * @file session.php
 * @brief Manages the session handling.
 * @author Gioele Giunta
 * @version 1.2
 * @date 2023-04-29
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

class Session
{
    /**
     * @brief Initializes the session if it hasn't been started already.
     */
    public static function start()
    {
        $cookies = new Cookies();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            // Check if the user is authenticated in cookies
            if($cookies->is_authenticated()){
                // Copy the cookie data to the session
                $_SESSION['ID'] = $_COOKIE['ID'];
                $_SESSION['name'] = $_COOKIE['name'];
                $_SESSION['surname'] = $_COOKIE['surname'];
                $_SESSION['email'] = $_COOKIE['email'];
                $_SESSION['password'] = $_COOKIE['password'];
            }
        }
    }

    /**
     * @brief Checks if the user is authenticated in the session.
     * @return bool True if the user is authenticated, false otherwise.
     */
    public static function is_authenticated()
    {
        // Check if the email and password are present in the session
        return (isset($_SESSION['email']) && isset($_SESSION['password']));
    }

    /**
     * @brief Saves data to the session.
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

    /**
     * @brief Destroys the session and removes the data.
     */
    public static function destroy_session()
    {
        // Ensure the session is started
        self::start();

        // Clear the session data
        $_SESSION = array();

        // Delete the session cookies
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Destroy the session
        session_destroy();
    }
}