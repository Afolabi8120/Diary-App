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
                }
            }else{

            }
        }
        elseif(isset($_POST['update'])){
            
            // passing data received from user into variable
            $id = $_POST['id'];
            $title = $_POST['title'];
            $note = $_POST['note'];

            // Preventing SQL Injection
            $title = mysqli_real_escape_string($conn, $title);
            $note = mysqli_real_escape_string($conn, $note);

            $title = strtoupper($title);
            $date = date('Y/m/d');
            $time = date('h:i:s a', time());

            // Form Validation 
            if(empty($title) || empty($note)){
                $_SESSION['WarningMessage'] = "All fields are Required";
            }
            else{
                $sql = "UPDATE tblcompose SET title = '$title',note = '$note' WHERE id = '$id'";
                $query_result = mysqli_query($conn, $sql);
                if ($query_result){
                    $_SESSION['SuccessMessage'] = "Note has been updated successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed to update note";
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
                        <h4 class="page-title">Compose</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-pen"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="compose.php">Compose</a>
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
                                <p class="small ">Create a new note using this form, make sure you fill them all</p>
                                <div class="card">
                                    <form action="edit_compose.php" method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <label>Title</label>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $title; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <label>Note</label>
                                                    <textarea type="text" name="note" class="form-control" placeholder="Enter Note" rows="8" cols="20" value=""><?php echo $note; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group">
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                    <a href="view_notes.php" type="submit" class="btn btn-danger" hr>Back</a>
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