<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_POST['register'])){
        // passing data received from user into variable
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Preventing SQL Injection
        $username = mysqli_real_escape_string($conn, $username);
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $password2 = mysqli_real_escape_string($conn, $password2);

        // Hashing the password provided by the user and storing it into a new variable $newpassword
        $newpassword = password_hash($password, PASSWORD_DEFAULT);

        // Form Validation 
        if(empty($username) || empty($fullname) || empty($email) || empty($password) || empty($password2)){
            $_SESSION['WarningMessage'] = "All fields are Required";
        }
        elseif ($password != $password2) {
            $_SESSION['ErrorMessage'] = "Both password did not match";
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $fullname)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the full name field";
        }else{
            // Check if username already exist in database
            $sql = "SELECT * FROM tbluser WHERE username = '$username'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                $_SESSION['ErrorMessage'] = "Username is currently not available";
            }
            else{
                // Check if email already exist in database
                $sql = "SELECT * FROM tbluser WHERE email = '$email'";
                $query_result = mysqli_query($conn, $sql);
                $result = mysqli_num_rows($query_result);
                if($result > 0){
                    $_SESSION['ErrorMessage'] = "Email address already taken";
                }
                else{
                    // it stores the data's into the database
                    $sql = "INSERT INTO tbluser (username,fullname,email,phone,gender,address,password,usertype) VALUES('$username','$fullname','$email','','','','$newpassword','User')";
                    $query_result = mysqli_query($conn, $sql);
                    if ($query_result){
                        $_SESSION['SuccessMessage'] = "Account has been created successfully";
                    }else{
                        $_SESSION['ErrorMessage'] = "Failed to create account";
                    }
                }
            }

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Private Diary - Registration</title>
    <!-- CSS Files -->
    <?php require_once('./includes/js.php') ?>
    <link rel="stylesheet" href="./css/css/fonts.min.css">
    <link rel="stylesheet" href="./css/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/css/atlantis.css">
    <link rel="stylesheet" href="./css/css/atlong.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn" style="display: block;">
            <h3 class="text-center">Create Account!</h3>
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                echo WarningMessage();
            ?>
            <form action="register.php" method="POST">
                <div class="login-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input  name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="username">Full Name</label>
                        <input  name="fullname" type="text" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input  name="email" type="text" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password">Retype Password</label>
                        <input name="password2" type="password" class="form-control" placeholder="Retype Password">
                    </div>
                    <div class="form-action mb-3">
                        <button type="submit" name="register" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="row form-sub m-0">
                        <p>Already have an account?<a href="index.php" class="link float-right mr-2">&nbsp;Click Here</a></p>
                    </div>
                </div>
            </form>
		</div>
	</div>

    <?php include_once('./includes/js.php'); ?>

</body>
</html>