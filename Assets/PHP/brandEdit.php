<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandID = intval($_POST['brand_id']);
    $brandName = $_POST['brand_name'];

    // Check if the new brand name already exists
    $checkSql = "SELECT COUNT(*) FROM Brand WHERE Name = ? AND BrandID != ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("si", $brandName, $brandID);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        // Brand name already exists
        echo "<script>alert('Brand name already exists.'); window.location.href='../Pages/brand.php';</script>";
    } else {
        // Proceed with the update
        $updateSql = "UPDATE Brand SET Name = ? WHERE BrandID = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $brandName, $brandID);

        if ($updateStmt->execute()) {
            echo "<script>alert('Brand updated successfully.'); window.location.href='../Pages/brand.php';</script>";
        } else {
            echo "<script>alert('Error updating brand: " . $updateStmt->error . "'); window.location.href='../Pages/brand.php';</script>";
        }

        // Close the statement
        $updateStmt->close();
    }
}

// Close the connection
$conn->close();
?>
