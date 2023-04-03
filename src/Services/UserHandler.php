<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handles user authentication and validation.
 * Fetches user data from the database.
 * Updates user data to the database.
 */
class UserHandler 
{
    /**
     * @var Request $request
     *   Instance of Request.
     */
    private $request = null;

    /**
     * @var EntityManagerInterface $em
     *   Instance of EntityManagerInterface.
     */
    private $em = null;

    /**
     * Initializes the class variables.
     * 
     *   @param Request $request
     *     Instance of Request.
     *   
     *   @param EntityManagerInterface $em
     *     Instance of EntityManagerInterface.
     */
    public function __construct(Request $request, EntityManagerInterface $em) {
        $this->request = $request;
        $this->em = $em;
    }

    /**
     * Validates user credentials
     */
    public function register() {
        $result["status"] = "success";
        if (!$this->existsUser()) {
            try {
                $user = new User();
                $user->setFullname($this->request->request->get('fullName'));
                $user->setEmail($this->request->request->get('email'));

                // Encrypting the password
                $options = ['cost' => 12];
                // Encrypting password.
                $password = password_hash($this->request->request->get('password'), PASSWORD_BCRYPT, $options);
                $user->setPassword($password);

                $this->em->persist($user);
                $this->em->flush();

                $result["message"] = "User created successfully";
            }
            catch (\Exception $e) {
                $result["status"] = "exception";
                $result["message"] = $e->getMessage();
            }
        }
        else {
            $result["status"] = "failed";
            $result["message"] = "user already exists with given email address";
        }
        return $result;
    }

    /**
     * Checks if user already exists or not
     * 
     *   @return boolean
     *     Return true if user already exists
     */
    private function existsUser(){
        $user = $this->em->getRepository(User::class)->findONeBy(['email' => $this->request->request->get('email')]);
        return $user ? TRUE : FALSE;
    }

    /**
     * Validates user credentials.
     * 
     *   @return array
     *     Return array of status and error messages.
     */
    public function login() {
        $result["status"] = "failed";
        if (!$this->existsUser()) {
            $result["message"] = "Given user does not exist";
        }
        else if (!$this->validatePassword()) {
            $result["message"] = "Invalid password";
        }
        else {
            $result["status"] = "success";
            $result["message"] = "Login successful";
        }
        return $result;
    }
    
    /**
     * Validates user's password
     * 
     *   @return boolean
     *     Return true if password is valid
     */
    private function validatePassword() {
        $user = $this->em->getRepository(User::class)->findOneByEmail(['email' => $this->request->request->get('email')]);
        return password_verify($this->request->request->get('password'), $user->getPassword());
    }
}