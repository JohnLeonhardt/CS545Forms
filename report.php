<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>A Runner Report</title>
    <link rel="stylesheet" href="report.css">
    
</head>
<body>
    <h1>Runner Report</h1>
<?php
$server = 'opatija.sdsu.edu:3306';
$user = 'jadrn026';
$password = 'tornado';
$database = 'jadrn026';

if(!($db = mysqli_connect($server, $user, $password, $database)))
	echo "ERROR in connection ".mysqli_error($db);
else {
	$sql = "select * from person order by lname;";
	$result = mysqli_query($db, $sql);
	if(!result)
		echo "ERROR in query".mysqli_error($db);
		echo "<table>\n";
		echo "<tr><td>Image name</td><td>First name</td><td>Last name</td><td>Address</td><td>City</td><td>State</td><td>Zipcode</td><td>Area</td><td>Prefix</td><td>Phone</td><td>Date of Birth</td><td>Email</td></tr>";
	while($row=mysqli_fetch_row($result)) {
		echo "<tr>";
		foreach(array_slice($row,1) as $item)
			echo "<td>$item</td>";
		echo "</tr>\n";
		}
	mysqli_close($db);
	}
?>
</table>
</body>
</html>