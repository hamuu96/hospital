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

    

    <div class="container" style="margin-top: 200px;">
      <div class="row">
          <div class="col-lg-3 col-md-2"></div>
          <div class="col-lg-6 col-md-8 login-box">
              <div class="col-lg-12 login-key">
                  <i class="fa fa-key" aria-hidden="true"></i>
              </div>
              <div class="col-lg-12 login-title">
                Admin Login 
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



