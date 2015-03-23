<?php 
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . $dirname . $file;
		header('Location: '. $home_url);
		//header('Refresh: 10; URL='. $home_url);
		//echo 'Re-directing in 10 sec';
?>