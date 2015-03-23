<?php
function searchQuery($id,$conn){
	$sql = "SELECT * FROM AnweshaHierarchy WHERE ID = $id";
	$result = mysqli_query($conn,$sql);
	return mysqli_fetch_assoc($result);	
}

function getName($eveID,$conn){
	$sql = "SELECT Event FROM Events WHERE EveID = $eveID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);	
	return strtoupper(preg_replace("/[_]/",' ',$row['Event']));
}

function checkGroup($eveID, $conn){
	$sql = "SELECT COUNT(*) AS COUNT FROM GrpEvent WHERE EveID = $eveID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);	
	if($row['COUNT'] > 0){
		return true;
	} else {
		return false;
	}
}

function getRegistered($eveID, $conn){
	$sql = "SELECT a.name,a.ID,a.college,a.sex,a.mobile,a.email,a.time,b.grp FROM RegOut a, Registration b WHERE a.ID = b.ID AND b.EveID = $eveID ORDER BY grp ASC";
	$result = mysqli_query($conn,$sql);
	$arrResult = array();
	while ($row = mysqli_fetch_assoc($result)){
		$arrResult[] = array($row['ID'],$row['name'],$row['college'],$row['sex'],$row['mobile'],$row['email'],$row['time'],$row['grp']);
	}
	return $arrResult;
}

function getPaid($eveID, $conn){
	$sql = "SELECT a.name,a.ID,a.college,a.sex,a.mobile,a.email,a.time,b.grp FROM RegOut a, Payment b WHERE a.ID = b.ID AND b.EveID = $eveID ORDER BY grp ASC";
	$result = mysqli_query($conn,$sql);
	$arrResult = array();
	while ($row = mysqli_fetch_assoc($result)){
		$arrResult[] = array($row['ID'],$row['name'],$row['college'],$row['sex'],$row['mobile'],$row['email'],$row['time'],$row['grp']);
	}
	return $arrResult;
}
function echDetail($arr){
	$ID = $arr[0];
	$name = $arr[1];
	$college = $arr[2];
	$sex = $arr[3];
	$mobile = $arr[4];
	$email = $arr[5];
	$time = $arr[6];
	$grp = $arr[7];
	echo "<td>ANW$ID</td><td>$name</td><td>$college</td><td>$sex</td><td>$mobile</td><td>$email</td><td>$time</td><td>$grp</td>";
	echo "</tr>";
}
?>