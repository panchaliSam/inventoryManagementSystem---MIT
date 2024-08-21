<?php
    // Include the config file for database connection
    require('../Config/config.php');

    // Capture the search term if available
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Modify the SQL query to include a search condition for the Supplier Name
    $sql = "SELECT SupplierID, Name, Telephone FROM Supplier";

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
    <title>Suppliers List</title>
</head>
<body>
    <div class="container">
        
        <div class="searchbar">
            <center>
                <form method="post" action="">
                    <input type="text" name="searchTerm" style="padding: 1rem 2rem; border-radius: 1rem;" placeholder="Search by supplier name" value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>" style="padding: 0.5rem; margin-bottom: 1rem;">
                    <input type="submit" value="Search" style="padding: 1rem 2rem; background-color: #F2613F; border: none; color: white; border-radius: 1rem;">
                </form>
            </center>
        </div>

        <h2 class="text-center" style="margin-top: 20px;">Suppliers List</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result set and display the suppliers
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['SupplierID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . htmlspecialchars($row['SupplierID']) . "' data-name='" . htmlspecialchars($row['Name']) . "' data-telephone='" . htmlspecialchars($row['Telephone']) . "'>
                                    <span class='glyphicon glyphicon-edit'></span>
                                </button>
                                <a href='../PHP/supplierDelete.php?id=" . htmlspecialchars($row['SupplierID']) . "' class='btn btn-danger btn-sm'>
                                    <span class='glyphicon glyphicon-trash'></span>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No suppliers found</td></tr>";
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
                    <h4 class="modal-title">Edit Supplier</h4>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        <div class="form-group">
                            <label for="supplier_id">Supplier ID:</label>
                            <input type="text" class="form-control" id="supplier_id" name="supplier_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Supplier Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" oninput="validateTelephoneInput(event)" required>
                            <span id="telephone-error" class="error-message"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="../JS/telephoneValidation.js"></script>

    <!-- Including Bootstrap's JavaScript for interactive components -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var supplierID = button.data('id');
            var name = button.data('name');
            var telephone = button.data('telephone');
            
            var modal = $(this);
            modal.find('#supplier_id').val(supplierID);
            modal.find('#name').val(name);
            modal.find('#telephone').val(telephone);
            modal.find('form').attr('action', '../PHP/supplierEdit.php'); // Adjust path as needed
        });
    </script>
</body>
</html>
