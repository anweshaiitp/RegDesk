<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('startSession.php');
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
require('Function.php');
require('csrf.php');
$EveID = array();
$ID = array($_SESSION['CID']);
$NAME = $_SESSION['NAME'];
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
$csrf=generate_csrf();
$_SESSION['csrf']=$csrf;
$_SESSION['EveID'] = $EveID;
// var_dump($EveID);
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>CentralDB - Home</title>
	
	<link type="text/css" rel="stylesheet" href="events.css"/>
	<link rel=stylesheet type="text/css" href="../../../assets/css/bootstrap.css"/>
	<link rel=stylesheet type="text/css" href="unip.css"/>
	</head>
	<body>

		<div class="page-header"><h1>Central DataBase - My Events</h1></div>
		
<div id="SideBar">
<div class="well anwid"> <?php echo $NAME; ?> </div>
<ul class="nav nav-pills links">
<li><a href="Home.php">My Events</a></li>
<li><a href="Logout.php">Logout</a></li>
</ul>
</div>
		<div id="Events">
		<form method="POST" id = "uinpf">
		<input type="hidden" value="<?php echo $csrf; ?>" name=	"CSRF">
		<?php
		// var_dump( $EveID);
		if(count($EveID)){ 
			for($i = 0 ; $i<count($EveID); $i++){
				echo "<h3>";
				$eveName = $EveName[$i];
				// $eveID = $EveID[$i];
				echo "<input type=\"checkbox\" name = \"event[]\" value = \"$i\">";
				echo "<a href = \"download.php?Idx=$i\">$eveName</a>";				
				echo "</h3>";
			}
			echo "<input type =\"submit\" value = \"View\" name = \"submit\" formaction = \"display.php\">";
		}
		 ?>
		
		</form>
		</div>
		<div id=bottom>
		In case of any issue contact: <br/>
		<div id=contact>	
		<a href="https://www.facebook.com/profile.php?id=1119454858&amp;fref=ts"> Aditya(8292337923)</a> <br/>
		</div>
		</div>
	</body>
	</html>