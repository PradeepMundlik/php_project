<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 ); 

$insert = false;
$showError = false;
$showAlert = false;
if(isset($_POST['username'])){
    // Create a database connection
    $con = mysqli_connect("localhost", "pradeep", "12345678", "kaustubha");

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];

    if($password==$cpassword){

    $sql = "INSERT INTO `users` (`username`, `email`, `password`, `date`) VALUES ('$username', '$email', '$password', current_timestamp());";
    $result = mysqli_query($con, $sql);
    if($result){
        // echo "Successfully signed up with username=$username and email-id=$email";
        $showAlert = true;
    }
    }
    else{
        $showError = "Passwords do not match";
    }
    
    $con->close();
}
?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.84.0">
      <title>Sample Project</title>
      <style>
         .divider:after,
         .divider:before 
         {
         content: "";
         flex: 1;
         height: 1px;
         background: #eee;
         }
         .h-custom 
         {
         height: calc(100% - 73px);
         }
         @media (max-width: 450px) 
         {
         .h-custom 
         {
         height: 100%;
         }
         }
      </style>
      <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
   <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
      <section class="vh-100">
      <div class="container-fluid h-custom">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
               <img src="download.jpeg"
                  class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

               <form action="index.php" method="POST">
                  <!-- Username input -->
                  <div class="form-outline mb-4">
                     <input type="text" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter Username" name="username" required />
                     <label class="form-label my-1" for="form3Example3">Username</label>
                  </div>
                   <!-- Email input -->
                  <div class="form-outline mb-4">
                     <input type="email" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter e-mail" name="email" required />
                     <label class="form-label my-1" for="form3Example3">Email Id</label>
                  </div>
                  <!-- <div class="form-outline mb-4">
                     <input type="text" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter UserId" name="userid" required />
                     <label class="form-label my-1" for="form3Example3">UserId</label>
                  </div> -->
                  <!-- Password input -->
                  <div class="form-outline mb-3">
                     <input type="password" id="form3Example4" class="form-control form-control-lg"
                        placeholder="Enter password" name="password" required/>
                     <label class="form-label my-1" for="form3Example4">Password</label>
                  </div>
                  <div class="form-outline mb-3">
                     <input type="password" id="form3Example4" class="form-control form-control-lg"
                        placeholder="Re-Enter password" name="cpassword" required/>
                     <label class="form-label my-1" for="form3Example4">Comfirmed Password</label>
                  </div>
                   <div class="text-center text-lg-start pt-2">
                     <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit">Submit</button>
                     <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/createNewAccount" class="link-danger">Create new account</a></p> -->
                  </div> 
               </form>
               
            </div>
         </div>
      </div>
      <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
         <!-- Copyright -->
         <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
         </div>
         <!-- Copyright -->
         <!-- Right -->
         <div>
            <a href="#!" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
            <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
            <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
            <i class="fab fa-linkedin-in"></i>
            </a>
         </div>
         <!-- Right -->
      </div>
   </body>
</html>