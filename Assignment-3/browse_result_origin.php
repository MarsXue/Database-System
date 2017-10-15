<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Search Result</h1>

<?php

$server = "info20003db.eng.unimelb.edu.au";
$username = "wenqingx";
$password = "813044";
$dbname = "wenqingx";

// Create connection
$con = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
	echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	exit();
}

$query = "SELECT ProductName FROM Spatula";

$check = 0;
$attribute = array('ProductName', 'Type', 'Size', 'Colour', 'Price');

foreach ($attribute as $value) {
	if (!empty($_GET[$value]) && $_GET[$value]!='--select type--') {
		if ($check != 0) {
			$query = $query . " AND " . $value . " = '" . $_GET[$value] . "'";
		} else {
			$query = $query . " WHERE " . $value . " = '" . $_GET[$value] . "'";
			$check = 1;
		}
	}
}

$result = mysqli_query($con, $query);

echo "<table border='1'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>More Info</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result)) {

	echo "<tr>";
	echo "<td>" . $row['ProductName'] . "</td>";
	echo "<td><a href='browse_detail.php?ProductName=" . $row['ProductName'] . "'>click here!</a></td>";
	echo "</tr>";

}
echo "</table>";

mysqli_close($con);
?>

</body>
</html>