<?php 
session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()])){
	setcookie(session_name(), '', time() - 3600);
}
session_destroy();
setcookie('ID', '', time() - 3600);
setcookie('NAME', '', time()-3600);	
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
header('Location: ' . $home_url);
exit();
?>
