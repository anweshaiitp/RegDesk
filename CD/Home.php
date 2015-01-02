<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('startSession.php');
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
require_once('Function.php');

$EveID = array();
$ID = array($_SESSION['id']);
$EveName = array();
for ($i = 0; $i < count($ID) ; $i++){
	$id = $ID[$i];
	$row = searchQuery($id,$conn);
	
	$event = $row['Event'];
	if(!empty($event)){
		$eventx = explode(" ", $event);
		foreach($eventx as $x){
			$EveID[] = $x;
		}
	}

	$subID = $row['subID'];
	if(!empty($subID)){
		$SUBID = explode(" ", $subID);
		foreach($SUBID as $y){
			$ID[] = $y;
		}
	}
}
sort($EveID);
foreach($EveID as $eveID){
	$EveName[] = getName($eveID,$conn);
}
// var_dump($EveID);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title><?php echo $_SESSION['user']; ?>-Home</title>
	</head>
	<!--<link type="text/css" rel="stylesheet" href="IntraReg.css">-->
	<body>

		<h1>ANWESHA 2K15 : <span id = "h1.2">Organizer's Database</span></h1>
		<header><span class = "Welcome">Welcome <?php echo $_SESSION['user']; ?> </span> <span class = "Logout"><a href = "Logout.php">Logout</a></span></header>


		<form id = "Display" method="POST" action="display.php">
		List of events : <br/>
		<?php
		if(count($EveID)){ 
			for($i = 0 ; $i<count($EveID); $i++){
				$eveName = $EveName[$i];
				$eveID = $EveID[$i];
				echo "<input type=\"checkbox\" name = \"event[]\" value = \"$eveID\">$eveName <br/>";				
			}
			echo "<input type =\"submit\" value = \"View\" name = \"submit\">";
			// echo "<input type = \"submit\" value = \"Download\" name = \"down\" formaction = \"download.php\"";
			mysqli_close($conn);
		}
		 ?>
			
		</form>
		
		<footer> For any queries or problems contact : Aditya(8292337923)</footer>
	</body>
	</html>