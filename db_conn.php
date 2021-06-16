<?php  

$sname = "localhost";
$uname = "superadmin";
$password = "12345";
$db_name = "restaurant";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}