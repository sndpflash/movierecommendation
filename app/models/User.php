<?php

    class User{

        private $db;


        public function __construct(){
            $this->db = new Database;

        }

        public function checkUsername($username){
            
            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row=$this->db->single();
            
            if($this->db->rowCount() > 0) {
               
                return $row;
            }
        }

        public function verifyUser($username){

            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row=$this->db->single();
            
            if($this->db->rowCount() > 0) {
               
                return $row;
            }


        }

         // Add User / Register
         public function register($data){
            // Prepare Query
            $this->db->query('INSERT INTO users (username, email,password) VALUES (:username, :email, :password)');
      
            // Bind Values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            
         
            //Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
          }


        // Find USer BY Email
    public function findUserByEmail($email){
      $this->db->query("SELECT * FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      //Check Rows
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    public function findUserByusername($username){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
  
        $row = $this->db->single();
  
        //Check Rows
        if($this->db->rowCount() > 0){
          return true;
        } else {
          return false;
        }
      }

    }
?>