<?php

require 'core.php';
require 'database_connector.php';
require 'functions.php';

   //OPERATION OF THE USER PROFILE BUTTON
   if(array_key_exists('profile', $_POST)) {
    header("Location: user/userProfile.php");
  }

  //OPERATION OF THE logout BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: logout.php");
  }

  //OPERATION OF THE SIGN-UP BUTTON
if(array_key_exists('signup', $_POST)) {
    header("Location: userRegistration.php");
  }

   //OPERATION OF THE LOGIN BUTTON
   if(array_key_exists('login', $_POST)) {
    header("Location: login.php");
  }

  if(isset($_GET['job_id'])){

    //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
    $job_id=$_GET['job_id'];

    $query="SELECT * FROM `jobs` WHERE `job_id`= $job_id";

            if($query_run = mysqli_query($con,$query)){ 
                while ($row = mysqli_fetch_assoc($query_run)){
                    $job_id_new = $row['job_id'];
                    $jobPosition = $row['job_position'];
                    $jobCategory = $row['job_category'];
                    $workingTime = $row['working_time'];
                    $workingHours = $row['working_hours'];
                    $paidSalary = $row['paid_salary'];
                    $lookingFor = $row['lookingFor'];
                    $gender = $row['gender'];
                    $jobProfile = $row['job_profile'];
                    $experienceQualifications = $row['experience_qualifications'];
                    $district = $row['district'];
                    $address = $row['address'];
                    $publishedBy = $row['published_by'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $publishedDate = $row['published_date'];

              }
          }else{
            echo "<script type='text/javascript'>alert('Database Error ');</script>";
            
          }

  }else{
    header("Location: index.php");
  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunities</title>
   

     <!-- Link Bootstrap -->

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="images/logo1.png" type="image/x-icon">
		
	<!-- End Link Bootstrap -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
         <!-- Header -->
         <header>
        <nav class="navbar navbar-expand-sm navbar mb-4 border-bottom fixed-top bg-white shadow" style="position">
            <div class="container">
            <a class="navbar-brand" href="index.php"> <img src="images/logo2.png" alt="brand" width="50px" height="50px" > JOB WORLD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-success" href="postJob.php" >Post a Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="jobOpportunities.php" style="font-weight:bold;">Job Vacancies</a>
                    </li>
                </ul>
                </div>
                <div class='col-md-1 text-end'>
                    
                    <a class="nav-link text-end" href="contactUs.php">Support</a>
                  
                </div>  
                
                <?php
                    if(loggedin()){

                        echo "<div class='col-md-1 text-end'>
                        <form method='post'>
                        <input class='btn btn-outline-primary me-2' type='submit' name='profile' class='button' value='User Profile' />
                        </form>
                        </div>

                        <div class='col-md-1 text-end'>
                            <form method='post'>
                            <input class='btn btn-primary' type='submit' name='logout' class='button' value='Logout' />
                        </form>
                        </div>";


                    }else{

                        echo "<div class='col-md-1 text-end'>
                            <form method='post'>
                            <input class='btn btn-outline-primary me-2' type='submit' name='login' class='button' value='Login' />
                        </form>
                        </div>

                        <div class='col-md-1 text-end'>
                            <form method='post'>
                            <input class='btn btn-primary' type='submit' name='signup' class='button' value='Sign-up' />
                        </form>
                        </div>";

                    }
                ?>
            </div>
        </nav>
        </header>

      <!-- End of Header -->
      <div class="container" style="margin-top:5%;">

        <div class="card shadow" style="margin: 0 auto 5%; width:80%">
            <h5 class="card-header text-center"><?php echo $jobPosition; ?></h5>
            <div class="card-body p-4">

                <div class="row" >
                    <div class="col-sm-9">  
                        <h5 class="card-title">Who we are looking for?</h5><p class="card-text"><?php echo $lookingFor; ?></p>
                    </div>
                    <div class="col-sm-3">    
                        <div class="card border border-info text-center shadow" style="width: 90%; margin: 0 auto 0; background-color:#931212;">
                            <div class="card-body">
                                <h4 class="card-title" style="color:#fff; font-weight:bold; font-style:italic; font-size:15pt;">Salary Rs.<?php echo $paidSalary; ?>/=</h4> 
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div> 
                </div>
                
                <h5 class="card-title">Job Profile</h5>
                <p class="card-text"><?php echo $jobProfile; ?></p>
                <h5 class="card-title">Experience and Qualifications</h5>
                <p class="card-text"><?php echo nl2br($experienceQualifications); ?></p>

                <div class="card border border-success shadow-sm" style="width:90%; margin: 0 auto 2%;">
                    <div class="card-body">
                        <div class="row" style="margin: 0 auto 0;">
                            <div class="col-sm-6 text-center"> 
                                <div class="row"> 
                                    <div class="col-sm-6 text-center"> <h6 class="card-title">Working Time</h6><p class="card-subtitle mb-2 text-muted"><?php echo $workingTime; ?></p></div>
                                    <div class="col-sm-6 text-center"><h6 class="card-title">Working Hours</h6><p class="card-subtitle mb-2 text-muted"><?php echo $workingHours; ?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center"><h6 class="card-title">Gender</h6><p class="card-subtitle mb-2 text-muted"><?php echo $gender; ?></p></div>
                                </div>
                             </div>
                               
                            <div class="col-sm-6 text-center shadow" style="color:#FF0000; font-weight:bold; font-style:italic; font-size:18pt; margin: auto;"><p>Apply Now - Send your CV to <?php echo $email; ?></p></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                        <h5 class="card-title text-center" style="color:#06541B; font-weight:bold; margin: 0 auto 2%;">Contact Us</h5>
                            <div class="col-sm-4 text-center"> <h6 class="card-title">Email</h6><p class="card-subtitle mb-2 text-muted"><?php echo $email; ?></p></div>
                            <div class="col-sm-4 text-center"> <h6 class="card-title">Phone</h6><p class="card-subtitle mb-2 text-muted"><?php echo $phone; ?></p></div>
                            <div class="col-sm-4 text-center"> <h6 class="card-title">Address</h6><p class="card-subtitle mb-2 text-muted"><?php echo $address; ?></p></div>
                        </div>

                <div class="card border border-info shadow-sm" style="width:80%; margin: 2% auto 2%;">
                    <h5 class="card-title" style="color:#06541B; font-weight:bold; margin: 2% auto 2%;">Send us your inquiries regarding this vacancy</h5>
                    <form action="inquiriy.php?job_id='<?php echo $job_id_new; ?>'" method="POST" style="width:80%; margin:2% auto 2%;" autocomplete="off">
                       
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="subject" class="form-control" name="subject" id="subject" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="description" rows="2" name="description" id="description" class="form-control" value="" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="email">
                            <div id="email" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit your Inquiry</button>
                    </form>
                </div>
                
            </div>
            <div class="card-footer text-muted">
                <div class="row">
                    <div class="col-sm-6"> <p class="card-text"> Published by <?php echo $publishedBy; ?></p></div>
                    <div class="col-sm-6"> <p class="card-text d-flex justify-content-sm-end"> Published on <?php echo $publishedDate; ?></p></div> 
                </div>
            </div>
            
        </div>
          

      <!-- Footer -->
      <footer class="text-center text-lg-start bg-light  py-3 my-4">

<!-- Section: Social media -->
<section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
    <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f" style='color:#0064FF'></i>
    </a>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter" style='color:#4672D0'></i>
    </a>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-google" style='color:#3F7A00'></i>
    </a>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram" style='color:#FA1814'></i>
    </a>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin" style='color:#0400FF'></i>
    </a>
    <a href="" class="me-4 text-reset">
        <i class="fab fa-github" style='color:#000000'></i>
    </a>
    </div>
    <!-- Right -->
</section>
<!-- Section: Social media -->

<!-- Section: Links  -->
<section class="">
    <div class="container text-center text-md-start mt-5">
    <!-- Grid row -->
    <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
        <!-- Content -->
        <h6 class="text-uppercase fw-bold mb-4">
            <img src="images/logo2.png" alt="brand" width="70vw" height="70vw" > JOB WORLD</a>
        </h6>
        <p style="text-align:justify;">
        Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
        </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
        <!-- Links -->
        <h6 class="text-uppercase fw-bold mb-4">
            useful links
        </h6>
        <p>
            <a href="login.php" class="text-reset">Sign in</a>
        </p>
        <p>
            <a href="userRegistration.php" class="text-reset">Sign Up</a>
        </p>
        <p>
            <a href="jobOpportunities.php" class="text-reset">Job Vacancies</a>
        </p>
        <p>
            <a href="postJob.php" class="text-reset">Post a Job</a>
        </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
        <!-- Links -->
        <h6 class="text-uppercase fw-bold mb-4">
            AIMS
        </h6>
        <p>
            Provide Service
        </p>
        <p>
            User Confidentiality
        </p>
        <p>
            Terms and Conditions
        </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        <!-- Links -->
        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
        <p><i class="fas fa-home me-3"></i> Negombo, Sri Lanka</p>
        <p>
            <i class="fas fa-envelope me-3"></i>
            jobworld782@gmail.com
        </p>
        <p><i class="fas fa-phone me-3"></i> +94 712 267 87</p>
        <p><i class="fas fa-print me-3"></i> +94 315 921 59</p>
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
    </div>
</section>
<!-- Section: Links  -->

<!-- Copyright -->
<div class="text-center p-4" style="background-color:#4672D0; color:#fff; font-weight:bold;">
    © 2022 Copyright: Created By - K.J.M. Perera (UWU/CST/19/041)
</div>
<!-- Copyright -->
</footer>
<!-- Footer -->

</div>
</body>
</html>