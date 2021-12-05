<?php

session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

$session = new session();
$session->adm_sess($_SESSION['doctors-username']);



$appointment = new select($connection);
//fetch appointment information 
$result = $appointment->doc_appointment($_SESSION['did']);

//get medication
$med = $appointment->medicine();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
  if(isset($_POST['diagnosis'])){

    $medicine_array = array();
    //convert medicine text to medicine id 
    $med1 = $appointment->med_id($_POST['med1']); 
    $med2 = $appointment->med_id($_POST['med2']);
    $med3 = $appointment->med_id($_POST['med3']);
    $msg = $_POST['feedback'];
   
    $userid = (int) $_POST['userid'];
    // var_dump($userid);

    //convert to integer 
    $ap_id = (int) $_POST['apid']; // return string
   
    
    
    //insert data into records table
    $insert = new insert_data($connection);
    $suc_record = $insert->insert_record($msg,$userid,$_SESSION['did'],$med1[0][0],$med2[0][0],$med3[0][0]);

    if($suc_record == True){
      $del = new delete($connection);
      $del->del_appointment($ap_id);
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
    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                      <h1>MDX Hospital</h1>
                  </a>
    
                  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icofont-navigation-menu"></span>
              </button>
          
              <div class="collapse navbar-collapse" id="navbarmain" >
                <ul class="navbar-nav ml-auto" >
                  
                    <li class="nav-item"><a class="nav-link" href="docdash.php">Dashboard</a></li>
                </ul>
              </div>
              <div class="dropdown" style="padding-left:100px;">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['doctors-username']; ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a style="text-align: center;" class="dropdown-item" href="#">update profile</a>
                <button style="width: 100%; border:none; background:none;"><a class="dropdown-item" href="#">log out</a></button>
              </div>
            </div>
            </div>
        </nav>
    </header>
    <div class="center-content" style="width: 50%; margin:auto; text-align:center; margin-top:30px;">
      <?php
        echo '<h3>Welcome back Doctor: '. $_SESSION["firstname"].'</h3>';

      ?>
    </div>
    <?php
  if (gettype($result) == 'string' ){
    
    ?>
      <div class="alert alert-primary" role="alert" style="text-align: center; margin-top:20px;">
        <?php echo $result;?>
      </div>
    <?php
  }
  else{
    ?>
    <div id="accordion" style="width: 50%; text-align:center; margin:auto; margin-top: 10%;">
      <?php
          for ($i=0; $i < count($result); $i++){
            // $ap_id = $result[$i][0];
            // echo $ap_id;
            ?>
              <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo 'Appointment '. $i + 1; ?>
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                <form method="POST" action="dappointment.php">
                <input type="text" name="apid" <?php $ap_id = $result[$i][0];  ?> placeholder="<?php var_dump($ap_id); ?>" value="<?php echo $ap_id?>" hidden >
                <input type="text" name="userid" <?php $userid = $result[$i][4];  ?>  value="<?php echo $userid?>" hidden >
                
                    <div class="form-row">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="<?php echo $result[$i][1] ?>" disabled>
                      </div>
                      <div class="col">
                        <input type="text" class="form-control" placeholder="<?php echo $result[$i][2] ?>" disabled>
                      </div>
                       
                    </div>
                    <div class="form-group purple-border" style="margin:0 2%; padding-bottom:20px;">
                            <label for="exampleFormControlTextarea4">Patients message</label>
                            <textarea class="form-control" name='feedback' id="exampleFormControlTextarea4" disabled rows="3"><?php echo $result[$i][3]; ?></textarea>
                        </div>
                        <div class="form-group purple-border" style="margin:0 2%; padding-bottom:20px;">
                            <label for="exampleFormControlTextarea4">Doctors Diagnosis </label>
                            <textarea class="form-control" name='feedback' id="exampleFormControlTextarea4" rows="3"></textarea>
                        </div>
                        <div class="medicine">

                        <select class="form-select" aria-label="Default select example" name="med1" style="margin:20px 0px;">
                        <?php
                        for ($a=0; $a < count($med) ; $a++) { 
                          # code...
                           ?>
                            <option id='dep' class="btn btn-primary" ><?php echo $med[$a][2] ?></option> 
                          <?php
                        }
                        
                        ?>
                       
                        <label class="mdb-main-label">Blue select</label>
                        </select>
                        <select class="form-select" aria-label="Default select example" name="med2" style="margin:20px 0px;">
                        <?php
                        for ($a=0; $a < count($med) ; $a++) { 
                          # code...
                           ?>
                            <option id='dep' class="btn btn-primary" ><?php echo $med[$a][2] ?></option> 
                          <?php
                        }
                        
                        ?>
                       
                        <label class="mdb-main-label">Blue select</label>
                        </select>
                        <select class="form-select" aria-label="Default select example" name="med3" style="margin:20px 0px;">
                        <?php
                        for ($a=0; $a < count($med) ; $a++) { 
                          # code...
                           ?>
                            <option id='dep' class="btn btn-primary" ><?php echo $med[$a][2] ?></option> 
                          <?php
                        }
                        
                        ?>
                       
                        <label class="mdb-main-label">Blue select</label>
                        </select>
                        </div>
                        <button type="submit" name='diagnosis' href="dappointment.php" style="background:none; border:none; float:right; margin-bottom: 20px;"><a  class="btn btn-primary">Submit Diagnosis</a></button>
                </form>
              </div>
              </div>
            </div>
            <?php
          }

      ?>
    </div> 
    <?php
  }

?>

<?php



?>
  
  
    
  
<!-- footer Start -->
<footer class="footer section gray-bg" style="margin-top: 70px;">
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
   
<!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>