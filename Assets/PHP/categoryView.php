 <!-- Panchali -->
<!-- Read data from category table -->
 
<?php

    //Include the config file for database connection
    require('../Config/config.php');

    //Read categories
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);


    //Normal Text
    // if ($result->num_rows > 0) {
    //     Output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "Category ID: " . $row["CategoryID"] . "<br>";
    //         echo "Category Name: " . $row["Name"] . "<br>";
    //         echo "Quantity: " . $row["Quantity"] . "<br>";
    //         echo "Description: " . $row["Description"] . "<br>";
    //         echo "<hr>"; 
    //     }
    // } else {
    //     echo "0 results";
    // }

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Here is where the Bootstrap card is embedded
            echo '
            <div class = "category-view">
                <div class="category-card" style="width: 40rem; margin: 1rem; display: inline-block;">
                    <img src="../Images/phone.jpg" class="category-image" alt="Category Image">
                    <div class="card-body">
                        <h1 class="card-title">' . $row["Name"] . '</h1><hr>
                        <p class="card-text" style="font-size: 15px;">
                            Quantity: ' . $row["Quantity"] . '<br><hr>
                            Description: ' . $row["Description"] . '
                        </p>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>
