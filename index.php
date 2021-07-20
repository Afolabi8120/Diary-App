<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_POST['login'])){
        // passing data received from user into variable
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Preventing SQL Injection
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // Form Validation 
        if(empty($username) || empty($password)){
            $_SESSION['WarningMessage'] = "All fields are Required";
        }
        else{
            // Check if username already exist in database
            $sql = "SELECT * FROM tbluser WHERE username = '$username'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                while($row = mysqli_fetch_array($query_result)){
                    $fetched_password = $row['password'];

                    // Storing user's data fetched from database into sessions
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['gender'] = $row['address'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['usertype'] = $row['usertype'];
                }

                if(password_verify($password, $_SESSION['password'])){
                    $_SESSION['SuccessMessage'] = "Login Successful";

                    // if Login is Successful it will redirect the use to his/her dashboard
                    RedirectTo('dashboard.php');
                }else{
                    $_SESSION['ErrorMessage'] = "Details Provided is Invalid";
                }
            }
            else{
                $_SESSION['ErrorMessage'] = "User's Record Not Found";
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
            <h3 class="text-center">Sign In To Your Account</h3>
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                echo WarningMessage();
            ?>
            <form action="index.php" method="POST">
                <div class="login-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input  name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-action mb-3">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                    <div class="row form-sub m-0">
                        <a href="reset.php" class="link float-right">Forget Password ?</a>
                    </div>
                    <div class="row form-sub m-0">
                        <p>Don't have an account?<a href="register.php" class="link float-right mr-2">&nbsp;Click Here</a></p>
                    </div>
                </div>
            </form>
		</div>
	</div>

    <?php include_once('./includes/js.php'); ?>

</body>
</html>