<?php

class security{

    public function hash($data){
        $data = password_hash($data, PASSWORD_DEFAULT);
        return $data;
    }

    public function verify($pass,$hash){
        $unhashed = password_verify($pass,$hash);
        return $unhashed;
    }
    public function html_strip($data){
        $data = htmlspecialchars($data,ENT_QUOTES);
        return $data;
    }
}



?>