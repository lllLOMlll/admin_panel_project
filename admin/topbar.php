<?php

// To display the data about the user
$username = $_SESSION['username'];
$user = $UserManager->getUserByUsername($username);
?> 

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">



        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></span>
            <?php if (!empty($user->getAvatar())) : ?>
                <img class="img-profile rounded-circle"
                I need the ../ because the folder is up by one level
                src="<?php echo $user->getAvatar(); ?>">
            <?php endif ?>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="update-profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Update Profile
        </a>
        <a class="dropdown-item" href="change-password.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Change Password
        </a>
        <?php
        if (isset($_SESSION['access_level'])) {
            $accessLevel = $_SESSION['access_level'];
            if ($accessLevel == 1) {
                ?>
                <a class="dropdown-item" href="add-user.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Add User
                </a>
                <?php
            }
        }
        ?>
        <div class="dropdown-divider"></div>                                
        <a class="dropdown-item" href="../controllers/user-controller.php?action=logout">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout                               
        </a>

    </div>
</li>

</ul>

</nav>
                <!-- End of Topbar -->