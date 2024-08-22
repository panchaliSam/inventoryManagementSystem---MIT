<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $purchase_price = $_POST['purchase_price'];
    $selling_price = $_POST['selling_price'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];

    // Insert the new item into the database
    $sql = "INSERT INTO item (Name, Quantity, PurchasePrice, SellingPrice, Status, Description, CategoryID, BrandID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siddisii", $item_name, $quantity, $purchase_price, $selling_price, $status, $description, $category_id, $brand_id);

    if ($stmt->execute()) {
        // Update the category quantity
        $update_sql = "UPDATE category SET Quantity = Quantity + ? WHERE CategoryID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $quantity, $category_id);
        $update_stmt->execute();

        echo "<script>alert('Item added successfully.'); window.location.href='../Pages/item.php';</script>";
    } else {
        echo "<script>alert('Error adding item: " . $conn->error . "');</script>";
    }

    // Close the connection
    $conn->close();
}
?>

<head>
    <title>Add Item</title>
    <link rel="icon" href="../Icons/electroKeep_favicon.png" type="image/x-icon" />
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

    <div class="afterNavContent" style="padding-top: 10px; margin-top: 10px; padding-left: 70px; margin-left: 50px; padding-right: 70px; margin-right: 50px;">
        <h2>Add Item</h2>

        <!-- Form to add item -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="purchase_price">Purchase Price:</label>
                <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" required>
            </div>
            <div class="form-group">
                <label for="selling_price">Selling Price:</label>
                <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <!-- Populate with categories from the database -->
                    <?php
                    $result = $conn->query("SELECT CategoryID, Name FROM category");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['CategoryID'] . "'>" . $row['Name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand:</label>
                <select class="form-control" id="brand_id" name="brand_id" required>
                    <!-- Populate with brands from the database -->
                    <?php
                    $result = $conn->query("SELECT BrandID, Name FROM brand");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['BrandID'] . "'>" . $row['Name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
            <a href="../Pages/item.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>
