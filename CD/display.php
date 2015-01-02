<?php 
require("startSession.php");
require("Function.php");
$events = $_POST['event'];
$Names = array();
if(!empty($events)){
	$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
        foreach($events as $event){
            $Names[] = getName($event, $conn);
        }
	for($j = 0; $j < count($events) ; $j++){
            $event = $events[$j];
                $i = 1;
		$sql = "SELECT name,ID,college,sex,mobile,email FROM RegOut WHERE eventPay LIKE '%$event%' ORDER BY Time DESC";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) != 0){
?>
		<table>
			<caption><?php echo $Names[$j]; ?> - Registered and Paid</caption>
                        <tr><th>S.No.</th><th>Name</th><th>ID</th><th>College</th><th>Sex</th><th>Mobile</th><th>Email</th></tr>
<?php
			while($row = mysqli_fetch_array($result)){
				$name = $row['name'];
				$ID = $row['ID'];
				$college = $row['college'];
				$sex = $row['sex'];
				$mobile = $row['mobile'];
				$email = $row['email'];
				$num = "even";
				if($i%2 != 0)
					$num = "odd";
						
				echo "<tr class = \"$num\"><td>$i</td><td>$name</td><td>$ID</td><td>$college</td><td>$sex</td><td>$mobile</td><td>$email</td></tr>";
                                $i++;
			}
?>
	</table>
<?php
		
		}

		$sql = "SELECT name,ID,college,sex,mobile,email FROM RegOut WHERE eventReg LIKE '%$event%' ORDER BY Time DESC";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) != 0){
?>
		<table>
			<caption><?php echo $Names[$j]; ?> - Registered Only(Not Paid)</caption>
			<tr><th>S.No.</th><th>Name</th><th>ID</th><th>College</th><th>Sex</th><th>Mobile</th><th>Email</th></tr>
<?php
			while($row = mysqli_fetch_array($result)){
				$name = $row['name'];
				$ID = $row['ID'];
				$college = $row['college'];
				$sex = $row['sex'];
				$mobile = $row['mobile'];
				$email = $row['email'];
				$num = "even";
				if($i%2 != 0)
					$num = "odd";
					
				echo "<tr class = \"$num\"><td>$i</td><td>$name</td><td>$ID</td><td>$college</td><td>$sex</td><td>$mobile</td><td>$email</td></tr>";
                                $i++;
			}
?>
	</table>
<?php
		}
    } 
}else {
	echo "hatt";
}


?>