<?php
// Include the config file for database connection
require('../Config/config.php');

// Capture the search term if available
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Modify the SQL query to include a search condition for the Customer Name and item details
$sql = "SELECT Orders.OrderID, Orders.DateAdded, Orders.Amount, Customer.Name AS CustomerName, 
               Item.Name AS ItemName, ItemHasOrder.Quantity
        FROM Orders
        JOIN Customer ON Orders.CustomerID = Customer.CustomerID
        JOIN ItemHasOrder ON Orders.OrderID = ItemHasOrder.OrderID
        JOIN Item ON ItemHasOrder.ItemID = Item.ItemID";

if ($searchTerm != '') {
    $sql .= " WHERE Customer.Name LIKE ?";
}

$sql .= " ORDER BY Orders.OrderID";

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
    <title>Orders List</title>
</head>
<body>
    <div class="container">
        
        <div class="searchbar">
            <center>
                <form method="post" action="">
                    <input type="text" name="searchTerm" style="padding: 1rem 2rem; border-radius: 1rem;" placeholder="Search by customer name" value="<?php echo isset($_POST['searchTerm']) ? htmlspecialchars($_POST['searchTerm']) : ''; ?>" style="padding: 0.5rem; margin-bottom: 1rem;">
                    <input type="submit" value="Search" style="padding: 1rem 2rem; background-color: #F2613F; border: none; color: white; border-radius: 1rem;">
                </form>
            </center>
        </div>

        <h2 class="text-center" style="margin-top: 20px;">Orders List</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date Added</th>
                    <th>Amount</th>
                    <th>Customer Name</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Initialize variables to handle grouping
                $currentOrderID = '';
                $firstRow = true;

                // Loop through the result set and display the orders and items
                while ($row = $result->fetch_assoc()) {
                    // Check if we're on a new order
                    if ($row['OrderID'] !== $currentOrderID) {
                        if (!$firstRow) {
                            echo "</tr>";
                        }
                        $currentOrderID = $row['OrderID'];
                        $firstRow = false;

                        // Print order details
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['OrderID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['DateAdded']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Amount']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['CustomerName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ItemName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . htmlspecialchars($row['OrderID']) . "' data-date='" . htmlspecialchars($row['DateAdded']) . "' data-amount='" . htmlspecialchars($row['Amount']) . "' data-customer='" . htmlspecialchars($row['CustomerName']) . "'>
                                    <span class='glyphicon glyphicon-edit'></span>
                                </button>
                                <a href='../PHP/orderDelete.php?id=" . htmlspecialchars($row['OrderID']) . "' class='btn btn-danger btn-sm'>
                                    <span class='glyphicon glyphicon-trash'></span>
                                </a>
                              </td>";
                        echo "</tr>";
                    } else {
                        // If the same order, just print item details in the next columns
                        echo "<tr>";
                        echo "<td></td><td></td><td></td><td></td>";
                        echo "<td>" . htmlspecialchars($row['ItemName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                }

                // Handle the last row
                if (!$firstRow) {
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='7'>No orders found</td></tr>";
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
                    <h4 class="modal-title">Edit Order</h4>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        <div class="form-group">
                            <label for="order_id">Order ID:</label>
                            <input type="text" class="form-control" id="order_id" name="order_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date">Date Added:</label>
                            <input type="text" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Order</button>
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
            var orderID = button.data('id');
            var date = button.data('date');
            var amount = button.data('amount');
            var customer = button.data('customer');
            
            var modal = $(this);
            modal.find('#order_id').val(orderID);
            modal.find('#date').val(date);
            modal.find('#amount').val(amount);
            modal.find('form').attr('action', '../PHP/orderEdit.php'); // Adjust path as needed
        });
    </script>
</body>
</html>
