<?php 
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();


$user = new login($connection);


if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['login'])){
        $username = $user->escape_user_input($_POST['username']);
        $password = $user->escape_user_input($_POST['password']);

        $docdata = $user->admin($username,$password);

        if ($docdata != null){
            $_SESSION['admin-username'] = $docdata[0][1];
            $_SESSION['firstname'] = $docdata[0][2];
            $_SESSION['lastname'] = $docdata[0][3];
            $_SESSION['did'] = $docdata[0][0];
            header('Location:admin-panel.php');
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
                    <a class="nav-link" href="admin-panel.php">Home</a>
                  </li>
                   
                    <li class="nav-item"><a class="nav-link" href="">Appoinments</a></li>
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
                Admini Login 
              </div>

              <div class="col-lg-12 login-form">
                  <div class="col-lg-12 login-form">
                      <form method="POST" action='admin.php'>
                          <div class="form-group">
                              <label class="form-control-label">USERNAME</label>
                              <input type="text" name='username' class="form-control">
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">PASSWORD</label>
                              <input type="password" name='password' class="form-control" >
                          </div>

                          <div class="col-lg-12 loginbttm">
                              <div class="col-lg-6 login-btm login-text">
                                  <!-- Error Message -->
                              </div>

                                  <a style="text-align: left; color: white;" href=''>Forgot password?</a><br>
                                  <a style="text-align: left; color: white;" href=''>If you dont have an account <a href='signup.php'>Sign up</a></a>
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



