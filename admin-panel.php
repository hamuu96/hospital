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

$users = new select($connection);
$no_users = $users->user();
$no_users = count($no_users);

$doctors = $users->doctors();
$doctors = count($doctors);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">
  
    <title>MDX Hospital</title>
  
    <!-- Favicon -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
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
    <link rel="stylesheet" href="css/style.css">
  
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
                    <li class="nav-item"><a class="nav-link" href="doccreate.php">Doctor signup</a></li>
                </ul>
              </div>
            </div>
        </nav>
    </header>

    <div class="center-content" style="width: 50%; margin:auto; text-align:center; margin-top:30px;">
      <?php
        echo '<h3>Welcome back: '. $_SESSION["admin-username"].'</h3>';

      ?>

<div class="row" style="margin-top: 150px;">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update user profiles</h5>
        <p class="card-text">You can be able to search for particular user and update their profile</p>
        <a href="userget.php" class="btn btn-primary">Search for User</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update user profiles</h5>
        <p class="card-text">You can be able to search for particular doctor and update their profile</p>
        <a href="#" class="btn btn-primary">Search for Doctor</a>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text" style="padding-top: 5px;">With supporting text below as a natural lead-in to additional content.</p><br>
       <?php
       
        echo "No of users: {$no_users}";
       ?>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text" style="padding-top: 5px;">With supporting text below as a natural lead-in to additional content.</p><br>
        <?php
            echo "No of doctors: {$doctors}";

        ?>
      </div>
    </div>
  </div>
    </div>

</body>
</html>