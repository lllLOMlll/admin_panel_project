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


<title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
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

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add a User!</h1>
                        </div>
                        
                        <form method="post" class="user" action="../controllers/user-controller.php" enctype="multipart/form-data" id="registrationForm">
                            <!-- First Name -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user 
                                    <?php 
                                    echo isset($_SESSION['fieldInputFeedbackFirstName']) ? $_SESSION['fieldInputFeedbackFirstName'] : ''; 
                                    if (isset($_SESSION['fieldInputFeedbackFirstName'])) {
                                        unset($_SESSION['fieldInputFeedbackFirstName']); 
                                    }
                                ?>" 
                                name="firstNameRegistration" id="firstNameRegistration"
                                placeholder="First Name" value="<?php 
                                echo isset($_SESSION['firstNameRegistration']) ? $_SESSION['firstNameRegistration'] : '';
                                if (isset($_SESSION['firstNameRegistration'])) {
                                    unset($_SESSION['firstNameRegistration']);
                                } 
                            ?>">
                            </div>
                            
                            <!-- Last Name -->
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user <?php 
                                echo isset($_SESSION['fieldInputFeedbackLastName']) ? $_SESSION['fieldInputFeedbackLastName'] : ''; 
                                if (isset($_SESSION['fieldInputFeedbackLastName'])) {
                                    unset($_SESSION['fieldInputFeedbackLastName']);
                                }  
                            ?>"
                            name="lastNameRegistration" id="lastNameRegistration"
                            placeholder="Last Name" value="<?php 
                            echo isset($_SESSION['lastNameRegistration']) ? $_SESSION['lastNameRegistration'] : ''; 
                            if (isset($_SESSION['lastNameRegistration'])) {
                                unset($_SESSION['lastNameRegistration']);
                            }
                        ?>">
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user <?php 
                        echo isset($_SESSION['fieldInputFeedbackUsername']) ? $_SESSION['fieldInputFeedbackUsername'] : ''; 
                        if (isset($_SESSION['fieldInputFeedbackUsername'])) {
                         unset($_SESSION['fieldInputFeedbackUsername']);  
                     } 
                 ?>" 
                 name="usernameRegistration" id="usernameRegistration"
                 placeholder="Username" value="<?php 
                 echo isset($_SESSION['usernameRegistration']) ? $_SESSION['usernameRegistration'] : ''; 
                 if (isset($_SESSION['usernameRegistration'])) {
                    unset($_SESSION['usernameRegistration']);
                 }
             ?>">
             </div>

             <!-- Email -->
             <div class="form-group">
                <input type="text" class="form-control form-control-user <?php 
                echo isset($_SESSION['fieldInputFeedbackEmail']) ? $_SESSION['fieldInputFeedbackEmail'] : ''; 
                if (isset($_SESSION['fieldInputFeedbackEmail'])) {
                  unset($_SESSION['fieldInputFeedbackEmail']);  
              }  
          ?>" name="emailRegistration" id="emailRegistration"
          placeholder="Email Address" value="<?php 
          echo isset($_SESSION['emailRegistration']) ? $_SESSION['emailRegistration'] : ''; 
          if (isset($_SESSION['emailRegistration'])) {
            unset($_SESSION['emailRegistration']);
          }
      ?>">
      </div>

      <!-- Password -->
      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user <?php 
            echo isset($_SESSION['fieldInputFeedbackPassword']) ? $_SESSION['fieldInputFeedbackPassword'] : '';
            if (isset($_SESSION['fieldInputFeedbackPassword'])) {
                unset($_SESSION['fieldInputFeedbackPassword']);
            }
        ?>" 
        name="passwordRegistration"
        id="passwordRegistration" placeholder="Password" value="<?php 
        echo isset($_SESSION['passwordRegistration']) ? $_SESSION['passwordRegistration'] : '';  
        if (isset($_SESSION['passwordRegistration'])) {
            unset($_SESSION['passwordRegistration']);
        }
    ?>">
    </div>

    <!-- Repeat password -->
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user <?php 
        echo isset($_SESSION['fieldInputFeedbackConfirmPassword']) ? $_SESSION['fieldInputFeedbackConfirmPassword'] : ''; 
        if (isset($_SESSION['fieldInputFeedbackConfirmPassword'])) {
            unset($_SESSION['fieldInputFeedbackConfirmPassword']);    
        }

    ?>" 
    name="passwordConfirmationRegistration"
    id="passwordConfirmationRegistration" placeholder="Repeat Password" value="<?php 
    echo isset($_SESSION['passwordConfirmationRegistration']) ? $_SESSION['passwordConfirmationRegistration'] : ''; 
    if (isset($_SESSION['passwordConfirmationRegistration'])) {
        unset($_SESSION['passwordConfirmationRegistration']);
    }
?>">
</div>
</div>

<!-- Avatar -->
<div class="d-flex flex-column align-items-center"> <!-- Container div for centering -->
  <label class="label-font me-2 mb-1 text-center" for="avatarUpdatingProfile" id="avatarRegistrationLabel">Select an avatar for your profile:</label>
  <span></span>
  <br>

  <div class="mb-3 text-center"> <!-- Centered div for file input -->
    <label for="avatarRegistration" class="form-label">Upload Avatar</label>
    <input class="form-control" type="file" id="avatarRegistration" name="avatarRegistration" hidden onchange="previewImage(event)">
    <label class="btn btn-secondary" for="avatarRegistration">
      <i class="bi bi-upload"></i> Choose File</label>

      <br>
      <br>

      <!-- Container to display the avatar preview -->
      <div id="avatarContainer"></div>
  </div>
</div>

<!-- Display the newly selected avatar -->
<script>
  function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function() {
      const avatarContainer = document.getElementById('avatarContainer');
      const existingPreview = document.getElementById('avatarPreview');

      if (existingPreview) {
        avatarContainer.removeChild(existingPreview);
    }

    if (input.files && input.files[0]) {
        const preview = document.createElement('img');
        preview.src = reader.result;
        preview.style.width = "100px";
        preview.style.height = "100px";
        preview.style.objectFit = "cover";
        preview.id = "avatarPreview";
        avatarContainer.appendChild(preview);
    }
};

if (input.files && input.files[0]) {
  reader.readAsDataURL(input.files[0]);
}
}
</script>

</div>




<!-- Register button -->
<input type="hidden" name="action" value="register">
<input class="btn btn-primary btn-user btn-block" type="submit" value="Register Account" name ="register">


</form>
<hr>
<div class="text-center">
    <a class="small" href="forgot-password.php">Forgot Password?</a>
</div>
<div class="text-center">
    <a class="small" href="login.php">Already have an account? Login!</a>
    <br>
    <br>
</div>
</div>
</div>
   
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'footer.php';