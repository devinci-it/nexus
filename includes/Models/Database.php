<?php

namespace Models;

class Database
{
    private $hostname;
    private $username;
    private $password;
    private $database;

    // Constructor with default values for database connection details
    public function __construct(
        $hostname = "10.10.10.11",
        $username = "webmaster",
        $password = "P@ssw0rd",
        $database = "vdetorre_project"


    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    // Method to establish a database connection
    public function getDbConnection()
    {
        $connection = @mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        if (!$connection) {
            // Return false on connection failure
            return false;
        }

        return $connection;
    }
}

//// Example usage with default values and checking for connection success
//$databaseConfig = new Database();
//$dbConnection = $databaseConfig->getDbConnection();
//
//if ($dbConnection !== false) {
//    // Proceed with database operations using $dbConnection
//} else {
//    // Handle the connection failure (log, display an error message, etc.)
//    echo "Failed to connect to the database.";
//}
