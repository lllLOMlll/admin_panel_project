<?php
include '../head.inc.php';

// Only Admin can acces this page
$username = $_SESSION['username'];
$User = $UserManager->getUserByUsername($username);
$userStatus = $User->getAccessLevel();

if ($userStatus == 0) {
    $_SESSION['errorMessage'] = "You must be an Admin to access the Admin tools";
    header('Location: index.php');
    exit();
}


?>

<?php include 'header.php' ?>

<?php include 'modal-style.php' ?>


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
<h1 class="h3 mb-2 text-gray-800 text-center">Users</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users : Admin privileges</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                     <th>Last Name</th>
                     <th>First Name</th>
                     <th>Username</th>
                     <th>Access Level</th>   
                     <th>Status</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                <!-- Display all the users of the database -->
                <?php
                $users = $UserManager->getAllUsers();
                foreach ($users as $user) {
                    ?>
                    <tr>

                      <td><?php echo $user->getLastName(); ?></td>
                      <td><?php echo $user->getFirstName(); ?></td>
                      <td><?php echo $user->getUsername(); ?></td>
                      <td><?php 
                      $accessLevel = $user->getAccessLevel();
                      if ($accessLevel == 1) {
                        echo '<strong><span style="background-color: yellow;">Admin</span></strong>';
                    } elseif ($accessLevel == 0) {
                        echo 'Moderator';
                    } else {
                        echo 'Access Level error!';
                    }
                ?></td>
                <td><?php 
                $status = $user->getStatus();
                $usernameTable = $user->getUsername();
                $_SESSION['usernameTable'] = $usernameTable;
                if ($status == 1) { 
                 echo '
                 <div class="text-center">
                 Active <br>
                 <a href="#" class="btn btn-success btn-circle">
                 <i class="fas fa-check"></i>
                 </a>
                 </div>';
             } elseif ($status == 0) {
                echo '
                <div class="text-center">
                Inactive <br>
                <a href="#" class="btn btn-danger btn-circle">
                <i class="fas fa-exclamation-triangle"></i>
                </a>
                </div>';
            } else {
                echo 'Status error!';
            }
        ?></td>
        <td>
            <!-- Ban/Unban user BUTTON -->
            <?php 
            if ($status == 1) { 
              echo '<form action="../controllers/user-controller.php" method="post">
              <input type="hidden" name="action" value="ban_user">
              <input type="hidden" name="username" value="' . $user->getUsername() . '"> 
              <button type="submit" class="btn-danger btn-icon-split">
              <span class="icon text-white-50">
              <i class="fas fa-exclamation-triangle"></i>
              </span>
              <span class="text">Ban user</span>
              </button>
              </form>';
          } elseif ($status == 0) {
            echo '<form action="../controllers/user-controller.php" method="post">
            <input type="hidden" name="action" value="unban_user"> 
            <input type="hidden" name="username" value="' . $user->getUsername() . '">
            <button type="submit" class="btn-success btn-icon-split">
            <span class="icon text-white-50">
            <i class="fas fa-check"></i>
            </span>
            <span class="text">Unban user</span>
            </button>
            </form>';
        } else {
            echo 'Status error!';
        }
        ?>
        <!-- Give/Remove admin privileges BUTTON -->
        <?php
        if ($accessLevel == 1) { 
            echo '<form action="../controllers/user-controller.php" method="post">
            <input type="hidden" name="action" value="remove_admin_privileges">
            <input type="hidden" name="username" value="' . $user->getUsername() . '">
            <button type="submit" class="mt-1 btn-danger btn-icon-split">
            <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
            </span>
            <span class="text">Remove admin privileges</span>
            </button>
            </form>';
        } elseif ($accessLevel == 0) {
            echo'<form action="../controllers/user-controller.php" method="post">
            <input type="hidden" name="action" value="give_admin_privileges">
            <input type="hidden" name="username" value="' . $user->getUsername() . '">
            <button type="submit" class="mt-1 btn-success btn-icon-split">
            <span class="icon text-white-50">
            <i class="fas fa-check"></i>
            </span>
            <span class="text">Give admin privileges</span>
            </button>
            </form>';
        } else {
            echo 'Status error!';
        }
        ?>
        <!-- Update User BUTTON -->
        <button type="button" class="mt-1 updateButton btn-primary btn-icon-split"
        data-firstName="<?php echo $user->getFirstName(); ?>"
        data-lastName="<?php echo $user->getLastName(); ?>"
        data-username="<?php echo $user->getUsername(); ?>"
        data-oldUsername="<?php echo $user->getUsername(); ?>"
        data-email="<?php echo $user->getEmail(); ?>"
        data-avatar="<?php echo $user->getAvatar(); ?>">


        <span class="icon text-white-50">
          <i class="fas fa-flag"></i>
      </span>
      <span class="text">Update User</span>
  </button>

</td>
</tr>
<!-- end of foreach loop -->
<?php
}
?>

