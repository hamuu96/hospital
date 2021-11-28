
<?php
//check for session
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

if(!$_SESSION['admin-username']){
    header('Location:admin.php');
  }

  
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
        $doc_pass = $_SESSION['doc-password'];
        $docid = $_SESSION['doc-id'];


        if(!empty($firstname and $lastname and $contact and $age and $email and $gender and $address) ){
        $update = new update($connection);
        $success = $update->updatedoc($firstname,$lastname,$contact,$doc_pass,$age,$email, $gender,$address,$docid);
        
        if($success == True){
            $success['suc-docupdate'] = 'Doctors record updated successfully';

        ?>
        <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
        user update successful
        </div>
    <?php
        }
        // header('Location:docget.php');

    }
    else{
        
        ?>
        <div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
           Please fill user data before updating
        </div>
    <?php
    }
}
}

?>



