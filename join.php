<?php
$Email = $_POST["Email"];

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

echo "<html><body>";
echo "<link rel='stylesheet' type='text/css' href='summary.css'>";
echo "<body bgcolor=\"#EDE1D1\">";


if ($conn){ 
  $user = "SELECT * FROM User WHERE Email = '{$Email}';";
  //echo $user;
  if(!$result = $conn->query($user)){
    die("Error running query.");
  }
  $row = $result->fetch_assoc();
  $Size = $row['Weight'];
  $Child = $row['Child'];
  $Exercise = $row['Exercise'];
  $Adapt = $row['Adapt'];
  $Apt = $row['Apt'];
  $Groom = $row['Groom'];
  $ID1 = $row['ID1'];
  $ID2 = $row['ID2'];
  $ID3 = $row['ID3'];  
  $D1 = '0';
  $D2 = '0';
  
  if ($Size == "Small"){
    $D1 = '0';
    $D2 = '20';
  }
  elseif ($Size == "Medium"){
    $D1 = '20';
    $D2 = '60';
  }
  elseif ($Size == "Large"){
    $D1 = '60';
    $D2 = '200';
  }
  else{
    $D1 = '0';
    $D2 = '200';
  }
  $child = (int) $Child;
  $exercise = (int) $Exercise;
  $adapt = (int) $Adapt;
  $apt = (int) $Apt;
  $groom = (int) $Groom;
  if ($child > 0){
    $child--;
    $Child = (string) $child;
  }
  if ($exercise < 5){
    $exercise++;
    $Exercise = (string) $exercise;
  }
  if ($adapt > 0){
    $adapt--;
    $Adapt = (string) $adapt;
  }
  if ($apt > 0){
    $apt--;
    $Apt = (string) $apt;
  }
  if ($groom < 5){
    $groom++;
    $Groom = (string) $groom;
  }
  $q = "SELECT * FROM Dogs WHERE Male_weight >= {$D1} AND Male_weight <= {$D2} AND Child >= {$Child} AND Exercise <= {$Exercise} AND Adapt >= {$Adapt} AND Apt >= {$Apt} AND Grooming <= {$Groom}";
  $q .= " ORDER BY Child DESC, Exercise DESC, Adapt DESC, Apt DESC, Grooming DESC;";
  //echo $q;
  $result = $conn->query($q);
  $count = 0;
  $data = "<center><h2>Your Favorited Ids:</h2></center>";
  if ($ID1 != "" and $ID1 != "0"){
    $data .= '<center><form action="id.php" method="POST"><input type="submit" name="Name" value="' . $ID1 . '"/></form></center>';
  }
  if ($ID2 != "" and $ID2 != "0"){
    $data .= '<center><form action="id.php" method="POST"><input type="submit" name="Name" value="' . $ID2 . '"/></form></center>';
  }
  if ($ID3 != "" and $ID3 != "0"){
    $data .= '<center><form action="id.php" method="POST"><input type="submit" name="Name" value="' . $ID3 . '"/></form></center>';
  }

  while($row = $result->fetch_assoc()){
    $data .= "<center><h2>" . (string) ++$count . "</h2><br></center>";
    $data .= '<center><form action="rescue.php" method="POST">Breed Info: <input type="submit" name="Name" value="' . $row['Name'] . '"/></form></center><center><form action="action_page2.php" method="POST">Adopt? <input type="text" name="City" value="Enter City"><input type="submit" name="Name" value="'. $row['Name'] . '"/></form></center>';
    $data .= "<center><b>" . $row['Name'] . "</b><br>";
    $data .= "Weight: " . $row['Male_weight'] . "<br>";
    $data .=  "Color: " . $row['Color'] . "<br>";
    $data .=  "Life Span: " . $row['Age'] . "<br>";
    $data .=  "Child-friendly: " . $row['Child'] . "<br>";
    $data .=  "Exercise Needs: " . $row['Exercise'] . "<br>";
    $data .=  "Adaptability: " . $row['Adapt'] . "<br>";
    $data .=  "Grooming Needs: " . $row['Grooming'] . "<br>";
    $data .=  "Apartment-friendly: " . $row['Apt'] . "<br>";
    $data .=  "<br><br>";
  }
  $conn->close();
}

echo $data;
echo "</body></html>";





//$data = "<html><body>";
//$data .= "<link rel='stylesheet' type='text/css' href='summary.css'>";
#echo $data;
/*
if ($conn)
  $data .= shell_exec("python join2.py {$Email}");
  //$f = fopen("dogs.txt", "w") or die("Unable to Open File!");
  $data .= "</body></html>";
echo $data;
*/
?>
