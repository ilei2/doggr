<?php

$mysql_host = '127.0.0.1';
$mysql_user = 'root';
$mysql_password = 'kija';
$dbname = 'test';
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password, $dbname);
//$name = $_POST["Name"];
//$name = str_replace(" ", ",", $name);
$Child = $_POST["Child"];
$Exercise = $_POST["Exercise"];
$Adaptability = $_POST["Adaptability"];
$Weight = $_POST["Weight"];
$Apt = $_POST["Apt"];
$Groom = $_POST["Grooming"];
$Filter = $_POST["filter"];
#$Coat = $_POST["Coat"];
#$Color = $_POST["Colors"];
#$Age = $_POST["Age"];
#$Kind = $_POST["Kinds"];
$Email = $_POST["Email"];
//$email2 = (string) $Email;

$f = fopen("dogs.txt", "w");
$data = "<html><head>
<link rel='stylesheet' type='text/css' href='summary.css'>
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet'></head><body>";
echo $data;
echo "<center><h2>Filtered By {$Filter}</h2><center>";
/*
if ($conn)
  $data .= shell_exec("python connect.py {$name} {$Weight} {$Coat} {$Color} {$Age} {$Kind} {$Email}");*/
  //$f = fopen("dogs.txt", "w") or die("Unable to Open File!");

/*
$value = 1;
  if ($value > 0)
    echo "value: {$value}";
*/

#echo "{$Email}";

if ($conn)
  //$data .= shell_exec("python update.py {$Email}");
    $value = shell_exec("python c2.py {$Email}"); #blah
    if ($value == "1" or $value > 0){
      $str = "1";
    } else{
      $str = "0";
    }

    //DETERMINES INSERT OR UPDATE BELOW
    $data .= shell_exec("python test.py {$Email} {$Child} {$Exercise} {$Adaptability} {$Weight} {$Apt} {$Groom} {$Filter} {$str}");

    //JOIN QUERY BELOW
    $data .= shell_exec("python j.py {$Email} {$Child} {$Exercise} {$Adaptability} {$Weight} {$Apt} {$Groom} {$Filter}");


    $data .= shell_exec("python c3.py {$Email} {$Child} {$Exercise} {$Adaptability} {$Weight} {$Apt} {$Groom} {$Filter}");
$data .= "</body></html>";
echo '<html><head><link rel="stylesheet" type="text/css" href="summary.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>
<body>
<form action="connect.php" method="post">
<center>    
    Child Friendly: <input type="range" name="Child" min="1" max="5" value=' . $Child . '><br><br>
 Exercise Needs: <input type="range" name="Exercise" min="1" max="5" value=' . $Exercise . '><br><br>
 Adaptability: <input type="range" name="Adaptability" min="1" max="5" value=' . $Adaptability . '><br><br>
 <select id="Weight" name="Weight" value=' . $Weight . '>
    <option value="Weight" selected>Size</option>
    <option value="Small">Small</option>
    <option value="Medium">Medium</option>
    <option value="Large">Large</option>
  </select><br><br>
 Apartment Friendly: <input type="range" name="Apt" min="1" max="5" value=' . $Apt . '><br><br>
 Grooming Needs: <input type="range" name="Grooming" min="1" max="5" value=' . $Groom . '><br><br>


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
</center></body></html>
'; 
echo $data;
#fwrite($f, $data);
#fclose($f);
  //$file = 'dogs.txt';
  //file_put_contents($file,$data);
  //passthru("python connect.py {$name} {$Weight} {$Coat} {$Color} {$Age} {$Kind}");
  //header('Location: dogs.html');
  //exit;
?>
