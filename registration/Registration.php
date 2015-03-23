<?php 
require("dbcon.php"); 
session_start();
?>
<!-- File containing registration details! -->
<!DOCTYPE html>
<html>
    <head>
        <title>Anwesha 2k15 Registration</title>
        <style>
                <style>
        @font-face{
    font-family: headingfont;
    src:url('../../assets/fonts/Modeka.otf');
}
            body{
    background: url('bg.jpg');
    font-family: Arial;
    padding: 1em;
}

.pic{
    font-size: 100%;
    width: 50%;
}
.but{
    font-size: 100%;
    border: 0;
    padding: 0.5em;
    border-radius: 2px;
    background: #166f97;
    color: #ffffff;
    
    margin:5px;
}
.but:hover{
    background: #8ab7cb;
}
input,textarea{
    font-family: Arial;
    font-size: 1px;
    color:#548acd;
}
.box{
    position: absolute;
    padding: 1em;
    margin: 1em;
    left: 50%;
    -ms-transform: translate(-50%,0); /* IE 9 */
    -webkit-transform: translate(-50%,0); /* Chrome, Safari, Opera */
    transform: translate(-50%,0);
    background: rgba(255,255,255,0.85);
    border-radius:0.3em;
    width:50%;
}
h1{
font-family:headingfont;
    text-align:center;
    color:#513515;
    font-size: 2.6em;
    /*line-height:50%;*/
}
h2{
    text-align:center;
    color:#513515;
    font-size:2em;
    line-height:50%;
}

#bottom {
    background: radial-gradient(#000 15%, transparent 16%) 0 0, 
            radial-gradient(#000 15%, transparent 16%) 8px 8px, 
            radial-gradient(rgba(255,255,255,0.1) 15%, transparent 20%) 0 1px, 
            radial-gradient(rgba(255,255,255,0.1) 15%, transparent 20%) 8px 9px;
    background-color: #500505;
    background-size: 16px 16px;
    color: #bbb;
    font-family:bebas;
    padding:0.5%;
    position: fixed;
    bottom:2%;
    left:80%;
    right:2%;
    text-align:center;
    border-radius:5px;
    border: 2px solid #6a6a6a;
}
#notice {
    background:#bbb;
    font-family:bebas;
    padding:0.5%;
    position: fixed;
    bottom:2%;
    right:80%;
    left:2%;
    text-align:center;
    border-radius:5px;
    border: 2px solid #6a6a6a;
}
.entry{
    margin:5px;

}
.entry label{
    float:left;
    line-height:40px;
    width:100px;
}
.sel{
    text-align:center;
    margin:3px 0 3px 0;
}
#bottom #contact {
    font-size: 0.7em;
}

