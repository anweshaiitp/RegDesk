<?php

//assuming event name & id is from GET array
// $eve = htmlspecialchars(stripcslashes(trim($_GET['event'])));
// $ID = $_GET['ID'];
// $id = preg_replace('/[^0-9]/', '', $ID);
// if(strlen($id) != 4) {
//     echo 'Invalid ID';
//     exit(0);
// }
require('startSession.php');
require("csrf.php");
$id=$_SESSION['ID'];
require("dbcon.php");
// session_start();
if(!check_csrf($_GET['csrf'])){
    exit();
}
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE); //check user id is unique & exists

$EveID = $_GET['EveID'];

//check if it is group event
$sql="SELECT size FROM `Events` WHERE `EveID` = $EveID";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($row['size']==1){
    echo "This event is not a group event. Go to event's page to register.";
    exit();
}
$size=$row['size'];

//check if already registered
$sql="SELECT * FROM `Registration` WHERE `EveID` = '$EveID' AND `ID` = '$id' AND `grp`  ='$EveID'" ;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(count($row)==1){
    echo "You group has already been registered for this group event.";
    exit();
}

//check if already paid
$sql="SELECT * FROM `Payment` WHERE `EveID` = '$EveID' AND `ID` = '$id' AND `grp` ='$EveID'"  ;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(count($row)==1){
    echo "You group has already paid for this event.";
    exit();
}
    

// $_SESSION['id']=$id;
// $_SESSION['gid']=$gid;
$_SESSION['EveID']=$EveID;
// $_SESSION['size']=$size;

?>

<!-- let's make a form....oh yeah !!! -->
<!DOCTYPE html>
<html>
    <head>
        <title>Anwesha 2k15 Internet Registration</title>
    </head>
    <link type="text/css" rel="stylesheet" href="reg.css">
    <link type="text/css" rel="stylesheet" href="events.css">
    <link type="text/css" rel="stylesheet" href="../../assets/css/bootstrap.css">
    <body>
    <?php require ('sideBar.php');?>
                <form action="./Submit.php" method="post" class="basic-grey" style="margin-top:100px;">
                    Please fill in the Anwesha IDs of all team members.
                    <p><input type="text" name=anwID[] readonly="readonly" value="<?echo "ANW".$_SESSION['ID'];?>" /></p>

                    <?php
                     for($i=0;$i<$size-1;$i++){
                    ?><p>
                    <input type="text" name=anwID[] placeholder="<?echo "MEMBER ".($i+2)."";?>" /></p>
                    <? } ?>
                    <input type="submit" name="formSubmit" value="Submit" class="but"/>
                </form>


    </body>
</html>

