<?php
/// to do 
  //logout user
  // update profile
  // input sanitization
  // type casting


  //select all doctors within a department using department id 
  // get a random doctor from the previous function
  // insert doctor id into appointment

session_start();

include 'includes/autoloader.ini.php';

$try = new conn();
$connection = $try->connect();

if(!$_SESSION['username']){
  header('Location:login.php');
}

$dep = new select($connection);
$result = $dep->department();


$insert = new insert_data($connection); 

if($_SERVER["REQUEST_METHOD"] == 'POST'){
  if(isset($_POST['appointment'])){

    $firstname = $insert->escape_user_input($_POST['firstname']);
    $lastname = $insert->escape_user_input($_POST['lastname']);
    $date = $insert->escape_user_input($_POST['date']);
    $time =  $insert->escape_user_input($_POST['time']);
    $msg = $insert->escape_user_input($_POST['message']);
    $department = $insert->escape_user_input($_POST['department']);
    $contact = $insert->escape_user_input($_POST['phone']);
    $userid = $_SESSION['id'];


    $dep_id = new select($connection);
    $result = $dep_id->department_id($department);
    $department_id = $result[0][0];
    $doctors_in_dep = $dep_id->count_dep($department_id);

    $new = array();

    foreach($doctors_in_dep as $value){
      $new [] += $value[0];
      
    }
    // echo count($doctors_in_dep);
    $appointment_doctor = $new[array_rand($new)];
    // echo $new[array_rand($new)];
  //  for($i=0; $i < count($doctors_in_dep); $i++){
  //    echo $doctors_in_dep[$i][0];
  //  } 

    // echo $doctors_in_dep[1][0];
   
    // echo "variable firstname: {$firstname} lastname: {$lastname} date: {$date} time: {$time} msg: {$msg} dep: {$department_id} cont: {$contact} usrid: {$userid}";

   
    $insert->insert_appointment($date,$msg,$contact,$firstname,$lastname,$userid,$appointment_doctor);
  }
}



?>

<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">

  <title>Novena- Health & Care Medical template</title>

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
					<a class="nav-link" href="index.html">Home</a>
				  </li>
				   <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
					<li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>
					<li class="nav-item"><a class="nav-link" href="appoinment.php">Appoinment</a></li>
				   <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
				</ul>
			  </div>
            <div class="dropdown" style="padding-left:100px;">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $_SESSION['username']; ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">£</a>
					<a class="dropdown-item" href="#">update user profile</a>
					<a class="dropdown-item" href="#">log out</a>
				</div>
		  </div>
			</div>
		</nav>
	</header>




<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Book your Seat</span>
          <h1 class="text-capitalize mb-5 text-lg">Appoinment</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Book your Seat</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>

<section class="appoinment section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
          <div class="mt-3">
            <div class="feature-icon mb-3">
              <i class="icofont-support text-lg"></i>
            </div>
             <span class="h3">Call for an Emergency Service!</span>
              <h2 class="text-color mt-3">+84 789 1256 </h2>
          </div>
      </div>

      <div class="col-lg-8">
           <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
            <h2 class="mb-2 title-color">Book an appoinment</h2>
            <p class="mb-4">Mollitia dicta commodi est recusandae iste, natus eum asperiores corrupti qui velit . Iste dolorum atque similique praesentium soluta.</p>
            <form  class="appoinment-form" method="POST" action="appointment.php">
                    <div class="row">
                         <div class="col-lg-6">
						            <div class="form-group-2 mb-4">
                                <select name='department' class="form-control" id="exampleFormControlSelect1" >
									      

                            <?php
                              while ($row = $result->fetch_assoc()) {
                                  ?>
                                 <option id='dep' class="col-lg-2" ><?php echo $row["department"] ?></option> 
                                 <?php
                              }
                              ?>

                                </select>
                            </div>
                        </div>

                         <div class="col-lg-6">
                            <div class="form-group">
                                <input id="date" name='date' type="text" class="form-control" placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input id="time" type="time" name='time' class="form-control" placeholder="Time">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <input  id="phone" type="Number" name='phone' class="form-control" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input  id="name" type="text" name='firstname' placeholder='firstname' class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <input id="date" name='lastname' type="text" class="form-control" placeholder="lastname">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-2 mb-4">
                        <textarea name="message" id="message" class="form-control"  rows="6" placeholder="Your Message"></textarea>
                    </div>
					    <button  name='appointment' type="submit" class="btn btn-outline-primary">make appointment</button>

                    <!-- <button style="background: none; outline:none;" type='submit' name='appointment'><a class="btn btn-main btn-round-full"  >Make Appoinment <i class="icofont-simple-right ml-2  "></i></a></button> -->
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- footer Start -->
<footer class="footer section gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mr-auto col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<div class="logo mb-4">
						<H1>MDX Hospital</H1>
					</div>
					<p>Tempora dolorem voluptatum nam vero assumenda voluptate, facilis ad eos obcaecati tenetur veritatis eveniet distinctio possimus.</p>

					<ul class="list-inline footer-socials mt-4">
						<li class="list-inline-item"><a href="https://www.facebook.com/themefisher"><i class="icofont-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/themefisher"><i class="icofont-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.pinterest.com/themefisher/"><i class="icofont-linkedin"></i></a></li>
					</ul>
				</div>
			</div>



			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Support</h4>
					<div class="divider mb-4"></div>

					<ul class="list-unstyled footer-menu lh-35">
						<li><a href="#">About</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Appointment</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="widget widget-contact mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Get in Touch</h4>
					<div class="divider mb-4"></div>

					<div class="footer-contact-block mb-4">
						<div class="icon d-flex align-items-center">
							<i class="icofont-email mr-3"></i>
							<span class="h6 mb-0">Support Available for 24/7</span>
						</div>
						<h4 class="mt-2"><a href="tel:+23-345-67890">Mdxhospital@email.com</a></h4>
					</div>

					<div class="footer-contact-block">
						<div class="icon d-flex align-items-center">
							<i class="icofont-support mr-3"></i>
							<span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
						</div>
						<h4 class="mt-2"><a href="tel:+23-345-67890">+xx-xxx-xxxx</a></h4>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-btm py-4 mt-5">


			<div class="row">
				<div class="col-lg-4">
					<a class="backtop js-scroll-trigger" href="#top">
						<i class="icofont-long-arrow-up"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>

    <script>
    function findmyvalue()
    {
    var myval = document.getElementById("dep").value;

    alert(myval);
    }

    </script>

    <!--
    Essential Scripts
    =====================================-->



    <!-- Main jQuery -->
    <script src="plugins/jquery/jquery.js"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="plugins/bootstrap/js/popper.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/counterup/jquery.easing.js"></script>
    <!-- Slick Slider -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <!-- Counterup -->
    <script src="plugins/counterup/jquery.waypoints.min.js"></script>

    <script src="plugins/shuffle/shuffle.min.js"></script>
    <script src="plugins/counterup/jquery.counterup.min.js"></script>
    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>

    <script src="js/script.js"></script>
    <script src="js/contact.js"></script>

  </body>
  </html>