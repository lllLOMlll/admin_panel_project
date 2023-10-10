<?php 
include '../head.inc.php'; 

$username = $_SESSION['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update profile</title>

    <!-- Link to Admin Panel -->
    <a href="index.php" class="btn btn-secondary btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-right"></i>
    </span>
    <span class="text">Back to Admin Panel?</span>
</a>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

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

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Change password!</h1>
                        </div>

                        <form method="post" class="user" action="../controllers/user-controller.php" id="updadePassword">
                          <!-- Old Password -->
                          <div class="form-group">                             
                            <label>Old password</label>
                            <input type="password" class="form-control form-control-user <?php 
                            echo isset($_SESSION['fieldInputFeedbackOldPassword']) ? $_SESSION['fieldInputFeedbackOldPassword'] : ''; 
                            if (isset($_SESSION['fieldInputFeedbackOldPassword'])) {
                                unset($_SESSION['fieldInputFeedbackOldPassword']);
                            }
                        ?>"
                        name="oldPassword" id="oldPassword"
                        placeholder="Old Password" value="<?php 
                            echo isset($_SESSION['oldPassword']) ? $_SESSION['oldPassword'] : ''; 
                            if (isset($_SESSION['oldPassword'])) {
                                unset($_SESSION['oldPassword']);
                            }
                        ?>">
                    </div>

                    <!-- New Password -->
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control form-control-user <?php 
                        echo isset($_SESSION['fieldInputFeedbackNewPassword']) ? $_SESSION['fieldInputFeedbackNewPassword'] : '';
                        if (isset($_SESSION['fieldInputFeedbackNewPassword'])) {
                            unset($_SESSION['fieldInputFeedbackNewPassword']);
                        }
                    ?>" 
                    name="newPassword" id="newPassword"
                    placeholder="New Password" value="<?php 
                            echo isset($_SESSION['newPassword']) ? $_SESSION['newPassword'] : ''; 
                            if (isset($_SESSION['newPassword'])) {
                                unset($_SESSION['newPassword']);
                            }
                        ?>">
                </div>

                <!-- Repeat Old password --> 
                <div class="form-group">
                    <label>Repeat New Password</label>
                    <input type="password" class="form-control form-control-user <?php 
                    echo isset($_SESSION['fieldInputFeedbackRepeatNewPassword']) ? $_SESSION['fieldInputFeedbackRepeatNewPassword'] : '';
                    if (isset($_SESSION['fieldInputFeedbackRepeatNewPassword'])) {
                        unset($_SESSION['fieldInputFeedbackRepeatNewPassword']);
                    } 
                    ?>
                    " name="repeatNewPassword" id="repeatNewPassword"
                    placeholder="Repead Password" value="<?php 
                            echo isset($_SESSION['repeatNewPassword']) ? $_SESSION['repeatNewPassword'] : ''; 
                            if (isset($_SESSION['repeatNewPassword'])) {
                                unset($_SESSION['repeatNewPassword']);
                            }
                        ?>">
                </div>


</div>




<!-- Updating profile button -->
<input type="hidden" name="action" value="change_password">
<input class="btn btn-primary btn-user btn-block" type="submit" value="Change password" name ="change_password">
</form>



<br>



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>