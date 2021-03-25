<?php include('../../../inc/db_connect.php');
include('../../../inc/config.inc.php');
$sql = "SELECT * FROM shop_products";
$query = mysqli_query($conn, $sql);
while($result = mysqli_fetch_assoc($query)){
?>
<tr>

<td data-id="id"><input class='data' readonly type="text" style='width:20px;' name='id' value='<?php echo $result['id']; ?>'/></td>
<td data-name="product_name"><input class='data' name='product_name' value='<?php echo $result['product_name']; ?>'></input></td>
<td data-category="parentid"><select class='data' name='parentid' class="form-control" id="parentid">
     <option value="0">None</option>
     <?php
     $sql2 = "SELECT * FROM shop_categories ORDER BY cat_name";
     $query2 = mysqli_query($conn, $sql2);
     while($result2 = mysqli_fetch_assoc($query2)){
     ?>
     <option value='<?php echo $result2['cat_id']; ?>'><?php echo $result2['cat_name']; ?></option>
   <?php } ?>
   </select>
</td>
<td data-description="product_desc"><textarea class='data' name='product_desc' placeholder='<?php echo $result['product_desc']; ?>'value='<?php echo $result['product_desc']; ?>'></textarea></td>
<td data-image="product_image"><button name='<?php echo $result['id']; ?>'class='editImage btn btn-success'>Edit</button><input class='data' name='product_image'></input></td>
<td data-price="product_price"><?php echo $currency;?><input style='width:80px;' class='data' type='number' name='product_price' value='<?php echo $result['product_price']; ?>'></input></td>
<td data-stock="product_stock"><input style='width:80px;' class='data' type='number' name='product_stock' value='<?php echo $result['product_stock']; ?>'></input></td>
</tr>


<?php } ?>
