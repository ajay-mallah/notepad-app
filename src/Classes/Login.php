<?php 
namespace APP\Classes;

use App\Classes\UserDB;

/**
 * Handles user registration
 */
class Login extends UserDB
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
     * Checks if user is exists or not.
     * validates user
     * Saves user's session.
     * 
     *   @return void
     *     Returns encoded json data.
     */
    public function loginUser() {
        if (!$this->selectUser($this->userData['email'])) {
            return json_encode(["status" => "failed", "message" => "user does not exists"]);
        }
        else if (!$this->validPassword($this->userData['password'])) {
            return json_encode(["status" => "failed", "message" => "invalid password."]);
        }

        // Saving user's session.
        session_start();
        $_SESSION['user'] = base64_encode($this->userData['email']);
        session_write_close();

        return json_encode(["status" => "success", "message" => "Logged in successfully."]);
    }
    
    /**
     * Matches password
     *   
     *   @return boolean
     *     Return true if password matches.
     */
    private function validPassword() {
        $password = $this->selectUserPassword($this->userData['email']);
        return password_verify($this->userData['password'], $password['password']);
    }
}