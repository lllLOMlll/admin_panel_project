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
<h1 class="h3 mb-2 text-gray-800">Title and Welcome Message</h1>


<br>

<!-- TITLE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Title</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display the title -->
                    <?php
                    $TitleAndWelcomeMessages = $TitleAndWelcomeMessageManager->getTitleAndWelcomeText();
                    foreach ($TitleAndWelcomeMessages as $TitleAndWelcomeMessage) {
                        $title = $TitleAndWelcomeMessage->getTitle();
                        ?>
                        <tr>
                          <td><?php echo $TitleAndWelcomeMessage->getTitle(); ?></td>
                          <td>
                            <!-- Update title -->
                            <button type="button" class="updateButton btn-primary btn-icon-split"
                            data-id="<?php echo $TitleAndWelcomeMessage->getId(); ?>"
                            data-title="<?php echo $TitleAndWelcomeMessage->getTitle(); ?>">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                          </span>
                          <span class="text">Update title</span>
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
</div>
</div>



<!-- WELCOME MESSAGE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Welcome Messages</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Paragraph</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display the welcome message -->
                    <?php
                    $TitleAndWelcomeMessages = $TitleAndWelcomeMessageManager->getTitleAndWelcomeText();
                    foreach ($TitleAndWelcomeMessages as $TitleAndWelcomeMessage) {
                        $paragraph = $TitleAndWelcomeMessage->getParagraph();
                        ?>
                        <tr>
                          <td><?php echo $TitleAndWelcomeMessage->getParagraph(); ?></td>
                          <td>
                            <!-- Update message -->
                            <button type="button" class="updateButton btn-primary btn-icon-split"
                            data-id="<?php echo $TitleAndWelcomeMessage->getId(); ?>"
                            data-paragraph="<?php echo $TitleAndWelcomeMessage->getParagraph(); ?>">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                          </span>
                          <span class="text">Update text</span>
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

<!-- Update Title Modal -->
<div id="updateTitleModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="text-center">Update Title</h3>
    <form method="post" action="../controllers/home-controller.php">
      <input type="hidden" id="titleMessageId" name="id" class="form-control">
      <label for="title">Title:</label>
      <ul>
        <li>Title cannot be empty</li>
        <li>Title must be 100 characters or less</li>
    </ul>
    <textarea id="title" name="title" class="form-control"></textarea>
    <br>
    <input type="hidden" name="action" value="update_title">
    <button type="submit" class="btn btn-primary">Update Title</button>
</form>
</div>
</div>

<!-- Update Paragraph Modal -->
<div id="updateParagraphModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 class="text-center">Update Paragraph</h3>
    <form method="post" action="../controllers/home-controller.php">
      <input type="hidden" id="paragraphMessageId" name="id" class="form-control">
      <label for="paragraph">Paragraph:</label>
         <ul>
        <li>Welcome text cannot be empty</li>
        <li>Welcomew text must be 500 characters or less</li>
    </ul>
      <textarea id="paragraph" name="paragraph" class="form-control"></textarea>
      <br>
      <input type="hidden" name="action" value="update_paragraph">
      <button type="submit" class="btn btn-primary">Update Paragraph</button>
  </form>
</div>
</div>



<script type="text/javascript">
   var updateTitleButtons = document.querySelectorAll(".updateButton[data-title]");
   var updateParagraphButtons = document.querySelectorAll(".updateButton[data-paragraph]");

   var updateTitleModal = document.getElementById("updateTitleModal");
   var updateParagraphModal = document.getElementById("updateParagraphModal");

   function closeModal(modal) {
      modal.style.display = "none";
  }

// Open the update title modal
  updateTitleButtons.forEach(function (button) {
      button.addEventListener("click", function() {
        var title = button.getAttribute("data-title");
        var id = button.getAttribute("data-id");

        document.getElementById("title").value = title;
        document.getElementById("titleMessageId").value = id;

        updateTitleModal.style.display = "block";
    });
  });

// Open the update paragraph modal
  updateParagraphButtons.forEach(function (button) {
      button.addEventListener("click", function() {
        var paragraph = button.getAttribute("data-paragraph");
        var id = button.getAttribute("data-id");

        document.getElementById("paragraph").value = paragraph;
        document.getElementById("paragraphMessageId").value = id;

        updateParagraphModal.style.display = "block";
    });
  });

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
      if (event.target == updateTitleModal) {
        closeModal(updateTitleModal);
    }
    if (event.target == updateParagraphModal) {
        closeModal(updateParagraphModal);
    }
});

</script>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';