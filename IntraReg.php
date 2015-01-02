<!DOCTYPE html>
<html>
    <head>
        <title>Anwesha 2k15 Reg. Intranet</title>
    </head>
    <link type="text/css" rel="stylesheet" href="IntraReg.css">
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
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data)) {
                return "Only letters and space are allowed!";
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

        if (isset($_POST['submit'])) {


            $out = false;
            $nameErr = '';
            $collegeErr = '';
            $cityErr = '';
            $mobileErr = '';
            $emailErr = '';
            $dateErr = '';

            $Fname = $_POST['FirstN'];
            $Lname = $_POST['LastN'];
            $name = prepare_input($Fname . ' ' . $Lname);
            $sex = $_POST['Sex'];
            $day = $_POST['Day'];
            $month = $_POST['Month'];
            $year = $_POST['Year'];
            $college = prepare_input($_POST['college']);
            $city = prepare_input($_POST['city']);
            $mobile = prepare_mobile($_POST['mobile']);
            $email = prepare_input($_POST['email']);

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
        }
        else {

            $out = true;
            $nameErr = '';
            $collegeErr = '';
            $cityErr = '';
            $mobileErr = 'Must be unique';
            $emailErr = '';
            $dateErr = '';

            $Fname = '';
            $Lname = '';
            $sex = 'M';
            $day = 10;
            $month = 7;
            $year = 1995;
            $college = '';
            $city = 'Patna';
            $mobile = '';
            $email = '';
        }
        if ($out) {
            ?>
            <form id = "UserInput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for = "FName">First Name : </label> <input id="FirstN" name = "FirstN" type="text"  value = "<?php echo $Fname; ?>"> <br>
                <label for = "LName"> Last Name : </label> <input id="LastN" name = "LastN" type="text"  value = "<?php echo $Lname; ?>"> <span class = "Err"> <?php echo $nameErr; ?></span><br>
                <label for = "Sex"> Sex : </label> 
                <select name = "Sex"> 
                    <option value = "M" <?php if ($sex == 'M') {
            echo 'selected';
        } ?>>Male</option>
                    <option value = "F" <?php if ($sex == 'F') {
            echo 'selected';
        } ?>>Female</option></select><br>
                <label for = "DOB">D.O.B.</label>
                DD <select name = "Day" type = "number"> 
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
                MM<select name = "Month"> 
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo '<option value = "' . $i . '" ';
                        if ($i == $month)
                            echo 'selected';

                        echo '>' . $i . '</option>';
                    }
                    ?>
                </select>
                YYYY <select name = "Year"> 
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
                <span class = "Err"> *<?php echo $dateErr; ?></span> <br>

                <label for = "College"> College : </label> <input id = "College" name = "college" type="text" value = "<?php echo $college; ?>"><span  class = "Err"> *<?php echo $collegeErr; ?></span><br>
                <label for = "City"> City : </label> <input id = "City" name = "city" type="text" value = "<?php echo $city; ?>"><span class = "Err"> *<?php echo $cityErr; ?></span><br>
                <label for = "Mobile"> Mobile : </label> +91<input id = "Mobile" name = "mobile" type="tel" value="<?php echo $mobile; ?>"><span class = "Err"> *<?php echo $mobileErr; ?></span><br>
                <label for = "Email"> Email : </label> <input id = "Email" name = "email" type="email" value = "<?php echo $email; ?>"><span class = "Err"> *<?php echo $emailErr; ?></span><br>
                <input type = "submit" value="Submit" class ="button" name="submit"> <input type = "reset" class ="button" value="Revert" name="revert">
            </form>
            <?php
        } else {
            require ("../dbcon.php");
            $Err = '';

            $sql = "SELECT ID FROM IDTable LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                $Err = 'Problem in Getting A new ID';
                mysqli_close($conn);
            } else {

                $row = mysqli_fetch_array($result);
                $id = $row['ID'];

                $sql2 = "INSERT INTO RegOut (name,college,city,sex,mobile,email,ID, dob) VALUES ('$name', '$college', '$city', '$sex', $mobile, '$email', $id, STR_TO_DATE('$day-$month-$year', '%d-%m-%Y'))";

                $result = mysqli_query($conn, $sql2);
                if (!$result) {
                    $Err = 'Problem in Creating new registration - Maybe mobile number already in use Error no : ' . mysqli_errno($conn);
                    mysqli_close($conn);
                } else {

                    $sql3 = "DELETE FROM IDTable WHERE id = $id";
                    $result = mysqli_query($conn, $sql3);
                    if (!$result) {
                        $Err = 'Problem in deleting id after use';
                        mysqli_close($conn);
                    } else {
                        $sql4 = "SELECT * FROM RegOut WHERE ID = '$id'";
                        $result = mysqli_query($conn, $sql4);
                        if (!$result) {
                            $Err = 'Problem in Displaying result for Anwesha ID = ' . $id;
                            mysqli_close($conn);
                        } else {
                            $row = mysqli_fetch_array($result);
                            $name = $row['name'];
                            $id = $row['ID'];
                            $college = $row['college'];
                            $city = $row['city'];
                            $dob = $row['dob'];
                            $sex = $row['sex'];
                            $mobile = $row['mobile'];
                            $email = $row['email'];
                            mysqli_close($conn);
                            ?>
                            <form id = "UserOutput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <label for = "Name"> Name : </label> <input name = "Name" type="text" size="30" value = "<?php echo $name; ?>" readonly="readonly"> <br>
                                <label for = "Sex"> Sex : </label> <input name = "Sex" type="text" size="30" value = "<?php echo $sex; ?>" readonly="readonly"> <br>
                                <label for = "DOB"> D.O.B. : </label><input name = "DOB" type="text" size="30" value = "<?php echo $dob; ?>" readonly="readonly"> <br>
                                <label for = "College"> College : </label> <input name = "College" type="text" size="50" value = "<?php echo $college . ', ' . $city; ?>" readonly="readonly"> <br>
                                <label for = "Mobile"> Mobile : </label> +91<input name = "Mobile" type="number" size="13" value = "<?php echo $mobile; ?>" readonly="readonly"> <br>
                                <label for = "Email"> Email : </label> <input name = "Email" type="text" size="30" value = "<?php echo $email; ?>" readonly="readonly"> <br>
                                <label for = "ID"> ID : </label> <input name = "ID" id = "ID" type="text" size="30" value = "<?php echo 'ANW' . $id; ?>" readonly="readonly"> <br>
                                <input type = "submit" class ="button" value="Back" name="restart">
                            </form>
                            <?php
                        }
                    }
                }
            }
            if ($Err) {
                ?>
                <form id = "UserOutput" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label class = "Err"> Error : </label> <?php echo $Err; ?> <br><br>
                    <input type = "submit" value="Back" name="restart">
                </form>
        <?php
    }
}
?>
    </body>
</html>