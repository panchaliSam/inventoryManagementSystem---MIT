<?php
// Include the config file for database connection
require('../Config/config.php');

// Set headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orders.csv"');

// Open the output stream
$output = fopen('php://output', 'w');

// Fetch order details from the database
$sql = "
    SELECT Orders.OrderID, Orders.CustomerID, Customer.Name AS CustomerName, Orders.DateAdded, Orders.Amount
    FROM Orders
    LEFT JOIN Customer ON Orders.CustomerID = Customer.CustomerID
";

$result = $conn->query($sql);

// Output column headings
fputcsv($output, array('Order ID', 'Customer ID', 'Customer Name', 'Date Added', 'Amount'));

// Output data rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Format date
        $row['DateAdded'] = date('Y-m-d H:i:s', strtotime($row['DateAdded']));
        fputcsv($output, $row);
    }
} else {
    // Handle case when there is no data
    fputcsv($output, array('No data available.'));
}

// Close the output stream
fclose($output);

// Close the database connection
$conn->close();
exit;
?>
