<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_SESSION['newemail']))
    {
        if(isset($_POST['change_password'])){
            // passing data received from user into variable
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            // Preventing SQL Injection
            $password = mysqli_real_escape_string($conn, $password);
            $password2 = mysqli_real_escape_string($conn, $password2);

            $newpass = password_hash($password, PASSWORD_DEFAULT);

            // Form Validation 
            if(empty($password) || empty($password2)){
                $_SESSION['WarningMessage'] = "All fields are Required";
            }
            elseif ($password != $password2) {
                $_SESSION['ErrorMessage'] = "Both password did not match";
            }
            else{
                
                $sql = "UPDATE tbluser SET password = '$newpass' WHERE email = '{$_SESSION['newemail']}' ";
                $query_result = mysqli_query($conn, $sql);
                if($query_result){
                    $_SESSION['SuccessMessage'] = "Password has been changed successfully";
                    $_SESSION['newemail'] = null;
                    RedirectTo('index.php');

                }else{
                    $_SESSION['ErrorMessage'] = "Failed to change password";
                }             
            }
        }// change password ends here
            
    } // new email session ends here
    else{
        RedirectTo('index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Private Diary - Reset Password</title>
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
            <h3 class="text-center">Reset Password</h3>
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                echo WarningMessage();
            ?>
            <form action="reset_password.php" method="POST">
                <div class="login-form">
                    <div class="form-group form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                    </div>
                    <div class="form-group form-group">
                        <label>Retype New Password</label>
                        <input type="password" name="password2" class="form-control" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="change_password" class="btn btn-primary form-control">Change Password</button>
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