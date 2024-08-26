<?php

session_start();
require "connection.php";

$name = $_POST["name"];
$brand = $_POST["brand"];
$category = $_POST["category"];
$p_price  = $_POST["pp"];
$s_price  = $_POST["sp"];
$quantity = $_POST["quantity"];
$description = $_POST["description"];

if(empty($name)){
    echo ("Please add Item Name");
}else if(strlen($name) >= 100){
    echo ("Item Name should have less than 100 characters");
}else if($brand == "0"){
    echo ("Please select a Brand");
}else if($category == "0"){
    echo ("Please select a Category");
}else if(empty($p_price)){
    echo ("Please add the Purchase Price");
}else if(empty($s_price)){
    echo ("Please add the Selling Price");
}else if(empty($quantity)){
    echo ("Please add the Quantity");
}else if($quantity == "0" | $quantity == "e" | $quantity < 0){
    echo ("Invalid value for field Quantity");
}else if(empty($description)){
    echo ("Please add the Description");
}else if($s_price<=$p_price){
    echo ("Selling Price Should be more than purchase price");
}else{


    $status = 1;
    Database::iud("INSERT INTO `item` (`Name`,`Quantity`,`PurchasePrice`,`SellingPrice`,`Status`,`Description`,
    `CategoryID`,`BrandID`) 
    VALUES ('".$name."','".$quantity."','".$p_price."','".$s_price."','".$status."','".$description."','".$category."','".$brand."')");

    echo ("Product Added Successfully.");

}

?>