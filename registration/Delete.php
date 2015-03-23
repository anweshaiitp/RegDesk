<?php 
require("dbcon.php");

$min = $_POST['min'];
$max = $_POST['max'];

$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
$sql = "DELETE FROM NewQuery WHERE SNO>=$min AND SNO<=$max";
if (mysqli_query($conn,$sql))
	echo 'done';
else
	echo 'not done yet';

mysqli_close($conn);
 ?>