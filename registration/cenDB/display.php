<?php 
require("startSession.php");
require("Function.php");
require("csrf.php");
$csrf = $_POST['CSRF'];
if(!check_csrf($csrf)){
	die("Invalid CSRF");
}
$idx = $_POST['event'];
$events = array();
foreach ($idx as $id) {
	$events[] = $_SESSION['EveID'][$id];
}
$Names = array();
if(!empty($events)){
	$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
        foreach($events as $event){
            $Names[] = getName($event, $conn);
        }
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>View Event</title>
	</head>
	<link type="text/css" rel="stylesheet" href="events1.css"/>
	<link rel=stylesheet type="text/css" href="../../../assets/css/bootstrap.css"/> 
	<link rel=stylesheet type="text/css" href="display.css"/>
	
	<body>

		<div class="page-header"><h1>Central DataBase - My Events</h1></div>
		</div>
<div id="SideBar">
<div class="well anwid"> <?php echo $_SESSION['NAME']; ?> </div>
<ul class="nav nav-pills links">
<li><a href="Home.php">My Events</a></li>
<li><a href="Logout.php">Logout</a></li>
</ul>
</div>
		<?php
		// var_dump( $EveID);
		// if(count($EveID)){ 
		// 	for($i = 0 ; $i<count($EveID); $i++){
		// 		echo "<h3>";
		// 		$eveName = $EveName[$i];
		// 		// $eveID = $EveID[$i];
		// 		echo "<input type=\"checkbox\" name = \"event[]\" value = \"$i\">";
		// 		echo "<a href = \"download.php?Idx=$i\">$eveName</a>";				
		// 		echo "</h3>";
		// 	}
		// 	echo "<input type =\"submit\" value = \"View\" name = \"submit\" formaction = \"display.php\"";
		// }

	for($j = 0; $j < count($events) ; $j++){
        $event = $events[$j];
        $i = 1;
		$sql = "SELECT a.name,a.ID,a.college,a.sex,a.mobile,a.email,a.time,b.grp FROM RegOut a, Registration b WHERE b.EveID = $event AND a.ID = b.ID ORDER BY grp ASC";
		// echo $sql;
		$result = mysqli_query($conn,$sql);
		$RegResult = array();
		while ($row = mysqli_fetch_assoc($result)){
			$RegResult[] = array($row['ID'],$row['name'],$row['college'],$row['sex'],$row['mobile'],$row['email'],$row['time'],$row['grp']);
		}

		if(count($RegResult) != 0){

?>
	<h3><?php echo $Names[$j]; ?></h3>
		<table>
        <div class="subEvents"><tr><th>S.No.</th><th>ID</th><th>Name</th><th>College</th><th>Sex</th><th>Mobile</th><th>Email</th><th>Time</th><th>Group</th></tr>
<?php
			for ($k = 0 ; $k < count($RegResult) ; $k++){
				$num = "even";
				if($i%2 != 0)
					$num = "odd";
						
				echo "<tr class = \"$num\"><td>$i</td>";
                $i++;
                echDetail($RegResult[$k]);
			}
?>
	</table>
	</div>
	<div id=bottom>
		In case of any issue contact: <br/>
		<div id=contact>	
		<a href="https://www.facebook.com/profile.php?id=1119454858&amp;fref=ts"> Aditya(8292337923)</a> <br/>
		</div>
		</div>
	</body>
<?php
		}

	}
mysqli_close($conn);
}else {
	exit();
}
?>
