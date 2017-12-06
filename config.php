<?php

// Connecting to the MySQL database
$user = 'babouk1';
$password = '7oeslubI';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall17_babouk1', $user, $password);

//Auto load
function autoloader($class){
	include 'classes/class.' . $class . '.php';
}

spl_autoload_register('autoloader');

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

//// if customerID is not set in the session and current URL not login.php redirect to login page
//if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
//    header("Location: login.php");
//}
//
//// Else if session key customerID is set get $customer from the database
//elseif (isset($_SESSION["customerID"])) {
//	$customer = new Customer($_SESSION["customerID"],$database);
//}

//Initalize Shoppping Cart
if(!isset($_SESSION["ShoppingCart"])){
	$_SESSION["ShoppingCart"] = new ShoppingCart();
}

$cart = $_SESSION["ShoppingCart"];