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
	return $row['Event'];
}

?>