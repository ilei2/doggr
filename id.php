<?php
$string = "<html><body>";
$string .= "<link rel='stylesheet' type='text/css' href='summary.css'>";
$string .= "<center>";

$id = $_POST["Name"];
$Pname = str_replace(" ", "-", $id);
$final = str_replace("_", ":", $Pname);

$url = getenv('JAWSDB_URL');
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
  $string .= shell_exec("python getID.py {$final}");
  $string .= "</center>";
  $string .= "</body></html>";
?>
<html>
<head>
<?php
echo "<h2><center>ID: {$final}</center></h2><br>";
echo $string;
?>
</head>
</html>
