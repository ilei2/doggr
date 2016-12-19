<?php
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
echo "connection successful!";

$Child = $_POST["Child"];
$Exercise = $_POST["Exercise"];
$Adaptability = $_POST["Adaptability"];
$Weight = $_POST["Weight"];
$Apt = $_POST["Apt"];
$Groom = $_POST["Grooming"];
$Filter = $_POST["filter"];
$Email = $_POST["Email"];

if ($Weight == "Weight"){
  $Weight = "Size";
}


$data = "<html><head>
<link rel='stylesheet' type='text/css' href='summary.css'>
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet'></head><body><center><h2>Filtered By {$Filter}</h2></center>";
echo $data;
echo "<body bgcolor=\"#EDE1D1\">";

echo "starting computation";
if ($conn){
  $query = "SELECT * FROM User WHERE Email = '{$Email}';";
  echo "{$query}";
  if(!$result = $conn->query($query)){
    die("Error running query.");
  }
  echo "total results: " . $result->num_rows;
}

?>
