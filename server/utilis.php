<?php
/**
 * @file utils.php
 * @brief Provides utility functions.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2023-04-29
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

/**
 * @brief Cleans and escapes input data for use in a database query.
 * @param object $db The database object to use for quoting.
 * @param mixed $data The input data to be cleaned, either a string or an array.
 * @return string The cleaned and escaped input data.
 */
function clean_input($db, $data) {
    // Check if data is an array
    if (is_array($data)) {
        // If it is, clean every member of the array
        array_walk_recursive($data, function(&$value) use ($db) {
            $value = trim($db->quote($value));
        });
        // Return the cleaned array as JSON
        return json_encode($data);
    } else {
        // If it is a string, clean it
        return trim($db->quote($value));
    }
}

/**
 * @brief Hashes a string using a combination of SHA-256, SHA-384, and MD5.
 * @param string $string The string to be hashed.
 * @return string The hashed string.
 */
function hash_crypt($string) {
    $string = "'" . $string . "'";
    return "'" . hash('sha384', hash('sha256', md5($string))) . "'";
}