<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    // Set quantity to 0 and IsAvailable to false
    $quantity = 0;
    $is_available = 0;

    // Insert the new category into the database
    $sql = "INSERT INTO category (Name, Quantity, IsAvailable, Description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $category_name, $quantity, $is_available, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Category added successfully.'); window.location.href='../Pages/category.php';</script>";
    } else {
        echo "<script>alert('Error adding category: " . $conn->error . "');</script>";
    }

    // Close the connection
    $conn->close();
}
?>

<head>
    <title>Add Category</title>
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

    <div class="afterNavContent" style="padding-top: 80px; margin-top: 50px; margin-left: 50px; margin-right: 50px;">
        <h2>Add Category</h2>

        <!-- Form to add category -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
            <a href="../Pages/category.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>
