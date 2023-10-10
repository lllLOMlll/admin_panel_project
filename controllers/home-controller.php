<?php

include "../head.inc.php";

$action = $_REQUEST['action'];

switch ($action) {

//********************************************************************************************************************************
// ********************************************************   VISIBILITY   *********************************************************
//********************************************************************************************************************************
	case "change_visibility":

	$id = trim($_POST['visibilityId']);

	$VisibilityManager->changeVisibility($id); 
	$_SESSION['successMessage'] = "You've successfully changed the visibility!";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_visibility.php");
	exit; 
	break;



//********************************************************************************************************************************
// ********************************************************   TITLE    ***********************************************************
//********************************************************************************************************************************

// ******************************************************** UPDATE  TITLE ********************************************************
	case "update_title":

	$newTitle = trim($_POST['title']);
	$messageId = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($newTitle)){
		$errorMessage .= "Title cannot be empty! <br>";
	}
	elseif (strlen($newTitle) > 100) {
		$errorMessage .= "The title must contain 100 characters and less. <br>";
	}
	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$TitleAndWelcomeMessageManager->updateTitle($messageId, $newTitle);
		$_SESSION['successMessage'] = "You've update successfully the Title!";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_title_and_welcome_message.php");
		exit; 
	}
	
	header("Location: ../admin/table_title_and_welcome_message.php");
	exit; 
	break;



    // ******************************************************** UPDATE  PARAGRAPH ********************************************************
	case "update_paragraph":

	$newParagraph = trim($_POST['paragraph']);
	$paragraphId = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($newParagraph)) {
		$errorMessage .= "The welcome text cannot be empty. <br>";
	} elseif (strlen($newParagraph) > 500) {
		$errorMessage .= "The welcome text must be 500 characters or less<br>";
	}
	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$TitleAndWelcomeMessageManager->updateParagraph($paragraphId, $newParagraph);
		$_SESSION['successMessage'] = "You've successfully added a paragraph!";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_title_and_welcome_message.php");
		exit; 
	}



	header("Location: ../admin/table_title_and_welcome_message.php");
	exit; 
	break;


