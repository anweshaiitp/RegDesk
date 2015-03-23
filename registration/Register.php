<?php

$ID = $_POST['ID'];
// $ID = 'ANW2693';
$eve = htmlspecialchars(stripcslashes(trim($_POST['event'])));
// $eve = 'meow';

require("dbcon.php");

$id = preg_replace('/[^0-9]/', '', $ID);
if(strlen($id) != 4) {
	echo json_encode('Invalid ID');
	exit(0);
}

$sql = "SELECT COUNT(*) FROM `RegOut` WHERE ID = $id";

$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(!($row['COUNT(*)'] == 1)) {
	echo json_encode("Invalid ID");
	exit();
}

$sql = "SELECT EveID FROM `Events` WHERE `Event` = '$eve'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);
if($rows == 0){
	echo json_encode('Error. Please contact Registration Desk');
	exit();
}
$EveID = $row['EveID'];

$sql = "SELECT COUNT(*) FROM `Registration` WHERE EveID = $EveID AND ID = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($row['COUNT(*)'] > 0){
	echo json_encode('Already registered');
	exit();
}
$sql = "SELECT COUNT(*) FROM `Payment` WHERE EveID = $EveID AND ID = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($row['COUNT(*)'] == 1){
	echo 'Already Paid';
	exit();
}

$sql = "INSERT INTO `Registration` (`EveID`, `ID`) VALUES ('$EveID', '$id')";
$result = mysqli_query($conn,$sql);
echo json_encode('Registered!');
$qry = $sql;
require("Command.php");
mysqli_close($conn);
exit();
?>