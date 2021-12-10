<?php

session_start();

include 'includes/autoloader.ini.php';

$try = new conn();
$connection = $try->connect();

// echo $_SESSION['lastname'];

$session = new session();
$session->user_sess($_SESSION['username']);

$sec = new security();


$users = new select($connection);
$user = $users->getuser($_SESSION['email']);
// var_dump($user);
$oldpass_hash = $user[0][4];


if($_SERVER["REQUEST_METHOD"] == 'POST'){

    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
    
        $contact = $_POST['contact'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $oldpass = $_POST['oldpass'];
        $password =  $sec->hash($_POST['password']);
        $userid = $_SESSION['userid'];

        if(!empty($firstname and $lastname and $contact and $age and $email and $gender and $address and $password) ){
            if(password_verify($oldpass,$oldpass_hash) == True){
                $update = new update($connection);
                $success = $update->updateuser($firstname,$lastname,$contact,$password,$age,$email, $gender,$address,$userid);
            }
            else{
                $_SESSION['suc-update'] = 'Users profile not updated successfully';

            }


        if($success == True){
            $_SESSION['suc-update'] = 'profile updated successfully';
        }
   
    }
    


    }
}

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
   <!-- bootstrap  -->
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

<body id="top">

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
						<a style="text-align: center;" class="dropdown-item" href="update.php">view records</a>
						<a style="text-align: center;" class="dropdown-item" href="records.php">view records</a>
					<button style="width: 100%; background:none; border:none;" type="submit" name="logout"><a class="dropdown-item" >log out</a></button>
				</div>
		  </div>
		  </form>
		</div>
	</nav>
</header>
    
<div class="alert alert-success" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
        <?php echo $_SESSION['suc-update']; 
        $_SESSION['suc-update'] = '';
        ?>
        </div>


<div class="main-content" style="margin: 6% 36%;">
                <form action='update.php' method='POST' class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Firstname</label>
                    <input type="text" class="form-control" id="inputEmail4" name ='firstname' placeholder="<?php echo $user[0][1] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Lastname</label>
                    <input type="text" class="form-control" id="inputAddress" name='lastname' placeholder="<?php echo $user[0][2] ?>">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="inputEmail4" name='oldpass' placeholder="old password">
                </div> 
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputEmail4" name='password' placeholder="new password">
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
                    <button type="submit" class="btn btn-primary" name="update" >update user</button>
                </div>
                </form>
        </div>



 
<!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>