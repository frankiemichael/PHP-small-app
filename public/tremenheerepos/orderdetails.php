<?php
include('../../inc/db_connect.php');
$lastid = '';
$sql = "SELECT order_id FROM shop_orders ORDER BY order_id DESC LIMIT 1";
$query = $conn->query($sql);
while($result = mysqli_fetch_assoc($query)){
  $lastid = $result['order_id'];
}


$json = file_get_contents('php://input');
$items = json_decode($json, true);
foreach ($items as $key => $value){
  $id = intval($value['id']);
  $qty = intval($value['product_qty']);
  $sql2 = "INSERT INTO shop_orderdetails (orderid, productid, productquantity) VALUES ($lastid, $id, $qty)";
  $q = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
  $sql3 = "UPDATE shop_products SET product_stock = product_stock - $qty WHERE id = $id";
  $q2 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));
  $sql4 = "UPDATE shop_products SET product_sales = product_sales + $qty WHERE id = $id";
  $q3 = mysqli_query($conn, $sql4) or die (mysqli_error($conn));

}

header('Location: success.php');

 ?>