/* Basic Grey */
.basic-grey {
    margin-left:auto;
    margin-right:auto;
    max-width: 500px;
    background: rgba(224,224,224,0.6);
    padding: 25px 15px 25px 10px;
    font: 16px Georgia, "Times New Roman", Times, serif;
    color: #101010;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #E4E4E4;
    font-weight:bold;
}
.basic-grey h1 {
    font-size: 25px;
    padding: 0px 0px 10px 40px;
    display: block;
    border-bottom:1px solid #E4E4E4;
    margin: -10px -15px 30px -10px;;
    color: #888;
}
.basic-grey h1>span {
    display: block;
    font-size: 11px;
}
.basic-grey label {
    display: block;
    margin: 0px;
}
.basic-grey label>span {
    float: left;
    width: 20%;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #101010;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select, .basic-grey input[type="tel"], .basic-grey input[type="number"] {
    border: 1px solid #DADADA;
    color: #101010;
    height: 30px;
    margin-bottom: 16px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 3px 3px 3px 5px;
    width: 70%;
    font-size: 12px;
    line-height:15px;
    box-shadow: inset 0px 1px 4px #ECECEC;
    -moz-box-shadow: inset 0px 1px 4px #ECECEC;
    -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
        -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
.basic-grey input:focus {
border: 1px solid #09C;
box-shadow: 0px 0px 4px #09C;
    -moz-box-shadow: 0px 0px 4px #09C;
    -webkit-box-shadow: 0px 0px 4px #09C;
}
.basic-grey textarea{
    padding: 5px 3px 3px 5px;
}

.basic-grey textarea{
    height:100px;
}
.basic-grey .button {
    background: #E27575;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    box-shadow: 1px 1px 5px #B6B6B6;
    border-radius: 3px;
    text-shadow: 1px 1px 1px #9E3F3F;
    cursor: pointer;
}
.basic-grey .button:hover {
    background: #CF7A7A
}
.Err{
color:red;
}        


/* mouse over link */
a:hover{
color:#ed5d33;
}
a:link{
transition:all .5s;
-webkit-transition:all .5s;
-moz-transition:all .5s;
-o-transition:all .5s;
}
#bottom a:visited,#bottom a:link{
text-decoration:none;
color:#bbb;
}
        </style>
    </head>
    <link type="text/css" rel="stylesheet" href="bootstrap.css">
    <body>
        <h1>Welcome to Anwesha 2k15 Registrations.!</h1>
        <br/>

        <?php

        function prepare_input($data) {
            return htmlspecialchars(stripcslashes(trim($data)));
        }

        function prepare_mobile($phno) {
            return $phno = preg_replace('/[^0-9]/', '', $phno);
        }

        function check_text($data) {
            if (empty($data)) {
                return 'Can\'t be blank';
            } elseif (!preg_match('/^[a-zA-Z]*$/', $data)) {
                return "Only letters are allowed!";
            } else
                return '';
        }

        function check_date($dd, $mm, $yyyy) {
            if ($mm == 2) {
                if ($dd > 29) {
                    return 'Date is Wrong';
                } elseif ($dd == 29) {
                    if ($yyyy == 2000 || $yyyy == 1996 || $yyyy == 1992 || $yyyy == 1988 || $yyyy == 1984)
                        return 0;
                    else
                        return 'Not a leap year';
                }
            }
            if ($dd == 31) {
                if ($mm == 2 || $mm == 4 || $mm == 6 || $mm == 9 || $mm == 11) {
                    return "Date is Wrong";
                }
            }
            return '';
        }

        function check_mobile($phno) {
            if (!(strlen($phno) == 10))
                return'Invalid number format';

            return '';
        }

        function check_email($email) {
            if (empty($email))
                return 'Can\'t be blank';
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
                return 'Invalid email format';
            else
                return '';
        }
        function check_captcha($data) {
            return preg_replace("/[^a-z]/",'', $data);
        }
        function make_text($data){
            return preg_replace('/[^a-zA-Z]/','', $data);
        }
        function make_numeric($data){
            return preg_replace('/[^0-9]/', '', $data);
        }
