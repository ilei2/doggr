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
//echo "connection successful!";

$Child = $_POST["Child"];
$Exercise = $_POST["Exercise"];
$Adapt = $_POST["Adaptability"];
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

//echo "starting computation";
if ($conn){
  $query = "SELECT * FROM User WHERE Email = '{$Email}';";
  //echo "{$query}";
  if(!$result = $conn->query($query)){
    die("Error running query.");
  }
  if ($result->num_rows > 0){
    //UPDATE User Table
    $up = "UPDATE `User` SET `Weight` = '{$Weight}', `Child` = '{$Child}', `Exercise` = '{$Exercise}', `Adapt` = '{$Adapt}', `Apt` = '{$Apt}', `Groom` = '{$Groom}' WHERE `Email` = '{$Email}';";
    //echo "{$up}";
    $conn->query($up);
  }
  else{
    //INSERT into User Table
    $new = "INSERT INTO `User`(`Email`, `Weight`, `ID1`, `ID2`, `ID3`, `Child`, `Exercise`, `Adapt`, `Apt`, `Groom`) VALUES('{$Email}', '{$Weight}', '0', '0', '0', '{$Child}', '{$Exercise}', '{$Adapt}', '{$Apt}', '{$Groom}');";
    //echo "{$new}";
    $conn->query($new);
  }

  //Perform JOIN query between User and Dogs
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
  //Sort by Filter
  if ($Filter == "All"){
    $q .= " ORDER BY Child DESC, Exercise DESC, Adapt DESC, Apt DESC, Grooming DESC";
  }
  elseif ($Filter == "Child"){
    $q .= " ORDER BY Child DESC";
  }
  elseif ($Filter == "Exercise"){
    $q .= " ORDER BY Exercise DESC";
  }
  elseif ($Filter == "Adapt"){
    $q .= " ORDER BY Adapt DESC";
  }
  elseif ($Filter == "Apt"){
    $q .= " ORDER BY Apt DESC";
  }
  elseif ($Filter == "Groom"){
    $q .= " ORDER BY Grooming DESC";
  }								    
											        $q .= ";";
  #echo "<br>{$q}";
  $result = $conn->query($q);
  $count = 0;
  $data = "";
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

  $data .= "</body></html>";
  $conn->close();
}

echo '<html><head><link rel="stylesheet" type="text/css" href="summary.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>
<body>
<form action="connect.php" method="post">
<center>
  Child Friendly: <input type="range" name="Child" min="1" max="5" value=' . $Child . '>
  <br><br>
  Exercise Needs: <input type="range" name="Exercise" min="1" max="5" value=' . $Exercise . '>
  <br><br>
  Adaptability: <input type="range" name="Adaptability" min="1" max="5" value=' . $Adaptability . '>
  <br><br>
  <select id="Weight" name="Weight" value=' . $Weight . '>
    <option value="Weight" selected>Size</option>
    <option value="Small">Small</option>
    <option value="Medium">Medium</option>
    <option value="Large">Large</option>
  </select><br><br>
  Apartment Friendly: <input type="range" name="Apt" min="1" max="5" value=' . $Apt . '>
  <br><br>
  Grooming Needs: <input type="range" name="Grooming" min="1" max="5" value=' . $Groom . '>
  <br><br>

  Filter By: <select id="filter" name="filter" value="All">
	<option value="All" selected>All</option>
	<option value="Child">Child Friendliness</option>
	<option value="Exercise">Exercise Needs</option>
	<option value="Adapt">Adaptability</option>
	<option value="Apt">Apt Friendliness</option>
	<option value="Groom">Grooming Needs</option>
  </select>
  Filter: <input type="submit" name="Email" value=' . $Email . '>
</form>
</center>
</body>
</html>';
echo "<br><center><h1>Dog Breed Ranking:</h1></center>";
echo $data;
?>
