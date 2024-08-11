<?php
session_start();
include "dbconnect.php";

// Redirect to login page if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve user information from database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM manufacturer WHERE ManufacturerId = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch orders associated with the ManufacturerID
$sql = "SELECT * FROM orders WHERE ProductID IN (SELECT ProductID FROM product WHERE ManufacturerID = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Order History</h2>

<table>
    <thead>
        <tr>
        <th>OrderID</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Product ID</th>
            <th>Total Cost</th>
            <th>Distributor ID</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any orders
        if ($result->num_rows > 0) {
            // Output orders in tabular form
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['OrderID'] . "</td>";
                echo "<td>" . $row['Quantity'] . "</td>";
                echo "<td>" . $row['Category'] . "</td>";
                echo "<td>" . $row['ProductID'] . "</td>";
                echo "<td>" . $row['total_cost'] . "</td>";
                echo "<td>" . $row['DistributorID'] . "</td>";
                echo "</tr>";
            }
        } else {
            // No orders found for the ManufacturerID
            echo "<tr><td colspan='6'>No orders found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
