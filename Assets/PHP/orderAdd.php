<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission for adding order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $date_added = $_POST['date_added'];

    // Initialize the total amount
    $amount = 0;

    // Start a transaction
    $conn->begin_transaction();

    // Initialize the order_id variable
    $order_id = null;

    try {
        // Insert the new order into the database
        $sqlOrder = "INSERT INTO Orders (CustomerID, DateAdded, Amount) VALUES (?, ?, ?)";
        $stmtOrder = $conn->prepare($sqlOrder);
        $stmtOrder->bind_param("isd", $customer_id, $date_added, $amount);

        if ($stmtOrder->execute()) {
            // Get the last inserted OrderID
            $order_id = $stmtOrder->insert_id;
            $stmtOrder->close();
        } else {
            throw new Exception("Error adding order: " . $conn->error);
        }

        // Handle the insertion of items into ItemHasOrder
        $item_ids = $_POST['item_id'];
        $quantities = $_POST['quantity'];

        // Calculate the total amount
        for ($i = 0; $i < count($item_ids); $i++) {
            $item_id = $item_ids[$i];
            $quantity = $quantities[$i];

            // Validate the requested quantity
            $sqlCheckQuantity = "SELECT Quantity, SellingPrice FROM Item WHERE ItemID = ?";
            $stmtCheckQuantity = $conn->prepare($sqlCheckQuantity);
            $stmtCheckQuantity->bind_param("i", $item_id);
            $stmtCheckQuantity->execute();
            $stmtCheckQuantity->bind_result($available_quantity, $selling_price);
            $stmtCheckQuantity->fetch();
            $stmtCheckQuantity->close();

            if ($quantity > $available_quantity) {
                throw new Exception("Requested quantity for item ID $item_id exceeds available stock.");
            }

            if ($quantity <= 0) {
                throw new Exception("Quantity must be a positive number.");
            }

            // Calculate the item total price
            $amount += $selling_price * $quantity;

            // Insert the item into ItemHasOrder
            $sqlItemOrder = "INSERT INTO ItemHasOrder (ItemID, OrderID, Quantity) VALUES (?, ?, ?)";
            $stmtItemOrder = $conn->prepare($sqlItemOrder);
            $stmtItemOrder->bind_param("iii", $item_id, $order_id, $quantity);
            $stmtItemOrder->execute();
            $stmtItemOrder->close();

            // Update the Item table to subtract the ordered quantity
            $sqlUpdateItem = "UPDATE Item SET Quantity = Quantity - ? WHERE ItemID = ?";
            $stmtUpdateItem = $conn->prepare($sqlUpdateItem);
            $stmtUpdateItem->bind_param("ii", $quantity, $item_id);
            $stmtUpdateItem->execute();
            $stmtUpdateItem->close();
        }

        // Update the order amount
        $sqlUpdateOrderAmount = "UPDATE Orders SET Amount = ? WHERE OrderID = ?";
        $stmtUpdateOrderAmount = $conn->prepare($sqlUpdateOrderAmount);
        $stmtUpdateOrderAmount->bind_param("di", $amount, $order_id);
        $stmtUpdateOrderAmount->execute();
        $stmtUpdateOrderAmount->close();

        // Commit the transaction
        $conn->commit();

        echo "<script>alert('Order and items added successfully.'); window.location.href='../Pages/order.php';</script>";
    } catch (Exception $e) {
        // Rollback the transaction if there is an error
        $conn->rollback();
        echo "<script>alert('" . $e->getMessage() . "');</script>";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 50px;
        }
        .btn-cancel {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <?php
        // Include your navigation bar or sidebar
        include_once "../Components/sideNavBar.php";
    ?>

    <div class="container">
        <h2>Add Order</h2>

        <!-- Form to add order -->
        <form action="" method="POST" id="order-form">
            <div class="form-group">
                <label for="customer_id">Customer Name:</label>
                <select class="form-control" id="customer_id" name="customer_id" required>
                    <option value="">Select a Customer</option>
                    <?php
                    // Fetch customer names and IDs from the Customer table
                    $sql = "SELECT CustomerID, Name FROM Customer ORDER BY Name";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['CustomerID']) . "'>" . htmlspecialchars($row['Name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No customers found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_added">Date Added:</label>
                <input type="datetime-local" class="form-control" id="date_added" name="date_added" required>
            </div>
            
            <!-- Add items section -->
            <div class="form-group">
                <label for="item_id">Item Name:</label>
                <select class="form-control" id="item_id" name="item_id[]" required>
                    <option value="">Select an Item</option>
                    <?php
                    // Fetch item names and IDs from the Item table
                    $sql = "SELECT ItemID, Name FROM Item ORDER BY Name";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['ItemID']) . "'>" . htmlspecialchars($row['Name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No items found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity[]" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Add Order</button>
            <a href="../Pages/order.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $('#order-form').on('change', 'select, input', function() {
            let totalAmount = 0;
            $('select[name="item_id[]"]').each(function(index) {
                let itemId = $(this).val();
                let quantity = $('input[name="quantity[]"]').eq(index).val();
                if (itemId && quantity) {
                    $.ajax({
                        url: './orderAddetItemPrice.php',
                        type: 'POST',
                        data: { item_id: itemId },
                        dataType: 'json',
                        success: function(response) {
                            let price = response.selling_price;
                            totalAmount += (price * quantity);
                            $('#amount').val(totalAmount.toFixed(2));
                        }
                    });
                }
            });
        });
    });
    </script>

</body>
</html>
