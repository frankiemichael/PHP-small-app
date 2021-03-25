<?php
session_start();
include("../../inc/config.inc.php");
setlocale(LC_MONETARY,"en_US");
include("../../inc/header.php");
?>
<title>Checkout</title>
<link href="../css/pos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/cart.js"></script>
<?php include('../../inc/container.php');?>
<div class="container">
<h3 style="text-align:left">Review Your Cart Before Buying</h3>
<?php
if(isset($_SESSION["products4"]) && count($_SESSION["products4"])>0){
	$total = 0;
	?>
	<table class="table" id="shopping-cart-results" style="margin-top:80px;">
	<thead>
	<tr>
	<th>Product</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Subtotal</th>
	<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$products = json_encode($_SESSION["products4"]);
	foreach($_SESSION["products4"] as $product){
		$product_name = $product["product_name"];
		$product_qty = $product["product_qty"];
		$product_price = $product["product_price"];
		$item_price = sprintf("%01.2f",($product_price * $product_qty));
		?>
		<tr>
		<td><?php echo $product_name;?></td>
		<td><?php echo $product_price; ?></td>
		<td><?php echo $product_qty; ?></td>
		<td><?php echo $currency; echo sprintf("%01.2f", ($product_price * $product_qty)); ?></td>
		<td>&nbsp;</td>
		</tr>
		<?php
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);
	}

	$grand_total = $total;
	$cart_box = "<span><hr>Total: $currency".sprintf("%01.2f", $grand_total)."</span>";
	?>
	<tfoot>
	<tr>
	<td><br><br><br><br><br><br><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
	<td><input id='notes' placeholder="Notes about this order"></input></td>
	<td>&nbsp;</td>
	<td class="text-center view-cart-total"><strong><?php echo $cart_box; ?></strong></td>
	<td><br><br><br><br><br><br><form><button id='placeorder' type='submit' class="btn btn-success btn-block">Place Order </button></form></td>
	</tr>
	</tfoot>
	<script type="text/javascript">
	var grandtotal = "<?php echo $grand_total; ?>"
	$('#notes').on('change', function(){
		var notes = $(this).val()

	})

		$('#placeorder').on('click', function(e){
				var notes = $('#notes').val()
					console.log(notes)
			e.preventDefault();
		$.ajax({
			url: "order4.php",
			type: "POST",
	    data: {
				notes: notes,
	    grandtotal: grandtotal
		},
	    cache: false,
	    success: function(result){
				console.log(notes)

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
								console.log(result)
								console.log(notes)
								//document.location.href = 'success.php'
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
