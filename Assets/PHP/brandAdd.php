<?php
// Include the config file for database connection
require('../Config/config.php');

// Function to check if brand exists
function brandExists($conn, $brand_name) {
    $checkSql = "SELECT BrandID FROM Brand WHERE Name = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $brand_name);
    $checkStmt->execute();
    $checkStmt->store_result();
    $exists = $checkStmt->num_rows > 0;
    $checkStmt->close();
    return $exists;
}

// Function to add a new brand
function addBrand($conn, $brand_name) {
    $sql = "INSERT INTO Brand (Name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $brand_name);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = trim($_POST['brand_name']);

    // Validate input
    if (empty($brand_name)) {
        echo "<script>alert('Brand name cannot be empty.'); window.location.href='../Pages/brand.php';</script>";
        exit;
    }

    try {
        if (brandExists($conn, $brand_name)) {
            echo "<script>alert('Brand already exists.'); window.location.href='../Pages/brand.php';</script>";
        } else {
            if (addBrand($conn, $brand_name)) {
                echo "<script>alert('Brand added successfully.'); window.location.href='../Pages/brand.php';</script>";
            } else {
                echo "<script>alert('Error adding brand: " . htmlspecialchars($conn->error) . "');</script>";
            }
        }
    } catch (Exception $e) {
        echo "<script>alert('An error occurred: " . htmlspecialchars($e->getMessage()) . "');</script>";
    } finally {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand</title>
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
        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <?php
        // Include your navigation bar or sidebar
        include_once "../Components/sideNavBar.php";
    ?>

    <div class="afterNavContent" style="padding-top: 10px; margin-top: 10px; padding-left: 70px; margin-left: 50px; padding-right: 70px; margin-right: 50px;">
        <h2>Add Brand</h2>

        <!-- Form to add brand -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="brand_name">Brand Name:</label>
                <input type="text" class="form-control" id="brand_name" name="brand_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Brand</button>
            <a href="../Pages/brand.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
