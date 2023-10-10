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
    <h1 class="h3 mb-2 text-gray-800">Slider</h1>



    <!-- TITLE -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Title of the Slider Section</h6>
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
              $titleObject = $SliderManager->getTitle();
              $sliderTitle = $titleObject->getTitle();
              ?>
              <tr>
                <td><?php echo $sliderTitle; ?></td>
                <td>
                  <!-- Update title -->
                  <button type="button" id="updateTitleButton" class="updateButton btn-primary btn-icon-split"
                  data-id="<?php echo $titleObject->getId(); ?>"
                  data-title="<?php echo $titleObject->getTitle(); ?>">
                  <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                  </span>
                  <span class="text">Update title</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- SERVICES -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary text-center">Slider</h6>
    </div>
    <div class="card-body">
          <!-- Add a service -->
    <button type="button" id="addSlideButton" class="updateButton btn-success btn-icon-split">
      <span class="icon text-white-50">
        <i class="fas fa-flag"></i>
      </span>
      <span class="text">Add a Slide to the Slider</span>
    </button>
    <br>
    <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order number</th>
              <th>Image Title</th>
              <th>Image Path</th>
              <th>Atl</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display the services -->
            <?php
            $slideList = $SliderManager->getAllSlides();

            foreach ($slideList as $slide) {
              ?>
              <tr>
                <td>
                  <form method="post" action="../controllers/home-controller.php">
                    <input type="hidden" name="action" value="update_slide_order_number">
                    <input type="hidden" name="slideId" value="<?php echo $slide->getId(); ?>">
                    <textarea name="OrderNumber" style="width: 40px; height: 30px; resize: none;"><?php echo $slide->getOrderNumber(); ?></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                  </form>
                </td>
                <td><?php echo $slide->getTitle(); ?></td>
                <td><?php echo $slide->getSlidePath(); ?></td>
                <td><?php echo $slide->getAlt(); ?></td>
                <td>
                  <!-- Update Slide -->
                  <button type="button" id="updateSlideButtons" class="updateSlideButton btn-primary btn-icon-split mb-2" 
                  data-id="<?php echo $slide->getId(); ?>"             
                  data-title="<?php echo $slide->getTitle(); ?>" 
                  data-slide-path="<?php echo $slide->getSlidePath(); ?>"
                  data-alt="<?php echo $slide->getAlt(); ?>"
                  data-order-number="<?php echo $slide->getOrderNumber(); ?>"                 
                  >Update Slide</button>
                  <!-- Delete Slide -->
                  <?php
                  if (isset($_SESSION['access_level'])) {
                    $accessLevel = $_SESSION['access_level'];
                    if ($accessLevel == 1) {
                      ?>
                      <form method="post" action="../controllers/home-controller.php" onsubmit="return confirmDelete();">
                        <input type="hidden" name="action" value="delete_slide">
                        <input type="hidden" name="slideId" value="<?php echo $slide->getId(); ?>"> 
                        <button type="submit" id="deleteSlideButton" class="deleteSlideButton btn-danger btn-icon-split">Delete Slide</button>
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

      <!-- MODAL - Update the title of the slide section -->
      <div id="updateTitleModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <!-- Service title -->
          <h3 class="text-center">Update Title</h3>
          <form method="post" action="../controllers/home-controller.php">
            <input type="hidden" id="titleMessageId" name="id" class="form-control">
            <label for="updateTitle"><strong>Title:</strong></label>
            <ul>
              <li>Title cannot be empty</li>
              <li>Title must be 50 characters or less</li>
            </ul>
            <input type="text" id="updateTitle" name="title" class="form-control">
            <br>
            <input type="hidden" name="action" value="update_title_slider">
            <button type="submit" class="btn btn-primary">Update Title</button>
          </form>
        </div>
      </div>

      <!-- MODAL - Add a Slide-->
      <div id="addSlideModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h3 class="text-center">Add a Slide</h3>
          <form method="post" action="../controllers/home-controller.php" enctype="multipart/form-data">
           <!-- Image -->
           <label for="slideTitleModal"><strong>Slide:</strong></label>
           <label class="label-font me-2 mb-1" for="slideRegistration" id="slideRegistrationLabel">Select an slide to upload:</label>
           <span></span>
           <br>
           <input class="mb-3" type="file" name="slideRegistration" id="slideRegistrationAdd">
           <img id="previewSlideAdd" src="" alt="Image preview" style="display: none; width: 150px; height: auto">
           <script>
            document.getElementById('slideRegistrationAdd').addEventListener('change', function(e) {
              var file = e.target.files[0];
                // Add image/png as a valid format
              if (file.type.match('image/jpeg') || file.type.match('image/jpg') || file.type.match('image/gif') || file.type.match('image/png')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  document.getElementById('previewSlideAdd').src = e.target.result;
                  document.getElementById('previewSlideAdd').style.display = 'block';
                }
                reader.readAsDataURL(file);
              } else {
                alert('Invalid file type. Please select an image file with a .jpg, .jpeg, .gif, or .png extension.');
                e.target.value = '';
              }
            });
          </script>
          <br>
          <!-- Title -->     
          <label for="slideTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input type="text" id="slideTitleAdd" name="slideTitle" class="form-control">
          <br>
          
          <!-- Alt -->     
          <label for="slideAltModal"><strong>Slide Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
          <ul>
            <li>Alt cannot be empty</li>
            <li>Alt text must be 50 characters or less</li>
          </ul>
          <input type="text" id="slideAltAdd" name="slideAlt" class="form-control">
          <br>
          <!-- Order Number -->     
          <label for="slideAltModal"><strong>Order number: </strong></label>
          <ul>
            <li>Order cannot be empty</li>
            <li>Order number must be between 1 and 100</li>
          </ul>
          <input type="text" id="slideNumber" name="slideNumber" class="form-control">
          <br>        
          <!-- Submit button -->
          <input type="hidden" name="action" value="add_slide">
          <button type="submit" class="btn btn-primary mt-2">Add Slide</button>
        </form>
      </div>
    </div>

    <!-- MODAL - Update a Slide-->
    <div id="updateSlideModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="text-center">Update a Slide</h3>
        <form method="post" action="../controllers/home-controller.php" enctype="multipart/form-data">
          <!-- id -->
          <input type="hidden" id="slideId" name="slideId" class="form-control">
          <!-- Image -->
          <label for="slideTitleModal"><strong>Slide:</strong></label>
          <label class="label-font me-2 mb-1" for="slideRegistration" id="slideRegistrationLabel">Select a slide to upload:</label>
          <br>
          <input class="mb-3" type="file" name="slideRegistration" id="slideRegistration">
          <img id="previewSlide" src="" alt="Image preview" style="display: none; width: 150px; height: auto">
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
          <!-- Title -->     
          <label for="slideTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input type="text" id="slideTitle" name="slideTitle" class="form-control">
          <br>
          <!-- Alt -->     
          <label for="slideAltModal"><strong>Slide Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
          <ul>
            <li>Alt cannot be empty</li>
            <li>Alt text must be 50 characters or less</li>
          </ul>
          <input type="text" id="slideAlt" name="slideAlt" class="form-control">
          <br>
          <!-- Order Number -->     
          <label for="slideAltModal"><strong>Order number: </strong></label>
          <ul>
            <li>Order cannot be empty</li>
            <li>Order number must be between 1 and 100</li>
          </ul>
          <input type="text" id="slideOrderNumber" name="slideOrderNumber" class="form-control">
          <br>        
          <!-- Submit button -->
          <input type="hidden" name="action" value="update_slide">
          <button type="submit" class="btn btn-primary mt-2">Update Slide</button>
        </form>
      </div>
    </div>


    <script type="text/javascript">

     function confirmDelete() {
      return confirm("Are you sure you want to delete this Slide?");
    }

// Buttons
    var updateTitleButton = document.getElementById("updateTitleButton");
var updateSlideButtons = document.querySelectorAll(".updateSlideButton"); // Targeting the class instead of the id since an id must be unique
var addSlideButton = document.getElementById("addSlideButton");

// Linking to the modal
var updateTitleModalElement = document.getElementById("updateTitleModal");
var updateSlideModalElement = document.getElementById("updateSlideModal");
var addSlideModalElement = document.getElementById("addSlideModal");

function closeModal(modal) {
  modal.style.display = "none";
}

// Update Title Slide section
updateTitleButton.addEventListener("click", function() {
  var title = updateTitleButton.getAttribute("data-title");
  var id = updateTitleButton.getAttribute("data-id");

  document.getElementById("updateTitle").value = title;
  document.getElementById("titleMessageId").value = id;

  updateTitleModalElement.style.display = "block";
});


// Update Slide
updateSlideButtons.forEach(function(button) {
  button.addEventListener("click", function() {
    var id = button.getAttribute("data-id");
    var title = button.getAttribute("data-title");
    var slidePath = "../" + button.getAttribute("data-slide-path"); 
    var alt = button.getAttribute("data-alt");
    var orderNumber = button.getAttribute("data-order-number");

    document.getElementById("slideId").value = id;
    document.getElementById("slideTitle").value = title;
    document.getElementById("previewSlide").src = slidePath; 
    document.getElementById("previewSlide").style.display = 'block'; 
    document.getElementById("slideAlt").value = alt;
    document.getElementById("slideOrderNumber").value = orderNumber;

    updateSlideModalElement.style.display = "block";
  });
});


// Add Slide
addSlideButton.addEventListener("click", function() {
  addSlideModalElement.style.display = "block";
});

// Closing the modal
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].addEventListener("click", function() {
    closeModal(updateTitleModalElement);
    closeModal(updateSlideModalElement);
    closeModal(addSlideModalElement); 
  });
}

</script>
</div>
</div>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';