<?php include('../../../inc/db_connect.php');
include('../../../inc/config.inc.php');
$sql = "SELECT * FROM trereife_orders ORDER BY order_placed DESC";
$query = mysqli_query($conn, $sql);
while($result = mysqli_fetch_assoc($query)){
?>
<tr>
<td name='id'><?php echo $result['order_id']; ?></td>
<td><?php echo $result['order_placed']; ?></td>
<td><?php echo $result['order_creator']; ?></td>
<td><?php echo $currency, $result['order_total']; ?></td>
<td><?php echo $result['order_notes']; ?></td>
<td><a href="#" class="moredetails">More Details</a></td>
</tr>

<?php } ?>
