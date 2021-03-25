<?php
require_once "../../inc/db_connect.php";
include('../../inc/config.inc.php');
$subcat_id = $_POST["subcat_id"];?>

<?php
$result = mysqli_query($conn,"SELECT * FROM trereife_categories where cat_parentid = $subcat_id");
?>
<option value='0'>None</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['cat_parentid']?>"><?php echo $row['cat_name']?></option>
<?php } ?></div></div>
