<?php
    // Include the config file for database connection
    require('Config/config.php');

    // Check if an item ID is provided
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $ItemID = intval($_GET['id']);

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Update the quantity of the item by 1
            $sql = "UPDATE Item SET Quantity = Quantity + 1 WHERE ItemID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ItemID);
            $stmt->execute();

             // setting the status up
             $sql = "UPDATE Item SET Status =  1 WHERE ItemID = ?";
             $stmt = $conn->prepare($sql);
             $stmt->bind_param("i", $ItemID);
             $stmt->execute();

            // Get the CategoryID of the item
            $sql = "SELECT CategoryID FROM Item WHERE ItemID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ItemID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $CategoryID = $row['CategoryID'];

            // Update the quantity of the category
            $sql = "UPDATE Category SET Quantity = Quantity + 1 WHERE CategoryID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $CategoryID);
            $stmt->execute();

            // Commit the transaction
            $conn->commit();

            // Redirect to the items list page
            header("Location: viewItems.php");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $conn->rollback();
            echo "<script>alert('Error updating quantity: " . $e->getMessage() . "'); window.location.href='viewItems.php';</script>";
        }
    } else {
        echo "<script>alert('No item ID specified.'); window.location.href='viewItems.php';</script>";
    }

    // Close the database connection
    $conn->close();
?>
