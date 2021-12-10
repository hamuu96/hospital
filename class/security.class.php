<?php

class security{

    public function hash($data){
        $options = [
            'cost' => 14,
        ];
        $data = password_hash($data, PASSWORD_DEFAULT, $options);
        return $data;
    }

    public function verify($pass,$hash){
        $unhashed = password_verify($pass,$hash);
        return $unhashed;
    }
    public function html_strip($data){
        $data = htmlspecialchars($data,ENT_QUOTES);
        return trim($data);
    }
}



?>