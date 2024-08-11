<?php
session_start();
include "dbconnect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Quantity = $_POST['Quantity'];
    $Category = $_POST['Category'];
    $ProductID = $_POST['ProductID'];
    $TotalCost = $_POST['total_cost'];
    
    // Retrieve DistributorID from session
    $DistributorID = $_SESSION['user_id'];
    
    // Insert data into the orders table
    $sql = "INSERT INTO orders (Quantity, Category, ProductID, total_cost, DistributorID) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isiii", $Quantity, $Category, $ProductID, $TotalCost, $DistributorID);
        if ($stmt->execute()) {
            // Order placed successfully
            $orderConfirmation = "Your order has been successfully placed!";
            // Fetch the most recent order for display
            $sql_recent_order = "SELECT * FROM orders WHERE DistributorID = ? ORDER BY OrderID DESC LIMIT 1";
            $stmt_recent_order = $conn->prepare($sql_recent_order);
            $stmt_recent_order->bind_param("i", $DistributorID);
            $stmt_recent_order->execute();
            $result_recent_order = $stmt_recent_order->get_result();
        } else {
            // Error in placing order
            $orderConfirmation = "Error placing order: " . $stmt->error;
        }
    } else {
        // Error in preparing SQL statement
        $orderConfirmation = "Error preparing statement: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (isset($orderConfirmation)) : ?>
        <?php if (strpos($orderConfirmation, 'successfully') !== false) : ?>
            <div class="success-message">
                <h2><?php echo $orderConfirmation; ?></h2>
            </div>
        <?php else : ?>
            <div class="error-message">
                <h2><?php echo $orderConfirmation; ?></h2>
            </div>
        <?php endif; ?>

        <?php if (isset($result_recent_order) && $result_recent_order->num_rows > 0) : ?>
            <h3>Recent Order Details:</h3>
            <table>
                <thead>
                    <tr>
                        <th>OrderID</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>ProductID</th>
                        <th>Total Cost</th>
                        <th>DistributorID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_recent_order->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                            <td><?php echo $row['Category']; ?></td>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['total_cost']; ?></td>
                            <td><?php echo $row['DistributorID']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
