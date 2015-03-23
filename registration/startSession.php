<?php 
session_start();
if (!isset($_SESSION['ID'])) {
	//$dirname = dirname($_SERVER['PHP_SELF']);
	//$file = '/Login.php';
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
	header('Location: ' . $home_url);
	exit();		
}
?>