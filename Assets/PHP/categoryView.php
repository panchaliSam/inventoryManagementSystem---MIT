<!-- Read all categories -->

<?php

// Include the config file for database connection
require('../Config/config.php');

// Capture the search term if available
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Modify the SQL query to include a search condition
$sql = "SELECT * FROM category";
if ($searchTerm != '') {
    $sql .= " WHERE Name LIKE ?";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);

if ($searchTerm != '') {
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

// Define image paths based on category name
$defaultImage = '../Images/alltech.jpg'; 
$images = array(
    'Laptop' => '../Images/laptop.jpg',
    'Phone' => '../Images/phone.jpg',
    'Headphone' => '../Images/headphones.jpg',
);

// Display the results
echo '<div class="category-view" style="display: flex; flex-wrap: wrap; gap: 1rem;">';

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Get the category name
        $categoryName = $row["Name"];

        // Determine the image path based on the category name
        $imagePath = isset($images[$categoryName]) ? $images[$categoryName] : $defaultImage;

        // Display the card with consistent size and style
        echo '
        <div class="category-card" style="width: 30rem; margin: 1rem; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;">
            <img src="' . $imagePath . '" class="category-image" alt="Category Image" style="width: 100%; height: auto;">
            <div class="card-body" style="padding: 10px;">
                <h2 class="card-title" style="font-size: 18px; text-align: center; color: #333;">' . $categoryName . '</h2><hr>
                <p class="card-text" style="font-size: 14px; text-align: center; color: #555;">
                    Quantity: ' . $row["Quantity"] . '<br><hr>
                    Description: ' . $row["Description"] . '
                </p>
            </div>
        </div>
        ';
    }
} else {
    echo "<p style='text-align: center; width: 100%;'>No results found for your search.</p>";
}

echo '</div>';

// Close the connection
$conn->close();
?>
