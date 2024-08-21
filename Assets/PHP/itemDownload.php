<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Fetch items with category names and brand names from the database
    $sql = "
        SELECT Item.ItemID, Item.Name, Brand.Name AS BrandName, Item.PurchasePrice AS Price, Item.Quantity, 
            Item.Status AS IsAvailable, Item.Description, Category.Name AS CategoryName
        FROM Item
        LEFT JOIN Category ON Item.CategoryID = Category.CategoryID
        LEFT JOIN Brand ON Item.BrandID = Brand.BrandID
    ";

    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Create a file pointer connected to the output stream
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="items.csv"');

        $output = fopen('php://output', 'w');

        // Output column headings
        fputcsv($output, array('Item ID', 'Name', 'Brand', 'Price', 'Quantity', 'Available', 'Description', 'Category Name'));

        // Output data rows
        while ($row = $result->fetch_assoc()) {
            // Convert boolean to Yes/No for 'IsAvailable' column
            $row['IsAvailable'] = $row['IsAvailable'] ? 'Yes' : 'No';
            fputcsv($output, $row);
        }

        fclose($output);
    } else {
        echo "No data available.";
    }

    // Close the connection
    $conn->close();
    exit;
?>
