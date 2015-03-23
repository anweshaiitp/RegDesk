<?php
function downloadFile($name){
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".$name."_ANWESHA2k15.xls");
}
require('startSession.php');
$size = count($_SESSION['EveID']);
$x = $_GET['Idx'];
if($x<$size && $x >= 0){}else{
	echo "Invalid get index, $x = x, $size = size";
	exit();
}
$EveID = $_SESSION['EveID'];
$eveID = $EveID[$x];
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);

$sql = "SELECT Event FROM Events WHERE EveID = $eveID";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['Event'];

$sql = "SELECT a.name,a.ID,a.college,a.sex,a.mobile,a.email,a.time,b.grp FROM RegOut a, Registration b WHERE b.EveID = $eveID AND a.ID = b.ID ORDER BY grp ASC";
$result1 = mysqli_query($conn,$sql);

// var_dump(result1);
// var_dump(result2);

downloadFile($name);
echo "<table><tr><th>Anwesha_ID</th><th>Name</th><th>Sex</th><th>EmailID</th><th>College</th><th>Group_ID</th><th>TimeOfRegistration</th></tr>";
while($res=mysqli_fetch_assoc($result1)){
	echo "<tr><td>ANW" . $res['ID'] . "</td><td>" . $res['name'] . "</td><td>" . $res['sex'] . "</td><td>" . $res['email'] . "</td><td>" . $res['college'] . "</td><td>" . $res['grp'] . "</td><td>" . $res['time'] . "</td></tr>";
}														
echo"</table>";
mysqli_close($conn);
?>