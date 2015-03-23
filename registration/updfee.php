<?php 
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You must authenticate to continue';
    exit ();
} else {
	$pass = $_SERVER['PHP_AUTH_PW'];
	$user = $_SERVER['PHP_AUTH_USER'];

	if($pass == 'aditya' && $user = '123456789987654321'){}else{
		echo "Wrong ID PASSWORD";
		exit();	
	}
}

function check_ID($conn,$ID){
	$sql = "SELECT COUNT(*) FROM RegOut WHERE ID = $ID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$num = $row['COUNT(*)'];
	return $num == 1;
}
function update_fee($conn, $ID, $fee){
	$sql = "UPDATE `RegOut` SET Fee = $fee WHERE ID = $ID";
	$result = mysqli_query($conn,$sql);
}
$Err = '';
$msg = '';
$ID = '';
$fee = '150';
if(isset($_POST['ID'])){
	require("dbcon.php");
	$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
	$ID = $_POST['ID'];
	$fee = $_POST['FEE'];
	if(check_ID($conn,$ID)){
		update_fee($conn, $ID, $fee);
		$msg = "Updated fee of $ID. New fee =$fee";
		$fee = '150';
		$ID = '';
	} else {
		$Err = 'ID doesn\'t Exist';
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Fee</title>
</head>
<style>
	/*body{
		text-align: center;
		background-color: black;
		color : white;
	}
	form{
		text-align: left;
		padding-left: 38%;
		font-size: 1.5em;
		padding-top: 10%;
	}*/
  body{
    text-align: center;
    color: #FFF;
    margin-top: 15%;
    font-family: Monaco;
  }
  label{
  	padding-right : 10%;
  }
  form{
    margin-left: 35%;
    text-align: center;
    color: #770006;
    border: thick;
    border-color: red;
    border-style: double; 
    width: 30%;
    font-size: 1.2em;
  }
  input[type="text"],input[type="password"]{
    color: inherit;
    background-color: yellow;
  }
  input[type="submit"]{
    font-size: inherit;
    background-color: #000;
    color: #FFF;
  }
  input[type="submit"]:hover{
    background-color: #FFF;
    color: #000;
  }
   html { 
  background: url(1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<body>
<!-- <img src="1.jpg" class="source-image"> -->
<form method = "POST"action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<?php echo $msg ; ?><br>
<label>AnweshaID:</label> <input autofocus type="text" name = "ID" value="<?php echo $ID; ?>"> <br> <?php echo $Err; ?><br>
<label>Fee: </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" value="<?php echo $fee; ?>" name="FEE"><br>
<input type="submit" value = "Update">
</form>
</body>
</html>