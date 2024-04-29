<?php 
/**
* database
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/

 class dbData {
    // The database connection
    protected static $connection;
    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {   
        $return = [];  
        $error;   
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            // Put the configuration file outside of the document root
            $config = parse_ini_file('config.ini'); 
            try {
              self::$connection = new mysqli($config['server'],$config['username'],$config['password'],$config['dbname']);
              // Check if the connection was successful
                if (self::$connection->connect_error) {
                    throw new Exception("Connection failed: " . self::$connection->connect_error);
                }
            } catch (Exception $e) {
                // Handle the connection error
                self::$connection = false;
                
                // Log the error or handle it in another way
                $error=  $e->getMessage();

            }
        }
    
        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle errormysqli_connect_error 
            $return = [
                'status' => false,
                'message' => $error,
            ];
            return json_encode($return);
        }
        $return = [
            'status' => true,
            'message' => self::$connection,
        ];
        return json_encode($return);
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();
        
        // Query the database
        $result = $connection -> query($query);
        
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> mysqli_real_escape_string($value) . "'";
    }
}


