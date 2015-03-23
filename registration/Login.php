<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
require("csrf.php");
session_start();
if(!(isset($_COOKIE['ID']) && isset($_COOKIE['NAME']))){
	$err = "";
	if(isset($_POST['UserName'])){

		$uname = preg_replace('/[^0-9]/', '',$_POST['UserName']);
		$pass = SHA1('' . $_POST['Password']);

		if((strlen($_POST['UserName']) == 7) && (strlen($uname) == 4) && (!empty($pass) && check_csrf($_POST['CSRF']))){
			require("dbcon.php");
			$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
			$sql = "SELECT COUNT(*) FROM LoginTable WHERE ID = $uname AND pass = '$pass'";
			// var_dump($sql);
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			if($row['COUNT(*)'] == 1){
				$_SESSION['ID'] = $uname;
				$sql = "SELECT name FROM RegOut WHERE ID = $uname";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_assoc($result);
				$_SESSION['NAME'] = $row['name'];
				setcookie('NAME',$row['name'],time() + 3600);
				setcookie('ID',$uname,time() + 3600);
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/ViewEvents.php';
				header('Location: ' . $home_url);
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
	<link type="text/css" rel="stylesheet" href="reg.css">
	<body>

		<h1>ANWESHA 2K15 : Sign in</h1>
		<form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
			<p></p>
			<label class = "Username"><span>Anwesha ID : </span></label> <input id = "UName" name = "UserName" type = "text" value="" autocomplete = "on" placeholder = "ANW****" required autofocus> <br/>
			<label class = "Password"><span>Password : </span></label> <input id = "Pass" name = "Password" type = "password" value="" autocomplete = "off" required> <br/>
			<input type="hidden" name = "CSRF" value="<?php $_SESSION['csrf'] = generate_csrf(); echo $_SESSION['csrf']; ?>">
			<span class = "Err"> <?php echo $err; ?> </span>
			
			<input type = "submit" value="Submit" name="submit" class="but"><br>
			<a href="forgotPassword.php">Forgot Password?</a><br>
			 <a href="firstLogin.php">If you haven't got your password, click here</a>
		</form>
		<div id="bottom">
		    In case of any issue contact: <br />
		    <div id="contact">
		        Avishek(9693575181)<br>
		        Manvee(9905057654)<br>
		       <a href="https://www.facebook.com/profile.php?id=1119454858&fref=ts"> Aditya(8292337923)</a> <br />
		        <a href="https://www.facebook.com/arindam.banerjee.790?fref=ts">Arindam (9472472543)</a> <br />
		    </div>
		</div> 
	</body>
	</html>
<?php
} else {
		$_SESSION['NAME'] = $_COOKIE['NAME'];
		$_SESSION['ID'] = $_COOKIE['ID'];
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/ViewEvents.php';
		header('Location: ' . $home_url);
		exit();
	}
?>
	