<?php
session_start();
include "dbconnect.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve DistributorID from session
$DistributorID = $_SESSION['user_id'];

// Fetch orders associated with the DistributorID
$sql = "SELECT * FROM orders WHERE DistributorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $DistributorID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Order History</h2>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
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
            // No orders found for the DistributorID
            echo "<tr><td colspan='6'>No orders found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