</tbody>


</table>
</div>



<!-- Update Modal -->
<div id="updateModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="text-center">Update Welcome Message</h3>
    <form method="post" action="../controllers/user-controller.php" enctype="multipart/form-data" id="registrationForm">
        <!-- First Name -->
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control form-control-user <?php 
            echo isset($_SESSION['fieldInputFeedbackFirstName']) ? $_SESSION['fieldInputFeedbackFirstName'] : ''; 
            if (isset($_SESSION['fieldInputFeedbackFirstName'])) {
                unset($_SESSION['fieldInputFeedbackFirstName']);
            }
        ?>"
        name="firstNameUpdatingProfile" id="firstNameUpdatingProfile"
        placeholder="First Name" value="">
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
    placeholder="Last Name" value="">
</div>

<!-- Username --> 
<div class="form-group">
    <label>Username</label>
    <input type="hidden" name="oldUsername" id="oldUsername">
    <input type="text" class="form-control form-control-user <?php 
    echo isset($_SESSION['fieldInputFeedbackUsername']) ? $_SESSION['fieldInputFeedbackUsername'] : '';
    if (isset($_SESSION['fieldInputFeedbackUsername'])) {
        unset($_SESSION['fieldInputFeedbackUsername']);
    } 
    ?>
    " name="usernameUpdatingProfile" id="usernameUpdatingProfile"
    placeholder="Username" value="">
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
    placeholder="Email Address" value="">
</div>

<!-- Avatar -->
<div class="d-flex flex-column align-items-center"> <!-- Container div for centering -->
  <!-- Avatar -->
  <label class="label-font me-2 mb-1 text-center" for="avatarUpdatingProfile" id="avatarLabel">Select an avatar for your profile:</label>
  <span></span>
  <br>

  <div class="mb-3 text-center"> <!-- Centered div for file input -->
    <label for="avatarUpdatingProfile" class="form-label">Upload Avatar</label>
     <input type="hidden" id="avatarUpdatingProfileHiddenInput" name="avatarUpdatingProfileHiddenInput">
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

<br>
<!-- Update user BUTTON -->
<input type="hidden" name="action" value="update_user_profile_admin">
<button type="submit" class="btn btn-primary">Save Changes</button>
</form>
</div>
</div>

<script type="text/javascript">
  var updateButtons = document.getElementsByClassName("updateButton");
  var addModalButton = document.getElementById("addButton");

  var updateModal = document.getElementById("updateModal");
  var addModal = document.getElementById("addModal");

  // Generic function to close modals
  function closeModal(modal) {
    modal.style.display = "none";
  }

  // Open the update modal and populate the form
  for (var i = 0; i < updateButtons.length; i++) {
    updateButtons[i].addEventListener("click", function(event) {
      var buttonElement = event.target.closest('.updateButton');
      var avatarUpdatingProfile = buttonElement.getAttribute("data-avatar");
      var avatarInput = document.getElementById("avatarUpdatingProfile");
      var avatarPreview = document.getElementById("avatarPreview");

      document.getElementById("firstNameUpdatingProfile").value = buttonElement.getAttribute("data-firstName");
      document.getElementById("lastNameUpdatingProfile").value = buttonElement.getAttribute("data-lastName");
      document.getElementById("usernameUpdatingProfile").value = buttonElement.getAttribute("data-username");
      document.getElementById("oldUsername").value = buttonElement.getAttribute('data-oldUsername');
      document.getElementById("emailUpdatingProfile").value = buttonElement.getAttribute("data-email");
      document.getElementById("avatarUpdatingProfileHiddenInput").value = avatarUpdatingProfile;


      if (avatarInput.files && avatarInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          avatarPreview.src = e.target.result;
        };
        reader.readAsDataURL(avatarInput.files[0]);
      } else {
        avatarPreview.src = avatarUpdatingProfile;
      }

      updateModal.style.display = "block";
    });
  }

  // Add event listener for close buttons
  var closeButtons = document.getElementsByClassName("close");
  for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", function(event) {
      var modal = event.target.closest('.modal');
      closeModal(modal);
    });
  }

  // Close the modal when clicked outside
  window.addEventListener("click", function(event) {
    if (event.target == updateModal) {
      closeModal(updateModal);
    }
    if (event.target == addModal) {
      closeModal(addModal);
    }
  });

  // Open the add modal
  addModalButton.addEventListener("click", function() {
    addModal.style.display = "block";
  });
</script>




</div>
<!-- End of Main Content -->

<?php include 'footer.php';