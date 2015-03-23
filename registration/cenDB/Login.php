<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
require("csrf.php");
session_start();
function check_username($uname){
	return preg_match('/^[Aa][Nn][Ww]\d\d\d\d$/',$uname);
}
function convert_username($uname){
	return preg_replace('/^[Aa][Nn][Ww]/','',$uname);
}
if(!isset($_SESSION['CID'])){
	$err = "";
	if(isset($_POST['UserName'])){

		$uname = $_POST['UserName'];
		$pass = SHA1('' . $_POST['Password']);

		if(check_username($uname) && check_csrf($_POST['CSRF'])){
			require("../dbcon.php");
			$uname = convert_username($uname);
			$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
			$sql = "SELECT COUNT(*) FROM LoginTable WHERE ID = $uname AND pass = '$pass'";
			// var_dump($sql);
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			if($row['COUNT(*)'] == 1){
				$sql = "SELECT COUNT(*) FROM UD WHERE ID = $uname";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				if($row['COUNT(*)'] == 1){
					$sql = "SELECT a.name , b.CID FROM RegOut a, UD b WHERE b.ID = $uname AND a.ID=b.ID";
					$result = mysqli_query($conn,$sql);
					$row = mysqli_fetch_assoc($result);
					$_SESSION['NAME'] = $row['name'];
					$_SESSION['CID'] = $row['CID'];
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Home.php';
					header('Location: ' . $home_url);					
				} else {
					$err = 'Hurr! Access Denied!';
				}
			} else {
				$err = 'Username OR Password is wrong';
			}
			mysqli_close($conn);
		} else {
		$err = 'Username or password is invalid';
		}

		//mysqli_close($conn);
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Login Anwesha2k15</title>
	</head>
	<link type="text/css" rel="stylesheet" href="../reg.css">
	<body>

		<h1>Central DB anwesha'15 : Sign in</h1>
		<form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
			<p></p>
			<label class = "Username"><span>Anwesha ID : </span></label> <input id = "UName" name = "UserName" type = "text" value="" autocomplete = "on" placeholder = "ANW****" required autofocus> <br/>
			<label class = "Password"><span>Password : </span></label> <input id = "Pass" name = "Password" type = "password" value="" autocomplete = "off" required> <br/>
			<input type="hidden" name = "CSRF" value="<?php $_SESSION['csrf'] = generate_csrf(); echo $_SESSION['csrf']; ?>">
			<span class = "Err"> <?php echo $err; ?> </span>
			
			<input type = "submit" value="Submit" name="submit" class="but"><br>
		</form>
		<div id="bottom">
		    In case of any issue contact: <br />
		    <div id="contact">
		       <a href="https://www.facebook.com/profile.php?id=1119454858&fref=ts"> Aditya(8292337923)</a> <br />
		    </div>
		</div> 
	</body>
	</html>
<?php
} else {
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Home.php';
		header('Location: ' . $home_url);
		exit();
	}
?>