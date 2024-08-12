<?php
// Include the config file for database connection
require('../Config/config.php');

// Fetch categories from the database
$sql = "SELECT CategoryID, Name, Quantity, Description FROM category";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Create a file pointer connected to the output stream
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="categories.csv"');

    $output = fopen('php://output', 'w');

    // Output column headings if needed
    fputcsv($output, array('Category ID', 'Category Name', 'Quantity', 'Description'));

    // Output data rows
    while ($row = $result->fetch_assoc()) {
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
