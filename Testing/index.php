<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'to_do_website';

	$con2 = mysqli_connect("localhost","root","");

	mysqli_select_db($con2,$database) or die( "Unable to select database");
	$na = 'joa@jimmiandersen.dk';

	$ideas = mysqli_query($con2,"SELECT id FROM autorised WHERE email = '.$na.'")or die(mysqli_error($con2));

if(mysql_num_rows($ideas) > 0 )
{
 while ($row = mysql_fetch_array ($ideas)) 
 {
echo "<br /> ID: " .$row['ID']. "<br />";
 }
	
}
else{
	echo "here";
}
	;
?>