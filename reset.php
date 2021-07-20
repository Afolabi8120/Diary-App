<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_POST['submit'])){
        // passing data received from user into variable
        $email = $_POST['email'];

        // Preventing SQL Injection
        $email = mysqli_real_escape_string($conn, $email);

        // Form Validation 
        if(empty($email)){
            $_SESSION['WarningMessage'] = "Please enter your email address";
        }
        else{
            // Check if username already exist in database
            $sql = "SELECT * FROM tbluser WHERE email = '$email'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                while($row = mysqli_fetch_array($query_result)){
                    $_SESSION['newemail'] = $row['email'];
                }

                if(isset($_SESSION['newemail'])){
                    RedirectTo('reset_password.php');
                }
            }
            else{
                $_SESSION['ErrorMessage'] = "Details Provided is Invalid";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Private Diary - Login</title>
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
            <h3 class="text-center">Forget Password</h3>
            <h6 class="text-center">Please enter your email address to reset your password</h6>
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                echo WarningMessage();
            ?>
            <form action="reset.php" method="POST">
                <div class="login-form">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input  name="email" type="text" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button>
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