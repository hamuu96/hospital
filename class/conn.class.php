<?php


class conn{

    private $username = 'root';
    private $password = '';
    private $server = 'localhost';
    private $database = 'Hospital';


    public function test_connection(){
        $conn = new mysqli($this->server, $this->username,$this->password);

        if(mysqli_connect_error()){
            die('connection error: '.$conn->connect_error);
        }
        else{
            echo 'connection test working!';
            // header('Location: /index.html');
            return $conn;

        }

    }
    public function create_db($conn){
        $sql = "CREATE DATABASE IF NOT EXISTS ". $this->database;
        if($conn->query($sql) == TRUE){
            echo 'db created';
        }
        else{
            echo 'error!: '. $conn->error;
        }


    }


    public function connect(){
        $select = new mysqli($this->server, $this->username,$this->password,$this->database);

        if(mysqli_connect_error()){
            die('connection error: '.$select->connect_error);
        }
        else{
            // echo 'database selection success!';
            // header('Location: /index.html');
            return $select;

        }

    }
}

?>