//********************************************************************************************************************************
// ********************************************************   SERVICES   *********************************************************
//********************************************************************************************************************************

 // ******************************************************** UPDATE SERVICE TITLE SECTION ********************************************************
	case "update_title_services":

	$newTitle = trim($_POST['title']);
	$messageId = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($newTitle)){
		$errorMessage .= "Title cannot be empty! <br>";
	}
	elseif (strlen($newTitle) > 50) {
		$errorMessage .= "The title must contain 50 characters and less. <br>";
	}
	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$updatedTitleData = [
			'id' => $messageId,
			'title' => $newTitle
		];

		$newTitleObject = new ServicesTitle($updatedTitleData);		
		$ServicesManager->updateTitle($newTitleObject);
		$_SESSION['successMessage'] = "You've update successfully the Title of the Services Section (Home page)!";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_services.php");
		exit; 
	}
	
	header("Location: ../admin/table_services.php");
	exit; 
	break;


 // ******************************************************** UPDATE  SERVICE ********************************************************
	case "update_service":

	$newIcon = trim($_POST['serviceIcon']);
	$newTitle = trim($_POST['serviceTitleModal']);
	$newDescription = trim($_POST['serviceDescriptionModal']);
	$newButtonText = trim($_POST['serviceButtonTextModalInput']);
	$serviceId = trim($_POST['serviceId']);

	// VALIDATION
	$errorMessage = '';
	// Icon
	if (empty($newIcon)) {
		$errorMessage .= "Icon cannot be empty! <br>";
	}

	// Title
	if (empty($newTitle)) {
		$errorMessage .= "Title cannot be empty! <br>";
	} elseif (strlen($newTitle) > 50) {
		$errorMessage .= "The title must contain 50 characters or less. <br>";
	}

	// Description
	if (empty($newDescription)) {
		$errorMessage .= "The description cannot be empty! <br>";
	} elseif (strlen($newDescription) > 180 ) {
		$errorMessage .= "The description must contain 180 characters or less. <br>";
	}

 	// Button text
	if (empty($newButtonText)) {
		$errorMessage .= "Button text cannot be empty";
	} elseif (strlen($newButtonText) > 15) {
		$errorMessage .= "Button text must contain 15 characters or less <br>";
	}

	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$selectedService = $ServicesManager->getSelectedService($serviceId);
		$serviceName = $selectedService->getTitle();

		$updatedServicesData = [		
			'id' => $serviceId,
			'icon' => $newIcon,
			'title' => $newTitle,
			'description' => $newDescription,
			'button_text' => $newButtonText,
			'order_number' => $selectedService->getOrderNumber()
		];

		$newServiceObject = new Services($updatedServicesData);

		$ServicesManager->editService($newServiceObject);
		$_SESSION['successMessage'] = "You've update successfully the service " . $serviceName;
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_services.php");
		exit; 	
	}
	
	header("Location: ../admin/table_services.php");
	exit; 
	break;

 // ******************************************************** UPDATE ORDER NUMBER  ********************************************************
	case "update_order_number":
	$newOrderNumber = trim($_POST['OrderNumber']);
	$serviceId = trim($_POST['serviceId']);

	// VALIDATION
	$errorMessage = '';
	
	// Order number
	if (empty($newOrderNumber)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($newOrderNumber) || (int)$newOrderNumber < 1 || (int)$newOrderNumber > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)) {
		$selectedService = $ServicesManager->getSelectedService($serviceId);
		$serviceName = $selectedService->getTitle();
		$updatedServiceData = [
			'id' => $serviceId,
			'icon' => $selectedService->getIcon(),
			'title' => $selectedService->getTitle(),
			'description' => $selectedService->getDescription(),
			'button_text' => $selectedService->getButtonText(),
		'order_number' => $newOrderNumber  // Changed this line
	];

	$updatedServiceObject = new Services($updatedServiceData);
	$ServicesManager->editService($updatedServiceObject);

	$_SESSION['successMessage'] = "You've updated successfully the order number of the service " . $serviceName;
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_services.php");
	exit;
} else {
	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_services.php");
	exit;
}


 // ******************************************************** ADDING A SERVICE  ********************************************************
case "add_service":

	// Check if there are already 6 services
$services = $ServicesManager->getAllServices();
if (count($services) >= 6) {
	$_SESSION['errorMessage'] = "You cannot add more than 6 services!";
	header("Location: ../admin/table_services.php");
	exit;
}

$newIcon = trim($_POST['serviceIcon']);
$newTitle = trim($_POST['serviceTitleModal']);
$newDescription = trim($_POST['serviceDescriptionModal']);
$newButtonText = trim($_POST['serviceButtonTextModalInput']);
$order_number = trim($_POST['order_number']);

	// VALIDATION
$errorMessage = '';
	// Icon
if (empty($newIcon)) {
	$errorMessage .= "Icon cannot be empty! <br>";
}

	// Title
if (empty($newTitle)) {
	$errorMessage .= "Title cannot be empty! <br>";
} elseif (strlen($newTitle) > 50) {
	$errorMessage .= "The title must contain 50 characters or less. <br>";
}

	// Description
if (empty($newDescription)) {
	$errorMessage .= "The description cannot be empty! <br>";
} elseif (strlen($newDescription) > 180 ) {
	$errorMessage .= "The description must contain 180 characters or less. <br>";
}

 	// Button text
if (empty($newButtonText)) {
	$errorMessage .= "Button text cannot be empty";
} elseif (strlen($newButtonText) > 15) {
	$errorMessage .= "Button text must contain 15 characters or less <br>";
}

$_SESSION['errorMessage'] = $errorMessage;

if (empty($errorMessage)) {


	$updatedServicesData = [		
		'icon' => $newIcon,
		'title' => $newTitle,
		'description' => $newDescription,
		'button_text' => $newButtonText,
		'order_number' => $order_number
	];

	$newServiceObject = new Services($updatedServicesData);
	$ServicesManager->addService($newServiceObject);
	$_SESSION['successMessage'] = "You've added successfully " . $newTitle . " as a new service";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_services.php");
	exit; 	
}

