<?php
session_start();
include "dbconnect.php";



if (isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];

    // Fetch product details from the database
    $sql = "SELECT * FROM product WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ProductID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Access other attributes of the product
        $ProductName = $row['ProductName'];
        $Price = $row['Price'];
        $Category = $row['Category'];
        // Access other attributes as needed
    } else {
        // Product not found
        // Handle this case, e.g., redirect the user
        exit("Product not found");
    }
} else {
    // ProductID not provided
    // Handle this case, e.g., redirect the user
    exit("ProductID not provided");
}
?>
<script>
    function calculateTotalCost() {
        // Get the price and quantity values
        var price = parseFloat(document.getElementById("Price").value);
        var quantity = parseFloat(document.getElementById("Quantity").value);

        // Calculate the total cost
        var totalCost = price * quantity;

        // Update the value of the total cost input field
        document.getElementById("total_cost").value = totalCost.toFixed(2);
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS for background image */
        body {
          background-image: url('images/bgposter.jpg'); /* Adjust the path */
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-top: 50px; /* Adjust as needed */
        }
        .input-group-btn .btn {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="insert_order.php" method="post">
                <div class="form-group">
                    <label for="ProductName">Product Name:</label>
                    <input type="text" id="ProductName" name="ProductName" value="<?php echo htmlspecialchars($ProductName); ?>" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="text" id="Price" name="Price" value="<?php echo htmlspecialchars($Price); ?>" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="Category">Category:</label>
                    <input type="text" id="Category" name="Category" value="<?php echo htmlspecialchars($Category); ?>" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="Quantity">Enter Quantity:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="Quantity">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="number" name="Quantity" id="Quantity" class="form-control input-number" value="1" min="<?php echo htmlspecialchars($Min_Order_Value); ?>" onchange="calculateTotalCost()" required>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="Quantity">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                    <small id="minOrderMessage" class="form-text text-danger"></small> <!-- Display minimum order message -->
                </div>
                <div class="form-group">
                    <label for="total_cost">Total Cost:</label>
                    <input type="text" id="total_cost" name="total_cost" readonly class="form-control">
                </div>

                <input type="hidden" name="ProductID" value="<?php echo htmlspecialchars($ProductID); ?>">
                <input type="hidden" name="DistributorID" value="<?php echo htmlspecialchars($DistributorID); ?>">
                <button type="submit" class="btn btn-primary">Confirm Order</button>
            </form>
        </div>
    </div>

    <!-- Link to Bootstrap JS and jQuery for the increment/decrement buttons -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to calculate total cost
        function calculateTotalCost() {
            var price = parseFloat(document.getElementById("Price").value);
            var quantity = parseFloat(document.getElementById("Quantity").value);
            var totalCost = price * quantity;
            document.getElementById("total_cost").value = totalCost.toFixed(2);
            // Check if quantity is less than minimum order value
            var minOrderValue = <?php echo htmlspecialchars($Min_Order_Value); ?>;
            if (Quantity < Min_Order_Value) {
                document.getElementById("minOrderMessage").innerText = "The minimum limit of this product should be " + Min_Order_Value;
            } else {
                document.getElementById("minOrderMessage").innerText = "";
            }
        }

        // Function to handle increment/decrement buttons
        $(document).ready(function(){
            $('.btn-number').click(function(e){
                e.preventDefault();
                var fieldName = $(this).attr('data-field');
                var type      = $(this).attr('data-type');
                var input = $("input[name='"+fieldName+"']");
                var currentVal = parseFloat(input.val());
                if (!isNaN(currentVal)) {
                    if(type == 'minus') {
                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if(parseFloat(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if(type == 'plus') {
                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if(parseFloat(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function(){
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {
                var minValue =  parseInt($(this).attr('min'));
                var maxValue =  parseInt($(this).attr('max'));
                var valueCurrent = parseInt($(this).val());
                var name = $(this).attr('name');
                if(valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if(valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled');
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
            });
            $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                     // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
