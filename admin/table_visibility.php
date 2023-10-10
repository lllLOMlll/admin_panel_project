<?php
include '../head.inc.php';

$footer = $FooterManager->getFooter();
?>

<?php include 'header.php' ?>



<?php include 'sidebar.php' ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

     <?php include 'topbar.php' ?>

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
<h1 class="h3 mb-2 text-gray-800 text-center">Visibility</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Visibility of the sections of the home page</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Section</th>
                        <th>Visibility</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allVisibilityObject = $VisibilityManager->getAllVisibilityObjects();

                    foreach ($allVisibilityObject as $sectionVisibilty) {

                        ?>
                        <tr>
                            <form method="post" action="../controllers/home-controller.php">
                                <input type="hidden" name="visibilityId" value="<?php echo $sectionVisibilty->getId(); ?>">
                                <td><?php echo $sectionVisibilty->getSection(); ?></td>
                                <td>
                                    <?php
                                    $isVisible = $sectionVisibilty->getIsVisible();
                                    if ($isVisible == 1) {
                                      echo '
                                      <div class="text-center">
                                      Visible <br>
                                      <a href="#" class="btn btn-success btn-circle">
                                      <i class="fas fa-check"></i>
                                      </a>
                                      </div>';
                                  } elseif ($isVisible == 0) {
                                    echo '
                                    <div class="text-center">
                                    Invisible <br>
                                    <a href="#" class="btn btn-danger btn-circle">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    </div>';
                                } else {
                                    echo 'Visibility error!';
                                }                          
                            ?>
                        </td>
                        <td>
                            <input type="hidden" name="action" value="change_visibility">
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Change visibility</span>
                            </button>
                        </td>
                    </form>
                </tr>
            </tbody>
            <!-- end of foreach loop -->
            <?php
        }
        ?>
    </table>
</div>
</div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'footer.php';