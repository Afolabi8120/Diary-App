<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_SESSION['username']))
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "SELECT * FROM tblcompose WHERE id = '$id'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                while($row = mysqli_fetch_array($query_result)){
                    $nid = $row['id'];
                    $title = $row['title'];
                    $note = $row['note'];
                    $date = $row['date'];
                    $time = $row['time'];
                    $username = $row['username'];
                }
            }else{

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
    <title>Private Diary - Compose </title>
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
                        <h4 class="page-title">View</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="fas fa-book"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="view.php">View</a>
                            </li>
                        </ul>
                    </div>
                    <div class="page-category">
                        <div class="row mt-5">
                            <div class="modal-body">
                                <?php
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                    echo WarningMessage();
                                ?>
                                <h2 class="page-title text-center"><?php echo $title; ?></h2>
                                <p style="font-weight: bolder; font-size: 16px; display: inline;" class="ml-1 mr-3">Date: <span style="color: grey; font-weight: normal;"><?php echo $date; ?></span></p>
                                <p style="font-weight: bolder; font-size: 16px; display: inline;" class="ml-1 mr-3">Time: <span style="color: grey; font-weight: normal;"><?php echo $time; ?></span></p>
                                <p style="font-weight: bolder; font-size: 16px; display: inline;" class="ml-1 mr-3">By: <span style="color: grey; font-weight: normal;"><?php echo $username; ?></span></p>
                                <p class="ml-1 mr-3">
                                    <?php echo $note; ?>
                                </p>
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