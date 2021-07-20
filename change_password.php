<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_SESSION['username']))
    {
        if(isset($_POST['change_password'])){
            // passing data received from user into variable
            $oldpassword = $_POST['oldpassword'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            // Preventing SQL Injection
            $oldpassword = mysqli_real_escape_string($conn, $oldpassword);
            $password = mysqli_real_escape_string($conn, $password);
            $password2 = mysqli_real_escape_string($conn, $password2);

            // Form Validation 
            if(empty($oldpassword) || empty($password) || empty($password2)){
                $_SESSION['WarningMessage'] = "All fields are Required";
            }
            elseif ($password != $password2) {
                $_SESSION['ErrorMessage'] = "Both password did not match";
            }
            else{
                if(password_verify($oldpassword, $_SESSION['password'])){
                    // Hashing the password provided by the user word
                    $newpassword = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "UPDATE tbluser SET password = '$newpassword' WHERE username = '{$_SESSION['username']}' ";
                    $query_result = mysqli_query($conn, $sql);
                    if($query_result){
                        $_SESSION['SuccessMessage'] = "Password has been changed successfully";
                    }else{
                        $_SESSION['ErrorMessage'] = "Failed to change password";
                    }
                }
                else{
                    $_SESSION['ErrorMessage'] = "Old Password Provided is Invalid";
                }
            }
        }
            
    }
    else{
        RedirectTo('index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Private Diary - Change Password </title>
    <?php require_once('./includes/js.php') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./css/css/fonts.min.css">
    <link rel="stylesheet" href="./css/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/css/atlantis.css">
</head>
<body>
    <div class="wrapper">
        <?php require_once('./includes/header.php') ?>

        <?php require_once('./includes/sidebar.php') ?>

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Change Password</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-lock"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="change_password.php">Change Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="page-category">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                            echo WarningMessage();
                        ?>
                        <div class="row mt-5">
                            <div class="modal-body">
                                <p class="small ">Leave form blank if you won't change your password</p>
                                <div class="card">
                                    <form action="change_password.php" method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <label>Current Password</label>
                                                    <input type="password" name="oldpassword" class="form-control" placeholder="Enter Current Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <label>New Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <label>Retype New Password</label>
                                                    <input type="password" name="password2" class="form-control" placeholder="Retype New Password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                                                    <a href="dashboard.php" type="submit" class="btn btn-danger" hr>Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <?php include_once('./includes/footer.php'); ?>
    <?php include_once('./includes/js.php'); ?>

</body>
</html>