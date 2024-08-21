<?php
// Include the config file for database connection
require('../Config/config.php');

// Define the form fields
$category_name = "";
$quantity = "";
$description = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $category_name = $_POST['category-name'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];

  // Validate the form fields
  if (empty($category_name) || empty($quantity) || empty($description)) {
    echo "Please fill out all fields.";
    exit;
  }

  // Prepare the SQL query
  $stmt = $conn->prepare("INSERT INTO Category (Name, Quantity, Description, IsAvailable) VALUES (?, ?, ?, 1)");
  $stmt->bind_param("sss", $category_name, $quantity, $description);

  // Execute the query
  $stmt->execute();

  // Check if the data was inserted successfully
  if ($stmt->affected_rows == 1) {
    echo "Data inserted successfully!";
  } else {
    echo "Error inserting data: " . $stmt->error;
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Category</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <!--Include navbar component-->
    <?php
        include_once "../Components/admin-navbar.php"
    ?>
  <div class="container" style="padding-top: 80px; margin-top: 50px;">
    <h1>Add Category</h1>
    <!-- Form to add category -->
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="category-name" class="col-sm-2 control-label">Category Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="category-name" name="category-name" placeholder="Enter category name">
        </div>
      </div>
      <div class="form-group">
        <label for="quantity" class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
        </div>
      </div>
      <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>