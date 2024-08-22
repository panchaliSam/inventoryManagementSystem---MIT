 <!-- Edit logic for category -->

<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if a category ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $CategoryID = intval($_GET['id']);

    // Fetch the category details
    $sql = "SELECT * FROM category WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $CategoryID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
    } else {
        echo "<script>alert('Category not found.'); window.location.href='previous_page.php';</script>";
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_name = $_POST['category_name'];
        $description = $_POST['description'];

        // Update the category in the database
        $sql = "UPDATE category SET Name = ?, Description = ? WHERE CategoryID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $category_name, $description, $CategoryID);

        if ($stmt->execute()) {
            echo "<script>alert('Category updated successfully.'); window.location.href='../Pages/category.php';</script>";
        } else {
            echo "<script>alert('Error updating category: " . $conn->error . "');</script>";
        }
    }

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No category ID specified.'); window.location.href='../Pages/category.php';</script>";
}
?>

<head>
    <title>Edit Category</title>
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

    <div class="afterNavContent" style="padding-top: 10px; margin-top: 10px; padding-left: 80px; margin-left: 50px; margin-right: 50px;">
        <h2>Edit Category</h2>

        <!-- Form to edit category -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['Name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($category['Description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="../Pages/category.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>

