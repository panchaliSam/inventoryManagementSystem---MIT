<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Capture the search term if available
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Modify the SQL query to include a search condition for the Brand
    $sql = "
        SELECT Item.ItemID, Item.Name, Brand.Name AS BrandName, Item.SellingPrice, 
               Item.PurchasePrice, Item.Quantity, Item.Status, Item.Description, Category.Name AS CategoryName
        FROM Item
        LEFT JOIN Category ON Item.CategoryID = Category.CategoryID
        LEFT JOIN Brand ON Item.BrandID = Brand.BrandID
    ";

    if ($searchTerm != '') {
        $sql .= " WHERE Brand.Name LIKE ?";
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);

    if ($searchTerm != '') {
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $searchTerm);
    }

    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking Bootstrap styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Items List</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 20px;">Items List</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Selling Price</th>
                    <th>Purchase Price</th>
                    <th>Quantity</th>
                    <th>Available</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result set and display the items
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ItemID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['BrandName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['SellingPrice']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PurchasePrice']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                        echo "<td>" . ($row['Status'] ? 'Yes' : 'No') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['CategoryName']) . "</td>";
                        echo "<td>
                                <a href='../PHP/itemEdit.php?id=" . htmlspecialchars($row['ItemID']) . "' class='btn btn-primary btn-sm'>
                                    <span class='glyphicon glyphicon-edit'></span>
                                </a>
                                <a href='../PHP/itemDelete.php?id=" . htmlspecialchars($row['ItemID']) . "' class='btn btn-danger btn-sm'>
                                    <span class='glyphicon glyphicon-trash'></span>
                                </a>
                                <a href='../PHP/itemAddQuantity.php?id=" . htmlspecialchars($row['ItemID']) . "' class='btn btn-success btn-sm'>
                                    <span class='glyphicon glyphicon-plus'></span> Add
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Including Bootstrap's JavaScript for interactive components -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
  // Close the database connection
  $conn->close();
?>
