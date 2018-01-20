<?php 
session_start();
require "../config.php";
require "functions.php";
$request = addslashes($_POST['request']);

if($request=="checkIfUsernameExists"){
	$username = addslashes($_POST['username']);
	echo checkIfUsernameExists($username);
	return checkIfUsernameExists($username);
}

?>