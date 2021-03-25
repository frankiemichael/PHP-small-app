<?php include('../../../inc/db_connect.php');
include('../../../inc/config.inc.php');
$orderid = $_POST['orderid'];
$sql = "SELECT trereife_products.product_name, trereife_products.product_sku, trereife_orderdetails.productquantity  FROM trereife_orderdetails INNER JOIN trereife_products ON trereife_orderdetails.productid = trereife_products.id  WHERE trereife_orderdetails.orderid = '$orderid'";
$result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
<tr>
<td><?php echo $row['product_name']; ?></td>
<td><?php echo $row['product_sku']; ?></td>
<td><?php echo $row['productquantity']; ?></td>
</tr>
<?php }?>
