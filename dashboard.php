<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Private Diary - Dashboard </title>
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
                        <h4 class="page-title">Dashboard</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard.php">Dashboard</a>
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
                            <div class="col-sm-6 col-md-6">
                                <div class="card card-stats card-danger card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-pen"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Total Notes</p>
                                                    <?php
                                                        $sql = "SELECT * FROM tblcompose WHERE username = '{$_SESSION['username']}'";
                                                        $query_result = mysqli_query($conn, $sql);
                                                        $result = mysqli_num_rows($query_result);
                                                    ?>
                                                    <h4 class="card-title">
                                                        <?php echo $result; ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card card-stats card-success card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-archive"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Archive Notes</p>
                                                    <?php
                                                        $sql = "SELECT * FROM tblcompose WHERE username = '{$_SESSION['username']}' AND status = 'Archive' ";
                                                        $query_result = mysqli_query($conn, $sql);
                                                        $result = mysqli_num_rows($query_result);
                                                    ?>
                                                    <h4 class="card-title">
                                                        <?php echo $result; ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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