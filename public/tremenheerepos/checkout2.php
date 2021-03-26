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
<h3 style="text-align:left">Review Cart</h3>
<?php
if(isset($_SESSION["products2"]) && count($_SESSION["products2"])>0){
	$total = 0;
	?>
	<table class="table" id="shopping-cart-results" style="margin-top:80px;">
	<thead>
		<a href="index.php?view_cart=2" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Go Back</a>
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
	$products = json_encode($_SESSION["products2"]);
	foreach($_SESSION["products2"] as $product){
		$product_name = $product["product_name"];
		$product_qty = $product["product_qty"];
		$product_price = $product["product_price"];
		$item_price = sprintf("%01.2f",($product_price * $product_qty));
		?>
		<tr>
		<td><?php echo $product_name;?></td>
		<td><?php echo $currency . $product_price; ?></td>
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
	<td><br><textarea id='notes' placeholder="Notes about this order"></textarea></td>
	<td><br><br><br><br><br><span style='float: right;' class="input-group-text">£</span>
		     <span style='float: right;' class="input-group-text">£</span></td>
	<td><br><br><br><br><br><form><input placeholder='Handled' type='number' style='width:72px; height:38px;' id='cashamount'</input>
	<input type='number' style='width:72px;height:38px;' placeholder="Change"id='cashchange'readonly></input><button id='cash' type='submit' name='cash' class="btn btn-success btn-block"><i class="fas fa-arrow-circle-right"></i>Cash</button></form></td>
	<td class="text-center view-cart-total"><strong><?php echo $cart_box; ?></strong></td>
	<td><br><br><br><br><br><br><br><br><form><button style='margin-top:4px;'name="card" id='card' type='submit' class="btn btn-success btn-block"><i class="fas fa-arrow-circle-right"></i>Card</button></form></td>
	</tr>
	</tfoot>
	<script type="text/javascript">
	var grandtotal = "<?php echo $grand_total; ?>"
	$('#cashamount').on('change', function(){
		if($(this).val()){
		$('#cashchange').val($('#cashamount').val() - grandtotal)
	}else{
		$('#cashchange').val('')
}
	})

		$('#cash').on('click', function(e){
			var notes = $('#notes').val()
		e.preventDefault();
	$.ajax({
		url: "order2.php",
		type: "POST",
		data: {
			paymentmethod:"Cash",
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
		$('#card').on('click', function(e){
				var notes = $('#notes').val()
			e.preventDefault();
		$.ajax({
			url: "order2.php",
			type: "POST",
	    data: {
				paymentmethod:"Card",
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
