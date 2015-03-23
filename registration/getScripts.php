<?php 
require("dbcon.php");
$sql = "SELECT MAX(SNO) AS SNO FROM NewQuery";
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$max = $row['SNO'];

$sql = "SELECT MIN(SNO) AS SNO FROM NewQuery";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$min = $row['SNO'];


$sql = "SELECT Query FROM NewQuery WHERE SNO <= $max";

$result = mysqli_query($conn,$sql);
?>

<form method="POST" action="Delete.php">
	<label>From : </label> <input type = "text" name = "min" readonly="readonly" value="<?php echo $min;?>"><br/>
	<label>To : </label> <input type = "text" name = "max" readonly="readonly" value="<?php echo $max;?>"><br/>
	<input	type = "submit" value = "Delete"><br/><br/><br/><br/>
</form>


<?php
while($row = mysqli_fetch_assoc($result))
{
	echo $row['Query'].';<br>';
}
mysqli_close($conn);
 ?>

 