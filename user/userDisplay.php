<?php

require '../database_connector.php';
require '../functions.php';


  //OPERATION OF THE SIGN-UP BUTTON
  if(array_key_exists('signup', $_POST)) {
    header("Location:../userRegistration.php");
  }

   //OPERATION OF THE LOGIN BUTTON
   if(array_key_exists('login', $_POST)) {
    header("Location: ../login.php");
  }


/*--- IF THE USER NOT LOG IN ---*/
if(!loggedin()){
    

    if( isset($_POST['username'])&&
        isset($_POST['password'])&&
        isset($_POST['password_again'])&&
        isset($_POST['firstname'])&&
        isset($_POST['lastname'])&&
        isset($_POST['gender'])&&
        isset($_POST['email'])&&
        isset($_POST['phone'])&&
        isset($_POST['district'])&&
        isset($_POST['address'])&&
        isset($_FILES['propic'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_again = $_POST['password_again'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $district = $_POST['district'];
            $image = $_FILES['propic'];

            $imagefilename = $image['name'];
            $imagefileerror = $image['error'];
            $imagefiletemp = $image['tmp_name'];
            $filename_separate = explode('.',$imagefilename);
            $file_extension = strtolower(end($filename_separate));
            
           
            $upload_images = 'userpics/'.$imagefilename;
            move_uploaded_file($imagefiletemp,$upload_images);

        

        /*--- ENCRYPTING THE PASSWORD ---*/
        $password_hash = md5($password);

        if(!empty($username)&&!empty($password)&&!empty($password_again)&&!empty($firstname)&&!empty($lastname)&&!empty($gender)&&!empty($email)&&!empty($phone)&&!empty($address)&&!empty($district)&&!empty($upload_images)){

            /*--- CHECKING THE MAXIMUM LENGTH ---*/
            if(strlen($username)>30||strlen($firstname)>20||strlen($lastname)>20||strlen($phone)>10){
                echo 'Please look to maxlength of fields';
            }else{  
                
                if ($password!=$password_again){
                    echo 'Passwords do not match';
                }else{

                    /*--- CHECKING USERNAME DUPLICATION ---*/
                    $query = "SELECT `Username` FROM `login` WHERE `Username`='$username'";
                    $query_run = mysqli_query($con,$query);

                    if (mysqli_num_rows($query_run)==1){
                        echo 'The username '.$username.' already exists.';
                    }else{

                        //INSERTING VALUES TO THE PETOWNER TABLE
                        $query2 = "INSERT INTO `users` VALUES (NULL,'".mysqli_real_escape_string($con,$phone)."','".mysqli_real_escape_string($con,$district)."','".mysqli_real_escape_string($con,$firstname)."','".mysqli_real_escape_string($con,$lastname)."','".mysqli_real_escape_string($con,$gender)."','".mysqli_real_escape_string($con,$address)."','".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$upload_images)."')";

                        //INSERTING VALUES TO THE LOGIN TABLE
                        $query3 = "INSERT INTO `login` VALUES (NULL,'".mysqli_real_escape_string($con,$username)."','".mysqli_real_escape_string($con,$password_hash)."')";

                        if(($query_run2 = mysqli_query($con,$query2))&&($query_run3 = mysqli_query($con,$query3))){
                          
                          
                            $subject = "JOB WORLD Registration";
                            $message = "Hi $username, \n Thank you for registering with JOB WORLD. Registration successful.";
                            $sender = "From: jeevakeperera@gmail.com";
                            
                                if(mail($email, $subject, $message, $sender)){
                                    // echo "<script type='text/javascript'>alert('success');location='registration.php';</script>";
                                    // exit();
                                }else{
                                    echo "<script type='text/javascript'>alert('Unsuccessful, Please enter a valid Email');location='../userRegistration.php';</script>";
                                }
                            

                        }else{
                            echo "Plz register again";
                            echo $query2;
                        }
                    }
                }
            }

        }else{
            echo "All fields are required";
        }
    }

}

/*--- IF THE USER LOG IN ---*/
else if(loggedin()){
//   echo 'Already registed user'; 
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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
      <div class="container" style="margin-top:10%;">

        <div class="card shadow" style="margin: 0 auto 5%; width:50%">
            <h5 class="card-header text-center">Registration Confirmation</h5>
            <div class="card-body">
                <p class="card-text">Hi <?php echo $username; ?>,</p>
                <p class="card-text">You have successfully registered on JOB WORLD</p>
                <p class="card-text">Thank you.</p>
                <p class="card-text"><a href="../login.php" class="link-primary">Log in</a></p>


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