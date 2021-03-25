<?php
include('../../../inc/db_connect.php');

$parentid = $_POST['parentid'];
$name = $_POST['name'];
$image = $_POST['image'];
$sql = "INSERT INTO trereife_categories ( cat_parentid, cat_name, cat_image) VALUES ($parentid, '$name', '$image')";
if(mysqli_query($conn, $sql)){
    echo "New folder created.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 ?>
