<?php
include "dbconnect.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
    $search_query = $_GET['query'];
    
    // Initialize variables for search results
    $product_results = [];
    $manufacturer_results = [];
    $distributor_results = [];
    
    // Parse the search query to extract relevant information
    $keywords = explode(',', $search_query);
    
    // Construct SQL queries for each search type
    $product_sql = "SELECT * FROM product WHERE ProductName LIKE ? OR Category LIKE ?";
    $manufacturer_sql = "SELECT * FROM manufacturer WHERE CompanyName LIKE ?";
    $distributor_sql = "SELECT * FROM distributor WHERE CompanyName LIKE ?";
    
    // Prepare statements
    $product_stmt = $conn->prepare($product_sql);
    $manufacturer_stmt = $conn->prepare($manufacturer_sql);
    $distributor_stmt = $conn->prepare($distributor_sql);
    
    // Bind parameters for product search
    $product_keyword = "%$search_query%";
    $product_stmt->bind_param("ss", $product_keyword, $product_keyword);
    
    // Execute product search
    $product_stmt->execute();
    $product_result = $product_stmt->get_result();
    
    // Bind parameters for manufacturer search
    $manufacturer_keyword = "%$search_query%";
    $manufacturer_stmt->bind_param("s", $manufacturer_keyword);
    
    // Execute manufacturer search
    $manufacturer_stmt->execute();
    $manufacturer_result = $manufacturer_stmt->get_result();
    
    // Bind parameters for distributor search
    $distributor_keyword = "%$search_query%";
    $distributor_stmt->bind_param("s", $distributor_keyword);
    
    // Execute distributor search
    $distributor_stmt->execute();
    $distributor_result = $distributor_stmt->get_result();
    
    // Display search results
    echo "<div class='container'>";
    
    // Display product search results
    if ($product_result->num_rows > 0) {
        echo "<h2>Product Search Results:</h2>";
        while ($row = $product_result->fetch_assoc()) {
            echo "<p>Product Name: " . $row['ProductName'] . "<br>";
            echo "Category: " . $row['Category'] . "<br>";
            echo "Price: " . $row['Price'] . "<br>";
            echo "Minimum Order Value: " . $row['Min_Order_Value'] . "</p>";
        }
    } else {
        echo "<p>No product results found.</p>";
    }
    
    // Display manufacturer search results
    if ($manufacturer_result->num_rows > 0) {
        echo "<h2>Manufacturer Search Results:</h2>";
        while ($row = $manufacturer_result->fetch_assoc()) {
            echo "<p>Company Name: " . $row['CompanyName'] . "<br>";
            echo "Location: " . $row['City'] . "<br>";
            echo "Contact: " . $row['ContactNo'] . "</p>";
        }
    } else {
        echo "<p>No manufacturer results found.</p>";
    }
    
    // Display distributor search results
    if ($distributor_result->num_rows > 0) {
        echo "<h2>Distributor Search Results:</h2>";
        while ($row = $distributor_result->fetch_assoc()) {
            echo "<p>Company Name: " . $row['CompanyName'] . "<br>";
            echo "Location: " . $row['City'] . "<br>";
            echo "Contact: " . $row['ContactNo'] . "</p>";
        }
    } else {
        echo "<p>No distributor results found.</p>";
    }
    
    echo "</div>";
    
    // Close statements and database connection
    $product_stmt->close();
    $manufacturer_stmt->close();
    $distributor_stmt->close();
    $conn->close();
} else {
    // Redirect to the search form if accessed directly without query
    header("Location: search_form.php");
    exit();
}
?>
