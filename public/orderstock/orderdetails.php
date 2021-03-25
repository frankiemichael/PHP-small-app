<?php
include('../../inc/db_connect.php');
$lastid = '';
$sql = "SELECT order_id FROM trereife_orders ORDER BY order_id DESC LIMIT 1";
$query = $conn->query($sql);
while($result = mysqli_fetch_assoc($query)){
  $lastid = $result['order_id'];
}


$json = file_get_contents('php://input');
$items = json_decode($json, true);
foreach ($items as $key => $value){
  $id = intval($value['id']);
  $qty = intval($value['product_qty']);
  $sql2 = "INSERT INTO trereife_orderdetails (orderid, productid, productquantity) VALUES ($lastid, $id, $qty)";
  $q = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
}



 ?>
