<?php
// Include the config file for database connection
require('Config/config.php');

// Check if an item ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ItemID = intval($_GET['id']);

    // Fetch the current quantity and CategoryID of the item
    $sql = "SELECT Quantity, CategoryID FROM Item WHERE ItemID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ItemID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $currentQuantity = $item['Quantity'];
        $CategoryID = $item['CategoryID'];

        if ($currentQuantity > 0) {
            // Decrease the item quantity by 1
            $newQuantity = $currentQuantity - 1;

            // Update the item quantity
            $sql = "UPDATE Item SET Quantity = ? WHERE ItemID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $newQuantity, $ItemID);
            $stmt->execute();

            // Update the category quantity
            $sql = "UPDATE Category SET Quantity = Quantity - 1 WHERE CategoryID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $CategoryID);
            $stmt->execute();

            // Redirect to the items list page
            header("Location: viewItems.php");

            //echo "<script>alert('Item quantity decreased successfully.'); window.location.href='viewItems.php';</script>";
        } else {
            // Quantity is 0, proceed with complete deletion
            // Delete the item
            $sql = "DELETE FROM Item WHERE ItemID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ItemID);
            $stmt->execute();

            // Update the category quantity (Assuming we want to subtract 1 from category quantity here as well)
            $sql = "UPDATE Category SET Quantity = Quantity - 1 WHERE CategoryID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $CategoryID);
            $stmt->execute();
            

            echo "<script>alert('Item deleted successfully.'); window.location.href='viewItems.php';</script>";
        }
    } else {
        echo "<script>alert('Item not found.'); window.location.href='viewItems.php';</script>";
    }

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No item ID specified.'); window.location.href='viewItems.php';</script>";
}
