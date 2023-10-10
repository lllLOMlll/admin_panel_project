<?php
session_start();

// Whenever call a class this method is invoked
spl_autoload_register(function ($class_name){
	require_once("models/" . $class_name . ".class.php");
});


// CREATE INSTANCES OF MY CLASS
$Utilities = new Utilities();
$UserManager = new UserManager();
$FooterManager = new FooterManager();
$TitleAndWelcomeMessageManager = new TitleAndWelcomeMessageManager();
$ServicesManager = new ServicesManager();
$SliderManager = new SliderManager();
$VisibilityManager = new VisibilityManager();
$PortfolioManager = new PortfolioManager();
$TeamManager = new TeamManager();
$ContactUsManager = new ContactUsManager();
$ServicesPageManager = new ServicesPageManager();
$AboutPageManager =  new AboutPageManager();
$PortfolioPageManager = new PortfolioPageManager();



?>