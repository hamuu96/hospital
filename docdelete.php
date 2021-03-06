
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
$email = $_GET['email'];
if($_SERVER["REQUEST_METHOD"] == 'GET'){
    if(isset($_GET['deldoc'])){

        $doc = $users->getdoc($email);
        // var_dump($doc);


    }
}


global $d;
$d = $doc;
// var_dump($d);
$_SESSION['doc-id'] = $d[0][0];
$_SESSION['doc-firstname'] = $d[0][1];
$_SESSION['doc-lastname'] = $d[0][2];
$_SESSION['doc-contact'] = $d[0][3];
$_SESSION['doc-age'] = $d[0][5];
$_SESSION['doc-email'] = $d[0][6];
$_SESSION['doc-gender'] = $d[0][7];
$_SESSION['doc-address'] = $d[0][1];
$_SESSION['doc-password'] = $d[0][4];





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

    <form action="docdelete.php" method="GET" style="margin-top:60px;">
        <div class="input-group mb-3">
        
        <input type="email" class="form-control" placeholder="Doctor's email" name='email' aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            
            <button class="btn btn-outline-secondary" type="submit" name='deldoc'  >Get Doctor</button>
        </div>
        </div>
    </form>
    <?php

if(gettype($doc) == 'array'){
    ?>
<form action="delconfirm.php" method="POST">


<table class="table">
  <thead>
    <tr>
      <th scope="col">Doc-id</th>
      <th scope="col">firstname</th>
      <th scope="col">lastname</th>
      <th scope="col">email</th>
      <th scope="col">age</th>
      <th scope="col">Contact</th>
      <th scope="col">gender</th>
      <th scope="col">address</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $doc[0][1]; ?></td>
      <td><?php echo $doc[0][2]; ?></td>
      <td><?php echo $doc[0][6]; ?></td>
      <td><?php echo $doc[0][5]; ?></td>
      <td><?php echo $doc[0][3]; ?></td>
      <td><?php echo $doc[0][7]; ?></td>
      <td><?php echo $doc[0][8]; ?></td>
    </tr>
  </tbody>
</table>
<button type="submit" class="btn btn-primary" name="delete" >Delete Doctor</button>

</form>
    <?php
}
else{
?>
<div class="alert alert-primary" role="alert"  style="text-align: center; margin-top:20px;">
<?php echo $doc;?>
</div>
<?php
}

if (!empty($_SESSION['deleted-doc'])){
  ?>
  <div class="alert alert-primary" role="alert" style="text-align: center; margin-top:20px;">
  <?php echo $_SESSION['deleted-doc']; 
        $_SESSION['deleted-doc'] = ''; 
  ?>
  </div>
  <?php 
}


?>

  


</body>
</html>

