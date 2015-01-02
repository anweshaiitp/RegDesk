<?php 
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . $dirname . $file;
		header('Location: '. $home_url);
?>