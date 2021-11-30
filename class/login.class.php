<?php 


    class login{

        private $email;
        private $password;
        public $connection;

        public function __construct($connection)
        {
             
            $this->connection = $connection;    
        }
      

        public function check_user($email, $password){

            $sql = "SELECT * from USER WHERE email = ? and user_pass = ?";

            $smt= $this->connection->prepare($sql);

            $smt->bind_param("ss",$email, $password);
            $smt->execute();
            $result = $smt->get_result();
            $user = $result->fetch_all();

           

            if (count($user) > 0){
                return $user;
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                  Error logging in. Please check your username and password! 
                </div>
            <?php
            }

        }
        public function user_login_verify($email){

            $sql = "SELECT * from USER WHERE email = ? ";

            $smt= $this->connection->prepare($sql);

            $smt->bind_param("s",$email);
            $smt->execute();
            $result = $smt->get_result();
            $user = $result->fetch_all();

           

            if (count($user) > 0){
                return $user;
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                  Error logging in. Please check your username and password! 
                </div>
            <?php
            }

        }
        public function doc_login_verify($email){

            $sql = "SELECT * from DOCTORS WHERE email = ? ";

            $smt= $this->connection->prepare($sql);

            $smt->bind_param("s",$email);
            $smt->execute();
            $result = $smt->get_result();
            $user = $result->fetch_all();

           

            if (count($user) > 0){
                return $user;
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                  Error logging in. Please check your username and password! 
                </div>
            <?php
            }

        }
        public function check_doc($email, $password){

            $sql = "SELECT * from DOCTORS WHERE email = ? and doc_pass = ?";

            $smt= $this->connection->prepare($sql);

            $smt->bind_param("ss",$email, $password);
            $smt->execute();
            $result = $smt->get_result();
            $doc = $result->fetch_all();

           

            if (count($doc) > 0){
                return $doc;
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                  Error logging in. Please check your username and password! 
                </div>
            <?php
            }

        } 
         public function admin($email, $password){

            $sql = "SELECT * from ADMINISTRATOR WHERE username = ? and admin_pass = ?";

            $smt= $this->connection->prepare($sql);

            $smt->bind_param("ss",$email, $password);
            $smt->execute();
            $result = $smt->get_result();
            $doc = $result->fetch_all();

           

            if (count($doc) > 0){
                return $doc;
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                  Error logging in. Please check your username and password! 
                </div>
            <?php
            }

        } public function escape_user_input($input){
            return $this->connection->real_escape_string($input);
        }
    }





?>