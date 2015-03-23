<?php 
$qry = mysqli_real_escape_string($conn,$qry);
$query = "INSERT INTO NewQuery(Query) VALUES ('$qry')";
$output = mysqli_query($conn,$query);
?>