<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Browse</h1>

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

echo "<form action='browse_result.php' method='get'>";
echo "Spatula name: <input type='text' name='ProductName'><br><br>";

echo "<select name='Type'>";
echo "<option selected='selected'>--select type--</option>";
echo "<option value='Food'>Food</option>";
echo "<option value='Drugs'>Drugs</option>";
echo "<option value='Paints'>Paints</option>";
echo "<option value='Plaster'>Plaster</option>";
echo "</select>";
echo "<br><br>";

echo "Size: <input type='text' name='Size'><br><br>";
echo "Colour: <input type='text' name='Colour'><br><br>";
echo "Price(\$AU): <input type='text' name='Price'><br><br>";

echo "<input type='submit' value='Search...'>";
echo "</form>";

mysqli_close($con);
?>

</body>
</html>