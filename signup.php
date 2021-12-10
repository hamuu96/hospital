<?php
declare(strict_types=1);

include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

$sec = new security();

$firstname = $sec->html_strip($_POST['firstname']);
$lastname = $sec->html_strip($_POST['lastname']);
$user_pass = $sec->hash($_POST['password']);
$contact = $sec->html_strip($_POST['contact']);
$age = $sec->html_strip($_POST['age']);
$email = $sec->html_strip($_POST['email']);
$gender = $sec->html_strip($_POST['gender']);
$address = $sec->html_strip($_POST['address']);
// $username = substr($firstname, 0,3).'.'.$lastname.$age;

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['login'])){
        $insert = new insert_data($connection);
        // $return = $insert->validation($_POST['firstname'] , $_POST['lastname'] ,$_POST['password'] ,$_POST['contact'], $_POST['age'], $_POST['email'],$_POST['gender'],$_POST['address']);
        $return = $insert->validation($firstname,$lastname, $contact,$user_pass, $age,$email, $gender, $address);

        if ($return == True){
            $userInsert = new insert_data($connection);
            $userInsert->insert_user($firstname,$lastname, $contact,$user_pass, $age,$email, $gender, $address);   
        }
        else{
            // echo 'not working';
            // var_dump($return);
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
                  <a class="navbar-brand" href="landing.php">
                      <!-- <img src="images/logo.png" alt="" class="img-fluid"> -->
                      <h1>MDX Hospital</h1>
                  </a>
    
                  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icofont-navigation-menu"></span>
              </button>
          
              <div class="collapse navbar-collapse" id="navbarmain" >
                <ul class="navbar-nav ml-auto" >
                  <li class="nav-item active">
                    <a class="nav-link" href="landing.php">Home</a>
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
                Sign up 
              </div>

              <div class="col-lg-12 login-form">
                  <div class="col-lg-12 login-form">
                       <form method="POST" action='signup.php'>
                          <div class="form-group">
                              <label class="form-control-label">FIRSTNAME</label>
                              <input name='firstname' type="text" class="form-control">
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">LASTNAME</label>
                              <input name='lastname' type="text" class="form-control" i>
                          </div>
                         
                          

                          <div class="form-group">
                              <label class="form-control-label">CONTACT</label>
                              <input name='contact' type="text" class="form-control">
                          </div>
                        <div class="form-group">
                              <label class="form-control-label">PASSWORD</label>
                              <input name='password' type="password" class="form-control" i>
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">AGE</label>
                              <input name='age' type="number" class="form-control">
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">EMAIL</label>
                              <input name='email' type="email" class="form-control" i>
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">GENDER</label>
                              <!-- <input name="gender" type="text" class="form-control"> -->
                              <select class="form-control" name="gender">
                                <option >Male </option>
                                <option >Female</option>
                                <option >Dont Specify</option>
                                
                            </select>
                          </div>
                          <div class="form-group">
                              <label class="form-control-label">ADDRESS</label>
                              <input name="address" type="text" class="form-control" placeholder="Apartment, studio, or floor">
                          </div>
                          <div class="col-lg-12 loginbttm">
                              <div class="col-lg-6 login-btm login-text">
                                  <!-- Error Message -->
                              </div>

                                  <!-- <a style="text-align: left; color: white;" href=''>Forgot password?</a><br> -->
                                  <a style="text-align: left; color: white;" href=''>If you  have an account <a style="color:rgb(99, 191, 99);" href='login.php'>Login</a></a><br>
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



