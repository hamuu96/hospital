<?php 
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();


$user = new login($connection);
$useremail = new select($connection);
$sec = new security();



if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['login'])){
        $email = $user->escape_user_input($_POST['email']);
        $password = $user->escape_user_input($_POST['password']);

       
        $userdata = $user->user_login_verify($email);
        $pass = $userdata[0][4];
       
        

        if ( $sec->verify($password,$pass) == true){
            $_SESSION['id'] = $userdata[0][0];
            $_SESSION['username'] = substr($userdata[0][1],0,-2).".".substr($userdata[0][2],0,-3).substr($userdata[0][4],-1,2);
            $_SESSION['firstname'] = $userdata[0][1];
            $_SESSION['lastname'] = $userdata[0][2];
            $_SESSION['email'] = $userdata[0][6];
            header('Location:main.php');
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
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  
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
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                   <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="appoinment.html">Appoinment</a></li>
                   <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
              </div>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 100px;">
      <div class="row">
          <div class="col-lg-3 col-md-2"></div>
          <div class="col-lg-6 col-md-8 login-box">
              <div class="col-lg-12 login-key">
                  <i class="fa fa-key" aria-hidden="true"></i>
              </div>
              <div class="col-lg-12 login-title">
                Login 
              </div>

              <div class="col-lg-12 login-form">
                  <div class="col-lg-12 login-form">
                      <form method="POST" action='login.php'>
                          <div class="form-group">
                              <label class="form-control-label">EMAIL</label>
                              <input type="email" name='email' class="form-control">
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">PASSWORD</label>
                              <input type="password" name='password' class="form-control" >
                          </div>

                          <div class="col-lg-12 loginbttm">
                              <div class="col-lg-6 login-btm login-text">
                                  <!-- Error Message -->
                              </div>

                                  <!-- <a style="text-align: left; color: white;" href=''>Forgot password?</a><br> -->
                                  <a style="text-align: left; color: white;" href=''>If you dont have an account <a style="color:rgb(99, 191, 99);" href='signup.php'>Signup</a></a><br>
                              <div class="col-lg-6 login-btm login-button">
                              <button style="margin-top: 40px;" name='login' type="submit" class="btn btn-outline-primary">LOGIN</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="col-lg-3 col-md-2"></div>
          </div>
      </div>






    </body>
    
</body>
</html>



