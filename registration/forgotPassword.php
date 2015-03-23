<?php 
function validate_captcha($captcha){
	return sha1($captcha) == $_SESSION['pass_phrase'];
}
function validate_ID($ID,$conn){
	// require('dbcon.php');
	$sql = "SELECT COUNT(*) FROM RegOut WHERE ID = $ID";
	// $conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$num = $row['COUNT(*)'];
	return $num == 1;
}
session_start();
require('csrf.php');
$CErr = $IErr = '';
if(isset($_POST['submit'])){
	require ('dbcon.php');
	$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);

	// echo 'from if';
	$captcha = preg_replace("/[^a-z]/",'', $_POST['captcha']);
	$ID = preg_replace('/[^0-9]/', '',$_POST['ID']);
	
	if(!check_csrf($_POST['CSRF'])){
		exit();
	}
	// echo 'reached 1';
	if(!(strlen($_POST['captcha']) == 6 && validate_captcha($captcha))){
		$CErr = 'Invalid Captcha';
	}
	// echo 'reached 2';
	if(!(strlen($_POST['ID']) == 7 && strlen($ID) == 4 && validate_ID($ID,$conn))){
		$IErr = 'Invalid ID';
	}
	// echo 'reached 3';
	if($ID == '1314'){
		$IErr = 'Rahul u can\'t change your password. It will remain BhooSheruBhoo';
	}
	if($CErr == '' && $IErr == ''){
		// require ('dbcon.php');
		$sql = "SELECT COUNT(*) FROM LoginTable WHERE ID = $ID";
		// $conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		if($row['COUNT(*)'] == 1){
			$token = generate_csrf();
			$sql = "UPDATE LoginTable SET token = '$token' WHERE ID = $ID";
			mysqli_query($conn, $sql);

			$sql = "SELECT name, email FROM RegOut WHERE ID = $ID";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$name = $row['name'];
			$email = $row['email'];
			$to = $email;
            $subject = "Reset Password - Anwesha 2k15";
            $msg = "Hello $name \nYour request to reset your password has been processed successfully.\nFollow this link to reset your password : http://2015.anwesha.info/form/registration/setPassword.php?ID=$ID&token=$token \nThank You\nRegistration Desk\nregistration@anwesha.info\nAnwesha 2k15 - Hakuna Matata\n\nIn case of any issue contact: \nAvishek(9693575181)\nAditya(8292337923)\nArindam (9472472543) \n\n\nFor more details log on to http://2015.anwesha.info/ or follow us on facebook http://www.facebook.com/anwesha.iitpatna";
            mail($to,$subject,$msg);
            mysqli_close($conn);
            //$dirname = dirname($_SERVER['PHP_SELF']);
			//$file = '/Login.php';
			//require('redirect.php');
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Login.php';
			header('Location: ' . $home_url);
			exit();
		} else {
			$IErr = "The account is not yet registered. Please visit <a href = \"firstLogin.php\">Sign up</a> page.";
		}
	}
}
$_SESSION['csrf'] = generate_csrf();
// var_dump($IErr);
// var_dump($CErr);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password Anwesha 2k15</title>
	<link rel="stylesheet" type="text/css" href="reg.css">
	
</head>

<body>
<h1>Anwesha 2k15 : Re-set Password</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
<h1><span>Please fill the details and click Re-set! You will recieve our confimation email, follow it to re-set your password. Thank You</span></h1>
	<input type="hidden" name = "CSRF" value="<?php echo $_SESSION['csrf']; ?>">
	<label><span>Your Anwesha ID</span></label><input type="text" name = "ID" required placeholder = "ANWxxxx"><span class = "Err"><?php echo $IErr; ?></span><br/>
	<label><span>Verification</span></label><input type="text" name = "captcha" required placeholder = "xxxxxx"><img src="captcha.php" alt="Verification pass-phrase" class="captcha"><br/>
	<span class = "Err"><?php echo $CErr; ?></span><br/>
	<input type="submit" value = "Re-Set" name = "submit" class="but">
</form>
<div id="bottom">
    In case of any issue contact: <br />
    <div id="contact">
        Avishek(9693575181)
        Manvee(9905057654)
       <a href="https://www.facebook.com/profile.php?id=1119454858&fref=ts"> Aditya(8292337923)</a> <br />
        <a href="https://www.facebook.com/arindam.banerjee.790?fref=ts">Arindam (9472472543)</a> <br />
    </div>
</div> 
</body>
</html>