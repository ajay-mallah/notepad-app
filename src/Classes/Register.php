<?php 
namespace APP\Classes;

use App\Classes\UserDB;

/**
 * Handles user registration
 */
class Register extends UserDB
{
    /**
     * @var array $userData;
     *    Stores user's details fetched from form submission.
     */
    private $userData = [];

    /**
     * Initializes class variables.
     * 
     *   @param array $userData
     *     Stores user's details fetched from form submission
     */
    public function __construct(array $userData)
    {
        $this->userData = $userData;
        print_r($this->userData);
        parent::__construct();
    }

    /**
     * Checks if user is registered or not.
     * Add new user to the database.
     * 
     *   @return void
     *     Returns encoded json data.
     */
    public function registerUser() {
        if (!$this->selectUser($this->userData['email'])) {
            $this->insertUserData($this->userData['fullName'], $this->userData['password'], $this->userData['email']);
            return json_encode(["status" => "success", "message" => "user registered successfully"]);
        }
        return json_encode(["status" => "failed", "message" => "user already exists"]);
    }

    /**
     * Returns user id.
     * 
     *   @param string $email
     *     Email address.
     * 
     *   @return int
     *     return user id.
     */
    public function getUserID(string $email) {
        $result = $this->selectUserData($email);
        return $result['id'];
    }
}