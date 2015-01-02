<?php 
session_start();

if(isset($_SESSION['id'])){
	$_SESSION = array();

	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time() - 3600);
	}
	session_destroy();
 }

 setcookie('id', '', time() - 3600);
 setcookie('user', '', time()-3600);	

 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
 header('Location: ' . $home_url);
 ?>
