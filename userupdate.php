
<?php
//check for session
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

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
        $password = $_SESSION['password'];
        $userid = $_SESSION['userid'];


        if(!empty($firstname and $lastname and $contact and $age and $email and $gender and $address) ){
        $update = new update($connection);
        $success = $update->updateuser($firstname,$lastname,$contact,$password,$age,$email, $gender,$address,$userid);
        header('Location:userget.php');

    }
    else{

        ?>
        <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
           Please fill user data before updating
        </div>
    <?php


header('Location:userget.php');
    }
}
}

?>



