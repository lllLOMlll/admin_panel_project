<?php include'../head.inc.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
 <div class="text-center">
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
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="post" class="user" action="../controllers/user-controller.php" enctype="multipart/form-data" id="registrationForm">
                                    <!-- Username -->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                        name="usernameLogin" id="usernameLogin" aria-describedby="emailHelp"
                                        placeholder="Username" value="<?php echo isset($_SESSION['usernameLogin']) ? $_SESSION['usernameLogin'] : '' ; 
                                        if (isset($_SESSION['usernameLogin'] )) {
                                            unset($_SESSION['usernameLogin']);    
                                        }
                                    ?>">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                    name="passwordLogin" id="passwordLogin" placeholder="Password" value="<?php echo isset($_SESSION['passwordLogin']) ? $_SESSION['passwordLogin'] : ''; 
                                    if (isset($_SESSION['passwordLogin'])){
                                               unset($_SESSION['passwordLogin']);  
                                    }
                             
                                ?>">
                                </div>
                                <!-- Login button -->
                                <input type="hidden" name="action" value="login">
                                <input class="btn btn-primary btn-user btn-block" type="submit" value="Login" name ="login">


                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.php">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>