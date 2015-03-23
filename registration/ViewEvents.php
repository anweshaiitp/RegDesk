<?php require('startSession.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - Anwesha2k15</title>
	<link rel="stylesheet" type="text/css" href="events.css"/>
	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css"/>
</head>
<body>

<div class="page-header">
  <h1>Registered Events</h1>
</div>
<?php 

function getGroup($conn,$GroupID){
	$sql = "SELECT ID FROM GrpID WHERE GrpID = $GroupID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	return explode(' ', $row['ID']);
}
function getName($conn,$ID){
	$sql = "SELECT name FROM RegOut WHERE ID = $ID";
	// var_dump($sql);
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	return $row['name'];
}

//require('startSession.php');

// $_SESSION['ID'] = 1314;
// $_SESSION['NAME'] = 'RAHUL ARYA';

// if(!isset($_SESSION['ID'])){
// 	exit();
// }

$ID = $_SESSION['ID'];
require("dbcon.php");
require("getEvents.php");
require("sideBar.php");
require("csrf.php");
$csrf = generate_csrf();
$_SESSION['csrf'] = $csrf;
// var_dump($csrf);
?> 
<div id="Events">
<h3>Individual Events:</h3>
<div class = "subEvents">
<ul class="list-group">
<?php 
foreach ($IndEvent as $xyz) {
	echo "<li class=\"list-group-item\">".strtoupper(preg_replace("/[_]/",' ', $xyz))."</li>";
}
?>
</ul>
</div>
<h3>Group Events:</h3>
<div class = "subEvents list-group" >
<ul>
<?php 
for ($i = 0 ; $i < count($GrpEventT); $i++) {
	$xyz = $GrpEventT[$i];
	echo "<li class=\"list-group-item\">".strtoupper(preg_replace("/[_]/",' ', $xyz))." (Group ID = $GIGrpEventT[$i]) ";
	echo "";
	echo "<ul class=\"list-group names\">";
	$members = getGroup($conn,$GIGrpEventT[$i]);
	foreach ($members as $abc) {
		$name = getName($conn,$abc);
		echo "<li class=\"list-group-item\">".strtoupper(preg_replace("/[_]/",' ', $name))." (ANW$abc)</li>";
	}
	echo "</ul></li>";
}

for ($i = 0 ; $i < count($GrpEventNT); $i++) {
	$xyz = $GrpEventNT[$i];
	$abc = $IGrpEventNT[$i];
	echo "<li>".strtoupper(preg_replace("/[_]/",' ', $xyz))."<a href = \"Selection.php?EveID=".$abc."&csrf=".$csrf."\"><button type=\"button\" class=\"btn btn-primary\">form group</button></a></li>";
}
?>
</ul>
</div>
</div>
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