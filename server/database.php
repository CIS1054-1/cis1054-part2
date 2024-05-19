<?php
/**
 * @file database.php
 * @brief Provides a class for interacting with the database.
 * @author Gioele Giunta
 * @version 1.3
 * @date 2023-04-29
 * @info The author, Gioele, is going to use the Snake Case for the PHP files.
 */

class dbData {
    // The database connection
    protected static $connection;

    /**
     * @brief Connects to the database.
     * @return string A JSON-encoded array with the connection status and message.
     */
    public function connect() {
        $return = [];
        $error;

        // Try and connect to the database
        if (!isset(self::$connection)) {
            // Load configuration from the config.ini file
            $config = parse_ini_file('config.ini');

            try {
                self::$connection = new mysqli($config['server'], $config['username'], $config['password'], $config['dbname']);

                // Check if the connection was successful
                if (self::$connection->connect_error) {
                    throw new Exception("Connection failed: " . self::$connection->connect_error);
                }
            } catch (Exception $e) {
                // Handle the connection error
                self::$connection = false;
                $error = $e->getMessage();
            }
        }

        // If the connection was not successful, handle the error
        if (self::$connection === false) {
            $return = [
                'status' => false,
                'message' => $error,
            ];
        } else {
            $return = [
                'status' => true,
                'message' => $this->connectionToArray(self::$connection),
            ];
        }

        return json_encode($return);
    }

    /**
     * @brief Executes a query on the database.
     * @param string $query The query to be executed.
     * @return mixed The result of the mysqli::query() function.
     */
    public function query($query) {
        // Connect to the database
        $this->connect();

        // Execute the query
        return self::$connection->query($query);
    }

    /**
     * @brief Fetches the last error from the database.
     * @return string The database error message.
     */
    public function error() {
        $this->connect();
        return self::$connection->error;
    }

    /**
     * @brief Converts a mysqli connection object to an associative array.
     * @param mysqli $connection The mysqli connection object.
     * @return array The associative array representation of the connection.
     */
    private function connectionToArray(mysqli $connection) {
        $connectionArray = [];
        foreach ($connection as $key => $value) {
            $connectionArray[$key] = $value;
        }
        return $connectionArray;
    }

    /**
     * @brief Quotes and escapes a value for use in a database query.
     * @param string $value The value to be quoted and escaped.
     * @return string The quoted and escaped string.
     */
    public function quote($value) {
        $this->connect();
        return strval(self::$connection->real_escape_string($value));
    }
}