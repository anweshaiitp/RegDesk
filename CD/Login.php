<?php 
    function prepare_input($data) {
        return htmlspecialchars(stripcslashes(trim($data)));
    }

if(!isset($_SESSION['id'])){
	$err = "";
	if(isset($_POST['UserName'])){
			//connect to mysql
		require("../dbcon.php");
		$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
		$user = mysqli_real_escape_string($conn, prepare_input($_POST['UserName']));
		$pass = mysqli_real_escape_string($conn, stripcslashes($_POST['Password']));

		if(!empty($user) && !empty($pass)){
			//Grab username and password
			$sql = "SELECT ID,Name FROM UserData WHERE UserName = '$user' AND Password = SHA('$pass')";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) == 1){
				//Check authenticity
				$row = mysqli_fetch_array($result);
				session_start();
				$_SESSION['id'] = $row['ID'];
				$_SESSION['user'] = $row['Name'];
				mysqli_close($conn);
				$dirname = dirname($_SERVER['PHP_SELF']);
				$file = '/Home.php';
				// $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  . ;
				// header('Location: '. $home_url);
				require('../redirect.php');
				} else {
					$err = 'Username OR Password is wrong';
				}
		} else {
		$err = 'Username or password is left blank';
		}

		mysqli_close($conn);
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Database-Login</title>
	</head>
	<link type="text/css" rel="stylesheet" href="IntraReg.css">
	<body>

		<h1>ANWESHA 2K15 : <span id = "h1.2">Organizer's Database</span></h1>
		<p>Login to continue</p>
		<form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p><input type = "submit" float = right value="Submit" class ="button" name="submit"></p>
			<label class = "Username">Username : </label> <input id = "UName" name = "UserName" type = "text" value="" autocomplete = "on" required autofocus> <br/>
			<label class = "Password">Password : </label> <input id = "Pass" name = "Password" type = "password" value="" autocomplete = "off" required> <br/>
			<span class = "Err"> <?php echo $err; ?> </span>
			
		</form>
		<footer> For any queries or problems contact : Aditya(8292337923)</footer>
	</body>
	</html>
<?php
} else {
		$dirname = dirname($_SERVER['PHP_SELF']);
		$file = '/Home.php';
		require('../redirect.php');
		// header('Location: '. $home_url);
	}
?>
	