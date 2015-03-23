<?php 

function validate_ID($ID,$token){
    require('dbcon.php');
    $sql = "SELECT COUNT(*) FROM LoginTable WHERE ID = $ID AND token = '$token'";
    $conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $num = $row['COUNT(*)'];
    return $num == 1;
}
function check_token($token){
    return preg_replace('/[^0-9a-f]/','', $token);
}
function validate_token($token){
    return strlen($token)==40;
}
session_start();

$Err = '';
$link = "http://2015.anwesha.info/form/registration/setPassword.php?ID=".$_GET['ID']."&token=".$_GET['token'];
//$link = "http://localhost/Test/Anwesha/Internet/setPassword.php?ID=".$_GET['ID']."&token=".$_GET['token'];
if(isset($_POST['submit'])){
    
    $ID = preg_replace('/[^0-9]/', '',$_GET['ID']);
    $token = check_token($_GET['token']);
    $pass = $_POST['pass'];

    if(!validate_token($token))
        exit();

    if(!(strlen($ID) == 4 && validate_ID($ID,$token))){
        exit();
    }
    if(!(strlen($pass) >= 8 && strlen($pass) <= 20)){
        $Err = 'Invalid password length';
    }
    if($Err == ''){
        $pass = sha1($pass);
        require ('dbcon.php');
        $sql = "UPDATE LoginTable SET pass = '$pass', token = NULL WHERE ID = $ID and token = '$token'";
        //echo $sql;
        $conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        
        $dirname = dirname($_SERVER['PHP_SELF']);
        $file = '/Login.php';
        require('redirect.php');
        exit();
    }
}
//$dirname = dirname($_SERVER['PHP_SELF']);
//$file = '/Login.php';
//$home_url = 'http://' . $_SERVER['HTTP_HOST'] . $dirname . $file;
//echo $home_url;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Anwesha 2k15</title>
    <link rel="stylesheet" type="text/css" href="reg.css">
</head>

<body>
<h1>Anwesha 2k15 : Sign Up</h1>
Enter Your new password!
<form method="POST" action="<?php echo $link; ?>" class="basic-grey">
    <label><span>New Password</span></label><input type="password" name = "pass" required ><br/><span class = "Err"><?php echo $Err; ?></span><br/>
    Password should be more than 8 character and less than 20 character long. <br/>
    <input type="submit" value = "Set Password" name = "submit" class="but">
</form>
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