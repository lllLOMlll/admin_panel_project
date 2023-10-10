<?php

include "../head.inc.php";

$action = $_REQUEST['action'];

switch ($action) {
// ******************************************************** UPDATE  TITLE ********************************************************
	case "update_title_about":

	$title = trim($_POST['title']);
	$id = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($title)){
		$errorMessage .= "Title cannot be empty! <br>";
	}
	elseif (strlen($title) > 50) {
		$errorMessage .= "The title must contain 50 characters and less. <br>";
	}

	if (empty($errorMessage)) {
		$selectedAboutTitleAndParagraph = $AboutPageManager->getSingleAboutPageTitleAndParagraph($id);

		$updatedAboutPageData = [
			'id' => $id,
			'title' => $title,
			'paragraph' => $selectedAboutTitleAndParagraph->getParagraph()
		];

		$updadatedAboutTitleAndParagraphObject = new AboutPage($updatedAboutPageData);
		$AboutPageManager->editAboutPageTitleAndParagraph($updadatedAboutTitleAndParagraphObject);

		$_SESSION['successMessage'] = "You've updated the title of the About page";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_about_page.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_about_page.php");
	exit; 
	break;

	 // ******************************************************** UPDATE PARAGRAPH  ********************************************************
	case "update_paragraph":

	$paragraph = trim($_POST['paragraph']);
	$id = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($paragraph)){
		$errorMessage .= "Paragraph cannot be empty! <br>";
	}
	elseif (strlen($paragraph) > 300) {
		$errorMessage .= "The paragraph must contain 300 characters and less. <br>";
	}

	if (empty($errorMessage)) {
		$selectedAboutTitleAndParagraph = $AboutPageManager->getSingleAboutPageTitleAndParagraph($id);

		$updatedAboutPageData = [
			'id' => $id,
			'title' => $selectedAboutTitleAndParagraph->getTitle(),
			'paragraph' => $paragraph
		];

		$updadatedAboutTitleAndParagraphObject = new AboutPage($updatedAboutPageData);
		$AboutPageManager->editAboutPageTitleAndParagraph($updadatedAboutTitleAndParagraphObject);

		$_SESSION['successMessage'] = "You've updated the paragraph of the About page";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_about_page.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_about_page.php");
	exit; 
	break;

// ******************************************************** UPDATE TITLE TEAM ********************************************************
	case "update_title_team":

	$id = trim($_POST['id']);
	$title = trim($_POST['title']);

	// VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "The Title cannot be empty! <br>";
	} elseif (strlen($title) > 50) {
		$errorMessage .= "The title must be 50 characters or less <br>";
	}


	if (empty($errorMessage)){
		$titleObject = $TeamManager->getSingleTitle($id);

		$updatedTeamTitleData = [
			'id' => $id,
			'title' => $title,
			'paragraph' => $titleObject->getParagraph()
		];

		$updatedTitle = new TeamTitle($updatedTeamTitleData);
		$TeamManager->updateTitle($updatedTitle);
		$_SESSION['successMessage'] = "You've updated the title of the team section";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_team.php");
		exit;

	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_team.php");
	exit; 
	break;
	
// ******************************************************** ADD TEAM MEMBER  ********************************************************
case "add_team_member":

	$name = trim($_POST['name']);
	$title = trim($_POST['title']);
	$bio = trim($_POST['bio']);
	$picture = $_FILES['picture'];
	$alt = trim($_POST['alt']);
	$order_number = trim($_POST['order_number']);

	// VALIDATION
	$errorMessage = '';
	// Name
	if (empty($name)) {
		$errorMessage .= "The name cannot be empty! <br>";
	} elseif (strlen($name) > 150 ) {
		$errorMessage .= "The name must contain 50 characters or less. <br>";
	}
	// Title
	if (empty($title)) {
		$errorMessage .= "The Title cannot be empty! <br>";
	} elseif (strlen($title) > 50) {
		$errorMessage .= "The title must be 50 characters or less <br>";
	}

	// Bio
	if (empty($bio)) {
		$errorMessage .= "The bio cannot be empty! <br>";
	} elseif (strlen($bio) > 300) {
		$errorMessage .= "The bio must be 300 characters or less <br>";
	}

	// Picture
	$uploadDir = '../img/';
	$newFilename = '';
	$image_path = '';

	if (isset($_FILES['picture'])) {
        // Check if file is uploaded
		if ($_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
			$errorMessage .= "Picture is empty. Please select a valid image.<br>";
		} elseif ($_FILES['picture']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
			$errorMessage .= "Picture must be smaller than 1000 KB.<br>";
		} else {
			$fileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
			if (!in_array($fileType, $allowedExtensions)) {
				$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
			} else {
                // Create a new filename using the title and original file extension
				$newFilename = time() . "." . $fileType;

                // Create the complete path for the upload
				$uploadFile = $uploadDir . $newFilename;

				if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                    // remove '../' 
					$picture_path = str_replace('../', '', $uploadFile);
				} else {
                    // handle upload error
					$errorMessage .= "File upload error! Picture must be smaller than 1000 KB<br>";
				}
			}
		}
	}

	// Alt
	if (empty($alt)) {
		$errorMessage .= "The alt cannot be empty! <br>";
	} elseif (strlen($alt) > 50) {
		$errorMessage .= "The alt must be 50 characters or less <br>";
	}

	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if(empty($errorMessage)) {
		$TeamData = [
			'name' => $name,
			'title' => $title,
			'bio' => $bio,
			'picture_path' => $picture_path,
			'alt' => $alt,
			'order_number' => $order_number
		];

		$teamMember = new Team($TeamData);
		$TeamManager->addTeam($teamMember);

		$_SESSION['successMessage'] = "You've added successfully a new member to the team section";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_about_page.php");
		exit;
	}


	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_about_page.php");
	exit; 
	break;


