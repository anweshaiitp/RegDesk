<?php

$nameList = array("abhijeet agnihotri",
"Aditya Jhalani",
"Aditya Gupta",
"Akash Bodhijani",
"Akhil Shukla",
"ALOK KUMAR",
"Amolika Sinha",
"ANUBHAV JOSHI",
"Arindam Banerjee",
"Arpit Bansal",
"Ashutosh Agarwal",
"ayushi priyam", 
"B.Rama Krishna",
"Haren Chelle",
"Chirag Jain",
"Deep Thakkar",
"Don Dennis",
"Sanjeevini",
"K.Sree Harsha",
"Harshit",
"A R JITHIN",
"Karan Jakhar",
"M.Karthik Kumar",
"Kumar Gaurav",
"Manu Kumar Sharma",
"Manvee",
"Mayank Garg",
"Naveen Kumar M G",
"NITESH KUMAR",
"Pranav Kulkarni",
"RAJAT GOYAL",
"Rakshit Bansal",
"Ravneet Kaur",
"K. Rishita",
"Ritobroto Maitra",
"RONAK JAIN",
"Md Shiyas Pulloonichallil",
"Sourabh Patil",
"Tanuj Sharma",
"Y.Avaneesh");

$unameList = array("abhijeet.me13",
"aditya.ce13",
"adityagupta.cs13",
"akash.ee13",
"akhil.ee12",
"alok.me13",
"amolika.ce13",
"anubhav.cs12",
"arindam.cs13",
"arpitbansal.me13",
"ashutosh.ee12",
"ayushi.ee13", 
"bathina.ee13",
"chelle.ee12", 
"chirag.me13",
"deep.me12",
"don.cs13",
"ganni.cs13",
"harsha.me12",
"harshit.cs13",
"jithin.me12",
"karan.me13",
"karthik.ee12",
"kumargaurav.ce13",
"manu.cs13",
"manvee.cs12",
"mayank.ee13",
"naveen.cs13",
"nitesh.me13",
"pranav.me12",
"rajat.ee12",
"rakshit.ee13",
"ravneet.ch13",
"rishita.cs12",
"ritobroto.ee13",
"ronak.ce13",
"shiyas.ee13",
"sourabh.me12",
"tanuj.ee13",
"yembadi.ee13");

$passwordList = array ("8292346573",
"8292346960",
"8292337923",
"8292349038",
"8084255325",
"9709348974",
"9472472533",
"8084257108",
"9472472543",
"8292338681",
"9453012060",
"7543033449",
"8292347023",
"8084340154",
"8292344734",
"8084256641",
"8292345127",
"9631519800",
"9472458687",
"7759855132",
"7677714415",
"9472472550",
"8084336021",
"9534089367",
"8292340331",
"9905057654",
"8292340330",
"9472472499",
"9798861799",
"8084337858",
"9472457145",
"7277634406",
"8292347037",
"9472457615",
"7762990626",
"9801239620");
$passwordList[] = "82923105656";

//INSERT INTO `Anwesha`.`UserData` (`UserName`, `Password`, `Name`, `ID`) VALUES ('adityagupta.cs13', '', 'Aditya Gupta', '333');

require("../dbcon.php");
$conn = mysqli_connect(SERVER_ADDRESS,USER_NAME,PASSWORD,DATABASE);
for($i = 0 ; $i < count($passwordList); $i++){
	$sql = "INSERT INTO `Anwesha`.`UserData` (`UserName`, `Password`, `Name`) VALUES ('$unameList[$i]', sha('$passwordList[$i]'), '$nameList[$i]')";
	echo $sql.'<br/>';
	mysqli_query($conn, $sql);
}