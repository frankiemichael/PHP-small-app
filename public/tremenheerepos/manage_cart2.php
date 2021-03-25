<?php
session_start();
include_once("../../inc/db_connect.php");
include_once("../../inc/config.inc.php");
setlocale(LC_MONETARY,"en_US");
# add products in cart
if(isset($_POST["id"])) {
	foreach($_POST as $key => $value){
		$product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	}
	$statement = $conn->prepare("SELECT product_name, product_price FROM shop_products WHERE id=? LIMIT 1");
	$statement->bind_param('s', $product['id']);
	$statement->execute();
	$statement->bind_result($product_name, $product_price);
	while($statement->fetch()){
		$product["product_name"] = $product_name;
		$product["product_price"] = $product_price;
		if(isset($_SESSION["products2"])){
			if(isset($_SESSION["products2"][$product['id']])) {
				$_SESSION["products2"][$product['id']]["product_qty"] = $_SESSION["products2"][$product['id']]["product_qty"] + $_POST["product_qty"];
			} else {
				$_SESSION["products2"][$product['id']] = $product;
			}
		} else {
			$_SESSION["products2"][$product['id']] = $product;
		}
	}
 	$total_product = count($_SESSION["products2"]);
	die(json_encode(array('products2'=>$total_product)));
}
# Remove products from cart
if(isset($_GET["remove_code"]) && isset($_SESSION["products2"])) {
	$id  = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING);
	if(isset($_SESSION["products2"][$id]))	{
		unset($_SESSION["products2"][$id]);
	}
 	$total_product = count($_SESSION["products2"]);
	die(json_encode(array('products2'=>$total_product)));
}
# Update cart product quantity
if(isset($_GET["update_quantity"]) && isset($_SESSION["products2"])) {
	if(isset($_GET["quantity"]) && $_GET["quantity"]>0) {
		$_SESSION["products2"][$_GET["update_quantity"]]["product_qty"] = $_GET["quantity"];
	}
	$total_product = count($_SESSION["products2"]);
	die(json_encode(array('products2'=>$total_product)));
}
