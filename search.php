<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Search</h2>
        <form action="search_results.php" method="GET">
            <div class="radio-group">
                <label><input type="radio" name="category" value="manufacturer" checked> Manufacturer</label>
                <label><input type="radio" name="category" value="distributor"> Distributor</label>
                <label><input type="radio" name="category" value="product"> Product</label>
            </div>
            <div class="form-group">
                <label for="search_query">Search :</label>
                <input type="text" id="search_query" name="query" required>
            </div>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
</body>
</html>

