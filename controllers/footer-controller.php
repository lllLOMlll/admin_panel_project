<?php
include "../head.inc.php";


$action = $_REQUEST['action'];


switch ($action) {

// ******************************************************** REGISTER ********************************************************
  case "updateFooter":
  $copyright = trim($_POST['footerCopyright']);
  $design_company = trim($_POST['footerDesignCompany']);
  $legal_message = trim($_POST['footerLegalMessage']);

  // VALIDATION
  $errorMessage = "";
  $maxLength = 255; // Define a maximum length if needed

  // Copyright
  if (empty($copyright)) {
    $errorMessage .= "Copyright field cannot be empty. <br>";
  } elseif (strlen($copyright) > $maxLength) {
    $errorMessage .= "Copyright field is too long. <br>";
  }

  // Design company
  if (empty($design_company)) {
    $errorMessage .= "Design company field cannot be empty. <br>";
  } elseif (strlen($design_company) > $maxLength) {
    $errorMessage .= "Design company field is too long. <br>";
  }

  // Legal message
  if (empty($legal_message)) {
    $errorMessage .= "Legal message field cannot be empty. <br>";
  } elseif (strlen($legal_message) > $maxLength) {
    $errorMessage .= "Legal message field is too long. <br>";
  }

  if (empty($errorMessage)) {
    $FooterManager->updateFooter($copyright, $design_company, $legal_message);
    $_SESSION['successMessage'] = "You have successfully updated the footer!";
    header("Location: ../admin/table_footer.php");
    exit;
  } else {
    $_SESSION['errorMessage'] = $errorMessage; // Store error message in the session
    header("Location: ../admin/table_footer.php");
    exit;
  }
  break;

}
?>