<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styleSideBar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="images/electroKeep_favicon.ico" type="image/x-icon" style="height: 32px;width: 32px;" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            padding-top: 50px;
            max-width: 600px;
            margin: auto;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            border-radius: 0.25rem;
            font-weight: 600;
            padding: 10px 20px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: 1px solid transparent;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #004085);
            border-color: #004085;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <link href="styleSideBar.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
<?php

include "sideBar.php";

?>


    <!-- content-->
    <div class="main p-3">
                    <!-- <div class="text-center">
                        <h1>
                            Sidebar Bootstrap 5

                            
                        </h1>
                    </div>
                </div> -->



                <div class="container">
        <h1 class="text-center mb-4">Add Supplier</h1>
        <form action="addSupplier.php" method="POST" onsubmit="return validateForm()">


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require('Config/config.php');

            // Capture form data
            $supplierName = $_POST['supplierName'];
            $supplierEmail = $_POST['supplierEmail'];
            $supplierPhone = $_POST['supplierPhone'];
            $supplierAddress = $_POST['supplierAddress'];

            // Prepare and execute the SQL query
            $sql = "INSERT INTO Supplier (Name, Email, Telephone, Address) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $supplierName, $supplierEmail, $supplierPhone, $supplierAddress);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4' id='success-alert'>Supplier added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger mt-4' id='danger-alert'>Error adding supplier: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>




            <div class="form-group mb-3">
                <label for="supplierName" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="supplierName" name="supplierName" required>
            </div>
            <div class="form-group mb-3">
                <label for="supplierEmail" class="form-label">Supplier Email</label>
                <input type="email" class="form-control" id="supplierEmail" name="supplierEmail" required>
            </div>
            <div class="form-group mb-3">
                <label for="supplierPhone" class="form-label">Supplier Phone</label>
                <input type="text" class="form-control" id="supplierPhone" name="supplierPhone" required>
            </div>
            <div class="form-group mb-3">
                <label for="supplierAddress" class="form-label">Supplier Address</label>
                <textarea class="form-control" id="supplierAddress" name="supplierAddress" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Supplier</button>
        </form>

      
    </div>

    <script>
        function validateForm() {
            var phone = document.getElementById("supplierPhone").value;
            var phoneRegex = /^\d{10}$/;

            if (!phoneRegex.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }
            return true;
        }

        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 3000);
        setTimeout(function() {
            var successAlert = document.getElementById('danger-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>



</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>