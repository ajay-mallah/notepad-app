<?php
namespace App\Classes;
use App\Classes\EnvHandler;

/**
 * Fetches credentials from environment variables and makes connection with 
 * Database 
 */
class DBConnector extends EnvHandler
{
    /**
     * Connects DataBase 
     * 
     *  @return mixed
     *    Returns $pdo object if database connected successfully.
     *    Prints error message if there is issue while database connection. 
     */
    protected function connectDB() {
        // Loading environment variables.
        $this->loadEnv();

        $dsn = "mysql:host=$this->server;dbname=$this->database;charset=UTF8";
        try {
            $pdo = new \PDO($dsn, $this->username, $this->password);
            if($pdo) {
                return $pdo;
            }
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}