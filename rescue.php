<?php
$string = "<html><body>";

$url = getenv("JAWSDB_URL");
$dbparts = parse_url($url);
$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$name = $_POST["Name"];
$Pname = str_replace(" ", "-", $name);

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
  }
if ($conn){
  $query = "SELECT * FROM Dogs WHERE Name = '{$name}';";
  if(!$result = $conn->query($query)){
    die("Error running query.");
  }
  while($row = $result->fetch_assoc()){
    $image = $row['Image'];
  }

  $string .= shell_exec("python rescue.py {$Pname} {$image}");
  $string .= "</body></html>";
  $conn->close();
}

//$Pname = str_replace(" ", "-", $name);

//if ($conn)
//  $string .= shell_exec("python rescue.py {$Pname}");
//  $string .= "</body></html>";
?>


<html>
<head>
  <link rel="stylesheet" type="text/css" href="summary.css">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>
<body>

<?php
//echo "<h2>Testing font</h2>";
//echo "<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet'>";
echo "<center><h2>Information about {$name}</h2></center><br>";
echo "<center>";
echo $string;
echo "</center>";
?>

</body>
</html>
