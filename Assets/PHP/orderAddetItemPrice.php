<?php
require('../Config/config.php');

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    $sql = "SELECT SellingPrice FROM Item WHERE ItemID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->bind_result($selling_price);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['selling_price' => $selling_price]);
}

$conn->close();
?>
