<?php
require('Config/config.php');

$sql = "SELECT CategoryID, Name FROM Category";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($categories);

$conn->close();
?>
