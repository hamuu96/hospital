<?php declare(strict_types=1);

class insert_data{
    public $connection;

    public function __construct($connection)
    {
     $this->connection = $connection;   
    }
   
   //insert admin user
    public function insert_admin(){

        $firstname = '';
        $lastname = '';
        $username = '';
        $admin_pass = '';

        $smti = $sql = "INSERT INTO ADMINISTRATOR (username,firstname,lastname,admin_pass ) 
        VALUE(?,?,?,?)";
        if ( false===$smti ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $smti= $this->connection->prepare($sql);
        $rc = $smti->bind_param('ssss',$username,$firstname,$lastname,$admin_pass);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($smti->error));
          }
        
        $username = 'administrator';
        $firstname = 'james';
        $lastname = 'Doe';
        $admin_pass = '802700';
        $rc = $smti->execute(); 
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($smti->error));
          }


        
         
     }
    //insert data to user table
    public function insert_user($firstname,$lastname,$contact,$user_pass,$age,$email, $gender,$address){

        $sql = "INSERT INTO USER (firstname, lastname, contact, user_pass, age, email, gender, address ) 
        VALUE(?,?,?,?,?,?,?,?)";

        $smti= $this->connection->prepare($sql);
        if ( false===$smti ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $smti->bind_param("ssssisss",$firstname,$lastname,$contact,$user_pass,$age,$email, $gender,$address);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($smti->error));
          }
        $rc = $smti->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($smti->error));
          }
          else{
            header('Location:login.php'); 
          }
          
        // if($smti->execute()){
        //     header('Location:login.php');
        //     // $this->connection->close();
        // }
        // else{
        //     echo 'not work';
        // }


    }
    public function check($email){
        // $sql = "SELECT user_id, email,firstname,lastname FROM USER where email='$email' and firstname='$firstname' and lastname='$lastname'";

        $sql = "SELECT user_id, email,firstname,lastname FROM USER where email= ? ";

        $smt= $this->connection->prepare($sql);

        $smt->bind_param("s",$email);
        $smt->execute();
        $result = $smt->get_result();
        $existing_user = $result->fetch_all();
        //check if user exists
        if (count($existing_user) > 0){
                ?>
                    <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                       User already exists try using another email
                    </div>
                <?php
        }else{
            return True;
        } 
       

    }
    
    //input validation function for signup form 
    public function validation($firstname,$lastname,$contact,$user_pass,$age,$email, $gender,$address){
        if($firstname != '' and $lastname != '' and $user_pass != '' and $contact != '' and $email != '' and $gender != '' and $address != ''){
            if (strlen($user_pass) >= 3){ //change password length
                $return = $this->check($email);
                return $return;
                // return True;
            }else{
                ?>
                    <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
                       Plase enter a longer password for your security.
                     </div>
                <?php
                }

        }
        else{
            ?>
            <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
               please fill form
             </div>
        <?php
               
            }
        }
       
    
    // insert n 'not working'; data to medicine 
    public function insert_medicine(){

        $description = '';
        $medicine = '';


        $sql = "INSERT INTO MEDICINE (description_med,med_name) 
        VALUE(?,?)";
      
        $smti= $this->connection->prepare($sql);
        // if ( false===$smti ) {
           
        //     die('prepare() failed: ' . htmlspecialchars($this->connection->error));
        //   }
        // $rc = $smti->bind_param("sssssii",$description,$medicine);
        // if ( false===$rc ) {
        //     // again execute() is useless if you can't bind the parameters. Bail out somehow.
        //     die('bind_param() failed: ' . htmlspecialchars($smti->error));
        //   }
        
        // $rc = $smti->execute();
        // if ( false===$rc ) {
        //     die('execute() failed: ' . htmlspecialchars($smti->error));
        //   }
        // else{
        //     header('Location:confirmation.html');
        // }
        $rc = $smti->bind_param("ss",$description,$medicine);

        $description = 'common painkiller used to treat aches and pain. It can also be used to reduce a high temperature';
        $medicine = 'Paracetamol';
        $rc = $smti->execute();
 




        $description = 'common painkiller used to treat aches and pain. It can also be used to reduce a high temperature';
        $medicine = 'antibiotic';
        $rc = $smti->execute();

        $description = 'common painkiller used to treat aches and pain. It can also be used to reduce a high temperature';
        $medicine = 'Eye drops';
        $rc = $smti->execute();

        $description = 'common painkiller used to treat aches and pain. It can also be used to reduce a high temperature';
        $medicine = 'Cough syrup';
        $rc = $smti->execute();

        $description = 'common painkiller used to treat aches and pain. It can also be used to reduce a high temperature';
        $medicine = 'Amoxil';
        $rc = $smti->execute();
 


    }
    // insert data into doctors table
    public function insert_doctor(){


        $firstname = '';
        $lastname = '';
        $contact = '';
        $doc_pass = '';
        $age = 0;
        $email = '';
        $gender = '';
        $address = '';
        $dep_id = 0;

        $sql = "INSERT INTO DOCTORS (firstname, lastname, contact, doc_pass, age, email, gender, address,dep_id ) 
        VALUE(?,?,?,?,?,?,?,?,?)";
        $smti= $this->connection->prepare($sql);
        $smti->bind_param('ssssisssi',$firstname,$lastname,$contact,$doc_pass,$age,$email, $gender,$address,$dep_id);

       
        $firstname = 'james';
        $lastname = 'Doe';
        $contact = '+4471119191';
        $doc_pass = '1234';
        $age = 44;
        $email = 'james@gmail.com';
        $gender = 'Male';
        $address = '23 olympic way , wembley';
        $dep_id = 1;
        $smti->execute();

        $firstname = 'hamu';
        $lastname = 'Doe';
        $contact = '+4471119191';
        $doc_pass = '1234';
        $age = 44;
        $email = 'hamu@gmail.com';
        $gender = 'Male';
        $address = '23 olympic way , wembley';
        $dep_id = 1;
        $smti->execute();


        $firstname = 'emil';
        $lastname = 'Doe';
        $contact = '+4471119191';
        $doc_pass = '1234';
        $age = 44;
        $email = 'emil@gmail.com';
        $gender = 'Male';
        $address = '23 olympic way , wembley';
        $dep_id = 1;
        $smti->execute();

        $firstname = 'john';
        $lastname = 'Doe';
        $contact = '+4471119191';
        $doc_pass = '1234';
        $age = 44;
        $email = 'john@gmail.com';
        $gender = 'Male';
        $address = '23 olympic way , wembley';
        $dep_id = 2;
        $smti->execute();

        $firstname = 'kate';
        $lastname = 'Doe';
        $contact = '+4471119191';
        $doc_pass = '1234';
        $age = 44;
        $email = 'kate@gmail.com';
        $gender = 'Male';
        $address = '23 olympic way , wembley';
        $dep_id = 3;

        
        $smti->execute();
        
        echo 'successful';


    }
    // insert data into appointment
    public function insert_appointment($date,$msg,$contact,$firstname,$lastname,$userid,$department){

        // $sql = "INSERT INTO APPOINTMENT (ap_date,usr_msg,ap_time,contact,firstname,lastname,user_id,dep_id) 
        // VALUE(?,?,?,?,?,?,?,?)";

        $sql = "INSERT INTO APPOINTMENT (ap_date,usr_msg,contact,firstname,lastname,user_id,did) 
        VALUE(?,?,?,?,?,?,?)";
      
        $smti= $this->connection->prepare($sql);
        if ( false===$smti ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $smti->bind_param("sssssii",$date,$msg,$contact,$firstname,$lastname,$userid,$department);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($smti->error));
          }
        
        $rc = $smti->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($smti->error));
          }
        else{
            header('Location:confirmation.html');
        }
        


    }
    // insert data into department table
    public function insert_dep(){
        $department = ["Peditritian","Dentist","Neurologist","Cardiologist","ENT"];

        $sql = "INSERT INTO DEPARTMENT (department) VALUE(?)";
        $smti= $this->connection->prepare($sql);
  
        for ($i=0; $i < count($department); $i++){
            $smti->bind_param("s",$department[$i]);
            if($smti->execute()){
                echo 'working';
            }else{
                echo 'not working'. $this->connection->error; 
            }

        }

            // $this->connection->close();
       
        
    }

    // insert data into records table

    // public function main(){
    //     $insertdata = new insert_data($this->connection);
    //     $insertdata->insert_dep(); 
    // }

    public function escape_user_input($input){
        return $this->connection->real_escape_string($input);
    }
}


?>