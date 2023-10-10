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
<h1 class="h3 mb-2 text-gray-800">Welcome Messages</h1>

<div style="display: flex;">
    <!-- Add a message -->
    <a id="addButton" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-check"></i>
        </span>
        <span class="text">Add a paragraph</span>
    </a>

    <!-- Sort by order number -->
    <form method="post" action="../controllers/welcomeMessage-controller.php" style="margin-left: 10px;">
        <input type="hidden" name="action" value="sort_by_order_number_welcome_message">
        <button type="submit" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Sort by Order Number</span>
        </button>
    </form>
</div>
<br>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Welcome Messages</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>Rank</th>
                        <th>Paragraph</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display all the messages of the database -->
                    <?php
                    $welcomeMessages = $WelcomeMessageManager->getAllWelcomeMessages();
                    foreach ($welcomeMessages as $welcomeMessage) {
                        ?>
                        <tr>

                          <td><?php echo $welcomeMessage->getOrderNumber(); ?></td>
                          <td><?php echo $welcomeMessage->getParagraph(); ?></td>
                          <td>

                            <!-- Update message -->
                            <button type="button" class="updateButton btn-primary btn-icon-split"
                            data-id="<?php echo $welcomeMessage->getId(); ?>"
                            data-order-number="<?php echo $welcomeMessage->getOrderNumber(); ?>"
                            data-paragraph="<?php echo $welcomeMessage->getParagraph(); ?>">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                          </span>
                          <span class="text">Update paragraph</span>
                      </button>

                      <!-- Delete message -->
                      <form method="post" action="../controllers/welcomeMessage-controller.php">
                        <input type="hidden" name="action" value="delete_welcome_message">
                        <input type="hidden" name="id" value="<?php echo $welcomeMessage->getId(); ?>">
                        <button type="submit" class="mt-2 btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Delete message</span>
                        </button>
                    </form>

                </td>
            </tr>
            <!-- end of foreach loop -->
            <?php
        }
        ?>

    </tbody>


</table>
</div>
</div>
</div>


<!-- Update Modal -->
<div id="updateModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="text-center">Update Welcome Message</h3>
    <form method="post" action="../controllers/welcomeMessage-controller.php">
      <input type="hidden" id="messageId" name="id" class="form-control">
      <label for="orderNumber">Order Number:</label>
      <input type="number" id="orderNumber" name="order_number" class="form-control">
      <label for="paragraph">Paragraph:</label>
      <textarea id="paragraph" name="paragraph" class="form-control"></textarea>
      <br>
      <input type="hidden" name="action" value="update_welcome_message">
      <button type="submit" class="btn btn-primary">Save Changes</button>
  </form>
</div>
</div>


<!-- Add a paragraph Modal -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="text-center">Add a Paragraph</h3>
    <form method="post" action="../controllers/welcomeMessage-controller.php">
      <label for="orderNumber">Order Number:</label>
      <input type="number" id="orderNumber" name="order_number" class="form-control">
      <label for="paragraph">Paragraph:</label>
      <textarea id="paragraph" name="paragraph" class="form-control"></textarea>
      <br>
      <input type="hidden" name="action" value="add_welcome_message">
      <button type="submit" id="addButton" class="btn btn-primary">Add Paragraph</button>
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
        var id = buttonElement.getAttribute("data-id");
        var orderNumber = buttonElement.getAttribute("data-order-number");
        var paragraph = buttonElement.getAttribute("data-paragraph");

        document.getElementById("messageId").value = id;
        document.getElementById("orderNumber").value = orderNumber;
        document.getElementById("paragraph").value = paragraph;

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