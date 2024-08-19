<!-- Edit Item Logic -->

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
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        // Update the item in the database
        $sql = "UPDATE Item SET Name = ?, Brand = ?, Price = ?, Description = ?, CategoryID = ? WHERE ItemID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiii", $name, $brand, $price, $description, $category_id, $ItemID);

        if ($stmt->execute()) {
            echo "<script>alert('Item updated successfully.'); window.location.href='../Pages/item.php';</script>";
        } else {
            echo "<script>alert('Error updating item: " . $conn->error . "');</script>";
        }
    }

    // Fetch categories for dropdown
    $sql = "SELECT CategoryID, Name FROM Category";
    $categories = $conn->query($sql);

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No item ID specified.'); window.location.href='../Pages/item.php';</script>";
}
?>

<head>
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
    <?php include_once "../Components/admin-navbar.php"; ?>

    <div class="afterNavContent" style="padding-top: 80px; margin-top: 50px; margin-left: 50px; margin-right: 50px;">
        <h2>Edit Item</h2>

        <!-- Form to edit item -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['Name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo htmlspecialchars($item['Brand']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['Price']); ?>" step="0.01" required>
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
