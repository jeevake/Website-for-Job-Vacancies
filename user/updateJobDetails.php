<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

  //OPERATION OF THE logout BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
  }

  //OPERATION OF THE USER PROFILE BUTTON
  if(array_key_exists('profile', $_POST)) {
    header("Location: userProfile.php");
  }

  /*--- IF THE USER NOT LOG IN ---*/
if(loggedin()){

$job_id=$_GET['job_id'];
   
if(isset($_GET['job_id'])){

    
    $query1="SELECT * FROM `jobs` WHERE `job_id`= $job_id";

    if($query_run = mysqli_query($con,$query1)){

            /*  FETCHING THE DATA FROM THE DATABASE */ 
          while ($row = mysqli_fetch_assoc($query_run)){
            $jobPosition = $row['job_position'];
            $jobCategory = $row['job_category'];
            $workingTime = $row['working_time'];
            $workingHours = $row['working_hours'];
            $paidSalary = $row['paid_salary'];
            $lookingFor = $row['lookingFor'];
            $jobProfile = $row['job_profile'];
            $gender = $row['gender'];
            $experienceQualifications = $row['experience_qualifications'];
            $district = $row['district'];
            $address = $row['address'];
            $publishedBy = $row['published_by'];
            $email = $row['email'];
            $phone = $row['phone'];
            $publishedDate = $row['published_date'];

          }

    }else{
        echo 'Error in the query';
    }
}

if (isset($_POST["submit"])) {
    if( isset($_POST['jobPosition'])&&
    isset($_POST['jobCategory'])&&
    isset($_POST['workingHours'])&&
    isset($_POST['time'])&&
    isset($_POST['gender'])&&
    isset($_POST['salary'])&&
    isset($_POST['lookingFor'])&&
    isset($_POST['job_profile'])&&
    isset($_POST['experience_qualifications'])&&
    isset($_POST['district'])&&
    isset($_POST['address'])&&
    isset($_POST['publishedBy'])&&
    isset($_POST['email'])&&
    isset($_POST['phone'])&&
    isset($_POST['publishedDate'])){

        $jobPosition = $_POST['jobPosition'];
        $jobCategory = $_POST['jobCategory'];
        $workingHours = $_POST['workingHours'];
        $workingTime = $_POST['time'];
        $gender = $_POST['gender'];
        $paidSalary = $_POST['salary'];
        $lookingFor = $_POST['lookingFor'];
        $jobProfile = $_POST['job_profile'];
        $experienceQualifications = $_POST['experience_qualifications'];
        $district = $_POST['district'];
        $address = $_POST['address'];
        $publishedBy = $_POST['publishedBy'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $publishedDate = $_POST['publishedDate'];
       
        if(!empty($jobPosition)&&!empty($jobCategory)&&!empty($workingHours)&&!empty($workingTime)&&!empty($gender)&&!empty($paidSalary)&&!empty($lookingFor)&&!empty($jobProfile)&&!empty($experienceQualifications)&&!empty($district)&&!empty($address)&&!empty($publishedBy)&&!empty($email)&&!empty($phone)&&!empty($publishedDate)){

            //INSERTING VALUES TO THE JOBS TABLE
            $query = "UPDATE jobs SET job_position ='".mysqli_real_escape_string($con,$jobPosition)."',job_category ='".mysqli_real_escape_string($con,$jobCategory)."',gender ='".mysqli_real_escape_string($con,$gender)."',working_time ='".mysqli_real_escape_string($con,$workingTime)."',working_hours ='".mysqli_real_escape_string($con,$workingHours)."',paid_salary ='".mysqli_real_escape_string($con,$paidSalary)."',lookingFor ='".mysqli_real_escape_string($con,$lookingFor)."',job_profile ='".mysqli_real_escape_string($con,$jobProfile)."',experience_qualifications ='".mysqli_real_escape_string($con,$experienceQualifications)."',district ='".mysqli_real_escape_string($con,$district)."',address ='".mysqli_real_escape_string($con,$address)."',published_by ='".mysqli_real_escape_string($con,$publishedBy)."',email ='".mysqli_real_escape_string($con,$email)."',phone ='".mysqli_real_escape_string($con,$phone)."',published_date ='".mysqli_real_escape_string($con,$publishedDate)."'WHERE job_id=$job_id";


            if($query_run = mysqli_query($con,$query)){
                                        
                $message = "Successful";
                echo "<script type='text/javascript'>alert('$message');location='userProfile.php';</script>";        

            }else{
                echo "Plz register again";
                echo $query;

            }

        }else{
            echo "All fields are required";
        }

    }else{
        echo "Not set";
    }
}


}
/*--- IF THE USER LOG IN ---*/
else if(!loggedin()){
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
            <p class="h2 text-center">UPDATE THE JOB VACANCY </p>
            <div class="card mt-3 mb-5 shadow" style="margin: 0 auto 0; width: 70%;">
                <div class="card-body">
                <form action="updateJobDetails.php?job_id=<?php echo $job_id; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="jobPosition" class="form-label">Job Position</label>
                                        <input class="form-control" id="jobPosition" aria-describedby="jobPosition" type="text" name="jobPosition" placeholder="jobPosition" value="<?php echo $jobPosition; ?>" required READONLY>
                                    </div>
                                </div>
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="jobCategory" class="form-label">Job Category</label>
                                        <select class="form-select" name="jobCategory" >
                                        <option value="<?php echo $jobCategory ?>" selected ><?php echo $jobCategory ?></option>
                                            <option value="Administration, business and management">Administration, business and management</option>
                                            <option value="Alternative therapies">Alternative therapies</option>
                                            <option value="Animals, land and environment">Animals, land and environment</option>
                                            <option value="Computing and ICT">Computing and ICT</option>
                                            <option value="Construction and building">Construction and building</option>
                                            <option value="Design, arts and crafts">Design, arts and crafts</option>
                                            <option value="Education and training">Education and training</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Facilities and property services">Facilities and property services</option>
                                            <option value="Financial services">Financial services</option>
                                            <option value="Garage services">Garage services</option>
                                            <option value="Hairdressing and beauty">Hairdressing and beauty</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Heritage, culture and libraries">Heritage, culture and libraries</option>
                                            <option value="Hospitality, catering and tourism">Hospitality, catering and tourism</option>
                                            <option value="Languages">Languages</option>
                                            <option value="Legal and court services">Legal and court services</option>
                                            <option value="Manufacturing and production">Manufacturing and production</option>
                                            <option value="Performing arts and media">Performing arts and media</option>
                                            <option value="Print and publishing, marketing and advertising">Print and publishing, marketing and advertising</option>
                                            <option value="Retail and customer services">Retail and customer services</option>
                                            <option value="Science, mathematics and statistics">Science, mathematics and statistics</option>
                                            <option value="Security, uniformed and protective services">Security, uniformed and protective services</option>
                                            <option value="Social sciences and religion">Social sciences and religion</option>
                                            <option value="Social work and caring services">Social work and caring services</option>
                                            <option value="Sport and leisure">Sport and leisure</option>
                                            <option value="Transport, distribution and logistics">Transport, distribution and logistics</option>
                                        </select>
                                    </div>
                                </div>
                        </div>  

                        <div class="row">
                               
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Working Hours</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="time" id="partTime" value="Part-Time" checked>
                                            <label class="form-check-label" for="partTime">Part-time</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="fullTime" name="time" value="Full-Time">
                                            <label class="form-check-label" for="fullTime">Full-time</label>
                                        </div>
                                        
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" id="workingHours" aria-describedby="workingHours" type="text" name="workingHours" placeholder="8:00 p.m. - 5:00 p.m. " value="<?php if(isset($workingHours)){ echo $workingHours; } ?>" required>
                                    </div>
                                    
                                </div>



                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <div class="form-check form-check-inline">

                                    <?php if($gender=="Male"){
                                        echo "<input class='form-check-input' type='radio' name='gender' id='male' value='Male' checked>";
                                    }else{
                                        echo "<input class='form-check-input' type='radio' name='gender' id='male' value='Male'>";
                                    }  ?>
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">

                                    <?php if($gender=="Female"){
                                        echo '<input class="form-check-input" type="radio" id="female" name="gender" value="Female" checked>';
                                    }else{
                                        echo '<input class="form-check-input" type="radio" id="female" name="gender" value="Female">';
                                    }  ?>

                                        
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>

                                    <div class="form-check form-check-inline">

                                    <?php if($gender=="Gender Neutral"){
                                        echo '<input class="form-check-input" type="radio" id="genderNeutral" name="gender" value="Gender Neutral" checked>';
                                    }else{
                                        echo '<input class="form-check-input" type="radio" id="genderNeutral" name="gender" value="Gender Neutral">';
                                    }  ?>

                                        <label class="form-check-label" for="genderNeutral">Gender-neutral</label>
                                    </div>
                                    </div>
                                </div>


                            </div>  
                            <div class="col-md-3 ">
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Paid Salary</label>
                                        <input class="form-control" id="salary" aria-describedby="salary" type="text" name="salary" placeholder="50000 " value="<?php if(isset($paidSalary)){ echo $paidSalary; } ?>" required>
                                    </div>
                            </div>

                        <div class="mb-3">
                                <label for="lookingFor" class="form-label">Who are you looking for</label>
                                <textarea type="lookingFor" rows="3" name="lookingFor" id="lookingFor" class="form-control" maxlength="200" placeholder="We are looking for ..." value="" required><?php if(isset($lookingFor)){ echo $lookingFor; } ?></textarea>
                        </div>

                        <div class="mb-3">
                                <label for="job_profile" class="form-label">Job Profile</label>
                                <textarea type="job_profile" rows="5" name="job_profile" id="job_profile" class="form-control" value="" required><?php if(isset($jobProfile)){ echo $jobProfile; } ?></textarea>
                        </div>

                        <div class="mb-3">
                                <label for="experience_qualifications" class="form-label">Experience and Qualifications</label>
                                <textarea type="experience_qualifications" rows="5" name="experience_qualifications" id="experience_qualifications" class="form-control" value="" required><?php if(isset($experienceQualifications)){ echo $experienceQualifications; } ?></textarea>
                        </div>

                            <div class="row">
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                    <label for="district" class="form-label">Select District :</label>
                                        <select class="form-select" name="district">
                                            <option value="<?php echo $district ?>" selected><?php echo $district ?></option>
                                            <option value="Gampaha">Gampaha</option>
                                            <option value="Colombo">Colombo</option>
                                            <option value="Kalutara">Kalutara</option>
                                            <option value="Anuradhapura">Anuradhapura</option>
                                            <option value="Polonnaruwa">Polonnaruwa</option>
                                            <option value="Matale">Matale</option>
                                            <option value="Kandy">Kandy</option>
                                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                                            <option value="Puttalam">Puttalam</option>
                                            <option value="Kurunegala">Kurunegala</option>
                                            <option value="Kegalle">Kegalle</option>
                                            <option value="Ratnapura">Ratnapura</option>
                                            <option value="Jaffna">Jaffna</option>
                                            <option value="Kilinochchi">Kilinochchi</option>
                                            <option value="Mannar">Mannar</option>
                                            <option value="Mullaitivu">Mullaitivu</option>
                                            <option value="Vavuniya">Vavuniya</option>
                                            <option value="Trincomalee">Trincomalee</option>
                                            <option value="Batticaloa">Batticaloa</option>
                                            <option value="Ampara">Ampara</option>
                                            <option value="Badulla">Badulla</option>
                                            <option value="Monaragala">Monaragala</option>
                                            <option value="Hambantota">Hambantota</option>
                                            <option value="Matara">Matara</option>
                                            <option value="Galle">Galle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea type="address" rows="2" name="address" id="address" class="form-control" value="" required><?php if(isset($address)){ echo $address; } ?></textarea>
                                </div>
                                </div>
                            </div>  
                           

                            <div class="row">

                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="publishedBy" class="form-label">Published By</label>
                                        <input class="form-control" id="publishedBy" aria-describedby="publishedBy" type="text" name="publishedBy" placeholder="" value="<?php if(isset($publishedBy)){ echo $publishedBy; } ?>" required>
                                    </div>
                               </div>
                               
                               <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="<?php if(isset($email)){ echo $email; } ?>" required>
                                    </div>   
                               </div>

                               
                           </div>  

                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Mobile No</label>
                                        <input type="text" class="form-control" id="phone" placeholder="mobile number" aria-describedby="phone" type="tel" placeholder="0713456789" pattern="[0-9]{10}" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="mb-3">
                                        <label for="publishedDate" class="form-label">Published Date</label>
                                        <input class="form-control" id="publishedDate" aria-describedby="publishedDate" type="text" name="publishedDate" value="<?php echo $publishedDate;  ?>" required READONLY>
                                    </div>
                                </div>
                            </div>
      
                    <input type="submit" name="submit" class="btn btn-primary btn-main mb-3 mt-3" value="Update">
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