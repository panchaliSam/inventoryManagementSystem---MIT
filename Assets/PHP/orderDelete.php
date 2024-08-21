<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if an order ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $OrderID = intval($_GET['id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Fetch items associated with the order
        $sql = "SELECT ItemID, Quantity FROM ItemHasOrder WHERE OrderID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $OrderID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                $ItemID = $item['ItemID'];
                $Quantity = $item['Quantity'];

                // Restore the item quantity
                $sqlUpdateItem = "UPDATE Item SET Quantity = Quantity + ? WHERE ItemID = ?";
                $stmtUpdateItem = $conn->prepare($sqlUpdateItem);
                $stmtUpdateItem->bind_param("ii", $Quantity, $ItemID);
                $stmtUpdateItem->execute();
            }

            // Delete associated items from ItemHasOrder
            $sqlDeleteItemOrder = "DELETE FROM ItemHasOrder WHERE OrderID = ?";
            $stmtDeleteItemOrder = $conn->prepare($sqlDeleteItemOrder);
            $stmtDeleteItemOrder->bind_param("i", $OrderID);
            $stmtDeleteItemOrder->execute();

            // Delete the order
            $sqlDeleteOrder = "DELETE FROM Orders WHERE OrderID = ?";
            $stmtDeleteOrder = $conn->prepare($sqlDeleteOrder);
            $stmtDeleteOrder->bind_param("i", $OrderID);
            $stmtDeleteOrder->execute();

            // Commit the transaction
            $conn->commit();

            echo "<script>alert('Order and associated items deleted successfully.'); window.location.href='../Pages/order.php';</script>";
        } else {
            throw new Exception("Order not found.");
        }
    } catch (Exception $e) {
        // Rollback the transaction if there is an error
        $conn->rollback();
        echo "<script>alert('" . $e->getMessage() . "'); window.location.href='../Pages/order.php';</script>";
    }

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No order ID specified.'); window.location.href='../Pages/order.php';</script>";
}
?>
