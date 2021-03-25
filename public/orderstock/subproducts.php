<?php
require_once "../../inc/db_connect.php";
include('../../inc/config.inc.php');
?>
<div id='overlayWrapper1'>
  <div id='overlay1'>
    <div class='overlaynav'>
        <button class='back fas fa-arrow-left'></button>
        <button class='close'>x</button>
    </div>
<?php
$cat_parentid = $_POST["cat_parentid"];
$sql = "SELECT * FROM trereife_products where parentid = $cat_parentid AND product_stock > '0'";
$query = mysqli_query($conn, $sql);
while($result2 = mysqli_fetch_assoc($query)) {
?>
<form class="product-form">
<div name="<?php echo $result2['product_name'];?>" class="card" style="margin-top:10px;width: 11rem;height:auto;display:inline-flex;">
  <img class="product_image" style="width:11rem;height:11rem;object-fit: cover;" class="card-img-top" src="<?php if($result2['product_image'] == NULL){$image = "../images/placeholder.jpeg";}else{$image = $result2['product_image'];} echo $image;?>" alt="">
  <div class="card-body">
    <h5 class="card-title"><?php echo $result2['product_name'];?></h5>
    <p class="card-text"><?php echo $result2['product_desc'];?></p>
    <div class="price text-success"><h5 class="mt-4"><?php echo $currency, $result2['product_price'];?></h5></div>
    <div class="product-box">
    <label for="product_qty">Quantity</label> / <?php echo $result2['product_stock'];?>
    <input style="width:40px;"type="number" name="product_qty" value='1'></input>
    </div>
    <input name='id' class="id" value="<?php echo $result2['id'];?>" hidden></input>
    <button type="submit" class="btn btn-primary">Add to Cart</button>

  </div>
</div> </form>
<?php } ?>
</div></div>
<script type="text/javascript">
$(".product-form").submit(function(e){
  var form_data = $(this).serialize();
  var button_content = $(this).find('button[type=submit]');
  button_content.html('Adding...');
  console.log(form_data)
  $.ajax({
    url: "manage_cart.php",
    type: "POST",
    dataType:"json",
    data: form_data,
      success: function(data){
        console.log('hello')
    $("#cart-container").html(data.products);
    button_content.html('Add to Cart');
    window.location.reload();
  },
  error: function(error){
    console.log(this)
  }

});
e.preventDefault();
})

</script>
