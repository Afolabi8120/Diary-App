<?php
    include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');

?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <h4 class="card-title text-white"> </h4>

        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>

                
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <span class="avatar-title rounded-circle border border-white text-white"><?php echo substr($_SESSION['fullname'], 0,1); ?></span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <span class="avatar-title rounded-circle border border-white text-white"><?php echo substr($_SESSION['fullname'], 0,1); ?></span>

                                    </div>
                                    <div class="u-text">
                                        <h4><?php echo $_SESSION['fullname']; ?></h4>
                                        <p class="text-muted"><?php echo $_SESSION['usertype']; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="profile.php">My Profile</a>     
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="archive.php">Archive</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>