// ******************************************************** UPDATE TEAM MEMBER  ********************************************************
	case "update_team_member":

	$id = trim($_POST['id']);
	$name = trim($_POST['name']);
	$title = trim($_POST['title']);
	$bio = trim($_POST['bio']);
	$picture = $_FILES['picture'];
	$alt = trim($_POST['alt']);
	$order_number = trim($_POST['order_number']);

		// VALIDATION
	$errorMessage = '';
	// Name
	if (empty($name)) {
		$errorMessage .= "The name cannot be empty! <br>";
	} elseif (strlen($name) > 150 ) {
		$errorMessage .= "The name must contain 50 characters or less. <br>";
	}
	// Title
	if (empty($title)) {
		$errorMessage .= "The Title cannot be empty! <br>";
	} elseif (strlen($title) > 50) {
		$errorMessage .= "The title must be 50 characters or less <br>";
	}

	// Bio
	if (empty($bio)) {
		$errorMessage .= "The bio cannot be empty! <br>";
	} elseif (strlen($bio) > 300) {
		$errorMessage .= "The bio must be 300 characters or less <br>";
	}

	// Alt
	if (empty($alt)) {
		$errorMessage .= "The alt cannot be empty! <br>";
	} elseif (strlen($alt) > 50) {
		$errorMessage .= "The alt must be 50 characters or less <br>";
	}

	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

  // Picture
	$uploadDir = '../img/';
	$newFilename = '';
	$image_path = '';


	if (isset($_FILES['picture'])) {
        // Check if file is uploaded
		if ($_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
			$currentTeamMember = $TeamManager->getSingleTeam($id);
			$picture_path = $currentTeamMember->getPicturePath();
		} elseif ($_FILES['picture']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
			$errorMessage .= "Picture must be smaller than 1000 KB.<br>";
		} else {
			$fileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
			if (!in_array($fileType, $allowedExtensions)) {
				$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
			} else {
                // Create a new filename using the title and original file extension
				$newFilename = time() . "." . $fileType;

                // Create the complete path for the upload
				$uploadFile = $uploadDir . $newFilename;

				if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                    // remove '../' from the avatar path before storing in userData
					$picture_path = str_replace('../', '', $uploadFile);
				} else {
                    // handle upload error
					$errorMessage .= "File upload error! Picture must be smaller than 1000 KB<br>";
				}
			}
		}
	}

	if(empty($errorMessage)){
		$updatedTeamData = [
			'id' => $id,
			'name' => $name,
			'title' => $title,
			'bio' => $bio,
			'picture_path' => $picture_path,
			'alt' => $alt,
			'order_number' => $order_number
		];

		$updatedTeamMember = new Team($updatedTeamData);
		$TeamManager->updateTeam($updatedTeamMember);

		$_SESSION['successMessage'] = "You've updated a member of the team section";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_about_page.php");
		exit;

	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_about_page.php");
	exit; 
	break;

// ******************************************************** DELETE TEAM MEMBER  ********************************************************
	case "delete_team_member":

	$id = trim($_POST['id']);
	
	$deletedTeamMemberObject = $TeamManager->getSingleTeam($id);
	$teamMemberName = $deletedTeamMemberObject->getName();
	$TeamManager->deleteTeam($id);



	$_SESSION['successMessage'] = "You've deleted " . $teamMemberName .  " of the team section";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_about_page.php");
	exit;

// ******************************************************** UPDATE TEAM MEMBER ORDER ********************************************************
	case "update_team_order_number":

	$id = trim($_POST['id']);
	$order_number = trim($_POST['OrderNumber']);

	$memberObject = $TeamManager->getSingleTeam($id);
	$teamMemberName = $memberObject->getName();
	
	// Order number
	$errorMessage = '';
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)){
		$updatedTeamData = [
			'id' => $id,
			'name' => $memberObject->getName(),
			'title' => $memberObject->getTitle(),
			'bio' => $memberObject->getBio(),
			'picture_path' => $memberObject->getPicturePath(),
			'alt' => $memberObject->getAlt(),
			'order_number' => $order_number
		];

		$updatedTeamMember = new Team($updatedTeamData);

		$TeamManager->updateTeam($updatedTeamMember);
		$_SESSION['successMessage'] = "You've updated the order number of " . $teamMemberName;
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_about_page.php");
		exit;
	}


	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_about_page.php");
	exit; 
	break;


}
?>