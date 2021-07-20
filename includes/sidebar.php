<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                <span class="avatar-title rounded-circle border border-info text-white"><?php echo substr($_SESSION['fullname'], 0,1); ?></span>

                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <span class="user-level">
                                <?php echo 'Welcome, ' .$_SESSION['username']; ?>
                            </span>
                            <span class="caret"></span>
                            <?php echo $_SESSION['usertype']; ?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="profile.php">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="dashboard.php" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                    <li class="nav-item">
                        <a href="compose.php">
                            <i class="fas fa-pen"></i>
                            <p>Compose</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="view_notes.php">
                            <i class="fas fa-address-book"></i>
                            <p>View Notes</p>
                        </a>
                    </li>

                <li class="nav-item">
                    <a href="change_password.php">
                        <i class="fas fa-user"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php">
                        <i class="fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->