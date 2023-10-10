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
<h1 class="h3 mb-2 text-gray-800 text-center">Footer</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Footer</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Copyright</th>
                            <th>Design Company</th>
                            <th>Legal Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="post" action="../controllers/footer-controller.php">
                                <td><input class="form-control" type="text" name="footerCopyright" value="<?php echo $footer->getCopyright(); ?>"></td>
                                <td><input class="form-control" type="text" name="footerDesignCompany" value="<?php echo $footer->getDesignCompany(); ?>"></td>
                                <td><input class="form-control" type="text" name="footerLegalMessage" value="<?php echo $footer->getLegalMessage(); ?>"></td>
                                <td>
                                    <input type="hidden" name="action" value="updateFooter">
                                    <button type="submit" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Update footer</span>
                                    </button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'footer.php';