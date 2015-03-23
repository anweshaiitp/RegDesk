<?php
require('startSession.php');
require("dbcon.php");
function check_ID($ID,$conn){
  $sql = "SELECT COUNT(*) FROM RegOut WHERE ID = $ID";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  return $row['COUNT(*)']==1;
}
function validate_ID($ID){
  return strlen($ID)==4;
}
function check_vacant($conn,$ID){
  $sqlt1="SELECT COUNT(*) FROM `Registration` WHERE `EveID` = '$EveID' AND `ID` = '".$ID."' AND `grp` != 0" ;
  // var_dump($sqlt1);
  $result1 = mysqli_query($conn,$sqlt1);
  $row1 = mysqli_fetch_assoc($result1);

  if ($row1['COUNT(*)']!=0) {
    $msg = "One of the group members is already registered in some other group for this event.";
    require('msg.php');
    exit();
    }
}

$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);

$EveID=$_SESSION['EveID'];
$anwID1[] = $_POST['anwID'];
$anwID1 = $anwID1[0];
$anwID = array();

for($i=0;$i<count($anwID1);$i++){
    if($anwID1[$i]!=""){
        $str = $anwID1[$i];
        $anwID[] = preg_replace('/[^0-9]/', '', $str);
    }
}

$size=count($anwID);
sort($anwID);
for ($i=0; $i < $size-1; $i++) { 
    if($anwID[$i] == $anwID[$i + 1]){
        $msg = "IDs were repeated in your input fields. Try again!";
        require('msg.php');
        exit();
    }
}
// var_dump($anwID);

for ($i=0; $i < $size; $i++){
  if(!validate_ID($anwID[$i])){
    $ID = $anwID[$i];
      $msg = "Improper Anwesha ID $anwID[$i]";
      require('msg.php');
      exit();
  }
    if(!check_ID($anwID[$i],$conn)){
      $msg = "Anwesha ID $anwID[$i] is not yet registered";
      require('msg.php');
      exit();
  }
  check_vacant($conn,$ID);
}
//checking if the ids of other members are in other groups in same event.
for ($i=0; $i < $size; $i++) { 

    $sqlt1="SELECT COUNT(*) FROM `Registration` WHERE `EveID` = '$EveID' AND `ID` = '".$anwID[$i]."' AND `grp` = 0" ;
    
    //var_dump($sqlt1);
    $result1 = mysqli_query($conn,$sqlt1);
    
    $row1 = mysqli_fetch_assoc($result1);
    
       if ($row1['COUNT(*)']!=1) {
           //$msg = "One of the group members is not registered for this event.";
           //require('msg.php');
           // exit();
           $sql = "INSERT INTO Registration(EveID,ID) VALUES ($EveID,ID)";
           mysqli_query($conn,$sql);
       }
}


$sql1="SELECT * FROM `GIDTable` LIMIT 1";
$sql2="DELETE FROM `GIDTable` LIMIT 1";
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);
$gid=$row['ID'];
$result = mysqli_query($conn,$sql2);    
//delete the used GroupID

for($i=0;$i<count($anwID);$i++){
    $sqlt1="UPDATE `Registration` SET `grp` = '$gid' WHERE `EveID` = $EveID AND `ID` = '$anwID[$i]'";
    $result1=mysqli_query($conn,$sqlt1);    
}

//finally putting the newly formed team in GrpID table and then we will be done :)

//so here it goes
//first we make a big string of all group members' ids
$idstr="";
for ($i=0; $i <count($anwID) ; $i++) { 
    $idstr=$idstr . $anwID[$i] . " ";
}
$idstr = trim($idstr);
$sql="INSERT INTO `GrpID` VALUES ('$gid','$EveID','$idstr')";
$result = mysqli_query($conn,$sql);

$msg = "Group Registration Complete";
require('msg.php');
mysqli_close($conn);
?>