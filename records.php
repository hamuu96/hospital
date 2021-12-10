<?php

session_start();

include 'includes/autoloader.ini.php';

$try = new conn();
$connection = $try->connect();

// echo $_SESSION['lastname'];

$session = new session();
$session->user_sess($_SESSION['username']);

//fetch user records depending on the user id
$user_records = new select($connection);
$records = $user_records->user_records($_SESSION['id']);


if(isset($_POST['logout'])){
	
	$session->logout($_SESSION['username'],'login.php');
}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">

  <title>MDX Hospital</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

  <!-- bootstrap.min css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>


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
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="main.php">Home</a>
			  </li>
			   <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
			    <li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>
			    <li class="nav-item"><a class="nav-link" href="appointment.php">Appoinment</a></li>
			   <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
			</ul>
        
			</div>
            <form action="main.php" method="POST">
            <div class="dropdown" style="padding-left:100px;">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $_SESSION['username']; ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a style="text-align: center;" class="dropdown-item" href="update.php">Update profile</a>
					<button style="width: 100%; background:none; border:none;" type="submit" name="logout"><a class="dropdown-item" >log out</a></button>
				</div>
		  </div>
		  </form>
		</div>
	</nav>
</header>
<body id="top">

<div class="main-content" style="margin:9% 20%;">
<table class="table table-hover">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">names</th>
      <th scope="col">Diagnosis/instruction</th>
      <th scope="col">medication</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  for ($i=0; $i < count($records); $i++) { 
		  ?>
		  <tr style="text-align: center;">
			<th scope="row"><?php echo $i +1 ?></th>
			<td><?php echo implode(' ',array($records[$i][0] ,$records[$i][1])); ?></td>
			<td><?php echo $records[$i][2] ?></td>
			<td><?php echo $records[$i][3] ?></td>
			</tr> 
		  <?php
	  }
	?>
  </tbody>
</table>
</div>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>