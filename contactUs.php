<?php

require 'core.php';
require 'database_connector.php';
require 'functions.php';

  //OPERATION OF THE SIGN-UP BUTTON
  if(array_key_exists('signup', $_POST)) {
    header("Location: userRegistration.php");
  }

   //OPERATION OF THE LOGIN BUTTON
   if(array_key_exists('login', $_POST)) {
    header("Location: login.php");
  }

  //OPERATION OF THE logout BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: logout.php");
  }

  //OPERATION OF THE USER PROFILE BUTTON
  if(array_key_exists('profile', $_POST)) {
    header("Location: user/userProfile.php");
  }

  if(isset($_POST['submit'])){

    if(isset($_POST['name'])&&
    isset($_POST['email'])&&
    isset($_POST['message'])){

        $name =  $_POST['name'];
        $email =  $_POST['email'];
        $message =  $_POST['message'];

    if(!empty($name)&&!empty($email)&&!empty($message)){
    
                    //INSERTING VALUES TO THE MESSAGE TABLE
                    $query2 = "INSERT INTO `message` VALUES (NULL,'".mysqli_real_escape_string($con,$name)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$message)."','".mysqli_real_escape_string($con,date('Y-m-d'))."',NULL)";


                   mysqli_query($con,$query2);
                   $message = "Message sent successfully";
                   echo "<script type='text/javascript'>alert('$message');location='ContactUs.php';</script>";

    }else{
        echo "All fields are required";
    }

    }
  }else{
    // echo "not submitted";
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB WORLD</title>

     <!-- Link Bootstrap -->

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="images/logo1.png" type="image/x-icon">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		
	<!-- End Link Bootstrap -->

</head>
<body>
         <!-- Header -->
         <header>
        <nav class="navbar navbar-expand-sm navbar mb-4 border-bottom fixed-top bg-white shadow" style="position">
            <div class="container">
                <a class="navbar-brand" href="index.php"> <img src="images/logo2.png" alt="brand" width="50px" height="50px"> JOB WORLD</a>
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
                    
                    <a class="nav-link text-end" href="#">Support</a>
                  
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
     

      <div class="container bg-ghoustwhite" style="margin-top:5%;">
  <div class="row ">
    

    <div class="col-md">
      <div class="card text-dark bg-white mb-3 shadow-crd shadow p-3" >
        
        <div class="card-body">
          <h5 class="card-title">Contact Us</h5>
          <p>Do you have any questions about Job World? Send your questions now.</p>
         
          <p>Click any of the links below to talk to us!.</p>
        

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
        
        <div class="tab-pane fade show active p-3" id="nav-petowner" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

            <form action="contactUs.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        
                    <div class="row">
                        <div class="col-md mt-3">
                            <div class="mb-3">
                                <label for="username" class="form-label">Name</label>
                                <input class="form-control" id="name" aria-describedby="name" type="text" name="name" placeholder="name " value="<?php if(isset($name)){ echo $name; } ?>" required>
                            </div>
                        </div>     
                        <div class="col-md mt-3">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php if(isset($email)){ echo $email; } ?>" required>
                            </div>
                        </div>    
                    </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Your Message</label>
                                <textarea type="address" rows="2" name="message" id="message" class="form-control" value="<?php if(isset($message)){ echo $message; } ?>" required></textarea>
                            </div>
 
            
              <input type="submit" name ="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Submit">

              <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-3" style="border-radius:30px" value="Reset">
              
            </form>
          </div>
         
     
      </div>
    </div>

    <div class="col-md">
      <div class="card text-dark bg-white mb-3 shadow-crd shadow p-1" >
        
        <div class="card-body" >
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126670.33587780868!2d79.78821309712316!3d7.189613451613786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2ee9c6bb2f73b%3A0xa51626e908186f3e!2sNegombo!5e0!3m2!1sen!2slk!4v1662657344496!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
        </div>
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