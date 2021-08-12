<?php

class User{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Register Function
    public function register($data){
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":email", $data['email']);
        $this->db->bind(":password", $data['password']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Login Function
    public function login($email, $password){
        $this->db->query("SELECT * FROM users WHERE email= :email ");
        $this->db->bind(':email', $email);

        $row = $this->db->singleSet();

        $hashedPassword = $row->password;

        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }


    // Find User by Email
    public function findUserByEmail($email){
        $this->db->query("SELECT * FROM users WHERE email= :email ");
        $this->db->bind(':email', $email);
        $row = $this->db->singleSet();

        if ($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    // Find User by ID
    public function findUserById($user_id){
        $this->db->query("SELECT * FROM users WHERE id= :user_id ");
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->singleSet();

        if ($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }

    }

}