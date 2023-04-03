<?php
namespace App\Classes;

use App\Classes\QueryExecuter;

/**
 * Performs Data insertion, selection and updation for User table.
 */
class UserDB extends DBConnector
{
    /**
     *  @var $pdo
     *     Instance of PDO class;
     */
    protected $pdo;

    /**
     * Extending QueryExecuter trait.
     */
    use QueryExecuter;

    
    /** 
     * Initializes $pdo (instance of PDO) when instance of the class is created.
     */
    public function __construct() {
        $this->pdo = $this->connectDB();
    }
    
    /**
     * Inserts user data into the user table.
     * 
     *  @param string $fullName
     *     User's full name.
     *     
     *  @param string $pwd
     *     Password of the user.
     *     
     *  @param string $email
     *     Email address of the user.
     */
    protected function insertUserData(string $fullName, string $pwd, string $email) {
        $options = ['cost' => 12];
        // Encrypting password.
        $pwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
        $query = "INSERT INTO user (fullname, password, email) VALUES (?, ?, ?)";
        $data_array = [$fullName, $pwd, $email];
        $this->save($query, $data_array, $this->pdo);
    }

    /**
     * Selects user's id from user table.
     * 
     *  @param string $email 
     *    email address.
     * 
     *  @return array
     *   Returns user.
     */
    protected function selectUser(string $email) {
        $query = "SELECT email FROM user WHERE email = ?";
        $data_array = [$email];
        return $this->select($query, $data_array, $this->pdo);
    }

    /**
     * Selects user's email from user table.
     * 
     *  @param string $email 
     *    User's email address.
     * 
     *  @return array
     *   Returns user info.
     */
    protected function selectUserData(string $email) {
        $query = "SELECT id, email, fullName FROM user WHERE email=?";
        $data_array = [$email];
        return $this->select($query, $data_array, $this->pdo);
    }
    
    /**
     * Selects user's password from user table.
     * 
     *  @param string $email 
     *    User's email address.
     * 
     *  @return array
     *   Returns user's encrypted password.
     */
    protected function selectUserPassword(string $email) {
        $query = "SELECT password FROM user WHERE email = ?";
        $data_array = [$email];
        return $this->select($query, $data_array, $this->pdo);
    }
}