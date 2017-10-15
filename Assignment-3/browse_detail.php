<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Product Details</h1>

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

$query = "SELECT * FROM `Spatula` WHERE ProductName = ?";
$stmt = mysqli_stmt_init($con);
$stmt = mysqli_prepare($con, $query);

$keyword = $_GET['ProductName'];
mysqli_stmt_bind_param($stmt, 's', $keyword);

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $idSpatula, $ProductName, $Type, $Size, $Colour, $Price, $QuantityInStock);

echo "<table border='1'>";
echo "<tr>";
echo "<th>Spatula ID</th>";
echo "<th>Name</th>";
echo "<th>Type</th>";
echo "<th>Size</th>";
echo "<th>Colour</th>";
echo "<th>Price</th>";
echo "<th>Quantity In Stock</th>";
echo "</tr>";

while(mysqli_stmt_fetch($stmt)) {

    echo "<tr>";
    echo "<td>" . $idSpatula . "</td>";
    echo "<td>" . $ProductName . "</td>";
    echo "<td>" . $Type . "</td>";
    echo "<td>" . $Size . "</td>";
    echo "<td>" . $Colour . "</td>";
    echo "<td>" . $Price . "</td>";
    echo "<td>" . $QuantityInStock . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

</body>
</html>