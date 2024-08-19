<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Capture the search term if available
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Modify the SQL query to include a search condition for the Brand
    $sql = "
        SELECT Item.ItemID, Item.Name, Item.Brand, Item.Price, Item.Quantity, 
               Item.IsAvailable, Item.Description, Category.Name AS CategoryName
        FROM Item
        LEFT JOIN Category ON Item.CategoryID = Category.CategoryID
    ";

    if ($searchTerm != '') {
        $sql .= " WHERE Item.Brand LIKE ?";
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

<head>  
    <!-- Linking Bootstrap styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
                    <th>Price</th>
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
                        echo "<td>" . $row['ItemID'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Brand'] . "</td>";
                        echo "<td>" . $row['Price'] . "</td>";
                        echo "<td>" . $row['Quantity'] . "</td>";
                        echo "<td>" . ($row['IsAvailable'] ? 'Yes' : 'No') . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "<td>" . $row['CategoryName'] . "</td>";
                        echo "<td>
                                <a href='../PHP?id=" . $row['ItemID'] . "' class='btn btn-primary btn-sm'>
                                    <span class='glyphicon glyphicon-edit'></span>
                                </a>
                                <a href='../PHP/itemDelete.php?id=" . $row['ItemID'] . "' class='btn btn-danger btn-sm'>
                                    <span class='glyphicon glyphicon-trash'></span>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No items found</td></tr>";
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
