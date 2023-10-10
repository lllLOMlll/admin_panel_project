<?php
include '../head.inc.php';


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
    <h1 class="h3 mb-2 text-gray-800">About (team)</h1>



    <!-- TITLE -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Title</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="titleTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Display the title -->
              <?php
              $aboutPageContent = $AboutPageManager->getAboutPageTitleAndParagraph();
              foreach ($aboutPageContent as $AboutPageTitleAndParagraph) {
                ?>
                <tr>
                  <td><?php echo $AboutPageTitleAndParagraph->getTitle(); ?></td>
                  <td>
                    <!-- Update title -->
                    <button type="button" id="updateTitleButton" class="updateButton btn-primary btn-icon-split"
                    data-id="<?php echo $AboutPageTitleAndParagraph->getId(); ?>"
                    data-title="<?php echo $AboutPageTitleAndParagraph->getTitle(); ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Update title</span>
                  </button>
                </td>
              </tr>
            </tbody>
            <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>

  <!-- PARAGRAPH -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary text-center">Paragraph</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="titleTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Paragraph</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display the paragraph -->
            <?php
            $aboutPageContent = $AboutPageManager->getAboutPageTitleAndParagraph();
            foreach ($aboutPageContent as $AboutPageTitleAndParagraph) {
              ?>
              <tr>
                <td><?php echo $AboutPageTitleAndParagraph->getParagraph(); ?></td>
                <td>
                  <!-- Update paragraph -->
                  <button type="button" id="updateParagraphButton" class="updateButton btn-primary btn-icon-split"
                  data-id="<?php echo $AboutPageTitleAndParagraph->getId(); ?>"
                  data-paragraph="<?php echo $AboutPageTitleAndParagraph->getParagraph(); ?>">
                  <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                  </span>
                  <span class="text">Update paragraph</span>
                </button>
              </td>
            </tr>
          </tbody>
          <?php
        }
        ?>
      </table>
    </div>
  </div>
</div>




<!-- TEAM -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary text-center">Team</h6>
  </div>
  <div class="card-body">
    <!-- Add a Team Member -->
    <button type="button" id="addTeamMemberButton" class="updateButton btn-success btn-icon-split">
      <span class="icon text-white-50">
        <i class="fas fa-flag"></i>
      </span>
      <span class="text">Add a person to the team</span>
    </button>
    <br>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Order number</th>
            <th>Name</th>
            <th>Title</th>
            <th>Bio</th>
            <th>Picture path</th>
            <th>Atl</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allTeam = $TeamManager->getAllTeam();

          foreach ($allTeam as $singleTeamMember) {
            ?>
            <tr>
              <td>
                <form method="post" action="../controllers/about-controller.php">
                  <input type="hidden" name="action" value="update_team_order_number">
                  <input type="hidden" name="id" value="<?php echo $singleTeamMember->getId(); ?>">
                  <textarea name="OrderNumber" style="width: 40px; height: 30px; resize: none;"><?php echo $singleTeamMember->getOrderNumber(); ?></textarea>
                  <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
              </td>
              <td><?php echo $singleTeamMember->getName(); ?></td>
              <td><?php echo $singleTeamMember->getTitle(); ?></td>
              <td><?php echo $singleTeamMember->getBio(); ?></td>
              <td><?php echo $singleTeamMember->getPicturePath(); ?></td>
              <td><?php echo $singleTeamMember->getAlt(); ?></td>
              <td>
                <!-- Update Team member -->
                <button type="button" id="updateTeamMemberButtons" class="updateTeamMemberButtons btn-primary btn-icon-split mb-2" 
                data-id="<?php echo $singleTeamMember->getId(); ?>"
                data-name="<?php echo $singleTeamMember->getName(); ?>"             
                data-title="<?php echo $singleTeamMember->getTitle(); ?>"
                data-bio="<?php echo $singleTeamMember->getBio(); ?>" 
                data-slide-path="<?php echo $singleTeamMember->getPicturePath(); ?>"
                data-alt="<?php echo $singleTeamMember->getAlt(); ?>"
                data-order-number="<?php echo $singleTeamMember->getOrderNumber(); ?>"                 
                >Update Worker</button>
                <!-- Delete Team member -->
                <?php
                if (isset($_SESSION['access_level'])) {
                  $accessLevel = $_SESSION['access_level'];
                  if ($accessLevel == 1) {
                    ?>
                    <form method="post" action="../controllers/about-controller.php" onsubmit="return confirmDelete();">
                      <input type="hidden" name="action" value="delete_team_member">
                      <input type="hidden" name="id" value="<?php echo $singleTeamMember->getId(); ?>"> 
                      <button type="submit" id="deleteSlideButton" class="deleteSlideButton btn-danger btn-icon-split">Delete Worker</button>
                    </form>

                  </td>
                </tr>
                <?php
              }
            }
            ?>
            <!-- end of foreach loop -->
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- MODAL - Update the title  -->
    <div id="updateTitleModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Service title -->
        <h3 class="text-center">Update Title</h3>
        <form method="post" action="../controllers/about-controller.php">
          <input type="hidden" id="teamTitleId" name="id" class="form-control">
          <label for="updateTitle"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title must be 50 characters or less</li>
          </ul>
          <input type="text" id="updateTitle" name="title" class="form-control">
          <br>
          <input type="hidden" name="action" value="update_title_about">
          <button type="submit" class="btn btn-primary">Update Title</button>
        </form>
      </div>
    </div>


    <!-- MODAL - Update the paragraph  -->
    <div id="updateParagraphModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Service paragraph -->
        <h3 class="text-center">Update Paragraph</h3>
        <form method="post" action="../controllers/about-controller.php">
          <input type="hidden" id="paragraphId" name="id" class="form-control">
          <label for="updateTitle"><strong>Title:</strong></label>
          <ul>
            <li>Paragraph cannot be empty</li>
            <li>Paragraph must be 300 characters or less</li>
          </ul>
          <textarea type="text" id="updateParagraph" name="paragraph" class="form-control"></textarea>
          <br>
          <input type="hidden" name="action" value="update_paragraph">
          <button type="submit" class="btn btn-primary">Update Title</button>
        </form>
      </div>
    </div>



    <!-- MODAL - Add a Team Member-->
    <div id="addTeamMemberModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="text-center">Add a Team Member</h3>
        <form method="post" action="../controllers/about-controller.php" enctype="multipart/form-data">

          <!-- Name -->     
          <label for="teamNameModal"><strong>Name:</strong></label>
          <ul>
            <li>Name cannot be empty</li>
            <li>Name text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamNameAdd" name="name" class="form-control">
          <br>

          <!-- Title -->     
          <label for="teamTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamTitleAdd" name="title" class="form-control">
          <br>
          <!-- Bio -->     
          <label for="teamBioModal"><strong>Bio:</strong></label>
          <ul>
            <li>Bio cannot be empty</li>
            <li>Bio text must be 500 characters or less</li>
          </ul>
          <textarea type="text" id="teamBioAdd" name="bio" class="form-control"></textarea>
          <br>
          <!-- Order Number -->     
          <label for="slideAltModal"><strong>Order number (that will determine the order of apparition in the caroussel): </strong></label>
          <ul>
            <li>Order cannot be empty</li>
            <li>Order number must be between 1 and 100</li>
          </ul>
          <input type="text" id="teamOrderNumberAdd" name="order_number" class="form-control">
          <br>     
          <!-- Image -->
          <label for="slideTitleModal"><strong>Picture:</strong></label>
          <label class="label-font me-2 mb-1" for="slidePictureModal" id="slidePictureModal">Select an slide to upload:</label>
          <span></span>
          <br>
          <input class="mb-3" type="file" name="picture" id="teamAddPicture">
          <img id="previewTeamAddPicture" src="" alt="Image preview" style="display: none; width: 150px; height: auto">
          <script>
            document.getElementById('teamAddPicture').addEventListener('change', function(e) {
              var file = e.target.files[0];
                // Add image/png as a valid format
              if (file.type.match('image/jpeg') || file.type.match('image/jpg') || file.type.match('image/gif') || file.type.match('image/png')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  document.getElementById('previewTeamAddPicture').src = e.target.result;
                  document.getElementById('previewTeamAddPicture').style.display = 'block';
                }
                reader.readAsDataURL(file);
              } else {
                alert('Invalid file type. Please select an image file with a .jpg, .jpeg, .gif, or .png extension.');
                e.target.value = '';
              }
            });
          </script>
          <br>
          <!-- Alt -->     
          <label for="teamALTModal"><strong>Slide Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
          <ul>
            <li>Alt cannot be empty</li>
            <li>Alt text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamAltAdd" name="alt" class="form-control">
          <br>



          <!-- Submit button -->
          <input type="hidden" name="action" value="add_team_member">
          <button type="submit" class="btn btn-primary mt-2">Add Team Member</button>
        </form>
      </div>
    </div>

    <!-- MODAL - Update a Team Member-->
    <div id="updateTeamMemberModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="text-center">Update a Team Member</h3>
        <form method="post" action="../controllers/about-controller.php" enctype="multipart/form-data">
          <!-- id -->
          <input type="hidden" id="teamId" name="id" class="form-control">
          <!-- Name -->     
          <label for="slideTitleModal"><strong>Name:</strong></label>
          <ul>
            <li>Name cannot be empty</li>
            <li>Name text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamName" name="name" class="form-control">
          <br>
          <!-- Title -->     
          <label for="slideTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamTitle" name="title" class="form-control">
          <br>

          <!-- Bio -->     
          <label for="slideTitleModal"><strong>Bio:</strong></label>
          <ul>
            <li>Bio cannot be empty</li>
            <li>Bio text must be 500 characters or less</li>
          </ul>
          <textarea type="text" id="teamBio" name="bio" class="form-control"></textarea>
          <br>
          <!-- Order Number -->     
          <label for="slideAltModal"><strong>Order number: </strong></label>
          <ul>
            <li>Order cannot be empty</li>
            <li>Order number must be between 1 and 100</li>
          </ul>
          <input type="text" id="teamOrderNumber" name="order_number" class="form-control">
          <br>    
          <!-- Image -->
          <label for="slideTitleModal"><strong>Slide:</strong></label>
          <label class="label-font me-2 mb-1" for="slideRegistration" id="slideRegistrationLabel">Select a slide to upload:</label>
          <br>
          <input class="mb-3" type="file" name="picture" id="slideRegistration">
          <img id="previewSlide" src="" alt="Image preview" style="display: none; width: 100px; height: auto">
          <script>
            document.getElementById('slideRegistration').addEventListener('change', function(e) {
              var file = e.target.files[0];
              if (file.type.match('image/jpeg') || file.type.match('image/jpg') || file.type.match('image/gif') || file.type.match('image/png')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  document.getElementById('previewSlide').src = e.target.result;
                  document.getElementById('previewSlide').style.display = 'block';
                };
                reader.readAsDataURL(file);
              } else {
                alert('Invalid file type. Please select an image file with a .jpg, .jpeg, .gif, or .png extension.');
                e.target.value = '';
              }
            });

            var updateSlideButtons = document.querySelectorAll(".updateSlideButton"); 

            updateSlideButtons.forEach(function(button) {
              button.addEventListener("click", function() {
                var slidePath = "../" + button.getAttribute("data-slide-path"); 
            document.getElementById('slideRegistration').value = ''; // Clear the file input
            document.getElementById("previewSlide").src = slidePath; 
            document.getElementById("previewSlide").style.display = 'block'; 
          });
            });
          </script>
          <br>
          <!-- Alt -->     
          <label for="slideAltModal"><strong>Picture Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
          <ul>
            <li>Alt cannot be empty</li>
            <li>Alt text must be 50 characters or less</li>
          </ul>
          <input type="text" id="teamAlt" name="alt" class="form-control">
          <br>    
          <!-- Submit button -->
          <input type="hidden" name="action" value="update_team_member">
          <button type="submit" class="btn btn-primary mt-2">Update the Team Member</button>
        </form>
      </div>
    </div>


    <script type="text/javascript">

     function confirmDelete() {
      return confirm("Are you sure you want to delete this item?");
    }