header("Location: ../admin/table_services.php");
exit; 
break;


 // ******************************************************** DELETE SERVICE  ********************************************************
case "delete_service":


// Check if there is only 1 service services
$services = $ServicesManager->getAllServices();
if (count($services) == 1) {
	$_SESSION['errorMessage'] = "You cannot delete all the services!";
	header("Location: ../admin/table_services.php");
	exit;
}

$serviceId = trim($_POST['serviceId']);

$ServicesManager->deleteService($serviceId);
$_SESSION['successMessage'] = "You've deleted successfully the selected service";
unset($_SESSION['errorMessage']);
header("Location: ../admin/table_services.php");
exit; 


break;

//********************************************************************************************************************************
// ********************************************************   TEAM   *********************************************************
//********************************************************************************************************************************
// ******************************************************** ADD TEAM MEMBER  ********************************************************
	case "add_team_member":

	// Check if there are already 30 services
	$teamMembers = $TeamManager->getAllTeam();
	if (count($teamMembers) >= 30) {
		$_SESSION['errorMessage'] = "You cannot add more than 30 team member!";
		header("Location: ../admin/table_.php");
	exit;
}

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
		header("Location: ../admin/table_team.php");
		exit;
	}


	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_team.php");
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
		header("Location: ../admin/table_team.php");
		exit;

	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_team.php");
	exit; 
	break;

// ******************************************************** DELETE TEAM MEMBER  ********************************************************
	case "delete_team_member":

	// Check if there is only 1 team member
	$teamMembers = $TeamManager->getAllTeam();
	if (count($teamMembers) == 1) {
		$_SESSION['errorMessage'] = "You cannot delete all the Team members!";
		header("Location: ../admin/table_team.php");
		exit;
	}

	$id = trim($_POST['id']);
	
	$deletedTeamMemberObject = $TeamManager->getSingleTeam($id);
	$teamMemberName = $deletedTeamMemberObject->getName();
	$TeamManager->deleteTeam($id);



	$_SESSION['successMessage'] = "You've deleted " . $teamMemberName .  " of the team section";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_team.php");
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
		header("Location: ../admin/table_team.php");
		exit;
	}


	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_team.php");
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

//********************************************************************************************************************************
// ********************************************************   PORTFOLIO   *********************************************************
//********************************************************************************************************************************
// ******************************************************** UPDATED TITLE  ********************************************************
	case "update_title_portfolio":

	$newTitle = trim($_POST['title']);
	$messageId = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($newTitle)){
		$errorMessage .= "Title cannot be empty! <br>";
	}
	elseif (strlen($newTitle) > 50) {
		$errorMessage .= "The title must contain 50 characters and less. <br>";
	}
	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$updatedPortfolioData = [
			'id' => $messageId,
			'title' => $newTitle
		];

		$newTitleObject = new PortfolioTitle($updatedPortfolioData);		
		$PortfolioManager->updateTitle($newTitleObject);
		$_SESSION['successMessage'] = "You've update successfully the Title of the Porfolio Section (Home page)!";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_portfolio.php");
		exit; 
	}
	
	header("Location: ../admin/table_portfolio.php");
	exit; 
	break;

// ******************************************************** ADD SLIDE  ********************************************************
case "add_portfolio":

	// Check if there are already 30 services
	$portfolioSlides = $PortfolioManager->getAllPortfolio();
	if (count($portfolioSlides) >= 30) {
		$_SESSION['errorMessage'] = "You cannot add more than 30 slides to the portfolio!";
		header("Location: ../admin/table_portfolio.php");
	exit;
}

