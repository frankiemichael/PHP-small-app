<?php
include_once("../../inc/db_connect.php");
include("../../inc/config.inc.php");
include("../../inc/header.php");
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

if (isset($_POST['productid'])) {
$productid = isset($_POST['productid']);
debug_to_console("$productid");
$sql_query = "SELECT id, parentid, product_name, product_desc, product_code, product_image, product_price FROM trereife_products WHERE parentid = '".$productid."'";
  $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
while( $row = mysqli_fetch_assoc($resultset) ) {

echo '
    <form class="product-form">
      <h4>'; echo $row["product_name"], $row["parentid"]; echo '</h4>
      <div><img class="product_image" src="images/';echo $row["product_image"]; echo '"></div>
      <div>Price : '; echo $currency; echo $row["product_price"]; echo'</div>
      <div class="product-box">
        <div>
          Color :
          <select name="product_color">
          <option value="Black">Black</option>
          <option value="Gold">Gold</option>
          <option value="White">White</option>
          </select>
        </div>
        <div>
          Qty :
          <select name="product_qty">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          </select>
        </div>
        <input name="product_code" type="hidden" value="';echo $row["product_code"]; echo'">
        <button type="submit">Add to Cart</button>
      </div>
    </form>
    </li>';
 }}?>
