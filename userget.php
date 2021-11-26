
<?php
//check for session
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

$users = new select($connection);
$email = $_GET['email'];
if($_SERVER["REQUEST_METHOD"] == 'GET'){
    if(isset($_GET['getuser'])){

        $user = $users->getuser($email);
        // var_dump($user);


    }
}


global $d;
$d = $user;
// var_dump($d);
$_SESSION['userid'] = $d[0][0];
$_SESSION['ufirstname'] = $d[0][1];
$_SESSION['lastname'] = $d[0][2];
$_SESSION['contact'] = $d[0][3];
$_SESSION['age'] = $d[0][5];
$_SESSION['email'] = $d[0][6];
$_SESSION['gender'] = $d[0][7];
$_SESSION['address'] = $d[0][1];
$_SESSION['password'] = $d[0][4];

// echo $opassword;

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
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                   
                    <li class="nav-item"><a class="nav-link" href="userget.php">user profiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="docget.php">Doctors profiles</a></li>
                   <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
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

    <form action="userget.php" method="GET" style="margin-top:60px;">
        <div class="input-group mb-3">
        
        <input type="email" class="form-control" placeholder="user's email" name='email' aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name='getuser'>Button</button>
        </div>
        </div>
    </form>
    <?php

        if(gettype($user) == 'array'){
            ?>
            <div class="main-content">
                <form action='userupdate.php' method='POST' class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Firstname</label>
                    <input type="text" class="form-control" id="inputEmail4" name ='firstname' placeholder="<?php echo $user[0][1] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Lastname</label>
                    <input type="text" class="form-control" id="inputAddress" name='lastname' placeholder="<?php echo $user[0][2] ?>">
                </div>
               
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name='email' placeholder="<?php echo $user[0][6] ?>">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress2" name="address" placeholder="<?php echo $user[0][8] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="inputCity" name="contact" placeholder="<?php echo $user[0][3] ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Gender</label>
                    <select id="inputState" name="gender" class="form-select">
                    <option  selected><?php echo $user[0][7] ?></option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Dont specify</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="inputZip" placeholder="<?php echo $user[0][5] ?>">
                </div>
              
                <div class="col-12" >
                    <button type="submit" class="btn btn-primary" name="update" href='userget.php'>update user</button>
                </div>
                </form>
        </div>
            <?php
    }
    else{
        ?>
      <div class="alert alert-primary" role="alert" style="text-align: center; margin-top:20px;">
        <?php echo $user;?>
      </div>
    <?php
    }


    ?>
</body>

  


</body>
</html>

