<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Check if an item ID is provided
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $ItemID = intval($_GET['id']);

        // Fetch the item details
        $sql = "SELECT * FROM Item WHERE ItemID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ItemID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
        } else {
            echo "<script>alert('Item not found.'); window.location.href='../Pages/item.php';</script>";
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $brand_id = $_POST['brand_id'];
            $purchase_price = $_POST['purchase_price'];
            $selling_price = $_POST['selling_price'];
            $quantity = $_POST['quantity'];
            $is_available = $_POST['is_available'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            // Update the item in the database
            $sql = "UPDATE Item SET Name = ?, BrandID = ?, PurchasePrice = ?, SellingPrice = ?, Quantity = ?, Status = ?, Description = ?, CategoryID = ? WHERE ItemID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siddisssi", $name, $brand_id, $purchase_price, $selling_price, $quantity, $is_available, $description, $category_id, $ItemID);

            if ($stmt->execute()) {
                echo "<script>alert('Item updated successfully.'); window.location.href='../Pages/item.php';</script>";
            } else {
                echo "<script>alert('Error updating item: " . $stmt->error . "');</script>";
            }
        }

        // Fetch categories for dropdown
        $sql = "SELECT CategoryID, Name FROM Category";
        $categories = $conn->query($sql);

        // Fetch brands for dropdown
        $sql = "SELECT BrandID, Name FROM Brand";
        $brands = $conn->query($sql);

        // Close the connection
        $conn->close();
    } else {
        echo "<script>alert('No item ID specified.'); window.location.href='../Pages/item.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
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
        // include_once "../Components/admin-navbar.php"
        include_once "../Components/sideNavBar.php"
    ?>

    <div class="container" style="padding-top: 80px;">
        <h2>Edit Item</h2>

        <!-- Form to edit item -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="item_id">Item ID:</label>
                <input type="text" class="form-control" id="item_id" name="item_id" value="<?php echo htmlspecialchars($item['ItemID']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['Name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand:</label>
                <select class="form-control" id="brand_id" name="brand_id" required>
                    <?php while ($row = $brands->fetch_assoc()): ?>
                        <option value="<?php echo $row['BrandID']; ?>" <?php echo $row['BrandID'] == $item['BrandID'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['Name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_price">Purchase Price:</label>
                <input type="number" class="form-control" id="purchase_price" name="purchase_price" value="<?php echo htmlspecialchars($item['PurchasePrice']); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="selling_price">Selling Price:</label>
                <input type="number" class="form-control" id="selling_price" name="selling_price" value="<?php echo htmlspecialchars($item['SellingPrice']); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['Quantity']); ?>" required>
            </div>
            <div class="form-group">
                <label for="is_available">Available:</label>
                <select class="form-control" id="is_available" name="is_available" required>
                    <option value="1" <?php echo $item['Status'] ? 'selected' : ''; ?>>Yes</option>
                    <option value="0" <?php echo !$item['Status'] ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($item['Description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $row['CategoryID']; ?>" <?php echo $row['CategoryID'] == $item['CategoryID'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['Name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="../Pages/item.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
