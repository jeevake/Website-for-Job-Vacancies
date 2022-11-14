<?php 

 //OPERATION OF THE SIGNUP BUTTON
 if(array_key_exists('signup', $_POST)) {
    header("Location: userRegistration.php");
  }

require 'core.php';
require 'database_connector.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    $generatedString = generateRandomString($length = 10);

    $password_hash = md5($generatedString);


    
    if(!empty($email)){


        //QUERY TO CHECK THE USER LOGIN DETAILS
        $query_u="SELECT `user_id` FROM `users` WHERE `Email`= '$email'";


        //CHECKING THE USER LOGIN DETAILS
        if($query_run_u = mysqli_query($con,$query_u)){
         $query_num_rows_u = mysqli_num_rows($query_run_u);

            if($query_num_rows_u==0){

                echo "<script type='text/javascript'>alert('No such registered Email');</script>";
 
            }
            
            else if($query_num_rows_u==1){

                /*  FETCHING THE DATA FROM THE DATABASE */ 
              while ($row = mysqli_fetch_assoc($query_run_u)){
                  $id = $row['user_id'];
                  
                    $query_insert = "UPDATE login SET Password = '".mysqli_real_escape_string($con,$password_hash)."' WHERE user_id = $id";
                    $query_run_insert = mysqli_query($con,$query_insert);


                    $message = "Your verification code is:  $generatedString \nUse the above verification code to log in.";
                    $subject = "Veification code";
                    $sender = "From: jobworld782@gmail.com";
                    
                    
                    if(mail($email, $subject, $message, $sender)){
                        header("Location: login.php");
                    }else{
                        echo "<script type='text/javascript'>alert('Unsuccess');</script>";
                    }

                header("Location: index.php");
              }
            }            

        }else{
            echo 'Error in the query';
        }

    }else{
      echo "<script type='text/javascript'>alert('Fill all the fields');</script>";
    }

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

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		
	<!-- End Link Bootstrap -->

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
                </ul>
                </div>
                <div class="col-md-1 text-end">
                    <form method='post'>
                    <input class='btn btn-outline-primary me-2' type='submit' name='login' class='button' value='Login' />
                   </form>
                </div>

                <div class="col-md-1 text-end">
                    <form method='post'>
                    <input class='btn btn-primary' type='submit' name='signup' class='button' value='Sign-up' />
                   </form>
                </div>
                
            </div>
        </nav>
        </header>

      <!-- End of Header -->
      <div class="container" style="margin-top:5%;">

      <!-- START OF ROW_1 -->
        <div class="row ">
            <p class="h2 text-center">Recover Password</p>
            <div class="card mt-3 mb-5 shadow" style="margin: 0 auto 0; width: 40%;">
                <div class="card-body">
                <form action="recoverPassword.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <label class="mt-3" for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="email">
                <div id="emailHelp" class="form-text">Enter your registered email address</div>
             </div>
            <input type="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Send Code">
            <input type="reset" class="btn btn-secondary mb-3 mt-3 ms-1" style="border-radius:30px" value="Reset">
            </form>

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

<script>
  function showhide() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>