<?php
// Include the config file for database connection
require('Config/config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $supplierID = $_POST['supplierID'];
    $supplierName = $_POST['supplierName'];
    $supplierEmail = $_POST['supplierEmail'];
    $supplierPhone = $_POST['supplierPhone'];
    $supplierAddress = $_POST['supplierAddress'];

    // Validate phone number to be 10 digits
    if (!preg_match('/^\d{10}$/', $supplierPhone)) {
        echo '<script>alert("Phone number must be 10 digits."); window.history.back();</script>';
        exit;
    }

    // Prepare the SQL update query
    $sql = "UPDATE Supplier SET Name = ?, Email = ?, Telephone = ?, Address = ? WHERE SupplierID = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $supplierName, $supplierEmail, $supplierPhone, $supplierAddress, $supplierID);

        if ($stmt->execute()) {
            echo '<script>alert("Supplier updated successfully."); window.location.href = "viewSupplier.php";</script>';
        } else {
            echo '<script>alert("Error updating supplier."); window.history.back();</script>';
        }

        $stmt->close();
    } else {
        echo '<script>alert("Error preparing the update query."); window.history.back();</script>';
    }
}

// Close the database connection
$conn->close();
?>
