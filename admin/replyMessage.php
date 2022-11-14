<?php

require '../core.php';
require '../database_connector.php';
require '../functions.php';

  //OPERATION OF THE logout BUTTON
  if(array_key_exists('logout', $_POST)) {
    header("Location: ../logout.php");
  }

 

  if(isset($_GET['id'])){
    $msg_id =  $_GET['id'];
  }else{
    header("Location: userMessages.php");
  }


  if(loggedin()){
    if(isset($_POST['submitReply'])){

        if(isset($_POST['reply'])&&
        isset($_POST['name'])&&
        isset($_POST['message'])&&
        isset($_POST['email'])){
    
            $reply =  $_POST['reply'];
            $email =  $_POST['email'];
            $userMessage =  $_POST['message'];
            $name =  $_POST['name'];
           
    
            if(!empty($reply)&&!empty($email)&&!empty($userMessage)&&!empty($name)){
        
                        //INSERTING VALUES TO THE MESSAGE TABLE
                        $query = "UPDATE `message` SET reply = '".mysqli_real_escape_string($con,$reply)."' WHERE msg_id='$msg_id'";
    
                        if($query_run = mysqli_query($con,$query)){
                                        
                                $subject = "Reply for your message\r\n";
                                $message = "Hi,$name \r\nThank you for contacting us.    \r\nYour question: $userMessage \r\nOur reply:$reply";
                                $sender = "From: jobworld782@gmail.com";
                                
                                
                                if(mail($email, $subject, $message, $sender)){
                                    echo "<script type='text/javascript'>location='userMessages.php';</script>";
                                }else{
                                    echo "<script type='text/javascript'>alert('Unsuccess');location='userMessages.php';</script>";
                                }
  
            
                        }else{
                            echo "Plz register again";
                            echo $query;
            
                        }
    
        }else{
            echo "All fields are required";
        }
    
        }else{
            echo "not set";
        }
      }else{
        // echo "not submitted";
      }
    

  }else{
    // header("Location: ../index.php");
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
    <link rel="stylesheet" href="adminStyle.css" type="text/css">
		
	<!-- End Link Bootstrap -->

</head>
<body>
         <!-- Header -->
         <header>
        <nav class="navbar navbar-expand-sm navbar mb-4 border-bottom bg-white shadow" style="position">
            <div class="container">
                <a class="navbar-brand" href="adminPanel.php"><img src="../images/logo2.png" alt="brand" width="50px" height="50px" >Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="registeredUsers.php">Registered Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allPostedVacancies.php" >Posted Job Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn"  href="userMessages.php" style="color:#fff; background-color:#3E3EB0;">User Messages</a>
                        </li>
                    </ul>
                </div>

                <div class='col-md-1 text-end'>
                            <form method='post'>
                            <input class='btn btn-primary' type='submit' name='logout' class='button' value='Logout' />
                        </form>
                </div>

            </div>
        </nav>
        </header>

      <!-- End of Header -->
      <div class="container" style="margin-top:7%;">





            <div class="card shadow" style="width: 50%; margin:0 auto 0;">
            <div class="card-header"><b>USER MESSAGES</b></div>
               
                <div class="card-body">

                                   

                    <?php
  
                        $query_u = "SELECT * FROM message WHERE msg_id=$msg_id;";
                        if($query_run_u = mysqli_query($con,$query_u)){ 
                            while ($row = mysqli_fetch_assoc($query_run_u)){
                                $name = $row['name'];
                                $email = $row['email'];
                                $message = $row['message'];
                                $date = $row['date'];

                                    ?>

                                                <form action="replyMessage.php?id=<?php echo $msg_id; ?>" method="POST" autocomplete="off">
                                                <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="name" class="form-control" name="name" id="name" aria-describedby="name" value="<?php echo $name; ?>" READONLY>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email address</label>
                                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="email" value="<?php echo $email; ?>" READONLY>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message" class="form-label">Message</label>
                                                        <input type="message" class="form-control" name="message" id="message" aria-describedby="message" value="<?php echo $message; ?>" READONLY>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="reply" class="form-label">Reply Message</label>
                                                        <input type="reply" class="form-control" name="reply" id="reply" aria-describedby="reply" value="">
                                                    </div>
                                                    <button type="submit" name="submitReply" class="btn btn-primary">Submit</button>
                                                </form>
                                        <?php
                        }   

                      }else{
                        // echo "<script type='text/javascript'>alert('Database Error ');</script>";
                        echo $query_p;
                      }

                    ?>


                    </div>
                </div>
            </div>
        </div>

</div>
</body>
</html>