<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Tables -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <h6 class="collapse-header">HOME:</h6>
                        <a class="collapse-item" href="table_title_and_welcome_message.php">Title/Welcome message</a>
                        <a class="collapse-item" href="table_services.php">Services</a>
                        <a class="collapse-item" href="table_team.php">Team</a>
                        <a class="collapse-item" href="table_portfolio.php">Portfolio</a>
                        <a class="collapse-item" href="table_slider.php">Slider</a>
                        <a class="collapse-item" href="table_footer.php">Footer</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <h6 class="collapse-header">OTHER PAGES:</h6>
                        <a class="collapse-item" href="table_services_page.php">Services</a>
                        <a class="collapse-item" href="table_about_page.php">About</a>
                        <a class="collapse-item" href="table_portfolio_page.php">Portfolio</a>
                        <a class="collapse-item" href="table_contact.php">Contact Us</a>
                        
                    </div>
                </div>
            </li>

            <?php
            if (isset($_SESSION['access_level'])) {
                $accessLevel = $_SESSION['access_level'];
                if ($accessLevel == 1) {
                    ?>
                    <!-- Visibility -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-eye"></i>
                        <span>Visibility</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded"> 
                            <h6 class="collapse-header">HOME:</h6>
                            <a class="collapse-item" href="table_visibility.php">Modify Visibility</a>

                        </div>
                    </div>
                </li>
                <?php
            }
        }
        ?>

        <!-- Users -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
         <h6 class="collapse-header">USERS:</h6>
         <a class="collapse-item" href="table_users.php">Users</a>

     </div>
 </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
    aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
</a>
<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Login Screens:</h6>

        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other Pages:</h6>
        <a class="collapse-item" href="login.php">Login</a>
        <a class="collapse-item" href="register.php">Register</a>
        <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
        <a class="collapse-item" href="404.php">404 Page</a>
        <a class="collapse-item" href="blank.php">Blank Page</a>
        <a class="collapse-item" href="buttons.php">Buttons</a>
        <a class="collapse-item" href="cards.php">Cards</a>
        <a class="collapse-item" href="utilities-color.php">Colors</a>
        <a class="collapse-item" href="utilities-border.php">Borders</a>
        <a class="collapse-item" href="utilities-animation.php">Animations</a>
        <a class="collapse-item" href="utilities-other.php">Other</a>
    </div>
</div>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
        <!-- End of Sidebar -->