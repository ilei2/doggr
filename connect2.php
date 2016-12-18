<?php
$msql_host = "o61qijqeuqnj9chh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$mysql_user = "ci2fcjbx9tpzqn4y";
$password = "kozr5qksyy4oy3wm";
$dbname = "obj143qd1hh6c964";

#$conn = new PDO("mysql:host={$mysql_host};dbname={$dbname};charsest=utf8mb4","{$mysql_user}", "{$password}");

$conn = mysql_connect($mysql_host, $mysql_user, $password, $dbname);

echo "Testing connect2.php";

#$conn = null;

?>
