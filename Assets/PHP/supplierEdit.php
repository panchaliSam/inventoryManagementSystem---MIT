<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $SupplierID = intval($_POST['supplier_id']);
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];

        // Update the supplier in the database
        $sql = "UPDATE Supplier SET Name = ?, Telephone = ? WHERE SupplierID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $telephone, $SupplierID);

        if ($stmt->execute()) {
            echo "<script>alert('Supplier updated successfully.'); window.location.href='../Pages/supplier.php';</script>";
        } else {
            echo "<script>alert('Error updating supplier: " . $stmt->error . "'); window.location.href='../Pages/supplier.php';</script>";
        }
    }

    // Close the connection
    $conn->close();
?>
