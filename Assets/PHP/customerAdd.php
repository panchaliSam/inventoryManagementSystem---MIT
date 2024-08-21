<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Prepare SQL statements to check if email or telephone already exists
    $checkEmailSql = "SELECT COUNT(*) FROM Customer WHERE Email = ?";
    $checkTelephoneSql = "SELECT COUNT(*) FROM Customer WHERE Telephone = ?";
    
    // Check email
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($emailCount);
    $stmt->fetch();
    $stmt->close();
    
    // Check telephone
    $stmt = $conn->prepare($checkTelephoneSql);
    $stmt->bind_param("s", $telephone);
    $stmt->execute();
    $stmt->bind_result($telephoneCount);
    $stmt->fetch();
    $stmt->close();

    if ($emailCount > 0) {
        echo "<script>alert('Email already exists.');</script>";
    } elseif ($telephoneCount > 0) {
        echo "<script>alert('Telephone number already exists.');</script>";
    } else {
        // Insert the new customer into the database
        $sql = "INSERT INTO Customer (Name, Email, Telephone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $customer_name, $email, $telephone);

        if ($stmt->execute()) {
            echo "<script>alert('Customer added successfully.'); window.location.href='../Pages/customer.php';</script>";
        } else {
            echo "<script>alert('Error adding customer: " . $conn->error . "');</script>";
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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

    <div class="container">
        <h2>Add Customer</h2>

        <!-- Form to add customer -->
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="text" class="form-control" id="telephone" name="telephone" oninput="validateTelephoneInput(event)" required>
                <span id="telephone-error" class="error-message"></span>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
            <a href="../Pages/customer.php" class="btn btn-default btn-cancel">Cancel</a>
        </form>
    </div>

    <script>
        // Add any additional JavaScript functions or validation here
        function validateForm() {
            // Perform any form validation if needed
            return true; // Return true if form is valid
        }
    </script>
</body>
</html>