$temp_image_path = $_FILES['addImagePathPortfolio'];
$alt = trim($_POST['addAltPorfolio']);
	$description = trim($_POST['addDescriptionPortfolio']); // Make sure this is the correct field for the description
	$order_number = trim($_POST['orderNumberPortfolio']);

	// Check if there are already 6 services
	$portfolios = $PortfolioManager->getAllPortfolio();
	if (count($portfolios) >= 15) {
		$_SESSION['errorMessage'] = "You cannot add more than 15 portfolio slides!";
		header("Location: ../admin/table_portfolio.php");
		exit;
	}


	// VALIDATION
	$errorMessage = "";
	
	// Alt
	if (empty($alt)) {
		$errorMessage .= "The alt cannot be empty! <br>";
	} elseif (strlen($alt) > 50) {
		$errorMessage .= "The alt must contain 50 characters or less. <br>";
	}

	// Description
	if (empty($description)) {
		$errorMessage .= "The description cannot be empty! <br>";
	} elseif (strlen($description) > 150 ) {
		$errorMessage .= "The description must contain 150 characters or less. <br>";
	}

	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	// Image 
	$uploadDir = '../img/portfolio/';
	$newFilename = '';
	$image_path = '';

	if (isset($_FILES['addImagePathPortfolio'])) {
        // Check if file is uploaded
		if ($_FILES['addImagePathPortfolio']['error'] == UPLOAD_ERR_NO_FILE) {
			$errorMessage .= "Slide is empty. Please select a valid image.<br>";
		} elseif ($_FILES['addImagePathPortfolio']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
			$errorMessage .= "Slide must be smaller than 1000 KB.<br>";
		} else {
			$fileType = strtolower(pathinfo($_FILES['addImagePathPortfolio']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
			if (!in_array($fileType, $allowedExtensions)) {
				$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
			} else {
                // Create a new filename using the title and original file extension
				$newFilename = time() . "." . $fileType;

                // Create the complete path for the upload
				$uploadFile = $uploadDir . $newFilename;

				if (move_uploaded_file($_FILES['addImagePathPortfolio']['tmp_name'], $uploadFile)) {
                    // remove '../' 
					$image_path = str_replace('../', '', $uploadFile);
				} else {
                    // handle upload error
					$errorMessage .= "File upload error! Slide must be smaller than 1000 KB<br>";
				}
			}
		}
	}
	
	if (empty($errorMessage)) {
			// Creating a object of portfolio
		$portfolioData = [
			'image_path' => $image_path,
			'alt' => $alt,
			'description' => $description,
			'order_number' => $order_number
		];

		$portfolio = new Portfolio($portfolioData);
		$PortfolioManager->addPortfolio($portfolio);

		$_SESSION['successMessage'] = "You've added successfully a slide to the portfolio";
		unset($_SESSION['errorMessage']);
		if (isset($_SESSION['table_portfolio_page'])) {
			header("Location: ../admin/table_portfolio_page.php");
			unset($_SESSION['table_portfolio_page']);
			exit;
		}
		header("Location: ../admin/table_portfolio.php");
		exit;
	}

	
	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_portfolio.php");
	exit; 
	break;


// ******************************************************** UPDATE SLIDE  ********************************************************
	case "update_slide_portfolio":

	$id = $_POST['slidePortfolioUpdateId'];
	$temp_image_path = $_FILES['imageUpdatePorfolio'];
	$alt = trim($_POST['slidePortfolioUpdateDescription']);
	$description = trim($_POST['slidePortfolioUpdateDescription']); // Make sure this is the correct field for the description
	$order_number = trim($_POST['slidePortfolioUpdateOrderNumber']);

	// VALIDATION
	$errorMessage = "";
    // Description
	if (empty($description)) {
		$errorMessage .= "description cannot be empty! <br>";
	} elseif (strlen($title) > 150) {
		$errorMessage .= "The description must contain 150 characters or less. <br>";
	}

    // Alt
	if (empty($alt)) {
		$errorMessage .= "The alt cannot be empty! <br>";
	} elseif (strlen($alt) > 50) {
		$errorMessage .= "The alt must contain 50 characters or less. <br>";
	}

    // Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

    // Slide
	$uploadDir = '../img/portfolio/';
	$newFilename = '';
	$image_path = '';


	if (isset($_FILES['imageUpdatePorfolio'])) {
        // Check if file is uploaded
		if ($_FILES['imageUpdatePorfolio']['error'] == UPLOAD_ERR_NO_FILE) {
			$currentPortfolio = $PortfolioManager->getSinglePortfolio($id);
			$image_path = $currentPortfolio->getImagePath();
		} elseif ($_FILES['imageUpdatePorfolio']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
			$errorMessage .= "Slide must be smaller than 1000 KB.<br>";
		} else {
			$fileType = strtolower(pathinfo($_FILES['imageUpdatePorfolio']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
			if (!in_array($fileType, $allowedExtensions)) {
				$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
			} else {
                // Create a new filename using the title and original file extension
				$newFilename = time() . "." . $fileType;

                // Create the complete path for the upload
				$uploadFile = $uploadDir . $newFilename;

				if (move_uploaded_file($_FILES['imageUpdatePorfolio']['tmp_name'], $uploadFile)) {
                    // remove '../' from the avatar path before storing in userData
					$image_path = str_replace('../', '', $uploadFile);
				} else {
                    // handle upload error
					$errorMessage .= "File upload error! Slide must be smaller than 1000 KB<br>";
				}
			}
		}
	}

	if (empty($errorMessage)) {
		$currentPortfolio = $PortfolioManager->getSinglePortfolio($id);

		$updatedPortfolioData = [
			'id' => $id,
			'image_path' => $image_path,
			'alt' => $alt,
			'description' => $description,
			'order_number' => $order_number
		];

		$updatedPortfolio = new Portfolio($updatedPortfolioData);
		$PortfolioManager->editPortfolio($updatedPortfolio);

		$_SESSION['successMessage'] = "You've added successfully a slide to the portfolio";
		unset($_SESSION['errorMessage']);
		if (isset($_SESSION['table_portfolio_page'])) {
			header("Location: ../admin/table_portfolio_page.php");
			unset($_SESSION['table_portfolio_page']);
			exit;
		}
		header("Location: ../admin/table_portfolio.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_portfolio.php");
	exit; 
	break;

// ******************************************************** DELETE SLIDE  ********************************************************
	case "delete_slide_portfolio":

	// Check if there is only 1 slide in the portfolio 
	$portfolioSlides = $PortfolioManager->getAllPortfolio();
	if (count($portfolioSlides) == 1) {
		$_SESSION['errorMessage'] = "You cannot delete all the slide of the portfolio!";
		header("Location: ../admin/table_portfolio.php");
		exit;
	}

	$id = $_POST['slidePortfolioId'];

	// Check if there is only 1 portfolio slide
	$portfolios = $PortfolioManager->getAllPortfolio();
	if (count($portfolios) == 1) {
		$_SESSION['errorMessage'] = "You cannot delete all the slides of the portfolio!";
		header("Location: ../admin/table_portfolio.php");
		exit;
	}

	$PortfolioManager->deletePortfolio($id);
	$_SESSION['successMessage'] = "You've deleted successfully the selected portfolio slide";
	unset($_SESSION['errorMessage']);
		if (isset($_SESSION['table_portfolio_page'])) {
			header("Location: ../admin/table_portfolio_page.php");
			unset($_SESSION['table_portfolio_page']);
			exit;
		}
	header("Location: ../admin/table_portfolio.php");
	exit; 

// ******************************************************** UPDATE PORTFOLIO SLIDE ORDER NUMBER  ********************************************************
	case "update_portfolio_order_number":

	$id = $_POST['slidePorfolioId'];
	$order_number = $_POST['OrderNumber'];

	// VALIDATION
	$errorMessage = '';
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}


	$PortfolioWithOldOrderNumber = $PortfolioManager->getSinglePortfolio($id);

	if(empty($errorMessage)){
		$updatedPortfolioData = [
			'id' => $id,
			'image_path' => $PortfolioWithOldOrderNumber->getImagePath(),
			'alt' => $PortfolioWithOldOrderNumber->getAlt(),
			'description' => $PortfolioWithOldOrderNumber->getDescription(),
			'order_number' => $order_number
		];

		$updatedPortfolio = new Portfolio($updatedPortfolioData);
		$PortfolioManager->editPortfolio($updatedPortfolio);

		$_SESSION['successMessage'] = "You've updated successfully a the portfolio slide order number";
		unset($_SESSION['errorMessage']);
			if (isset($_SESSION['table_portfolio_page'])) {
			header("Location: ../admin/table_portfolio_page.php");
			unset($_SESSION['table_portfolio_page']);
			exit;
		}
		header("Location: ../admin/table_portfolio.php");
		exit;	
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_portfolio.php");
	exit; 
	break;	

//********************************************************************************************************************************
// ********************************************************   SLIDER   *********************************************************
//********************************************************************************************************************************
// ******************************************************** UPDATE TITLE  ************************************************
	case "update_title_slider":

	$newTitle = trim($_POST['title']);
	$messageId = trim($_POST['id']); 

	// VALIDATION
	$errorMessage = '';
	if (empty($newTitle)){
		$errorMessage .= "Title cannot be empty! <br>";
	}
	elseif (strlen($newTitle) > 50) {
		$errorMessage .= "The title must contain 50 characters and less. <br>";
	}
	$_SESSION['errorMessage'] = $errorMessage;

	if (empty($errorMessage)) {
		$updatedSliderData = [
			'id' => $messageId,
			'title' => $newTitle
		];

		$newTitleObject = new SliderTitle($updatedSliderData);		
		$SliderManager->updateTitle($newTitleObject);
		$_SESSION['successMessage'] = "You've update successfully the Title of the Slider Section (Home page)!";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_slider.php");
		exit; 
	}
	
	header("Location: ../admin/table_slider.php");
	exit; 
	break;

 // ******************************************************** ADD SLIDE  ************************************************
case "add_slide":

	// Check if there are already 30 services
	$numberOfSLides = $SliderManager->getAllSlides();
	if (count($numberOfSLides) >= 30) {
		$_SESSION['errorMessage'] = "You cannot add more than 30 slides to the Slider!";
		header("Location: ../admin/table_slider.php");
	exit;
}

$title = trim($_POST['slideTitle']);
$alt = trim($_POST['slideAlt']);
$order_number = trim($_POST['slideNumber']);
$slideImage = $_FILES['slideRegistration'];

    // VALIDATION
$errorMessage = "";
    // Title
if (empty($title)) {
	$errorMessage .= "Title cannot be empty! <br>";
} elseif (strlen($title) > 50) {
	$errorMessage .= "The title must contain 50 characters or less. <br>";
}

    // Alt
if (empty($alt)) {
	$errorMessage .= "The alt cannot be empty! <br>";
} elseif (strlen($alt) > 50) {
	$errorMessage .= "The alt must contain 50 characters or less. <br>";
}

    // Order number
if (empty($order_number)) {
	$errorMessage .= "Order number cannot be empty! <br>";
} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
	$errorMessage .= "Order number must be a number between 1 and 100. <br>";
}

    // Slide
$uploadDir = '../img/';
$newFilename = '';
$slidePath = '';

if (isset($_FILES['slideRegistration'])) {
        // Check if file is uploaded
	if ($_FILES['slideRegistration']['error'] == UPLOAD_ERR_NO_FILE) {
		$errorMessage .= "Slide is empty. Please select a valid image.<br>";
	} elseif ($_FILES['slideRegistration']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
		$errorMessage .= "Slide must be smaller than 1000 KB.<br>";
	} else {
		$fileType = strtolower(pathinfo($_FILES['slideRegistration']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
		if (!in_array($fileType, $allowedExtensions)) {
			$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
		} else {
                // Create a new filename using the title and original file extension
			$newFilename = $title . "_" . time() . "." . $fileType;

                // Create the complete path for the upload
			$uploadFile = $uploadDir . $newFilename;

			if (move_uploaded_file($_FILES['slideRegistration']['tmp_name'], $uploadFile)) {
                    // remove '../' from the avatar path before storing in userData
				$slidePath = str_replace('../', '', $uploadFile);
			} else {
                    // handle upload error
				$errorMessage .= "File upload error! Slide must be smaller than 1000 KB<br>";
			}
		}
	}
}

if (empty($errorMessage)) {
	$_SESSION['successMessage'] = "You've added successfully a slide to the Slider";
	$SliderManager->addSlide($title, $alt, $order_number, $slidePath);
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_slider.php");
	exit;
}

$_SESSION['errorMessage'] = $errorMessage;
header("Location: ../admin/table_slider.php");
exit; 
break;



// ******************************************************** UPDATE SLIDE  ************************************************
case "update_slide":

$id = trim($_POST['slideId']);
$title = trim($_POST['slideTitle']);
$alt = trim($_POST['slideAlt']);
$order_number = trim($_POST['slideOrderNumber']);
$slideImage = $_FILES['slideRegistration'];

    // VALIDATION
$errorMessage = "";
    // Title
if (empty($title)) {
	$errorMessage .= "Title cannot be empty! <br>";
} elseif (strlen($title) > 50) {
	$errorMessage .= "The title must contain 50 characters or less. <br>";
}

    // Alt
if (empty($alt)) {
	$errorMessage .= "The alt cannot be empty! <br>";
} elseif (strlen($alt) > 50) {
	$errorMessage .= "The alt must contain 50 characters or less. <br>";
}

    // Order number
if (empty($order_number)) {
	$errorMessage .= "Order number cannot be empty! <br>";
} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
	$errorMessage .= "Order number must be a number between 1 and 100. <br>";
}

    // Slide
$uploadDir = '../img/';
$newFilename = '';
$slidePath = '';

if (isset($_FILES['slideRegistration'])) {
        // Check if file is uploaded
	if ($_FILES['slideRegistration']['error'] == UPLOAD_ERR_NO_FILE) {
		$slide = $SliderManager->getSlideByID($id);
		$slidePath = $slide->getSlidePath();
	} elseif ($_FILES['slideRegistration']['size'] > 1000 * 1024) {
            // Check if file is larger than 1000 KB
		$errorMessage .= "Slide must be smaller than 1000 KB.<br>";
	} else {
		$fileType = strtolower(pathinfo($_FILES['slideRegistration']['name'], PATHINFO_EXTENSION));

            // Check if the file has a valid extension
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
		if (!in_array($fileType, $allowedExtensions)) {
			$errorMessage .= "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.<br>";
		} else {
                // Create a new filename using the title and original file extension
			$newFilename = $title . "_" . time() . "." . $fileType;

                // Create the complete path for the upload
			$uploadFile = $uploadDir . $newFilename;

			if (move_uploaded_file($_FILES['slideRegistration']['tmp_name'], $uploadFile)) {
                    // remove '../' from the avatar path before storing in userData
				$slidePath = str_replace('../', '', $uploadFile);
			} else {
                    // handle upload error
				$errorMessage .= "File upload error! Slide must be smaller than 1000 KB<br>";
			}
		}
	}
}

if (empty($errorMessage)) {
	$_SESSION['successMessage'] = "You've updated successfully a slide of the Slider";
	$SliderManager->updateSlide($id, $title, $alt, $order_number, $slidePath);
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_slider.php");
	exit;
}

$_SESSION['errorMessage'] = $errorMessage;
header("Location: ../admin/table_slider.php");
exit; 
break;



// ******************************************************** DELETE SLIDE ************************************************
case "delete_slide":

$slideId = trim($_POST['slideId']);

$SliderManager->deleteSlide($slideId);
$_SESSION['successMessage'] = "You've deleted successfully the selected slide";
unset($_SESSION['errorMessage']);
header("Location: ../admin/table_slider.php");
exit; 


break;

 // ******************************************************** UPDATE SLIDE NUMBER  ********************************************************
case "update_slide_order_number":
$newOrderNumber = trim($_POST['OrderNumber']);
$serviceId = trim($_POST['slideId']);

	// VALIDATION
$errorMessage = '';

	// Order number
if (empty($newOrderNumber)) {
	$errorMessage .= "Order number cannot be empty! <br>";
} elseif (!is_numeric($newOrderNumber) || (int)$newOrderNumber < 1 || (int)$newOrderNumber > 100) {
	$errorMessage .= "Order number must be a number between 1 and 100. <br>";
}

if (empty($errorMessage)) {
	$SliderManager->updateOrderNUmber($serviceId, $newOrderNumber);
	$_SESSION['successMessage'] = "You've updated successfully the order number of the selected service";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_slider.php");
	exit;
} else {
	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_slider.php");
	exit;
}
break;






}
?>