// Buttons
    var updateTitleButton = document.getElementById("updateTitleButton");
    var addTeamMemberButton = document.getElementById("addTeamMemberButton");
var updateTeamMemberButtons = document.querySelectorAll(".updateTeamMemberButtons"); // Targeting the class instead of the id since an id must be unique
var updateParagraphButton = document.getElementById("updateParagraphButton");

// Linking to the modal
var updateTitleModalElement = document.getElementById("updateTitleModal");
var addTeamMemberModalElement = document.getElementById("addTeamMemberModal");
var updateTeamMemberModalElement = document.getElementById("updateTeamMemberModal");
var updateParagraphModalElement = document.getElementById("updateParagraphModal");


function closeModal(modal) {
  modal.style.display = "none";
}

// Update Title Member section
updateTitleButton.addEventListener("click", function() {
  var title = updateTitleButton.getAttribute("data-title");
  var id = updateTitleButton.getAttribute("data-id");

  document.getElementById("updateTitle").value = title;
  document.getElementById("teamTitleId").value = id;

  updateTitleModalElement.style.display = "block";
});

// Update Paragraph section
updateParagraphButton.addEventListener("click", function() {
  var paragraph = updateParagraphButton.getAttribute("data-paragraph");
  var id = updateParagraphButton.getAttribute("data-id");

  document.getElementById("updateParagraph").value = paragraph;
  document.getElementById("paragraphId").value = id;

  updateParagraphModal.style.display = "block";
});

