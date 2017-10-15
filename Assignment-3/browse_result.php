<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Search Results</h1>

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

$check = 0;
$attribute = array('ProductName', 'Type', 'Size', 'Colour', 'Price');

$record = array();
$query = "SELECT ProductName FROM `Spatula`";

foreach ($attribute as $value) {
	if (!empty($_GET[$value]) && $_GET[$value]!='--select type--') {
		if ($check != 0) {
			$query = $query . " AND " . $value . " = ?";
			if ($value == 'Price') {
				$string = $string . 'sd';
			} else {
				$string = $string . 'ss';
			}
			$record[] = $_GET[$value];
		} else {
			$query = $query . " WHERE " . $value . " = ?";
			$check = 1;
			if ($value == 'Price') {
				$string = 'sd';
			} else {
				$string = 'ss';
			}
			$record[] = $_GET[$value];
		}
	}
}

$stmt = mysqli_stmt_init($con);
$stmt = mysqli_prepare($con, $query);

call_user_func_array("mysqli_stmt_bind_param", array_merge(array($stmt), array($string), $record));
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $result);

echo "<table border='1'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>More Info</th>";
echo "</tr>";

while(mysqli_stmt_fetch($stmt)) {
	echo "<tr>";
	echo "<td>" . $ProductName . "</td>";
	echo "<td><a href='browse_detail.php?ProductName=" . $ProductName . "'>click here!</a></td>";
	echo "</tr>";
}
echo "</table>";

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

</body>
</html>