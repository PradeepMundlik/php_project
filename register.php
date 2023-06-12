
<?php
require_once "config.php";

error_reporting( E_ALL );
ini_set( "display_errors", 1 ); 

$username = $password = $confirm_password = $email = $gender = $address = $zip = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    
    
    // Check for password
    if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}
// print_r($_POST);
echo $_POST['confirm_password'];
echo $username_err;
echo $password_err;
echo $confirm_password_err;


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO `users` ( `username`, `email`, `address`, `gender`, `password`, `zip`) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_prepare($conn, $sql);
    // echo $stmt;
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $email, $address, $gender, $param_password ,$zip);
        
        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $gender = trim($_POST['gender']);
        $zip = trim($_POST['zip']);
        echo $param_password;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
else{
    echo $username_err." ".$password_err." ".$confirm_password_err."<br>";
}
mysqli_close($conn);
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
    <title>Registration Page</title>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100">
        <!-- <div class="container-fluid h-custom"> -->
        <!-- <div class="row d-flex justify-content-center align-items-center h-100"> -->
        <div class="col-md-9 col-lg-6 col-xl-5">
            <!-- <h1 class='px-5'>Create New Account</h1> <br> -->
            <img src="download.jpeg" class="img-fluid" alt="Sample image">
        </div>

        <div class="container mt-2">
            <h3>Please Register Here:</h3>
            <hr>
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Username</label>
                        <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Username" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="text" class="form-control" name="email" id="inputEmail4" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="Confirm Password" required>
                    </div>
                        <br>
                    <div class="container">
                    <p>Gender:</p>
                        <input type="radio" value="M" name="gender">
                        <label for="inputAddress2">Male</label>
                        <input type="radio"   value="F" name="gender">
                        <label for="inputAddress2">Female</label>
                        <input type="radio"   value="O" name="gender">
                        <label for="inputAddress2">Other</label>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inputAddress2">Address</label>
                        <input type="text" class="form-control" id="inputAddress2" name="address" placeholder="Apartment, studio, or floor">
                    </div>
                    <!-- <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select> -->
                    <!-- </div> -->
                    <div class="form-group col-md-6">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip" name="zip">
                    </div>
                    <!-- </div> -->
                    <button type="submit" class="btn btn-primary mt-2 py-2">Sign in</button>
            </form>
        </div>

        <!-- </div> -->
        <!-- </div> -->
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between mt-2 py-4 px-4 px-xl-5 bg-primary">
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>