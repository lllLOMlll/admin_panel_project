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
    <h1 class="h3 mb-2 text-gray-800">Services</h1>



    <!-- TITLE -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Title of the Services Section</h6>
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
              $titleEntity = $ServicesManager->getTitle();
              $titleText = $titleEntity->getTitle();
              ?>
              <tr>
                <td><?php echo $titleText; ?></td>
                <td>
                  <!-- Update title -->
                  <button type="button" id="updateTitleButton" class="updateButton btn-primary btn-icon-split"
                  data-id="<?php echo $titleEntity->getId(); ?>"
                  data-title="<?php echo $titleEntity->getTitle(); ?>">
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
      <h6 class="m-0 font-weight-bold text-primary text-center">Services</h6>
    </div>
    <div class="card-body">
      <!-- Add a service -->
      <button type="button" id="addServiceButton" class="updateButton btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-flag"></i>
        </span>
        <span class="text">Add a Service</span>
      </button>
      <br>
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order number</th>
              <th>Services Title</th>
              <th>Icon</th>
              <th>Description</th>
              <th>Button text</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display the services -->
            <?php
            $servicesList = $ServicesManager->getAllServices();

            foreach ($servicesList as $singleService) {
              ?>
              <tr>
                <td>
                  <form method="post" action="../controllers/home-controller.php">
                    <input type="hidden" name="action" value="update_order_number">
                    <input type="hidden" name="serviceId" value="<?php echo $singleService->getId(); ?>">
                    <textarea name="OrderNumber" style="width: 40px; height: 30px; resize: none;"><?php echo $singleService->getOrderNumber(); ?></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                  </form>
                </td>
                <td><?php echo $singleService->getTitle(); ?></td>
                <td><?php echo $singleService->getIcon(); ?></td>
                <td><?php echo $singleService->getDescription(); ?></td>
                <td><?php echo $singleService->getButtonText(); ?></td>
                <td>
                  <!-- Update Service -->
                  <button type="button" id="updateServiceButton" class="updateServiceButton btn-primary btn-icon-split mb-2" 
                  data-id="<?php echo $singleService->getId(); ?>" 
                  data-icon="<?php echo $singleService->getIcon(); ?>"
                  data-title="<?php echo $singleService->getTitle(); ?>" 
                  data-description="<?php echo $singleService->getDescription(); ?>"
                  data-text-button="<?php echo $singleService->getButtonText(); ?>">
                Update Service</button>           
                <!-- Delete Service -->
                <?php
                if (isset($_SESSION['access_level'])) {
                  $accessLevel = $_SESSION['access_level'];
                  if ($accessLevel == 1) {
                    ?>
                    <form method="post" action="../controllers/home-controller.php" onsubmit="return confirmDelete();">
                      <input type="hidden" name="action" value="delete_service">
                      <input type="hidden" name="serviceId" value="<?php echo $singleService->getId(); ?>"> 
                      <button type="submit" id="deleteServiceButton" class="deleteServiceButton btn-danger btn-icon-split">Delete Service</button>
                    </form>
                    <?php
                  }
                }
                ?>

              </td>
            </tr>

            <!-- end of foreach loop -->
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- MODAL - Update the title of the service section -->
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
          <input type="hidden" name="action" value="update_title_services">
          <button type="submit" class="btn btn-primary">Update Title</button>
        </form>
      </div>
    </div>

    <!-- MODAL - Update services-->
    <div id="updateServiceModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="text-center">Update Service</h3>
        <form method="post" action="../controllers/home-controller.php">
          <!-- Id -->
          <input type="hidden" id="serviceId" name="serviceId" class="form-control">
          <!-- Icon -->
          <label for="serviceIcon"><strong>Icon:</strong></label>
          <select id="serviceIcon" name="serviceIcon" class="form-control">
            <option value="">Select Icon</option> <!-- Placeholder option -->
            <option value="icon-sli-location-pin">Location Pin Icon</option>
            <option value="icon-sli-phone">Phone Icon</option>
            <option value="icon-sli-envelope">Enveloppe Icon</option>
            <option value="icon-sli-umbrella">Umbrella Icon</option>
            <option value="icon-sli-shield">Shield Icon</option>
            <option value="icon-sli-home">Home Icon</option>
            <option value="icon-sli-power">Power Icon</option>
            <option value="icon-sli-phone">Phone Icon</option>
            <option value="icon-sli-compass">Compass Icon</option>
            <option value="icon-sli-check">Check Icon</option>
            <option value="icon-sli-trophy">Trophy Icon</option>
            <option value="icon-sli-energy">Energy Icon</option>
            <option value="icon-sli-fire">Fire Icon</option>
            <option value="icon-sli-anchor">Anchor Icon</option>
            <option value="icon-sli-puzzle">Puzzle Icon</option>
          </select>
          <br>
          <!-- Title -->
          <label for="serviceTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title cannot be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input id="serviceTitleModalTextarea" name="serviceTitleModal" class="form-control">
          <br>
          <!-- Description -->
          <label for="serviceDescriptionModal"><strong>Description:</strong></label>
          <ul>
            <li>Description cannot be empty</li>
            <li>Description text must be 180 characters or less</li>
          </ul>
          <textarea type="text" id="serviceDescriptionModal" name="serviceDescriptionModal" class="form-control"></textarea>
          <br>
          <!-- Button text -->
          <label for="serviceButtonTextModal"><strong>Button text:</strong></label>
          <ul>
            <li>Button text cannot be empty</li>
            <li>Button text must be 15 characters or less</li>
          </ul>
          <input type="text" id="serviceButtonTextModalInput" name="serviceButtonTextModalInput" class="form-control">
          <br>
          <!-- Submit button -->
          <input type="hidden" name="action" value="update_service">
          <button type="submit" class="btn btn-primary">Update Service</button>
        </form>
      </div>
    </div>


    <!-- MODAL - Add a services-->
    <div id="addServiceModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="text-center">Add a Service</h3>
        <form method="post" action="../controllers/home-controller.php">
          <!-- Icon -->
          <label for="serviceIcon"><strong>Icon:</strong></label>
          <select id="serviceIcon" name="serviceIcon" class="form-control">
            <option value="">Select Icon</option> <!-- Placeholder option -->
            <option value="icon-sli-umbrella">Umbrella Icon</option>
            <option value="icon-sli-shield">Shield Icon</option>
            <option value="icon-sli-home">Home Icon</option>
            <option value="icon-sli-power">Power Icon</option>
            <option value="icon-sli-phone">Phone Icon</option>
            <option value="icon-sli-compass">Compass Icon</option>
            <option value="icon-sli-check">Check Icon</option>
            <option value="icon-sli-trophy">Trophy Icon</option>
            <option value="icon-sli-energy">Energy Icon</option>
            <option value="icon-sli-fire">Fire Icon</option>
            <option value="icon-sli-anchor">Anchor Icon</option>
            <option value="icon-sli-puzzle">Puzzle Icon</option>
          </select>
          <br>
          <!-- Title -->     
          <label for="serviceTitleModal"><strong>Title:</strong></label>
          <ul>
            <li>Title be empty</li>
            <li>Title text must be 50 characters or less</li>
          </ul>
          <input id="serviceTitleModalTextarea" name="serviceTitleModal" class="form-control">
          <br>
          <!-- Description -->     
          <label for="serviceDescriptionModal"><strong>Description:</strong></label>
          <ul>
            <li>Description cannot be empty</li>
            <li>Description text must be 180 characters or less</li>
          </ul>
          <textarea type="text" id="serviceDescriptionModal" name="serviceDescriptionModal" class="form-control"></textarea>
          <br>
          <!-- Button text -->    
          <label for="serviceButtonTextModal"><strong>Button text:</strong></label>
          <ul>
            <li>Button text cannot be empty</li>
            <li>Button text must be 15 characters or less</li>
          </ul>
          <input type="text" id="addserviceButtonTextModalInput" name="serviceButtonTextModalInput" class="form-control">
          <br>
          <!--Order Number -->    
          <label for="serviceButtonTextModal"><strong>Order number (will determine the order of apparition):</strong></label>
          <br>
          <input type="text" id="addServiceOrderNumber" name="order_number" class="form-control"> 
          <br>     
          <br> 
          <!-- Submit button -->
          <input type="hidden" name="action" value="add_service">
          <button type="submit" class="btn btn-primary">Add Service</button>
        </form>
      </div>
    </div>

    <script type="text/javascript">

     function confirmDelete() {
      return confirm("Are you sure you want to delete this item?");
    }

// Buttons
    var updateTitleButton = document.getElementById("updateTitleButton");
var updateServicesButtons = document.querySelectorAll(".updateServiceButton"); // Targeting the class instead of the id since an id must be unique
var addServiceButton = document.getElementById("addServiceButton");

// Linking to the modal
var updateTitleModalElement = document.getElementById("updateTitleModal");
var updateServicesModalElement = document.getElementById("updateServiceModal");
var addServiceModalElement = document.getElementById("addServiceModal");

function closeModal(modal) {
  modal.style.display = "none";
}

// Update Title section
updateTitleButton.addEventListener("click", function() {
  var title = updateTitleButton.getAttribute("data-title");
  var id = updateTitleButton.getAttribute("data-id");

  document.getElementById("updateTitle").value = title;
  document.getElementById("titleMessageId").value = id;

  updateTitleModalElement.style.display = "block";
});


// Update Service
updateServicesButtons.forEach(function(button) {
  button.addEventListener("click", function() {
    var id = button.getAttribute("data-id");
    var icon = button.getAttribute("data-icon");
    var title = button.getAttribute("data-title");
    var description = button.getAttribute("data-description");
    var buttonText = button.getAttribute("data-text-button");

    document.getElementById("serviceId").value = id;
    document.getElementById("serviceIcon").value = icon;
    document.getElementById("serviceTitleModalTextarea").value = title;
    document.getElementById("serviceDescriptionModal").value = description;
    document.getElementById("serviceButtonTextModalInput").value = buttonText;

    updateServicesModalElement.style.display = "block";
  });
});

// Add Service
addServiceButton.addEventListener("click", function() {
  addServiceModalElement.style.display = "block";
});

// Closing the modal
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].addEventListener("click", function() {
    closeModal(updateTitleModalElement);
    closeModal(updateServicesModalElement);
    closeModal(addServiceModal); 
  });
}

</script>
</div>
</div>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';