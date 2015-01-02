<?php
require_once("../dbcon.php");

function checkLogin(){
	$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
	$id = $_SESSION['id'];
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM UserData WHERE ID = $id AND Name = '$user'";
	$result = mysqli_query($conn,$sql);
	$rows = mysqli_num_rows($result);
	mysqli_close($conn);
	return ( $rows == 1) ;
} 

session_start();

if(!isset($_SESSION['id'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Authentication Error</title>
	</head>
	<body>
		<p>Please <a href="Login.php">Login</a> to continue</p>
	</body>
	</html>
<?php
die();
} elseif (!checkLogin()) {
?>
<html>
	<head>
		<title>Authentication Error</title>
	</head>
	<body>
		<p>Please <a href="Login.php">Login</a> to continue</p>
	</body>
	</html>
<?php
die();
}
if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time() - 3600);
	}
setcookie('id', '', time() - 3600);
setcookie('user', '', time()-3600);	
?>
