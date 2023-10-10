<?php

include "../head.inc.php";

$action = $_REQUEST['action'];

switch ($action) {

 // ******************************************************** UPDATE SERVICE TITLE SECTION ********************************************************
	case "update_title_services":

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
			$selectedServiceTitleAndParagraph = $ServicesPageManager->getSingleServicesTitleandParagraph($id);

	$updatedServicesPageData = [
		'id' => $id,
		'title' => $title,
		'paragraph' => $selectedServiceTitleAndParagraph->getParagraph()
	];

	$updadatedServicesTitleAndParagraphObject = new ServicesPage($updatedServicesPageData);
	$ServicesPageManager->editServicesTitleAndParagraph($updadatedServicesTitleAndParagraphObject);

	$_SESSION['successMessage'] = "You've updated the title of the Services page";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_services_page.php");
	exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_services_page.php");
	exit; 
	break;

	 // ******************************************************** UPDATE PARAGRAPH  ********************************************************
	case "update_paragraph_services":

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
			$selectedServiceTitleAndParagraph = $ServicesPageManager->getSingleServicesTitleandParagraph($id);

	$updatedServicesPageData = [
		'id' => $id,
		'title' => $selectedServiceTitleAndParagraph->getTitle(),
		'paragraph' => $paragraph
	];

	$updadatedServicesTitleAndParagraphObject = new ServicesPage($updatedServicesPageData);
	$ServicesPageManager->editServicesTitleAndParagraph($updadatedServicesTitleAndParagraphObject);

	$_SESSION['successMessage'] = "You've updated the paragraph of the Services page";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_services_page.php");
	exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_services_page.php");
	exit; 
	break;


	// ******************************************************** UPDATE SERVICE TITLE SECTION ********************************************************
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
		header("Location: ../admin/table_services_page.php");
		exit; 	
	}
	
	header("Location: ../admin/table_services_page.php");
	exit; 
	break;


 // ******************************************************** DELETE SERVICE  ********************************************************
	case "delete_service":

	// Check if there is only 1 service services
	$services = $ServicesManager->getAllServices();
	if (count($services) == 1) {
		$_SESSION['errorMessage'] = "You cannot delete all the services!";
		header("Location: ../admin/table_services_page.php");
		exit;
	}

	$serviceId = trim($_POST['serviceId']);

	$ServicesManager->deleteService($serviceId);
	$_SESSION['successMessage'] = "You've deleted successfully the selected service";
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_services_page.php");
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
	header("Location: ../admin/table_services_page.php");
	exit;
} else {
	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_services_page.php");
	exit;
}


}
?>