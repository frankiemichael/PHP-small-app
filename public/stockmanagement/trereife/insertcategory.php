<?php
include('../../../inc/db_connect.php');
$id = $_POST['id'];
$column = $_POST['column'];
$data = $_POST['data'];
$sql = "UPDATE trereife_categories SET $column='$data' WHERE cat_id = $id";
if (mysqli_query($conn, $sql)) {
  echo "Database updated.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 ?>
