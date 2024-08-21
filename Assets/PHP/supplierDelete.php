<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if a supplier ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $supplierID = intval($_GET['id']);

    // Prepare the SQL statement to delete the supplier
    $sql = "DELETE FROM Supplier WHERE SupplierID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supplierID);

    if ($stmt->execute()) {
        // Check if the supplier was successfully deleted
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Supplier deleted successfully.'); window.location.href='../Pages/supplier.php';</script>";
        } else {
            echo "<script>alert('Supplier not found or already deleted.'); window.location.href='../Pages/supplier.php';</script>";
        }
    } else {
        echo "<script>alert('Error deleting supplier.'); window.location.href='../Pages/supplier.php';</script>";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No supplier ID specified.'); window.location.href='../Pages/supplier.php';</script>";
}
?>
