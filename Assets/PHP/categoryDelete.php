<!-- Panchali -->
<!-- Delete logic for category -->

<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if a category ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $CategoryID = intval($_GET['id']);

    // Fetch the quantity of the category
    $sql = "SELECT Quantity FROM category WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $CategoryID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        
        // Check if the quantity is 0
        if ($category['Quantity'] == 0) {
            // Prepare SQL statement to delete the category
            $sql = "DELETE FROM category WHERE CategoryID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $CategoryID);

            if ($stmt->execute()) {
                echo "<script>alert('Category deleted successfully.'); window.location.href='../Pages/category.php';</script>";
            } else {
                echo "<script>alert('Error deleting category: " . $conn->error . "'); window.location.href='../Pages/category.php';</script>";
            }
        } else {
            echo "<script>alert('Category cannot be deleted because its quantity is not 0.'); window.location.href='../Pages/category.php';</script>";
        }
    } else {
        echo "<script>alert('Category not found.'); window.location.href='../Pages/category.php';</script>";
    }

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No category ID specified.'); window.location.href='../Pages/category.php';</script>";
}
?>
