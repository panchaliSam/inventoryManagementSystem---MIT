<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_name = $_POST['supplier_name'];
    $telephone = $_POST['telephone'];

    // Insert the new supplier into the database
    $sql = "INSERT INTO Supplier (Name, Telephone) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $supplier_name, $telephone);

    if ($stmt->execute()) {
        echo "<script>alert('Supplier added successfully.'); window.location.href='../Pages/supplier.php';</script>";
    } else {
        echo "<script>alert('Error adding supplier: " . $conn->error . "');</script>";
    }

    // Close the connection
    $conn->close();
}
?>

<head>
    <title>Add Supplier</title>
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

    <script src="../JS/telephoneValidation.js"></script>

</head>
<body>

    <?php
        // Include your navigation bar or sidebar
        include_once "../Components/sideNavBar.php";
    ?>

    <div class="afterNavContent" style="padding-top: 10px; margin-top: 10px; padding-left: 70px; margin-left: 50px; padding-right: 70px; margin-right: 50px;">
        <h2>Add Supplier</h2>

        <!-- Form to add supplier -->
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="supplier_name">Supplier Name:</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="text" class="form-control" id="telephone" name="telephone" oninput="validateTelephoneInput(event)" required>
                <span id="telephone-error" class="error-message"></span>
            </div>
            <button type="submit" class="btn btn-primary">Add Supplier</button>
            <a href="../Pages/supplier.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>
</body>
