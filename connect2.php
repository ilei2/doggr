<?php
/*$mysql_host = "o61qijqeuqnj9chh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$mysql_user = "ci2fcjbx9tpzqn4y";
$password = "kozr5qksyy4oy3wm";
$dbname = "obj143qd1hh6c964";

$conn = mysqli_connect($mysql_host, $mysql_user, $password, $dbname);
#$conn = mysql_connect($mysql_host, $mysql_user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connection was successfully established!";

#echo "Testing connect2.php";
#$conn = null;
*/

$url = getenv('mysql://ci2fcjbx9tpzqn4y:kozr5qksyy4oy3wm@o61qijqeuqnj9chh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/obj143qd1hh6c964');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

?>
