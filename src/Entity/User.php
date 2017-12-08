<?php

namespace Entity;

/**
 * Description of User
 *
 * @author johandelacasiniere
 */
class User {
    /**
     * Id of User
     * @var int 
     */
    private $idUsers;
    
    /**
     * username of User
     * @var string
     */
    private $username;
    
    /**
     * Firstname of User
     * @var string
     */
    private $firstname;
        
    /**
     * Lastname of User
     * @var string
     */
    private $lastname;
        
    /**
     * Email of User
     * @var string
     */
    private $email;
        
    /**
     * Password of User
     * @var string
     */
    private $password;
    
    /**
     * Role of User
     * @var string
     */
    private $role;
    
    /**
     * Salt for password
     * @var string
     */
    private $salt;
    
    public function getIdUsers() {
        return $this->idUsers;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setIdUsers($idUsers) {
        $this->idUsers = $idUsers;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }


    
    
}
