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

//    //OPERATION OF THE LOGIN BUTTON
//    if(array_key_exists('login', $_POST)) {
//     header("Location: login.php");
//   }

if(isset($_GET['job_category'])){

    //ASSIGNING THE JOB CATEGORY TO THE VARIABLE
    $job_category=$_GET['job_category'];
   
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
    <link rel="shortcut icon" href="images/logo1.png" type="image/x-icon">

     <!-- Link Bootstrap -->

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
		
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

      <div class="card shadow bg-dark text-white" style="width: 25%;">
            <div class="card-body">
                <h5 class="card-title">Filter by District</h5>

                <?php
                        $query2="SELECT DISTINCT `district` FROM `jobs` WHERE job_category = '$job_category'";
                        if($query_run2 = mysqli_query($con,$query2)){  ?>

                        <form action="selectJob.php?job_category=<?php echo $job_category;?>" method="POST" style="width:100%">
                        <div class="row">
                   
                          <div class="col-md-8">

                            <!-- FETCHING THE DATA FROM THE DATABASE -->
                            <SELECT class="form-select" name="district" style="width:100%;" >
                            <option value='all'> Select district </option>
                            <?php  while ($row = mysqli_fetch_assoc($query_run2)){ 
                                      $s_district = $row['district'];
                            
                                      echo  "<option value='$s_district'> $s_district </option>";
                                    }  
                             ?>

                            </SELECT>
                          </div>

                          <div class="col-md-4">
                            <input class="btn btn-light" type="submit" name="submit" value="Search" >
                          </div> 
                        </div>

                        </form>
                        <?php

                        }else{
                        echo 'Error in the query';
                        }
                    ?>  

            </div>
        </div>

      <p class="h1 text-center mt-3 mb-4"><?php echo $job_category; ?></p>


            <?php

            //FILTER SECTION

             if (isset($_POST["submit"])) {

                $selected_district = $_POST['district'];
                $query="SELECT * FROM `jobs` WHERE `job_category`= '$job_category' AND district = '$selected_district' AND status='active' ORDER BY published_date DESC";;

                if($selected_district=='all'){
                $query="SELECT * FROM `jobs` WHERE `job_category`= '$job_category' AND status='active'  ORDER BY published_date DESC";}

              }else{
                $query="SELECT * FROM `jobs` WHERE `job_category`= '$job_category' AND status='active'  ORDER BY published_date DESC";
              }
            
              //END OF FILTER SECTION

            if($query_run = mysqli_query($con,$query)){ 
                while ($row = mysqli_fetch_assoc($query_run)){
                    $jobPosition = $row['job_position'];
                    $workingTime = $row['working_time'];
                    $lookingFor = $row['lookingFor'];
                    $publishedBy = $row['published_by'];
                    $publishedDate = $row['published_date'];
                    $address = $row['address'];
                    $district = $row['district'];
                    $job_id = $row['job_id'];              
                    ?>
           
                <div class="col-sm-12" style="position:realtive; float:left; margin:0 auto 2%; width: 100%">
                    <div class="card mb-3 shadow" style="background-image: linear-gradient(to right,rgba(157,202,241,0.5), rgba(255,0,0,0) );">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                               
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <h5 class="card-title" style="font-weight:bold;"><?php echo $jobPosition; ?></h5>
                                            <h6 class="card-title" style="font-style:italic;"><?php echo $lookingFor; ?> </h6>
                                            <!-- <h6 class="card-title d-flex justify-content-sm-end" style="font-style:italic;"> <?php echo "<i class='fas fa-map-marker-alt'></i>&nbsp;".$district; ?> </h6> -->
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="row "> <h6 class="card-title" style="font-style:italic;"><?php echo $workingTime; ?> </h6></div>
                                            <form method='post' action="individualJob.php?job_id='<?php echo $job_id; ?>'">
                                                <input class='btn btn-outline-primary me-2' type='submit' class='button' value='View Job' />
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row" style="margin:1% 0 0 0;">
                                        <div class="col-sm-6">
                                            <p class="card-text bottom"><i class='fas fa-id-badge'></i>&nbsp<?php echo "Published By - ".$publishedBy." on ".$publishedDate ; ?></p>
                                        </div>

                                        <div class="col-sm-6 ">
                                         
                                            <h6 class="card-title d-flex justify-content-sm-end" style="font-style:italic;"> <?php echo "<i class='fas fa-map-marker-alt'></i>&nbsp;".$address; ?> </h6>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <?php
              }
          }else{
            echo "<script type='text/javascript'>alert('Database Error ');</script>";

          }

          ?>
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