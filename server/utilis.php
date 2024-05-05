<?php
/**
* utilis
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/

function clean_input($db, $data) {
    // Check if data is an array
    if (is_array($data)) {
        // If it is clean every member of the array
        array_walk_recursive($data, function(&$value) {
            $value = trim($db->quote($value));
        });
        // Return cleaned JSON
        return json_encode($data);
    } else {
        // If it is a string clean it
        return trim($db->quote($value));
    }
}


function hash_crypt($string){
    return "'" . hash('sha384', hash('sha256', md5($string))) . "'";
}

  ?>