// Add Team Member
addTeamMemberButton.addEventListener("click", function() {
  addTeamMemberModalElement.style.display = "block";
});

// Update Team Member
updateTeamMemberButtons.forEach(function(button) {
  button.addEventListener("click", function() {
    var id = button.getAttribute("data-id");
    var name = button.getAttribute('data-name');
    var title = button.getAttribute("data-title");
    var bio = button.getAttribute('data-bio');
    var slidePath = "../" + button.getAttribute("data-slide-path"); 
    var alt = button.getAttribute("data-alt");
    var orderNumber = button.getAttribute("data-order-number");

    document.getElementById("teamId").value = id;
    document.getElementById("teamName").value = name;
    document.getElementById("teamTitle").value = title;
    document.getElementById("teamBio").value = bio;
    document.getElementById("previewSlide").src = slidePath; 
    document.getElementById("previewSlide").style.display = 'block'; 
    document.getElementById("teamAlt").value = alt;
    document.getElementById("teamOrderNumber").value = orderNumber;

    updateTeamMemberModalElement.style.display = "block";
  });

// Closing the modal
  var closeButtons = document.getElementsByClassName("close");
  for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", function() {
      closeModal(updateTitleModalElement);
      closeModal(updateTeamMemberModalElement);
      closeModal(addTeamMemberModalElement); 
      closeModal(updateParagraphModalElement);  
    });
  }


});




</script>
</div>
</div>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';