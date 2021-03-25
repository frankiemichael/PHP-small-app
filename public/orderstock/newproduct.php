<?php
include('../../inc/db_connect.php');

$parentid = $_POST['parentid'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];
$stock = $_POST['stock'];
$sql = "INSERT INTO trereife_products ( parentid, product_name, product_desc, product_image, product_price, product_stock) VALUES ($parentid, '$name', '$description', '$image', $price, $stock)";
if(mysqli_query($conn, $sql)){
    echo "New product created.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 ?>
