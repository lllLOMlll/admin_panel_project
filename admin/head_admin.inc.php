<?php
session_start();

// Whenever call a class this method is invoked
spl_autoload_register(function ($class_name){
	require_once("../models/" . $class_name . ".class.php");
});

// CREATE INSTANCES OF MY CLASS
$FooterManager = new FooterManager();


?>