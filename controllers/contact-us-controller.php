<?php

include "../head.inc.php";

$action = $_REQUEST['action'];

switch ($action) {

//********************************************************************************************************************************
// ********************************************************   TITLE   *********************************************************
//********************************************************************************************************************************

// ******************************************************** UPDATE  TITLE ********************************************************
	case "update_title_contact_us":

	$id = trim($_POST['id']);
	$title = trim($_POST['title']);

	//VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "Title cannot be empty <br>";
	} elseif (strlen($title) > 50) {
		$errorMessage .= "Title must be 50 characters or less <br>";
	}

	if (empty($errorMessage)) {
		$titleParagraphObject = $ContactUsManager->getTitleParagraphById($id);

		$updatedTitleParagraph = [
			'id' => $id,
			'title' => $title,
			'paragraph' =>$titleParagraphObject->getParagraph()
		];

		$updatedTitle = new ContactUsTitleParagraph($updatedTitleParagraph);

		$ContactUsManager->updateTitleParagraph($updatedTitle);
		$_SESSION['successMessage'] = "You've successfully updated the order the title of the Contact Us page";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;	
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;


//********************************************************************************************************************************
// ********************************************************   CONTACT METHOD   ***************************************************
//********************************************************************************************************************************
// ******************************************************** UPDATE  CONTACT METHOD ***********************************************
	case "update_contact_method":

	$id = trim($_POST['id']);
	$title = trim($_POST['title']);
	$icon = trim($_POST['icon']);
	$line1 = trim($_POST['line1']);
	$line2 = trim($_POST['line2']);

	// VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "The title cannot be empty";
	} elseif (strlen($title) > 50){
		$errorMessage .= "Title must be 50 characters or less <br>";
	}

	// Icon
	if (empty($icon)) {
		$errorMessage .= "Icon cannot be empty <br>";
	}

	// Line 1
	if (empty($line1)) {
		$errorMessage .= "Line 1 cannot be empty <br>";
	} elseif (strlen($line1) > 50) {
		$errorMessage .= "Line 1 must be 50 characters or less <br>";
	}

	// Line 2
	if (strlen($line2) > 50) {
		$errorMessage .= "Line 2 must be 50 characters or less <br>";
	}


	if (empty($errorMessage)){
		$selectedContactMethod = $ContactUsManager->getSingleContactMethod($id); 

		$updatedContactMethodData = [
			'id' => $id,
			'title' => $title,
			'icon' => $icon,
			'line1' => $line1,
			'line2' => $line2, 
			'order_number' => $selectedContactMethod->getOrderNumber()
		];

		$newContactMethod = new ContactMethod($updatedContactMethodData);

		$ContactUsManager->editContactMethod($newContactMethod);
		$_SESSION['successMessage'] = "You've successfully updated the '" . $title . "' contact method";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;

	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;


// ******************************************************** ADD CONTACT METHOD ***********************************************
	case "add_contact_method":

	$title = trim($_POST['title']);
	$icon = trim($_POST['icon']);
	$line1 = trim($_POST['line1']);
	$line2 = trim($_POST['line2']);
	$order_number = trim($_POST['order_number']);

	// VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "The title cannot be empty <br>";
	} elseif (strlen($title) > 50){
		$errorMessage .= "Title must be 50 characters or less <br>";
	}

	// Icon
	if (empty($icon)) {
		$errorMessage .= "Icon cannot be empty <br>";
	}

	// Line 1
	if (empty($line1)) {
		$errorMessage .= "Line 1 cannot be empty <br>";
	} elseif (strlen($line1) > 50) {
		$errorMessage .= "Line 1 must be 50 characters or less <br>";
	}

	// Line 2
	if (strlen($line2) > 50) {
		$errorMessage .= "Line 2 must be 50 characters or less <br>";
	}

	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}


	if (empty($errorMessage)){

		$newContactMethodData = [
			'title' => $title,
			'icon' => $icon,
			'line1' => $line1,
			'line2' => $line2,
			'order_number' => $order_number
		];

		$newContactMethod = new ContactMethod($newContactMethodData);
		$ContactUsManager->addContactMethod($newContactMethod);
		$_SESSION['successMessage'] = "You've successfully added the '" . $title . "' contact method";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

// ******************************************************** UPDATE ORDER NUMBER CONTACT METHOD ***********************************************
	case "update_order_number_contact_method":

	$id = (int) trim($_POST['id']);
	$order_number = (int) trim($_POST['order_number']);

	// VALIDATION
	$errorMessage = '';
	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)) {
		$selectedContactMethod = $ContactUsManager->getSingleContactMethod($id);
		$title = $selectedContactMethod->getTitle();
		$updatedContactMethodData = [
			'id' => $id,
			'title' => $selectedContactMethod->getTitle(),
			'icon' => $selectedContactMethod->getIcon(),
			'line1' => $selectedContactMethod->getLine1(),
			'line2' => $selectedContactMethod->getLine2(),
			'order_number' => $order_number
		];

		$updatedContactMethodObject = new ContactMethod($updatedContactMethodData);

		$ContactUsManager->editContactMethod($updatedContactMethodObject);
		$_SESSION['successMessage'] = "You've updated successfully the order number of the '" . $title . "' contact method";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;

	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

// ******************************************************** DELETE CONTACT METHOD ***********************************************
	case "delete_contact_method":

	$id = trim($_POST['id']);

	$selectedContactMethod = $ContactUsManager->getSingleContactMethod($id);
	$contactMethodName = $selectedContactMethod->getTitle();
	$ContactUsManager->deleteContactMethod($id);
	$_SESSION['successMessage'] = "You've successfully deleted the '" . $contactMethodName . "' contact method";  
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_contact.php");
	exit;



//********************************************************************************************************************************
// ********************************************************   OFFICE HOURS  ***************************************************
//********************************************************************************************************************************
// ******************************************************** UPDATE OFFICE HOURS ***********************************************
	case "update_office_hours":

	$id = $_POST['id'];
	$monday = trim($_POST['monday']);
	$tuesday = trim($_POST['tuesday']);
	$wednesday = trim($_POST['wednesday']);
	$thursday = trim($_POST['thursday']);
	$friday = trim($_POST['friday']);
	$saturday = trim($_POST['saturday']);
	$sunday = trim($_POST['sunday']);

	// VALIDATION
// Create an associative array to hold the day and its corresponding value
	$dayValues = [
		'monday' => $monday,
		'tuesday' => $tuesday,
		'wednesday' => $wednesday,
		'thursday' => $thursday,
		'friday' => $friday,
		'saturday' => $saturday,
		'sunday' => $sunday
	];

	$errorMessage = '';

	foreach ($dayValues as $day => $value) {
		if (empty($value)) {
			$errorMessage .= "You cannot let " . ucfirst($day) . " empty <br>";
		} elseif (strlen($value) > 50) {
			$errorMessage .= "Your opening hours text for " . ucfirst($day) . " must be 50 characters or less <br>";
		}
	}


	if (empty($errorMessage)) {
		$updatedOfficeHoursData = [
			'id' => $id,
			'monday' => $monday,
			'tuesday' => $tuesday,
			'wednesday' => $wednesday,
			'thursday' => $thursday,
			'friday' => $friday,
			'saturday' => $saturday,
			'sunday' => $sunday
		];

		$newOfficeHours = new ContactOfficeHours($updatedOfficeHoursData);
		$ContactUsManager->updateOfficeHours($newOfficeHours);

		$_SESSION['successMessage'] = "You've updated successfully the Offices Hours of the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;


//********************************************************************************************************************************
// ********************************************************   SOCIAL MEDIA  ***************************************************
//********************************************************************************************************************************
// ******************************************************** ADD SOCIAL MEDIA ***********************************************
	case "add_social_media":

	$title = trim($_POST['title']);
	$icon = trim(($_POST['icon']));
	$hyperlink = trim($_POST['hyperlink']);
	$order_number = trim($_POST['order_number']);

	
	// VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "The title cannot be empty <br>";
	} elseif (strlen($title) > 50){
		$errorMessage .= "Title must be 50 characters or less <br>";
	}

	// Icon
	if (empty($icon)) {
		$errorMessage .= "Icon cannot be empty <br>";
	}

	// Hyperlink
	if (empty($hyperlink)) {
		$errorMessage .= "Hyperlink cannot be empty <br>";
	} elseif (strlen($hyperlink) > 250) {
		$errorMessage .= "Hyperlink must be 250 characters or less <br>";
	} elseif (strpos($hyperlink, 'https://') !== 0) { 
		$errorMessage .= "Hyperlink must start with https:// <br>";
	}


	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)) {
		$newSocialMediaData = [
			'title' => $title,
			'icon' => $icon,
			'hyperlink' => $hyperlink,
			'order_number' => $order_number
		];

		$newSocialMedia = new ContactSocialMedia($newSocialMediaData);
		$ContactUsManager->addSocialMedia($newSocialMedia);


		$_SESSION['successMessage'] = "You've added successfully " . $title . " as  a new Social Media to the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

// ******************************************************** UPDATE SOCIAL MEDIA ***********************************************
	case "update_social_media":

	$id = trim($_POST['id']);
	$title = trim($_POST['title']);
	$icon = trim($_POST['icon']);
	$hyperlink = trim($_POST['hyperlink']);

		// VALIDATION
	$errorMessage = '';
	// Title
	if (empty($title)) {
		$errorMessage .= "The title cannot be empty <br>";
	} elseif (strlen($title) > 50){
		$errorMessage .= "Title must be 50 characters or less <br>";
	}

	// Icon
	if (empty($icon)) {
		$errorMessage .= "Icon cannot be empty <br>";
	}

	// Hyperlink
	if (empty($hyperlink)) {
		$errorMessage .= "Hyperlink cannot be empty <br>";
	} elseif (strlen($hyperlink) > 250) {
		$errorMessage .= "Hyperlink must be 250 characters or less <br>";
	} elseif (strpos($hyperlink, 'https://') !== 0) { 
		$errorMessage .= "Hyperlink must start with https:// <br>";
	}


	if (empty($errorMessage)){
		$selectedSocialMediaObject = $ContactUsManager->getSingleSocialMedia($id);
		$updatedSocialMediaData = [
			'id' => $id,
			'title' =>$title,
			'icon' =>$icon,
			'hyperlink' => $hyperlink,
			'order_number' => $selectedSocialMediaObject->getOrderNumber()
		];

		$updadedSocialMediaObject = new ContactSocialMedia($updatedSocialMediaData);
		$ContactUsManager->editSocialMedia($updadedSocialMediaObject);

		$_SESSION['successMessage'] = "You've updated successfully " . $title . " as a Social Media to the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

	// ******************************************************** UPDATE SOCIAL MEDIA ORDER NUMBER ***********************************************
	case "update_social_media_order_number":

	$id = trim($_POST['id']);
	$order_number = trim($_POST['order_number']);

		// VALIDATION
	$errorMessage = '';
	// Order number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)) {
		$selectedSocialMediaObject = $ContactUsManager->getSingleSocialMedia($id);
		$title = $selectedSocialMediaObject->getTitle();

		$updatedSocialMediaData = [
			'id' => $selectedSocialMediaObject->getId(),
			'title' => $selectedSocialMediaObject->getTitle(),
			'icon' => $selectedSocialMediaObject->getIcon(),
			'hyperlink' => $selectedSocialMediaObject->getHyperlink(),
			'order_number' => $order_number
		];

		$updatedSocialMediaObject = new ContactSocialMedia($updatedSocialMediaData);
		$ContactUsManager->editSocialMedia($updatedSocialMediaObject);

		$_SESSION['successMessage'] = "You've updated successfully the order number of " . $title . " as a Social Media to the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

	// ******************************************************** DELETE SOCIAL MEDIA ***********************************************
	case "delete_social_media":

	$id = trim($_POST['id']);


	$selectedSocialMediaObject = $ContactUsManager->getSingleSocialMedia($id);
	$title = $selectedSocialMediaObject->getTitle();

	$ContactUsManager->deleteSocialMedia($id);

	$_SESSION['successMessage'] = "You've deleted " . $title . " as a Social Media to the Contact Us page";  
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_contact.php");
	exit;


//********************************************************************************************************************************
// ********************************************************   CONTACT FORM  ***************************************************
//********************************************************************************************************************************
// ******************************************************** ADD CONTACT FORM ***********************************************
	case "add_contact_form":

	$input_type = trim($_POST['input_type']);
	$input_name = trim($_POST['input_name']);
	$place_holder = trim($_POST['place_holder']);
	$mandatory = trim($_POST['mandatory']);
	$order_number = trim($_POST['order_number']);

	// VALIDATION
	$errorMessage .= '';
	// Input Type
	if (empty($input_type)) {
		$errorMessage .= "Input type cannot be empty <br>";
	} elseif (strlen($input_type) > 50){
		$errorMessage .= "Input type must be 50 characters or less <br>";
	}
	// Input Name
	if (empty($input_name)) {
		$errorMessage .= "Input name cannot be empty <br>";
	} elseif (strlen($input_name) > 50){
		$errorMessage .= "Input name must be 50 characters or less <br>";
	}
	// Placeholder
	if (empty($place_holder)) {
		$errorMessage .= "Placeholder cannot be empty <br>";
	} elseif (strlen($place_holder) > 50){
		$errorMessage .= "Placeholder type must be 50 characters or less <br>";
	}
	// Mandatory


	// Order Number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)) {
		$newContactMethodObject = [
			'input_type' => $input_type,
			'input_name' => $input_name,
			'place_holder' => $place_holder,
			'mandatory' => $mandatory,
			'order_number' => $order_number
		];


		$newContactMethodObject = new ContactForm($newContactMethodObject);
		$ContactUsManager->addContactForm($newContactMethodObject);

		$_SESSION['successMessage'] = "You've added successfully the input '" . $input_name . "'' to the Contact Form in the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;


// ******************************************************** UPDATE CONTACT FORM ***********************************************
	case "update_contact_form":

	$id = trim($_POST['id']);
	$input_type = trim($_POST['input_type']);
	$input_name = trim($_POST['input_name']);
	$place_holder = trim($_POST['place_holder']);
	$mandatory = trim($_POST['mandatory']);
	$order_number = trim($_POST['order_number']);


	// VALIDATION
	$errorMessage .= '';
	// Input Type
	if (empty($input_type)) {
		$errorMessage .= "Input type cannot be empty <br>";
	} elseif (strlen($input_type) > 50){
		$errorMessage .= "Input type must be 50 characters or less <br>";
	}
	// Input Name
	if (empty($input_name)) {
		$errorMessage .= "Input name cannot be empty <br>";
	} elseif (strlen($input_name) > 50){
		$errorMessage .= "Input name must be 50 characters or less <br>";
	}
	// Placeholder
	if (empty($place_holder)) {
		$errorMessage .= "Placeholder cannot be empty <br>";
	} elseif (strlen($place_holder) > 50){
		$errorMessage .= "Placeholder type must be 50 characters or less <br>";
	}
	// Order Number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}


	if (empty($errorMessage)) {
		$updatedContactFormData = [
			'id' => $id,
			'input_type' => $input_type,
			'input_name' => $input_name,
			'place_holder' => $place_holder,
			'mandatory' => $mandatory,
			'order_number' => $order_number
		];

		$updatedContactFormObject = new ContactForm($updatedContactFormData);
		$ContactUsManager->editContactForm($updatedContactFormObject);

		$_SESSION['successMessage'] = "You've updated successfully the input '" . $input_name . "'' of the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;


// ******************************************************** UPDATE ORDER NUMBER CONTACT FORM ***********************************************
	case "update_order_number_contact_form":

	$id = trim($_POST['id']);
	$order_number = trim($_POST['order_number']);

	// VALIDATION
	$errorMessage .= '';

	// Order Number
	if (empty($order_number)) {
		$errorMessage .= "Order number cannot be empty! <br>";
	} elseif (!is_numeric($order_number) || (int)$order_number < 1 || (int)$order_number > 100) {
		$errorMessage .= "Order number must be a number between 1 and 100. <br>";
	}

	if (empty($errorMessage)){
		$selectedContactForm = $ContactUsManager->getSingleContactForm($id);
		$contactFormName = $selectedContactForm->getInputName();

		$updatedContactFormData = [
			'id' => $id,
			'input_type' => $selectedContactForm->getInputType(),
			'input_name' => $selectedContactForm->getInputName(),
			'place_holder' =>$selectedContactForm->getPlaceHolder(),
			'mandatory' => $selectedContactForm->getMandatory(),
			'order_number' => $order_number
		];

		$updatedContactFormObject = new ContactForm($updatedContactFormData);
		$ContactUsManager->editContactForm($updatedContactFormObject);

		$_SESSION['successMessage'] = "You've updated successfully the order number of the input ''" . $contactFormName . "'' of the Contact Us page";  
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_contact.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_contact.php");
	exit; 
	break;

// ******************************************************** DELETE CONTACT FORM ***********************************************
	case "delete_contact_form":

	$id = trim($_POST['id']);


	$selectedContactFormObject = $ContactUsManager->getSingleContactForm($id);
	$input_name = $selectedContactFormObject->getInputName();
	$ContactUsManager->deleteContactForm($id);

	

	$_SESSION['successMessage'] = "You've deleted successfully the input ''" . $contactFormName . "'' of the Contact Us page";  
	unset($_SESSION['errorMessage']);
	header("Location: ../admin/table_contact.php");
	exit;


}
?>