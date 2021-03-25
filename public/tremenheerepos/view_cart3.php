
			<h3>My Cart (<span
id="cart-items-count"><?PHP if(isset($_SESSION["products3"])){
echo count($_SESSION["products3"]); }
?></span>)</h3>
			<?php
			if(isset($_SESSION["products3"]) && count($_SESSION["products3"])>0) {
			?>
				<table class="table1" id="shopping-cart-results">
				<tbody>
			<?php
				$cart_box = '<ul class="cart-products-loaded">';
				$total = 0;
				foreach($_SESSION["products3"] as $product){
					$product_name = $product["product_name"];
					$product_price = $product["product_price"];
					$id = $product["id"];
					$product_qty = $product["product_qty"];
					$subtotal = ($product_price * $product_qty);
					$total = ($total + $subtotal);
				?>
				<tr>
				<td><?php echo "<span style='white-space:nowrap;'><h5>", $product_qty, '  x  ', $product_name, "      	</h5></span>";?></td>
				<td>
				<a href="#" class="btn btn-danger remove-item"
data-code="<?php echo $id; ?>"><i
class="fa fa-trash" aria-hidden="true"></i></a>
				</td>
				</tr>
			 <?php } ?>
			<tfoot>
			<br>
			<br>
			<tr>

			<?php
			if(isset($total)) {
			?>
			<td class="text-center cart-products-total"><strong>Total <?php echo $currency.sprintf("%01.2f",$total); ?></strong></td>
			<td><a href="checkout3.php"
class="btn btn-success btn-block">Checkout <i
class="glyphicon glyphicon-menu-right"></i></a></td>
			<?php } ?>
			</tr>
			</tfoot>
			<?php
			} else {
				echo "Your Cart is empty";
			?>
			<tfoot>
			<br>
			<br>
			<tr>
			<td colspan="2"></td>
			</tr>
			</tfoot>
			<?php } ?>
			</tbody>
			</table>
