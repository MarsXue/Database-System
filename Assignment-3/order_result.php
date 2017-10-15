<html>
<head><title>Spatula Town</title></head>
<body>
<h1>Orders Result</h1>

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

mysqli_query($con, "Start Transaction");
$query = "";
$keyarray = array();
$valarray = array();
$count = 0;
$ordered = FALSE;
foreach ($_POST AS $key=>$value) {

    if ($key == 'CustomerDetails') {
        if (!$value) {
            mysqli_query($con, "Rollback");
            die ("Customer Detail is required! Please double check the order!");
        }
        $cdval = $value;
    } elseif ($key == 'ResponsibleStaffMember') {
        if ($value) {
            $stmt = mysqli_stmt_init($con);
            $query = "INSERT INTO `Order` VALUES (DEFAULT, NOW(), ?, ?);";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ss', $value, $cdval);
            mysqli_stmt_execute($stmt);

            $order = mysqli_insert_id($con);
            $query = "";
            $rsmval = $value;
        } else {
            mysqli_query($con, "Rollback");
            die ("Responsible Staff Member is required! Please double check the order!");
        }
    } else {
        $query = "SELECT QuantityInStock FROM `Spatula` WHERE idSpatula = ?";
        $stmt = mysqli_stmt_init($con);
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $key);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        while(mysqli_stmt_fetch($stmt)) {
            $qis = $result;
        }

        if ($value > 0 && ($qis-$value) >= 0) {
        	$ordered = TRUE;
            $query = "UPDATE `Spatula` SET QuantityInStock = (QuantityInStock - ?) WHERE idSpatula = ?";
            $stmt = mysqli_stmt_init($con);
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'is', $value, $key);
            mysqli_stmt_execute($stmt);

            $query = "INSERT INTO `OrderLineItem` VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($con);
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'sii', $key, $order, $value);
            mysqli_stmt_execute($stmt);

            $keyarray[] = $key;
            $valarray[] = $value;
            $count++;
 
        } else if ($qis-$value < 0) {
            mysqli_query($con, "Rollback");
            die ("There is no enough quantity in stock! Please double check the order!");
        }
    }
}

if ($ordered == FALSE) {
    mysqli_query($con, "Rollback");
    die ("Order Quantity is incorrect! Pleas double check the order!");
}

mysqli_query($con, "Commit");

echo "<h2>Order is successful!</h2>";
echo "<h3>Customer Details: </h3>";
echo "<p>" . $cdval . "</p>";
echo "<h3>Responsible Staff Member: </h3>";
echo "<p>" . $rsmval . "</p>";
echo "<h3>Order Number: </h3>";
echo "<p>" . $order . "</p>";

echo "<table border='1'>";
echo "<tr>";
echo "<th>SpatulaID</th>";
echo "<th>Order Quantity</th>";
echo "</tr>";

for ($i = 0; $i < $count; $i++) {
    echo "<tr>";
    echo "<td>" . $keyarray[$i] . "</td>";
    echo "<td>" . $valarray[$i] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

</body>
</html>