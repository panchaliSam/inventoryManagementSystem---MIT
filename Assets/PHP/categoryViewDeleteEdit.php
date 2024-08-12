<!-- Panchali
Manage category  -->

<?php
// Include the config file for database connection
require('../Config/config.php');

// SQL query to fetch categories
$sql = "SELECT * FROM category";
$result = $conn->query($sql);

// Check if there are results and output them
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['CategoryID'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Quantity'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>
                <a href='../PHP/categoryEdit.php?id=" . $row['CategoryID'] . "' class='btn btn-primary btn-sm'>
                  <span class='glyphicon glyphicon-edit'></span>
                </a>
                <a href='deleteCategory.php?id=" . $row['CategoryID'] . "' class='btn btn-danger btn-sm'>
                  <span class='glyphicon glyphicon-trash'></span>
                </a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No categories found</td></tr>";
}

// Close the connection
$conn->close();
?>