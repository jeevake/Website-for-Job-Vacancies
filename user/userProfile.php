<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

   //OPERATION OF THE USER PROFILE BUTTON
   if(array_key_exists('profile', $_POST)) {
    header("Location: userProfile.php");
  }

  //OPERATION OF THE logout BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
  }


  if(loggedin()){

    $username = getfield('login','Username','user_id',$con);

    $user_id = getfield('users','user_id','user_id',$con);

    $query="SELECT * FROM `users` WHERE `user_id`= $user_id";

    if($query_run = mysqli_query($con,$query)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
              $fname = $row['F_name'];
              $lname = $row['L_name'];
              $email = $row['Email'];
              $phone = $row['Phone_number'];
              $address = $row['Address'];
              $gender = $row['Gender'];
              $image = $row['profilepic'];
              $district = $row['District'];
          }


    }else{
        echo 'Error in the query';
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
    <title>JOB WORLD</title>
    <link rel="shortcut icon" href="../images/logo1.png" type="image/x-icon">

     <!-- Link Bootstrap -->

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		
	<!-- End Link Bootstrap -->

</head>
<body>
         <!-- Header -->
         <header>
        <nav class="navbar navbar-expand-sm navbar mb-4 border-bottom fixed-top bg-white shadow" style="position">
            <div class="container">
            <a class="navbar-brand" href="../index.php"> <img src="../images/logo2.png" alt="brand" width="50px" height="50px" > JOB WORLD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-success" href="../postJob.php" >Post a Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../jobOpportunities.php" style="font-weight:bold;">Job Vacancies</a>
                    </li>
                </ul>
                </div>
                <div class='col-md-1 text-end'>
                    
                    <a class="nav-link text-end" href="../contactUs.php">Support</a>
                  
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

      <!-- START OF ROW_1 -->
        <div class="row ">
            <div class="card mt-3 mb-5 shadow" style="margin: 0 auto 0; width: 90%;">
                <div class="card-body">
                <div class="card-header">
                <h5 class="card-title">USER PROFILE</h5>
                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#pd">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#postedJobs">Posted Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#UpdateJobs">UpdateJobs</a>
                    </li>
                </ul>
            </div>
            <form class="card-body tab-content">


                <!-- USER DETAILS -->
                <div class="tab-pane active" id="pd">
                    
                    <div class="row">
                        <div class="col-sm-2 mb-2">

                            <img src="<?php echo $image; ?>" class="rounded-circle mb-2 img-fluid" alt="Cinque Terre" style=" margin: 0 auto 0;">
                            <p class="card-text text-center" style="font-weight:bold;"><?php echo $username; ?></p>
                            
                        </div>

                        <div class="col-sm-10 mb-2">
                            <div class="card-block">
                                <div class="row" style="margin:2% 0 0 5%">
                                    <div class="col-sm-5">
                                        <h6>First Name</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $fname; ?></h6></br>
                                    
                                        <h6 class="m-b-5 f-w-600">Phone</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $phone; ?></h6></br>
                                   
                                        <h6 class="m-b-5 f-w-600">Email</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $email; ?></h6></br>

                                        <a href="updatePersonalDetails.php" class="btn btn-primary">Update Details</a>
                                        <a href="updatePassword.php" class="btn btn-primary">Update Password</a>
                                    </div>

                                    <div class="col-sm-7">
                                        <h6 class="m-b-5 f-w-600">Last Name</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $lname; ?></h6></br>
                                  
                                        <h6 class="m-b-5 f-w-600">Gender</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $gender; ?></h6></br>
                                  
                                        <h6 class="m-b-5 f-w-600">Address</h6>
                                        <h6 class="text-muted f-w-400"><?php echo $address; ?></h6>
                                   
                                    </div>
                                    
                                </div>                              
                            </div>

                                
                        </div> 
                    
                    </div>
                </div>


                <!-- POSTED JOBS BY THE USER -->
                <div class="tab-pane" id="postedJobs">
                <div style="height:400px; padding: 0px;	margin: 0px auto 0px auto; overflow: auto;">
                            <table class="table table-bordered">
                                    <thead class="fixed">
                                        <tr>
                                            <th>Job Position</th>
                                            <th>Job Category</th>
                                            <th>Working Time</th>
                                            <th>Working Hours</th>
                                            <th>Paid Salary</th>
                                            <th>Published Date</th>

                                        </tr>
                                    </thead>   
                                    <tbody>
                                   
                    <?php
  
                        $query_p = "SELECT * FROM jobs WHERE user_id =$user_id ORDER BY published_date DESC;";
                        if($query_run_p = mysqli_query($con,$query_p)){ 
                            while ($row = mysqli_fetch_assoc($query_run_p)){
                                $jobPosition = $row['job_position'];
                                $jobCategory = $row['job_category'];
                                $paidSalary = $row['paid_salary'];
                                $publishedDate = $row['published_date'];
                                $workingTime = $row['working_time'];
                                $workingHours = $row['working_hours'];

                                echo "<tr>
                                    <td>$jobPosition</td>
                                    <td>$jobCategory</td>
                                    <td>$workingTime</td>
                                    <td>$workingHours</td>
                                    <td>Rs.$paidSalary/=</td>
                                    <td>$publishedDate</td>

                                    </tr>";
            
                          }
                      }else{
                        // echo "<script type='text/javascript'>alert('Database Error ');</script>";
                        echo $query_p;
                      }

                    ?>


                       
                            </tbody>
                            
                        </table>
                        </div>
                </div>

                <!-- UPDATE JOBS BY THE USER -->
                <div class="tab-pane" id="UpdateJobs">
                <div style="height:400px; padding: 0px;	margin: 0px auto 0px auto; overflow: auto;">
                            <table class="table table-bordered">
                                    <thead class="fixed">
                                        <tr>
                                            <th>Job Position</th>
                                            <th>Job Category</th>
                                            <th>Published Date</th>
                                            <th>Action Jobs</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                   

                    <?php
  
                        $query_p = "SELECT * FROM jobs WHERE user_id =$user_id ORDER BY published_date DESC;";
                        if($query_run_p = mysqli_query($con,$query_p)){ 
                            while ($row = mysqli_fetch_assoc($query_run_p)){
                                $jobPosition = $row['job_position'];
                                $jobCategory = $row['job_category'];
                                $paidSalary = $row['paid_salary'];
                                $publishedDate = $row['published_date'];
                                $workingTime = $row['working_time'];
                                $workingHours = $row['working_hours'];
                                $status = $row['status'];
                                $job_id = $row['job_id'];

                                echo "<tr>
                                    <td>$jobPosition</td>
                                    <td>$jobCategory</td>
                                    <td>$publishedDate</td>
                                    <td>
                                        <a class='btn btn-primary' href='../individualJob.php?job_id=$job_id'> View </a>
                                        <a class='btn btn-warning' href='updateJobDetails.php?job_id=$job_id'> Update </a>
                                        <a class='btn btn-danger' href='removeJobVacancy.php?job_id=$job_id'> Remove </a>
                                    </td>

                                    <td>$status</td>                                   

                                    </tr>";
            
                          }
                      }else{
                        // echo "<script type='text/javascript'>alert('Database Error ');</script>";
                        echo $query_p;
                      }

                    ?>
                            </tbody>
                            
                        </table>
                        </div>
                </div>
                
            </form>

                </div>
            </div>
        <div>

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
            <img src="../images/logo2.png" alt="brand" width="70vw" height="70vw" > JOB WORLD</a>
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
            <a href="../login.php" class="text-reset">Sign in</a>
        </p>
        <p>
            <a href="../userRegistration.php" class="text-reset">Sign Up</a>
        </p>
        <p>
            <a href="../jobOpportunities.php" class="text-reset">Job Vacancies</a>
        </p>
        <p>
            <a href="../postJob.php" class="text-reset">Post a Job</a>
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