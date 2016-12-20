<?php
$one = $_POST["one"];
$two = $_POST["two"];
$three = $_POST["three"];
$Email = $_POST["email"];

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


if ($conn){
  $query = "SELECT * FROM User WHERE Email = '{$Email}';";

  if(!$result = $conn->query($query)){
    die("Error running query.");

  }

  if($result->num_rows > 0){
    $up = "UPDATE `User` SET `ID1`= '{$one}', `ID2` = '{$two}', `ID3` = '{$three}' WHERE `Email` = '{$Email}';";
    //echo "Update query: " . $up;  
    echo "<center>Added!</center>";
  }

  else{
    echo "User Email not found, please try again.";
  }
  $conn->close();
}

?>

