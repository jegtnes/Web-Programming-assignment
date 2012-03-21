<?php
//Tutorial http://v3.thewatchmakerproject.com/journal/276/building-a-simple-php-shopping-cart followed when building this cart
include_once 'modules/dbConnect.inc';
function displayCart() {
	
	if (isset($_SESSION['cart'])) {
		$ret = "";
		print_r($_SESSION['cart']);
		foreach($_SESSION['cart'] as $prod) {
			$id = $prod['id'];
			
			//This statement combines the book and film tables with the main product tables
			//To avoid getting invalid data, the "AND product.prod_type_id = " in the outer join 
			//will not assign the properties to the array if they're not appropriate
			$sql = 
			"SELECT *
			FROM product
			LEFT OUTER JOIN prod_film ON product.product_id = prod_film.product_id AND product.prod_type_id = 1
			LEFT OUTER JOIN prod_book ON product.product_id = prod_book.product_id AND product.prod_type_id = 0
			WHERE product.product_id = $id
			";
			
			$result = mysql_query($sql) or die(mysql_error());
			print_r($row = mysql_fetch_array($result, MYSQL_ASSOC));
			
		}
		//return @$ret;
	}

	else {
		return "<p>You have no items in your cart.</p>";
	}
}

//unset($_SESSION['cart']);

//if you came to the cart wanting to add something
if (isset($_POST['id'])) {
	
	$id = $_POST['id'];
	
	//if we know the quantity
	if (isset($_POST['quantity_select'])) {
		$q = $_POST['quantity_select'];
	}
	
	else {
		//if the quantity somehow hasn't been specified, default to 1
		$q = 1;
	}

	//if there's no cart already set, initialise
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
		$_SESSION['cart'][] = array('id' => $id,'q' => $q);
		print_r($_SESSION['cart']);
	}

	//else initialise cart
	else {
		$_SESSION['cart'][] = array('id' => $id,'q' => $q);
		print_r($_SESSION['cart']);
	}
	
}

//if you didn't want to add something, just display the cart
else {
	echo "<pre>";
	echo (displayCart());
	echo "</pre>";
}







?>
<pre>
<?php


?>
</pre>