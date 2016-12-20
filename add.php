<?php

$one = $_POST["one"];
$two = $_POST["two"];
$three = $_POST["three"];
/*
$email = $_POST["email"];
#echo $one;
$mysql_host = '127.0.0.1';
$mysql_user = 'root';
$mysql_password = 'kija';
$dbname = 'test';
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password, $dbname);

$url = getenv("JAWSDB_URL");
$dbparts = parse_url($url);
$hostname = $dbparts['host'];
$username = $dbpars['user'];
$password = $dbpars['pass'];
$database = ltrim($dbpars['path'],'/');
*/

$url = getenv("JAWSDB_URL");
$dbparts = parse_url($url);
$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

if ($conn)
  $check = "SELECT * FROM `User` WHERE `Email` = '{$Email}'";
  echo "Check query: " . $check;
  $up = "UPDATE `User` SET `ID1`= '{$one}', `ID2` = '{$two}', `ID3` = '{$three}' WHERE `Email` = '{$Email}';";
  echo "Update query: " . $up;  
  echo "Added!";
  $conn->close();

?>

<html>
<head>
</head>
</html>
