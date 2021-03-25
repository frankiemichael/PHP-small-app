<?php
session_start();
include("../../inc/config.inc.php");
setlocale(LC_MONETARY,"en_US");
include("../../inc/header.php");
?>
<title>Checkout</title>
<link href="../css/pos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/cart.js"></script>
<?php include('../../inc/container.php');?>
<div class="container">
<h3 style="text-align:left">Review Your Cart</h3>
<?php
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$total = 0;
	?>
	<table class="table" id="shopping-cart-results" style="margin-top:80px;">
	<thead>
	<tr>
	<th>Product</th>
	<th>Quantity</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$products = json_encode($_SESSION["products"]);
	foreach($_SESSION["products"] as $product){
		$product_name = $product["product_name"];
		$product_qty = $product["product_qty"];
		?>
		<tr>
		<td><?php echo $product_name;?></td>
		<td><?php echo $product_qty; ?></td>
		<td>&nbsp;</td>
		</tr>
		<?php
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);
	}

	$grand_total = 0;
	$cart_box = "<span><hr>Total: $currency".sprintf("%01.2f", $grand_total)."</span>";
	?>
	<tfoot>
	<tr>
	<td><br><br><br><br><br><br><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back</a></td>
	<td>&nbsp;</td>
	<td class="text-center view-cart-total"><strong><?php echo $cart_box; ?></strong></td>
	<td><br><br><br><br><br><br><form><button id='placeorder' type='submit' class="btn btn-success btn-block">Send Request </button></form></td>
	</tr>
	</tfoot>
	<script type="text/javascript">
	var grandtotal = "<?php echo $grand_total; ?>"
		$('#placeorder').on('click', function(e){
			e.preventDefault();
		$.ajax({
			url: "order.php",
			type: "POST",
	    data: {
	    grandtotal: grandtotal
		},
	    cache: false,
	    success: function(result){
				console.log(grandtotal)

						var itemsjson = '<?php echo $products;?>'
						var items = JSON.parse(itemsjson)
						$.each(items, function(id, items){
							var item = items
						$.ajax({
							url: "orderdetails.php",
							type: "POST",
							data: JSON.stringify({
							item: item
						}),
							cache: false,
							success: function(result){
								document.location.href = 'success.php'
							},
							error: function(error){
								alert('There was an error processing your order.')
							}
						})
						})
			},
			error: function(error){
				console.log(error)
			}
		})

	})
	</script>
	<?php
} else {
	echo "Your Cart is empty";
}
?>
</tbody>
</table>
</div>
<?php include('../../inc/footer.php');?>
