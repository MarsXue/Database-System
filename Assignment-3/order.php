<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Orders</h1>

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

$query = "SELECT * FROM Spatula WHERE QuantityInStock > 0";
$result = mysqli_query($con, $query);

echo "<form action='order_result.php' method='post'>";

echo "Customer Details: <br>";
echo "<textarea name='CustomerDetails' rows='8' cols='48'></textarea>";
echo "<br><br>";

echo "Responsible Staff Member: ";
echo "<input type='text' name='ResponsibleStaffMember'>";
echo "<br><br>";

echo "<table border='1'>";
echo "<tr>";
echo "<th>SpatulaID</th>";
echo "<th>Name</th>";
echo "<th>Type</th>";
echo "<th>Size</th>";
echo "<th>Colour</th>";
echo "<th>Price</th>";
echo "<th>Quantity currently in stock</th>";
echo "<th>Order Quantity</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result)) {

    echo "<tr>";
    echo "<td>" . $row['idSpatula'] . "</td>";
    echo "<td>" . $row['ProductName'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Size'] . "</td>";
    echo "<td>" . $row['Colour'] . "</td>";
    echo "<td>" . $row['Price'] . "</td>";
    echo "<td>" . $row['QuantityInStock'] . "</td>";
    echo "<td><input type='text' name={$row['idSpatula']} size='17' value='0'></td>";
    echo "</tr>";

}

echo "</table>";
echo "<br>";
echo "<input type='submit' value='Submit'>";
echo "</form>";

mysqli_close($con);
?>

</body>
</html>