
<?php
//check for session
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

$sec = new security($connection);

// $users = new select($connection);

// echo $user;


if($_SERVER["REQUEST_METHOD"] == 'POST'){

    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $contact = $_POST['contact'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $password =  $sec->hash($_SESSION['password']);
        $userid = $_SESSION['userid'];


        if(!empty($firstname and $lastname and $contact and $age and $email and $gender and $address and $password) ){
        $update = new update($connection);
        $success = $update->updateuser($firstname,$lastname,$contact,$password,$age,$email, $gender,$address,$userid);
        // header('Location:userget.php');

        if($success == True){
            $_SESSION['suc-userupdate'] = 'Users record updated successfully';

        }
        header("Refresh:0");  //refresh page 
        header('Location:userget.php');


    }
    else{
        $_SESSION['suc-userupdate'] = ' Please fill user data before updating';
    }


header('Location:userget.php');
    }
}


?>



