<?php
  class User {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // register user
    public function register($data) {
      // prepare sql
      $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

      // bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // execute
      if($this->db->execute()) {
        return true;
      }
      
      return false;
    }

    public function login($email, $password) {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;

      if(password_verify($password, $hashed_password)) {
        // return user row
        return $row;
      }

      return false;
    }

    // find user by email
    public function findUserByEmail($email) {
      $this->db->query("SELECT * FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

      // data
      $row = $this->db->single();

      // check row if exist
      if($this->db->rowCount() > 0) {
        // email is already in used.
        return true;
      }

      // email is valid
      return false;
    }
  }