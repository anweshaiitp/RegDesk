<?php
function downloadFile($i){
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=spreadsheet($i).xls");
}

require("../dbcon.php");
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
$sql="SELECT * FROM RegOut";
$result = mysqli_query($conn,$sql);

for($i = 0; $i < 2; $i++){
downloadFile($i);
echo"<table><tr><th>name</th><th>mobile</th><th>college</th></tr>";
 while($res=mysqli_fetch_assoc($result))
 {
  echo"<tr><td>".$res['name']."</td><td>".$res['mobile']."</td><td>".$res['college']."</td></tr>";
 }
echo"</table>";
}




?>