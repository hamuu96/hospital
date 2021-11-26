<?php

class update{
    private $connection;

    public function __construct($connection)
    {
       $this->connection = $connection; 
    }

    public function updateuser($firstname,$lastname,$contact,$user_pass,$age,$email, $gender,$address,$userid)
    {
        $sql = 'UPDATE USER SET firstname = ?, lastname = ? , contact = ?, user_pass = ?, age =? , email = ?, gender = ?, address = ? WHERE user_id = ?';

        $smti = $this->connection->prepare($sql);
        if ( false===$smti ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $smti->bind_param("ssssisssi",$firstname,$lastname,$contact,$user_pass,$age,$email, $gender,$address,$userid);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($smti->error));
          }
        $rc = $smti->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($smti->error));
          }
         
        return True;
       
        // $this->connection->close();
    }
}



?>