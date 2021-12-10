
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

//instatiation of select method to get available department for doctors
$dep = new select($connection);
$result = $dep->department();

//security class intatiation
$sec = new security();

$firstname = $sec->html_strip($_POST['firstname']);
$lastname = $sec->html_strip($_POST['lastname']);
$doc_pass = $sec->hash($_POST['password']);
$contact = $sec->html_strip($_POST['phone']);
$age = $sec->html_strip($_POST['age']);
$email = $sec->html_strip($_POST['email']);
$gender = $sec->html_strip($_POST['gender']);
$address = $sec->html_strip($_POST['address']);
$department = $sec->html_strip($_POST['department']);


if($_SERVER["REQUEST_METHOD"] == 'POST'){
  if(isset($_POST['signup'])){
    $insert = new insert_data($connection);
  
    //get department id based on admin selection
    $dep_return = $dep->department_id($department);
    $dep_id = $dep_return[0][0];

    //validation checks
    $return = $insert->validate_doc($firstname,$lastname, $contact,$_POST['password'], $age,$email, $gender, $address);
    
    if ($return == True) {
      # code...
      $insert->insert_doc($firstname,$lastname,$contact,$doc_pass,$age,$email, $gender,$address,$dep_id);
    }



   
   
   
   
  }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">
  
    <title>MDX Hospital</title>
  
    <!-- Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">
  
    <!-- Main Stylesheet -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
  
</head>
<body id='top'>
<header>
	
  <nav class="navbar navbar-expand-lg navigation" id="navbar">
      <div class="container">
            <a class="navbar-brand" href="index.html">
                <!-- <img src="images/logo.png" alt="" class="img-fluid"> -->
                <h1>MDX Hospital</h1>
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icofont-navigation-menu"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarmain" >
          <ul class="navbar-nav ml-auto" >
            <li class="nav-item active">
              <a class="nav-link" href="admin-panel.php">Home</a>
            </li>
             
              <li class="nav-item"><a class="nav-link" href="">user profiles</a></li>
              <li class="nav-item"><a class="nav-link" href="docget.php">Doctors profiles</a></li>
              <li class="nav-item"><a class="nav-link" href="docdelete.php">Doctor Delete</a></li>
          </ul>
        </div>
      </div>
  </nav>
</header>

<div class="main-content" style="margin: 6% 36%;">
<div class="welcome" style="text-align: center;">
    <?php
        echo '<h3>Welcome back: '. $_SESSION["admin-username"].'</h3>';

      ?>
</div>

 <form action="doccreate.php" method="POST" style="margin-top: 30px;">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Firstname</label>
      <input type="text" class="form-control" id="inputEmail4" name="firstname" placeholder="Firstname">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Lastname</label>
      <input type="text" class="form-control" id="inputPassword4" name="lastname" placeholder="Lastname">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputAddress">Contact</label>
    <input type="text" class="form-control" id="inputAddress" name="phone" placeholder="072112241">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" name="address" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
       <label for="inputState">Gender</label>
      <select id="inputState" name="gender" class="form-control">
        <!-- <option >Choose...</option> -->
        <option>Male</option>
        <option>Female</option>
        <option>Dont Specify</option>
      </select>
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputZip">Age</label>
      <input type="number" class="form-control" name="age" id="inputZip">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAddress">Department</label>
      <select id="inputState" name='department' class="form-control">
        
      
      <?php
      //loop to echo out available departments
        while ($row = $result->fetch_assoc()) {
            ?>
            <option id='dep' class="col-lg-2" ><?php echo $row["department"] ?></option> 
            <?php
        }
      ?>
      </select>
  </div>
  
  <button type="submit" name="signup" class="btn btn-primary">Sign up</button>
</form>

 <!-- bootstrap js -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  


</body>
</html>

