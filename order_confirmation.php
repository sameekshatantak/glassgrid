<?php
session_start();

// Check if the required session variables are set
if(!empty($_GET['ProductID']) && !empty($_GET['Category']) && !empty($_GET['Price'])) {
    // Retrieve product details from URL parameters
    $ProductID = $_GET['ProductID'];
    $Category = $_GET['Category'];
    $Price = $_GET['Price'];
    $_SESSION['ProductID'] = $ProductID;
    $_SESSION['Category'] = $Category;
    $_SESSION['Price'] = $Price;
    
    // Ensure $Price is converted to float before performing calculations
    $Price = floatval($Price);

    // Fetch minimum order value from the database based on ProductID
    include 'dbconnect.php';
    $sql = "SELECT Min_Order_Value FROM product WHERE ProductID = $ProductID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Minimum order value found, fetch it
        $row = $result->fetch_assoc();
        $Min_Order_Value = $row['Min_Order_Value'];

        // Redirect to the form with hidden inputs and a quantity input
        echo '
        <div style="text-align: center;"> <!-- Center align the block -->
            <form action="order_confirmation.php" method="GET">
                <input type="hidden" name="ProductID" value="'.$ProductID.'">
                <input type="hidden" name="Category" value="'.$Category.'">
                <input type="hidden" name="Price" value="'.$Price.'">
                <div style="font-size: 18px;"> <!-- Increase font size -->
                    Quantity: <input type="number" name="Quantity" value="1" min="1"><br>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
        ';

        // Check if Quantity is set after form submission
        if(isset($_GET['Quantity'])) {
            $Quantity = $_GET['Quantity'];

            // Ensure $Quantity is converted to integer
            $Quantity = intval($Quantity);

            // Check if quantity is less than the minimum order value
            if ($Quantity < $Min_Order_Value) {
                echo "The minimum order value of this product is: " . $Min_Order_Value;
                exit();
            }

            // Calculate total cost
            $total_cost = $Quantity * $Price;

            // Fetch product name from database based on ProductID
            $sql = "SELECT ProductName FROM product WHERE ProductID = $ProductID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Product found, fetch product name
                $row = $result->fetch_assoc();
                $ProductName = $row['ProductName'];

                // Store data in session for display on ordertable.php
                $_SESSION['order_details'] = array(
                    'ProductName' => $ProductName,
                    'Category' => $Category,
                    'Price' => $Price,
                    'Quantity' => $Quantity,
                    'TotalCost' => $total_cost
                );

                // Redirect to ordertable.php
                header('Location: ordertable.php');
                exit();
            } else {
                // Product not found
                echo "Error: Product not found.";
                exit();
            }
        }
    } else {
        // Minimum order value not found
        echo "Error: Minimum order value not found for the product.";
        exit();
    }

    // Close database connection
    $conn->close();
} else {
    // Handle case where parameters are missing or empty
    echo "Error: Product details are missing from session.";
}
?>