//If submit input button is clicked following code proceeds
        if (isset($_POST['submit'])) {

            //out=false if all inputs are correct else out = true
            $out = false;
            $nameErr = '';
            $collegeErr = '';
            $cityErr = '';
            $mobileErr = '';
            $emailErr = '';
            $dateErr = '';
            $captchaErr = 'Invalid Captcha';

            $Fname = ucfirst(strtolower(make_text(prepare_input($_POST['FirstN']))));
            $Lname = ucfirst(strtolower(make_text(prepare_input($_POST['LastN']))));
            $name = make_text(prepare_input($Fname . $Lname));
            $sex = make_text(prepare_input($_POST['Sex']));
            $day = make_numeric(prepare_input($_POST['Day']));
            $month = make_numeric(prepare_input($_POST['Month']));
            $year = make_numeric(prepare_input($_POST['Year']));
            $college = make_text(prepare_input($_POST['college']));
            $city = make_text(prepare_input($_POST['city']));
            $mobile = make_numeric(prepare_mobile($_POST['mobile']));
            $email = prepare_input($_POST['email']);

            
            $captcha = $_POST['captcha'];
            $captcha = check_captcha($captcha);
            if(SHA1($captcha) == ($_SESSION['pass_phrase'])){
                $captchaErr = '';
                // var_dump($captchaErr);
                // var_dump($captcha);
            }
            $nameErr = check_text($name);
            $collegeErr = check_text($college);
            $cityErr = check_text($city);
            $mobileErr = check_mobile($mobile);
            $emailErr = check_email($email);
            $dateErr = check_date($day, $month, $year);

            if ($nameErr)
                $out = true;
            if ($collegeErr)
                $out = true;
            if ($cityErr)
                $out = true;
            if ($mobileErr)
                $out = true;
            if ($emailErr)
                $out = true;
            if ($dateErr)
                $out = true;
            if($captchaErr)
                $out = true;
        }
        else {

            $out = true;
            $nameErr = '';
            $collegeErr = '';
            $cityErr = '';
            $mobileErr = 'Must be unique';
            $emailErr = '';
            $dateErr = '';
            $captchaErr = '*Case Sensitive';

            $Fname = '';
            $Lname = '';
            $sex = 'M';
            $day = 10;
            $month = 7;
            $year = 1995;
            $college = 'IIT Patna';
            $city = 'Patna';
            $mobile = '';
            $email = '';
        }
        if ($out) {
            //generating input form
            ?>
             <form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
                <label for = "FName"><span>First Name : </span></label> <input class="inp" required id="FirstN" name = "FirstN" type="text"  autofocus value = "<?php echo $Fname; ?>"> <br>
                <label for = "LName"> <span>Last Name : </span></label> <input class="inp"  id="LastN" name = "LastN" type="text" value = "<?php echo $Lname; ?>"> <span class = "Err"> <?php echo $nameErr; ?></span><br>
                <label for = "Sex"><span> Sex : </span></label> 
                
                <select name = "Sex" required id="Sex"> 
                    <option value = "M" <?php if ($sex == 'M') {
            echo 'selected';
        } ?>>Male</option>
                    <option value = "F" <?php if ($sex == 'F') {
            echo 'selected';
        } ?>>Female</option></select>
                <label for = "DOB" style="margin:0 5px 0 0;"><span>D.O.B.</span></label><br><br>
                <label><span>DD</span></label> <select name = "Day" type = "number" required id="Day"> 
                    <?php
                    for ($i = 01; $i <= 31; $i++) {
                        echo '<option value = "' . $i . '" ';

                        if ($i == $day) {
                            echo 'selected';
                        }

                        echo '>' . $i . '</option>';
                    }
                    ?>
                </select>
                <label><span>MM</span></label><select name = "Month" required id="Month"> 
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo '<option value = "' . $i . '" ';
                        if ($i == $month)
                            echo 'selected';

                        echo '>' . $i . '</option>';
                    }
                    ?>
                </select>
                <label><span>YYYY</span></label> <select name = "Year" required id="Year"> 
                    <?php
                    for ($i = 1984; $i <= 2000; $i++) {
                        echo '<option value = "' . $i . '" ';

                        if ($i == $year) {
                            echo 'selected';
                        }

                        echo '> ' . $i . ' </option>';
                    }
                    ?>
                </select>
                <span class = "Err"> <?php echo $dateErr; ?></span> <br>

                <label for = "College"><span>College : </span></label> <input class="inp" require id = "College" name = "college" type="text" value = "<?php echo $college; ?>"><span  class = "Err"> <?php echo $collegeErr; ?></span><br>
                <label for = "City"> <span>City : </span></label> <input class="inp" required id = "City" name = "city" type="text" value = "<?php echo $city; ?>"><span class = "Err"> <?php echo $cityErr; ?></span><br>
                <label for = "Mobile"><span> Mobile : +91 </span></label><input class="inp" required id = "Mobile" name = "mobile" type="tel" value="<?php echo $mobile; ?>"><span class = "Err"> <?php echo $mobileErr; ?></span><br>
                <label for = "Email"><span> Email : </span></label> <input class="inp" required id = "Email" name = "email" type="email" value = "<?php echo $email; ?>"><span class = "Err"> <?php echo $emailErr; ?></span><br>
                <label for="verify"><span>Verification:</span></label><input type="text" name = "captcha" id="verify" value=""><img src="captcha.php" alt="Verification pass-phrase"><span class = "Err"><?php echo $captchaErr; /*var_dump($_SESSION); var_dump($pass_phrase);*/ ?></span><br>
                <input type = "submit" value="Submit" class ="but" name="submit"> <input type = "reset" class ="but" value="Revert" name="revert">
            </form>
            <?php
        } else {
            

            $conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
            $Err = '';

            $sql = "SELECT ID FROM IDTable LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                $Err = 'Problem in Getting A new ID';
                mysqli_close($conn);
            } else {

                $row = mysqli_fetch_array($result);
                $id = $row['ID'];
                $time = time() + (5*60*60 + 30*60);
                $stime = gmdate('Y-m-d H:i:s',$time);
                $name = preg_replace('/[^a-zA-Z]/','_', $name);
                $college = preg_replace('/[^a-zA-Z]/','_', $college);
                $city = preg_replace('/[^a-zA-Z]/','_', $city);
                $sql2 = "INSERT INTO RegOut (name,college,city,sex,mobile,email,ID,dob,time) VALUES ('$name', '$college', '$city', '$sex', $mobile, '$email', $id, STR_TO_DATE('$day-$month-$year', '%d-%m-%Y'), '$stime') ";
                
                $result = mysqli_query($conn, $sql2);
                if (!$result) {
                    $Err = 'Problem in Creating new registration - Maybe mobile number already in use.';
                    mysqli_close($conn);
                } else {
                    $qry = $sql2;
                    require("Command.php");
                    $sql3 = "DELETE FROM IDTable WHERE id = $id";
                    $result = mysqli_query($conn, $sql3);
                    if (!$result) {
                        $Err = 'Problem in deleting id after use';
                        mysqli_close($conn);
                    } else {
                        $qry = $sql3;
                        require("Command.php");
                        $sql4 = "SELECT * FROM RegOut WHERE ID = '$id'";
                        $result = mysqli_query($conn, $sql4);
                        if (!$result) {
                            $Err = 'Problem in Displaying result for Anwesha ID = ' . $id;
                            mysqli_close($conn);
                        } else {
                            $row = mysqli_fetch_array($result);
                            $name = preg_replace("/[_]/",' ',$row['name']);
                            $id = $row['ID'];
                            $college = preg_replace("/[_]/",' ',$row['college']);
                            $city = preg_replace("/[_]/",' ',$row['city']);
                            $dob = $row['dob'];
                            $sex = $row['sex'];
                            $mobile = $row['mobile'];
                            $email = $row['email'];
                            
                            $to = $email;
                            $subject = "Registration Confirmation - Anwesha 2k15";
                            require("csrf.php");
                            $token = generate_csrf();
                            $sql = "INSERT INTO LoginTable (ID, pass, token) VALUES ($id, NULL,'$token')";
                            mysqli_query($conn, $sql);
                            $msg = "Hello $name \nYou have been successfully registered to Anwesha 2k15.\nYour Anwesha ID : ANW".$id."\nRegistered Mobile : $mobile.\nFollow this link to set password for your Anwesha account: http://2015.anwesha.info/form/registration/setPassword.php?ID=$id&token=$token \nThank You\nRegistration Desk\nregistration@anwesha.info\nAnwesha 2k15 - Hakuna Matata\n\nIn case of any issue contact: \nAvishek(9693575181)\nAditya(8292337923)\nArindam (9472472543) \n\n\nFor more details log on to http://2015.anwesha.info/ or follow us on facebook http://www.facebook.com/anwesha.iitpatna\n\n\nDownload dabblr-The Student Companion App and follow Anwesha to receive all live notifications and updates.\nClick- http://goo.gl/bGHY5O to download or search Google PlayStore for 'dabblr'";                            
                            mail($to,$subject,$msg);
                            $link = "http://2015.anwesha.info/form/registration/setPassword.php?ID=$id&token=$token";
                            //echo 'You have Registered Successfully!';
                            mysqli_close($conn);
                            ?>
                             <form id = "UserOutput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
                                <label for = "ID"><span> ID : </span></label> <input name = "ID" id = "ID" type="text" size="30" value = "<?php echo 'ANW' . $id; ?>" readonly="readonly"><br>
                                <label for = "Name"><span> Name : </span></label> <input name = "Name" type="text" size="30" value = "<?php echo $name; ?>" readonly="readonly"> <br>
                                <label for = "Mobile"><span> Mobile : +91</span></label><input name = "Mobile" type="number" size="13" value = "<?php echo $mobile; ?>" readonly="readonly"> <br>
                                <label for = "Email"><span> Email : </span></label> <input name = "Email" type="text" size="30" value = "<?php echo $email; ?>" readonly="readonly"> <br>
                                <input type = "submit" class ="but" value="Set Password!" autofocus formaction="<?php echo $link; ?>"><input type = "submit" class ="but" value="Back" name="restart">
                                <span style="color:green">You have been successfully registered!</span>
                            </form>
                            <?php
                        }
                    }
                }
            }
            if ($Err) {
                ?>
                <form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="basic-grey">
                    <label class = "Err"><span> Error : </span></label> <?php echo $Err; ?> <br><br>
                    <input type = "submit" value="Back" name="restart" class="but">
                </form>
        <?php
    }
}
?>
<div id="bottom">
    In case of any issue contact: <br />
    <div id="contact">
        Avishek(9693575181)
        Manvee(9905057654)
       <a target="_blank"href="https://www.facebook.com/profile.php?id=1119454858&fref=ts"> Aditya(8292337923)</a> <br />
       <a target="_blank"href="https://www.facebook.com/arindam.banerjee.790?fref=ts">Arindam (9472472543)</a> <br />
       <a target="_blank"href="https://www.facebook.com/manu.sharma.1428921">Manu(8292340331)</a> <br />
    </div>
</div>  
<div id="notice">
	<p>To register for an event go to the respective events details <a href="http://2015.anwesha.info/#slide-3" target="_blank">page</a></p>
	<p style="color:#e25d33">To register in a group event, first register for the events <a href="http://2015.anwesha.info/#slide-3" target="_blank">page</a> and then go to  <a href="Login.php"> Login</a> page</p>
	<p>For managing events and making groups click <a href="Login.php">here.</a></p>
</div>  
    </body>
</html>
                            
                            
                            
                            
                            
                            
                            