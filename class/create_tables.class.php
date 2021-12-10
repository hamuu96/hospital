<?php
declare(strict_types=1);
class create_tables{

    protected $connection;

    public function __construct($connection)
    {
       $this->connection = $connection; 
    }

    private function admin_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS ADMINISTRATOR (
            admin_id INT(6) auto_increment primary key,
            username varchar(50) not null,
            firstname varchar(30) not null,
            lastname varchar(30) not null,
            admin_pass varchar(200) not null 
           
            )";
        
        if($connection->query($sql) == TRUE){
            echo '<br>';
            echo 'admin table created'."\r\n";
            echo '<br>';
        }
        else{
            echo 'Error creating user: '. $connection->error."\r\n";
            echo '<br>';
        }
    }
    private function user_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS USER (
            user_id INT(6) auto_increment primary key,
            firstname varchar(50) not null,
            lastname varchar(50) not null,
            contact varchar(50) not null, 
            user_pass varchar(200) not null, 
            age INT(3) not null,
            email varchar(50) not null,
            gender char(8) not null,
            address varchar(50) not null
            )";
        
        if($connection->query($sql) == TRUE){
            echo '<br>';
            echo 'User table created'."\r\n";
            echo '<br>';
        }
        else{
            echo 'Error creating user: '. $connection->error."\r\n";
            echo '<br>';
        }
    }
    private function doctor_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS DOCTORS (
            did INT(6) auto_increment primary key,
            firstname varchar(10) not null,
            lastname varchar(50) not null,
            contact varchar(50) not null, 
            doc_pass varchar(200) not null,
            age INT(3) not null,
            email varchar(50) not null,
            gender char(8) not null,
            address varchar(50) not null,
            FOREIGN KEY (dep_id) REFERENCES DEPARTMENT (dep_id),
            dep_id INT(6)
            
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'doctors table created'."\r\n";
            echo '<br>';
        }
        else{
            echo 'Error creating doctors: '. $connection->error."\r\n";
            echo '<br>';
        }
    }

    private function department_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS DEPARTMENT (
            dep_id INT(6) auto_increment primary key,
            department varchar(30)  not null
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'department table created'."\r\n";
            echo '<br>';
            // $insert = new insert_data($connection);
            // $insert->insert_dep();
    
        }
        else{
            echo 'Error creating department: '. $connection->error."\r\n";
            echo '<br>';
        }
    }

    private function appointment_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS APPOINTMENT (
            ap_id INT(6) auto_increment primary key,
            ap_date date not null,
            usr_msg varchar(300) not null,
            -- ap_time time not null,
            contact varchar(30) not null,
            firstname varchar(50) not null,
            lastname varchar(50) not null,
            FOREIGN KEY (user_id) REFERENCES USER (user_id),
            FOREIGN KEY (did) REFERENCES DOCTORS (did),
            user_id INT(6),
            did INT(6)
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'appointment table created'."\r\n";
            echo '<br>';
        }
        else{
            echo 'Error creating appointment: '. $connection->error."\r\n";
            echo '<br>';
        }
    }

    private function records_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS RECORDS (
            rec_id INT(6) auto_increment primary key,
            diagnosis varchar(200) not null,
            FOREIGN KEY (user_id) REFERENCES USER (user_id),
            FOREIGN KEY (med_id) REFERENCES MEDICINE (med_id),
            FOREIGN KEY (med_id2) REFERENCES MEDICINE (med_id),
            FOREIGN KEY (med_id3) REFERENCES MEDICINE (med_id),
            FOREIGN KEY (did) REFERENCES DOCTORS (did),
            user_id INT(6),
            did INT(6),
            med_id INT(6),
            med_id2 INT(6),
            med_id3 INT(6)
           
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'records table created'."\r\n";
            echo '<br>';
        }
        else{
            echo 'Error creating records: '. $connection->error."\r\n";
            echo '<br>';
        }
    }

    private function medicine_table($connection){
        $sql = "CREATE TABLE IF NOT EXISTS MEDICINE (
            med_id INT(6) auto_increment primary key,
            description_med varchar(150) not null,
            med_name varchar(40) not null
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'medicine table created';
        }
        else{
            echo 'Error creating user: '. $connection->error;
        }
 
    }
    private function contact($connection){
        $sql = "CREATE TABLE IF NOT EXISTS CONTACT (
            cont_id INT(6) auto_increment primary key,
            message varchar(150) not null,
            email varchar(150) not null,
            topic varchar(100) not null,
            )";
        
        if($connection->query($sql) == TRUE){
            echo 'medicine table created';
        }
        else{
            echo 'Error creating user: '. $connection->error;
        }
 
    }
    
  

    public function main($connection){
        $run = new create_tables($connection);
        $run->admin_table($connection);
        $run->contact($connection);
        $run->user_table($connection);
        $run->department_table($connection);
        $run->doctor_table($connection);
        $run->appointment_table($connection);
        $run->medicine_table($connection);
        $run->records_table($connection);
        
        

    
     
        // $connection->close();
    }
}





?>