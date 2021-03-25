<?php include('../../../inc/db_connect.php');
include('../../../inc/config.inc.php');
$sql = "SELECT * FROM trereife_categories";
$query = mysqli_query($conn, $sql);
while($result = mysqli_fetch_assoc($query)){
?>
<tr>

<td data-id="id"><input class='data' readonly type="text" style='width:20px;' name='id' value='<?php echo $result['cat_id']; ?>'/></td>
<td data-name="cat_name"><input class='data' name='cat_name' value='<?php echo $result['cat_name']; ?>'></input></td>
<td data-category="parentid"><select class='data' name='cat_parentid' class="form-control" id="catparentid">
     <option value="0">None</option>
     <?php
     $sql2 = "SELECT * FROM trereife_categories WHERE cat_parentid = '0' ORDER BY cat_name";
     $query2 = mysqli_query($conn, $sql2);
     while($result2 = mysqli_fetch_assoc($query2)){
     ?>
     <option value='<?php echo $result2['cat_id']; ?>'><?php echo $result2['cat_name']; ?></option>
   <?php } ?>
   </select>
</td>
<td><button name='<?php echo $result['cat_id']; ?>'class='editImage btn btn-success'>Edit</button><input class='data' name='cat_image'></input></td>
</tr>


<?php } ?>
