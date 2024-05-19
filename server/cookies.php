<?php
/**
 * @file cookies.php
 * @brief Handles the management of cookies.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-04-29
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

class Cookies
{
    /**
     * @brief Checks if cookies are allowed.
     * @return bool True if cookies are allowed, false otherwise.
     */
    public static function cookies_allowed()
    {
        // Check if the "cookieAllow" cookie is set
        return isset($_COOKIE['cookieAllow']) && $_COOKIE['cookieAllow'] === 'true';
    }

    /**
     * @brief Checks if the user is authenticated in cookies.
     * @return bool True if the user is authenticated, false otherwise.
     */
    public static function is_authenticated()
    {
        // Check if the email and password are present in the cookies
        return (isset($_COOKIE['email']) && isset($_COOKIE['password']));
    }

    /**
     * @brief Saves data to the cookies.
     * @param array $data An associative array with keys as the cookie names and values as the corresponding values.
     */
    public static function save_data(array $data)
    {
        // Check if cookies are allowed
        if (!self::cookies_allowed()) {
            return;
        }

        // Set the cookie expiration time to 6 months from now
        $expiration = time() + (6 * 30 * 24 * 60 * 60); // 6 months

        // Save the data to cookies
        foreach ($data as $key => $value) {
            setcookie($key, $value, $expiration, '/');
        }
    }

    /**
     * @brief Destroys cookies and removes the data.
     */
    public static function destroy_cookies()
    {
        $cookies = $_COOKIE;

        // Delete every single cookie except the cookieAllow
        foreach ($cookies as $name => $value) {
            if($name != 'cookieAllow'){
                setcookie($name, '', time() - 3600, '/');
            }
        }
    }
}