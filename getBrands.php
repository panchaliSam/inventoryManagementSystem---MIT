<?php
require('Config/config.php');

$sql = "SELECT BrandID, Name FROM Brand";
$result = $conn->query($sql);

$brands = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($brands);

$conn->close();
?>
