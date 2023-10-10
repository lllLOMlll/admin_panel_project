<?php

include "../head.inc.php";

$action = $_REQUEST['action'];

switch ($action) {
// ******************************************************** UPDATE  TITLE ********************************************************
	case "update_title":

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
		$selectedPortfolioTitleAndParagraph = $PortfolioPageManager->getSinglePortfolioPageTitleAndParagraph($id);

		$updatedPortfolioPageData = [
			'id' => $id,
			'title' => $title,
			'paragraph' => $selectedPortfolioTitleAndParagraph->getParagraph()
		];

		$updatedPortfolioTitleAndParagraphObject = new PortfolioPage($updatedPortfolioPageData);
		$PortfolioPageManager->editPortfolioPageTitleAndParagraph($updatedPortfolioTitleAndParagraphObject);


		$_SESSION['successMessage'] = "You've updated the title of the Porfolio page";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_portfolio_page.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_portfolio_page.php");
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
		$selectedPortfolioTitleAndParagraph = $PortfolioPageManager->getSinglePortfolioPageTitleAndParagraph($id);

		$updatedPortfolioPageData = [
			'id' => $id,
			'title' => $selectedPortfolioTitleAndParagraph->getTitle(),
			'paragraph' => $paragraph
		];

		$updadatedPortfolioTitleAndParagraphObject = new PortfolioPage($updatedPortfolioPageData);
		$PortfolioPageManager->editPortfolioPageTitleAndParagraph($updadatedPortfolioTitleAndParagraphObject);

		$_SESSION['successMessage'] = "You've updated the paragraph of the Portfolio page";
		unset($_SESSION['errorMessage']);
		header("Location: ../admin/table_portfolio_page.php");
		exit;
	}

	$_SESSION['errorMessage'] = $errorMessage;
	header("Location: ../admin/table_portfolio_page.php");
	exit; 
	break;




}
?>