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
    <h1 class="h3 mb-2 text-gray-800">Portfolio</h1>



    <!-- TITLE OF THE PORTFOLIO SECTION -->
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
              $titleObject = $PortfolioManager->getTitle();
              $title = $titleObject->getTitle();
          
              ?>
              <tr>
                <td><?php echo $title; ?></td>
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

  <!-- PORTFOLIO TABLE -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary text-center">Slider</h6>
    </div>
    <div class="card-body">
      <!-- ADD A PICTURE TO THE PORTFOLIO -->
      <button type="button" id="addPictureToThePortfolioButton" class="updateButton btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-flag"></i>
        </span>
        <span class="text">Add a Picture to the Portfolio</span>
      </button>
      <br>
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order number</th>
              <th>Description</th>
              <th>Image Path</th>
              <th>Atl</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display the portfolio -->
            <?php
            $portfolios = $PortfolioManager->getAllPortfolio();

            foreach ($portfolios as $portfolio) {
              ?>
              <tr>
                <td>
                  <form method="post" action="../controllers/home-controller.php">
                    <input type="hidden" name="action" value="update_portfolio_order_number">
                    <input type="hidden" name="slidePorfolioId" value="<?php echo $portfolio->getId(); ?>">
                    <textarea name="OrderNumber" style="width: 40px; height: 30px; resize: none;"><?php echo $portfolio->getOrderNumber(); ?></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                  </form>
                </td>
                <td><?php echo $portfolio->getDescription(); ?></td>
                <td><?php echo $portfolio->getImagePath(); ?></td>
                <td><?php echo $portfolio->getAlt(); ?></td>
                <td>
                  <!-- Update Slide -->
                  <button type="button" id="updatePorfolioSlideButtons" class="updatePorfolioSlideButtons btn-primary btn-icon-split mb-2" 
                  data-id="<?php echo $portfolio->getId(); ?>"             
                  data-description="<?php echo $portfolio->getDescription(); ?>" 
                  data-image-path="<?php echo $portfolio->getImagePath(); ?>"
                  data-alt="<?php echo $portfolio->getAlt(); ?>"
                  data-order-number="<?php echo $portfolio->getOrderNumber(); ?>"                 
                  >Update Slide</button>
                  <!-- Delete Slide -->
                  <?php
                  if (isset($_SESSION['access_level'])) {
                    $accessLevel = $_SESSION['access_level'];
                    if ($accessLevel == 1) {
                      ?>
                      <form method="post" action="../controllers/home-controller.php" onsubmit="return confirmDelete();">
                        <input type="hidden" name="action" value="delete_slide_portfolio">
                        <input type="hidden" name="slidePortfolioId" value="<?php echo $portfolio->getId(); ?>"> 
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
            <input type="hidden" name="action" value="update_title_portfolio">
            <button type="submit" class="btn btn-primary">Update Title</button>
          </form>
        </div>
      </div>

      <!-- MODAL - Add Portfolio-->
      <div id="addPortfolioModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h3 class="text-center">Add a slide to the Portfolio</h3>
          <form method="post" action="../controllers/home-controller.php" enctype="multipart/form-data">
            <!-- Image -->
            <label for="addPortfolioTitleModal"><strong>Image:</strong></label>
            <label class="label-font me-2 mb-1" for="addImagePortfolio" id="addImagePortfolioLabel">Select an slide to upload:</label>
            <span></span>
            <br>
            <input class="mb-3" type="file" name="addImagePathPortfolio" id="addImagePathPortfolio">
            <img id="previewImageAddPortfolio" src="" alt="Image preview" style="display: none; width: 150px; height: auto">
            <script>
              document.getElementById('addImagePathPortfolio').addEventListener('change', function(e) {
                var file = e.target.files[0];
                // Add image/png as a valid format
                if (file.type.match('image/jpeg') || file.type.match('image/jpg') || file.type.match('image/gif') || file.type.match('image/png')) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    document.getElementById('previewImageAddPortfolio').src = e.target.result;
                    document.getElementById('previewImageAddPortfolio').style.display = 'block';
                  }
                  reader.readAsDataURL(file);
                } else {
                  alert('Invalid file type. Please select an image file with a .jpg, .jpeg, .gif, or .png extension.');
                  e.target.value = '';
                }
              });
            </script>
            <br>
            <!-- Description -->     
            <label for="descriptionPortfolioModal"><strong>Description:</strong></label>
            <ul>
              <li>Description cannot be empty</li>
              <li>Description must be 150 characters or less</li>
            </ul>
            <input type="text" id="addDescriptionPortfolio" name="addDescriptionPortfolio" class="form-control">
            <br>
            
            <!-- Alt -->     
            <label for="altPortfolioModal"><strong>Image Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
            <ul>
              <li>Alt cannot be empty</li>
              <li>Alt text must be 50 characters or less</li>
            </ul>
            <input type="text" id="addAltPorfolio" name="addAltPorfolio" class="form-control">
            <br>
            <!-- Order Number -->     
            <label for="orderPortfolioModal"><strong>Order number: </strong></label>
            <ul>
              <li>Order cannot be empty</li>
              <li>Order number must be between 1 and 100</li>
            </ul>
            <input type="text" id="orderNumberPortfolio" name="orderNumberPortfolio" class="form-control">
            <br>        
            <!-- Submit button -->
            <input type="hidden" name="action" value="add_portfolio">
            <button type="submit" class="btn btn-primary mt-2">Add a picture to the Porfolio</button>
          </form>
        </div>
      </div>

      <!-- MODAL - Update a slide of the Portfolio-->
      <div id="updatePortfolioSlideModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h3 class="text-center">Update a Slide of the Portfolio</h3>
          <form method="post" action="../controllers/home-controller.php" enctype="multipart/form-data">
            <!-- id -->
            <input type="hidden" id="slidePortfolioId" name="slidePortfolioId" class="form-control">
            <!-- Image -->
            <label for="slideTitleModal"><strong>Image:</strong></label>
            <label class="label-font me-2 mb-1" for="slideRegistration" id="slideRegistrationLabel">Select a slide to upload:</label>
            <br>
            <input class="mb-3" type="file" name="imageUpdatePorfolio" id="slideRegistration">
            <img id="previewImageUpdatePortfolio" src="" alt="Image preview" style="display: none; width: 150px; height: auto">
            <script>
              document.getElementById('slideRegistration').addEventListener('change', function(e) {
                var file = e.target.files[0];
                if (file.type.match('image/jpeg') || file.type.match('image/jpg') || file.type.match('image/gif') || file.type.match('image/png')) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    document.getElementById('previewImageUpdatePortfolio').src = e.target.result;
                    document.getElementById('previewImageUpdatePortfolio').style.display = 'block';
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
            <!-- Id -->
            <input type="hidden" id="slidePortfolioUpdateId" name="slidePortfolioUpdateId" class="form-control">
            <!-- Description -->     
            <label for="slideTitleModal"><strong>Description:</strong></label>
            <ul>
              <li>Description cannot be empty</li>
              <li>Description must be 50 characters or less</li>
            </ul>
            <input type="text" id="slidePortfolioUpdateDescription" name="slidePortfolioUpdateDescription" class="form-control">
            <br>
            <!-- Alt -->     
            <label for="slideAltModal"><strong>Slide Alt: </strong> (it's like a title for the image in case the image is not displayed)</label>
            <ul>
              <li>Alt cannot be empty</li>
              <li>Alt text must be 50 characters or less</li>
            </ul>
            <input type="text" id="slidePortfolioUpdateAlt" name="slidePortfolioUpdateAlt" class="form-control">
            <br>
            <!-- Order Number -->     
            <label for="slideAltModal"><strong>Order number: </strong></label>
            <ul>
              <li>Order cannot be empty</li>
              <li>Order number must be between 1 and 100</li>
            </ul>
            <input type="text" id="slidePortfolioUpdateOrderNumber" name="slidePortfolioUpdateOrderNumber" class="form-control">
            <br>        
            <!-- Submit button -->
            <input type="hidden" name="action" value="update_slide_portfolio">
            <button type="submit" class="btn btn-primary mt-2">Update Slide</button>
          </form>
        </div>
      </div>


      <script type="text/javascript">

       function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");
      }

// Buttons
      var updateTitleButton = document.getElementById("updateTitleButton");
var updatePorfolioSlideButtons = document.querySelectorAll(".updatePorfolioSlideButtons"); // Targeting the class 
var addPictureToThePortfolioButton = document.getElementById("addPictureToThePortfolioButton");

// Linking to the modal
var updateTitleModalElement = document.getElementById("updateTitleModal");
var updatePortfolioSlideModalElement = document.getElementById("updatePortfolioSlideModal");
var addPortfolioModalElement = document.getElementById("addPortfolioModal");

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
updatePorfolioSlideButtons.forEach(function(button) {
  button.addEventListener("click", function() {
    var id = button.getAttribute("data-id");
    var description = button.getAttribute("data-description");
    var imagePath = "../" + button.getAttribute("data-image-path"); 
    var alt = button.getAttribute("data-alt");
    var orderNumber = button.getAttribute("data-order-number");

    document.getElementById("slidePortfolioUpdateId").value = id;
    document.getElementById("slidePortfolioUpdateDescription").value = description;
    document.getElementById("previewImageUpdatePortfolio").src = imagePath; 
    document.getElementById("previewImageUpdatePortfolio").style.display = 'block'; 
    document.getElementById("slidePortfolioUpdateAlt").value = alt;
    document.getElementById("slidePortfolioUpdateOrderNumber").value = orderNumber;

    updatePortfolioSlideModalElement.style.display = "block";
  });
});


// Add Slide
addPictureToThePortfolioButton.addEventListener("click", function() {
  addPortfolioModalElement.style.display = "block";
});

// Closing the modal
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].addEventListener("click", function() {
    closeModal(updateTitleModalElement);
    closeModal(updatePortfolioSlideModalElement);
    closeModal(addPortfolioModalElement); 
  });
}

</script>
</div>
</div>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';