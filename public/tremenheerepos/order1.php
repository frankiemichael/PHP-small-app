<?php
session_start();
include_once("../../inc/db_connect.php");
include("../../inc/config.inc.php");
$total = $_POST['grandtotal'];
$time = date('Y-m-d H:i:s');
$creator = $_SESSION['name'];
$notes = $_POST['notes'];
$paymentmethod = $_POST['paymentmethod'];

$sql = "INSERT INTO shop_orders ( order_placed, order_creator, order_total, order_notes, paymentmethod) VALUES ('$time', '$creator', '$total', '$notes', '$paymentmethod')";
if(mysqli_query($conn, $sql)){
    echo "Records inserted successfully.";
    header('Location: success.php');
    unset($_SESSION['products']);
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>
