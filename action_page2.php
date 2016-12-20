<?php  
$Pname = $_POST["Name"];
$Pcity = $_POST["City"];

if ($Pcity == "" or $Pcity == "Enter City") {
	$Pcity = "Champaign";
}
$name = str_replace(" ", "-", $Pname);

$string = "<html><body>";
$string .= "<link rel='stylesheet' type='text/css' href='summary.css'>";
$string .= shell_exec("python rec.py {$name} {$Pcity}");
$string .= "</body></html>";

echo "<center><h2>Information about {$Pname} Adoptions</h2></center>";
//echo "<center><h3>Sorted By Distance From {$Pcity} </h3></center><br>";
echo "<center><h3>Enter Top Three Faves</h3></center><br>";
echo '<center><form action="add.php" method="POST">
        1st ID Pick: <input type="text" name="one" value="0"><br>
        2nd ID Pick: <input type="text" name="two" value="0"><br>
	3rd ID Pick: <input type="text" name="three" value="0"><br>
	Email: <input type="text" name="email"><br> 
	<input type="submit">
        </form></center><center>';
echo $string;
echo "</center>";
?>
