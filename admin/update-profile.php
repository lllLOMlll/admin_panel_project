<?php 
include '../head.inc.php'; 

$username = $_SESSION['username'];
$user = $UserManager->getUserByUsername($username);

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
                            <h1 class="h4 text-gray-900 mb-4">Update profile!</h1>
                        </div>

                        <form method="post" class="user" action="../controllers/user-controller.php" enctype="multipart/form-data" id="registrationForm">
                          <!-- First Name -->
                          <div class="form-group">                             
                            <label>First Name</label>
                            <input type="text" class="form-control form-control-user <?php 
                            echo isset($_SESSION['fieldInputFeedbackFirstName']) ? $_SESSION['fieldInputFeedbackFirstName'] : ''; 
                            if (isset($_SESSION['fieldInputFeedbackFirstName'])) {
                                unset($_SESSION['fieldInputFeedbackFirstName']);
                            }
                        ?>"
                        name="firstNameUpdatingProfile" id="firstNameUpdatingProfile"
                        placeholder="First Name" value="<?php echo $user->getFirstName(); ?>">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control form-control-user <?php 
                        echo isset($_SESSION['fieldInputFeedbackLastName']) ? $_SESSION['fieldInputFeedbackLastName'] : '';
                        if (isset($_SESSION['fieldInputFeedbackLastName'])) {
                            unset($_SESSION['fieldInputFeedbackLastName']);
                        }
                    ?>" 
                    name="lastNameUpdatingProfile" id="lastNameUpdatingProfile"
                    placeholder="Last Name" value="<?php echo $user->getLastName(); ?>">
                </div>

                <!-- Username --> 
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control form-control-user <?php 
                    echo isset($_SESSION['fieldInputFeedbackUsername']) ? $_SESSION['fieldInputFeedbackUsername'] : '';
                    if (isset($_SESSION['fieldInputFeedbackUsername'])) {
                        unset($_SESSION['fieldInputFeedbackUsername']);
                    } 
                    ?>
                    " name="usernameUpdatingProfile" id="usernameUpdatingProfile"
                    placeholder="Username" value="<?php echo $user->getUsername(); ?>">
                </div>

                <!-- Email -->
                <div class="form-group">                
                    <label>Email</label>
                    <input type="text" class="form-control form-control-user <?php 
                    echo isset($_SESSION['fieldInputFeedbackEmail']) ? $_SESSION['fieldInputFeedbackEmail'] : ''; 
                    if (isset($_SESSION['fieldInputFeedbackEmail'])) {
                        unset($_SESSION['fieldInputFeedbackEmail']);
                    }
                    ?>
                    " name="emailUpdatingProfile" id="emailUpdatingProfile"
                    placeholder="Email Address" value="<?php echo $user->getEmail(); ?>">
                </div>

                <!-- Avatar -->
                <div class="d-flex flex-column align-items-center"> <!-- Container div for centering -->
                  <!-- Avatar -->
                  <label class="label-font me-2 mb-1 text-center" for="avatarUpdatingProfile" id="avatarLabel">Select an avatar for your profile:</label>
                  <span></span>
                  <br>

                  <div class="mb-3 text-center"> <!-- Centered div for file input -->
                    <label for="avatarUpdatingProfile" class="form-label">Upload Avatar</label>
                    <input class="form-control" type="file" id="avatarUpdatingProfile" name="avatarUpdatingProfile" hidden onchange="previewImage(event)">
                    <label class="btn btn-secondary" for="avatarUpdatingProfile">
                      <i class="bi bi-upload"></i> Choose File
                  </label>

                  <br>
                  <br>

                  <!-- Display the user's current avatar or newly selected avatar -->
                  <img src="<?php echo !empty($user->getAvatar()) ? $user->getAvatar() : ''; ?>" alt="Avatar Preview" style="width: 100px; height: 100px; object-fit: cover;" id="avatarPreview">
              </div>
          </div>

          <!-- Display the newly selected avatar -->
          <script>
              function previewImage(event) {
                const input = event.target;
                const reader = new FileReader();

                reader.onload = function() {
                  const preview = document.getElementById('avatarPreview');
      if (preview) { // Ensure the preview element exists
        preview.src = reader.result;
    }
};

if (input.files && input.files[0]) {
  reader.readAsDataURL(input.files[0]);
}
}
</script>

</div>




<!-- Updating profile button -->
<input type="hidden" name="action" value="update_profile">
<input class="btn btn-primary btn-user btn-block" type="submit" value="Update Profile" name ="update_profile">
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