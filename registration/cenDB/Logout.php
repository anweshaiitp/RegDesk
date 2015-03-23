<?php 
session_start();
$_SESSION = array();
session_destroy();
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
header('Location: ' . $home_url);
?>
