<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

    if(isset($_SESSION['username']))
    {
        if(isset($_POST['btn_update'])){
            // passing data received from user into variable
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];

            // Preventing SQL Injection
            $fullname = mysqli_real_escape_string($conn, $fullname);
            $email = mysqli_real_escape_string($conn, $email);
            $phone = mysqli_real_escape_string($conn, $phone);
            $gender = mysqli_real_escape_string($conn, $gender);
            $address = mysqli_real_escape_string($conn, $address);

            // Form Validation 
            if(empty($fullname) || empty($phone) || empty($email) || empty($gender)){
                $_SESSION['WarningMessage'] = "All fields are Required";
            }
            else{
                $sql = "UPDATE tbluser SET fullname = '$fullname',email = '$email',phone = '$phone',gender = '$gender',address = '$address' WHERE username = '{$_SESSION['username']}' ";
                $query_result = mysqli_query($conn, $sql);
                if ($query_result){
                    $_SESSION['SuccessMessage'] = "Account has been updated successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed to update account";
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
	<title>Welcome to dashboard </title>
	
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
						<h4 class="page-title">Profile</h4>
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
								<a href="profile.php">Profile</a>
							</li>
						</ul>
					</div>
					<div class="page-category">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                            echo WarningMessage();
                        ?>
						<div class="row">
                            <div class="col-md-12">
                                <div class="card card-with-nav">
                                    <div class="card-header">
                                        <div class="row row-nav-line">
                                            <ul class="nav nav-tabs nav-line nav-color-primary w-100 pl-3" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Edit Profile</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="profile.php" method="POST">
                                            <div class="row">
                                                <?php
                                                $sql = "SELECT * FROM tbluser WHERE username = '{$_SESSION['username']}' ";
                                                $query_result = mysqli_query($conn, $sql);
                                                $result = mysqli_num_rows($query_result);
                                                if($result > 0){
                                                    while($row = mysqli_fetch_array($query_result)){
                                                        $fname = $row['fullname'];
                                                        $email = $row['email'];
                                                        $phone = $row['phone'];
                                                        $gender = $row['gender'];
                                                        $address = $row['address'];
                                                
                                                ?>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input  value="<?php echo $fname; ?>" type="text" class="form-control" placeholder="Full Name" name="fullname" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input  value="<?php echo $email; ?>" type="email" class="form-control" placeholder="Email Address"  name="email" readonly="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phone No.</label>
                                                        <input  value="<?php echo $phone; ?>" type="text" class="form-control" placeholder="Phone No" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control">
                                                            <option><?php echo $gender; ?></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        <select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea type="text" class="form-control" placeholder="Address" cols="8" rows="5" value="<?php echo $address; ?>" name="address">
                                                            <?php echo $address; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        <div class="text-right mt-3 mb-3">
                                            <input type="submit" name="btn_update" class="btn btn-primary" value="Update Account">
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
		
	</div>

<?php require_once('./includes/js.php') ?>
<?php include_once('./includes/js.php'); ?>
  
</body>
</html>