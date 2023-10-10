<?php 
include'../head.inc.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged'] !== true) {
    $_SESSION['errorMessage'] = "You must be logged to access the admin panel";
    header('Location: ../admin/login.php');
    exit();
}

?>

<!-- HEADER -->
<?php include 'header.php'; ?>


<!-- SIDEBAR -->
<?php include 'sidebar.php';?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- TOPBAR -->
        <?php include 'topbar.php';?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- SUCCESS MESSAGE -->
            <?php
            if (isset($_SESSION['successMessage'])) {
              ?>
              <div id="successMessage" class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <strong>Yahoo!</strong><br><?php echo $_SESSION['successMessage'] ?>
            </div>
            <?php
            unset($_SESSION['successMessage']);
        }
        ?>

        <!-- ERROR MESSAGE -->
        <?php
        if (isset($_SESSION['errorMessage'])) {
          ?>
          <div class="alert alert-danger fade in alert-dismissible show">
            <strong>Oups!</strong><br><?php echo $_SESSION['errorMessage'] ?>
        </div>
        <?php
        unset($_SESSION['errorMessage']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php'; ?>