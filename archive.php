<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_SESSION['username']))
    {
        if(isset($_POST['delete'])){
            $id = $_POST['id'];

            $sql = "DELETE FROM tblcompose WHERE id = '$id'";
            $query_result = mysqli_query($conn, $sql);
            if($query_result){
                $_SESSION['SuccessMessage'] = "Your Note has been deleted successfully";
            }
            else{
                $_SESSION['ErrorMessage'] = "Failed to delete note";
            }
        }
        elseif(isset($_POST['archive'])){
            $id = $_POST['id'];

            $sql = "UPDATE tblcompose SET status = 'Un-Archive' WHERE id = '$id'";
            $query_result = mysqli_query($conn, $sql);
            if($query_result){
                $_SESSION['SuccessMessage'] = "Your Note has been un-archive";
            }
            else{
                $_SESSION['ErrorMessage'] = "Failed to move note";
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
    <title>Private Diary - Archive </title>
    <?php require_once('./includes/js.php') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['./css/css/fonts.min.css']},
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
                        <h4 class="page-title">Archive(s)</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-archive"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="archive.php">Archive(s)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="page-category">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                            echo WarningMessage();
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">My Notes</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <table class="table table-striped mt-1">

                                                <thead>
                                                    <tr>
                                                        <th scope="col">S/N</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Note</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $i = 0;
                                                $sql = "SELECT * FROM tblcompose WHERE username = '{$_SESSION['username']}' AND status = 'Archive' ORDER BY date ASC";
                                                $query_result = mysqli_query($conn, $sql);
                                                $result = mysqli_num_rows($query_result);
                                                if($result > 0){
                                                    while($row = mysqli_fetch_array($query_result)){
                                                        $i++;
                                                        $note_id = $row['id'];
                                                        $title = $row['title'];
                                                        $note = $row['note'];
                                                        $date = $row['date'];
                                                        $time = $row['time'];
                                                
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $title; ?></td>
                                                        <td><?php echo $note; ?></td>
                                                        <td><?php echo $date; ?></td>
                                                        <td><?php echo $time; ?></td>
                                                        <td>
                                                            <!-- Archive Starts Here -->
                                                            <form action="archive.php" method="POST">
                                                                <input type="hidden" value="<?php echo $note_id; ?>" name="id">
                                                                <input type="submit" name="archive" class="btn btn-warning btn-sm m-1" value="Un-Archive">
                                                            </form>
                                                            <!-- Archive Ends Here -->

                                                            <!-- Delete Starts Here -->
                                                            <form action="archive.php" method="POST">
                                                                <input type="hidden" value="<?php echo $note_id; ?>" name="id">
                                                                <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm m-1">
                                                            </form>
                                                            <!-- Delete Ends Here -->
                                                        </td>
                                                    </tr>
                                                <?php
                                                      }
                                                }
                                                    else {
                                                    $msg = "No Record Available";
                                                ?>
                                                <tr><td colspan="6" style="text-align: center;"><?php echo $msg; ?></td></tr>
                                                <?php
                                                    
                                                }
                                                ?>
                                                </tbody>
                                            </table>
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

</body>
</html>