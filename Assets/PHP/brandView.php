<?php
// Include the config file for database connection
require('../Config/config.php');

// Capture the search term if available
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Modify the SQL query to include a search condition for the Brand Name
$sql = "SELECT BrandID, Name FROM Brand";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking Bootstrap styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Brands List</title>
</head>
<body>
    <div class="container">
        
        <div class="searchbar">
            <center>
                <form method="post" action="">
                    <input type="text" name="searchTerm" style="padding: 1rem 2rem; border-radius: 1rem;" placeholder="Search by brand name" value="<?php echo htmlspecialchars($searchTerm); ?>" style="padding: 0.5rem; margin-bottom: 1rem;">
                    <input type="submit" value="Search" style="padding: 1rem 2rem; background-color: #F2613F; border: none; color: white; border-radius: 1rem;">
                </form>
            </center>
        </div>

        <h2 class="text-center" style="margin-top: 20px;">Brands List</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Brand ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result set and display the brands
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['BrandID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . htmlspecialchars($row['BrandID']) . "' data-name='" . htmlspecialchars($row['Name']) . "'>
                                    <span class='glyphicon glyphicon-edit'></span>
                                </button>
                                <a href='../PHP/brandDelete.php?id=" . htmlspecialchars($row['BrandID']) . "' class='btn btn-danger btn-sm'>
                                    <span class='glyphicon glyphicon-trash'></span>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No brands found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Brand</h4>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="../PHP/brandEdit.php" method="POST">
                        <div class="form-group">
                            <label for="brand_id">Brand ID:</label>
                            <input type="text" class="form-control" id="brand_id" name="brand_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Brand Name:</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Including Bootstrap's JavaScript for interactive components -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var brandID = button.data('id');
            var name = button.data('name');
            
            var modal = $(this);
            modal.find('#brand_id').val(brandID);
            modal.find('#brand_name').val(name);
        });
    </script>
</body>
</html>
