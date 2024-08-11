<?php
include "dbconnect.php";
session_start();

// Check if order details are set in session
if(isset($_SESSION['order_details'])) {
    $order_details = $_SESSION['order_details'];
} else {
    echo "Error: Order details are missing from session.";
    exit();
}

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO `orders` (Quantity, Category, ProductID, ManufacturerID, total_cost) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $Quantity, $Category, $ProductID, $ManufacturerID, $total_cost);

    // Execute the statement
    if ($stmt->execute()) {
        $showAlert = true;
    } else {
        $showError = true;
    }

    // Close statement
    $stmt->close();


// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Order Details</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    th {
        background-color: #f2f2f2;
    }
    .btn-place-order {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-place-order:hover {
            background-color: #0056b3;
        }
</style>
</head>
<body>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $order_details['ProductName']; ?></td>
                            <td><?php echo $order_details['Category']; ?></td>
                            <td>$<?php echo number_format($order_details['Price'], 2); ?></td>
                            <td><?php echo $order_details['Quantity']; ?></td>
                            <td>$<?php echo number_format($order_details['TotalCost'], 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button onclick="placeOrder()">Place Order</button>

<script>
    function placeOrder() {
        alert("Order placed successfully");
    }
</script>

</body>
</html>
