<?php include('../../../inc/db_connect.php');
include('../../../inc/config.inc.php');
$orderid = $_POST['orderid'];
$sql = "SELECT shop_products.product_name, shop_products.product_sku, shop_orderdetails.productquantity  FROM shop_orderdetails INNER JOIN shop_products ON shop_orderdetails.productid = shop_products.id  WHERE shop_orderdetails.orderid = $orderid";
$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
<tr>
<td><?php echo $row['product_name']; ?></td>
<td><?php echo $row['product_sku']; ?></td>
<td><?php echo $row['productquantity']; ?></td>
</tr>
<?php }?>
