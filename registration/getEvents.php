<?php 
if(!isset($ID)){
	exit();
}


$IndEvent = array();
$GrpEventNT = array();
$IGrpEventNT = array();
$GrpEventT = array(); 
$GIGrpEventT = array();

$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
$sql1 = "SELECT b.Event, a.EveID FROM Registration a, Events b WHERE a.ID = $ID AND a.grp = 0 AND a.EveID = b.EveID AND b.size != 1 ORDER BY b.Event";
//gives group events where no team is formed yet
$sql2 = "SELECT b.Event, a.grp FROM Registration a, Events b WHERE a.ID = $ID AND a.grp != 0 AND a.EveID = b.EveID AND b.size != 1 ORDER BY b.Event";
//gives group events where team is already formed
$sql3 = "SELECT b.Event FROM Registration a, Events b WHERE a.ID = $ID AND a.EveID = b.EveID AND b.size = 1 ORDER BY b.Event";
//gives individual events

$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);
$result3 = mysqli_query($conn,$sql3);

while($row = mysqli_fetch_assoc($result1)){
	$GrpEventNT[] = $row['Event'];
	$IGrpEventNT[] = $row['EveID'];
}
while($row = mysqli_fetch_assoc($result2)){
	$GrpEventT[] = $row['Event'];
	$GIGrpEventT[] = $row['grp'];
}
while($row = mysqli_fetch_assoc($result3)){
	$IndEvent[] = $row['Event'];
}


?>