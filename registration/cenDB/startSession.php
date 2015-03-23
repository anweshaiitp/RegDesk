<?php
require("../dbcon.php");
session_start();
if(!isset($_SESSION['CID'])){
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
	header('Location: ' . $home_url);	
} 
?>