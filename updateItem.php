<?php
// Include the config file for database connection
require('Config/config.php');

// Check if form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemBrand = $_POST['itemBrand'];
    $itemCategory = $_POST['itemCategory'];
    $itemSellingPrice = $_POST['itemSellingPrice'];
    $itemQuantity = $_POST['itemQuantity'];
    $itemDescription = $_POST['itemDescription'];

    // Validate and sanitize input
    $itemId = filter_var($itemId, FILTER_SANITIZE_NUMBER_INT);
    $itemName = filter_var($itemName, FILTER_SANITIZE_STRING);
    $itemBrand = filter_var($itemBrand, FILTER_SANITIZE_NUMBER_INT);
    $itemCategory = filter_var($itemCategory, FILTER_SANITIZE_NUMBER_INT);
    $itemSellingPrice = filter_var($itemSellingPrice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $itemQuantity = filter_var($itemQuantity, FILTER_SANITIZE_NUMBER_INT);
    $itemDescription = filter_var($itemDescription, FILTER_SANITIZE_STRING);

    // Prepare and execute the update query
    $sql = "UPDATE Item SET Name = ?, BrandID = ?, CategoryID = ?, SellingPrice = ?, Quantity = ?, Description = ? WHERE ItemID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('siidisi', $itemName, $itemBrand, $itemCategory, $itemSellingPrice, $itemQuantity, $itemDescription, $itemId);

    if ($stmt->execute()) {
        // Redirect to the same page or to another page with a success message
        header("Location: viewItems.php?update=success");
        exit();
    } else {
        // Handle error
        echo "Error updating record: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Handle the case where form data is not posted
    echo "No form data received.";
}
?>
