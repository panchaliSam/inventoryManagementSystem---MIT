<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if a brand ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $brandID = intval($_GET['id']);

    // Prepare the SQL statement to delete the brand
    $sql = "DELETE FROM Brand WHERE BrandID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $brandID);

    if ($stmt->execute()) {
        // Check if the brand was successfully deleted
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Brand deleted successfully.'); window.location.href='../Pages/brand.php';</script>";
        } else {
            echo "<script>alert('Brand not found or already deleted.'); window.location.href='../Pages/brand.php';</script>";
        }
    } else {
        echo "<script>alert('Error deleting brand.'); window.location.href='../Pages/brand.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No brand ID specified.'); window.location.href='../Pages/brand.php';</script>";
}
?>
