<h2>Your cart</h2>

<?php
//Tutorial http://v3.thewatchmakerproject.com/journal/276/building-a-simple-php-shopping-cart followed when building this cart
include_once 'modules/dbConnect.inc';

function displayCart($extended = false) {
	
	if (isset($_SESSION['cart'])) {
		$ret = "";
		echo "<table>";
		
		foreach($_SESSION['cart'] as $prod) {
			$id = $prod['id'];
			$q = $prod['q'];
			//This statement combines the book and film tables with the main product tables
			//To avoid getting invalid data, the "AND product.prod_type_id = " in the outer join 
			//will not assign the properties to the array if they're not appropriate
			$sql = 
			"SELECT product.name, product.price
			FROM product
			WHERE product.product_id = $id
			";
			
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			echo "<tr>";
			
			//The amounts
			echo "<td>" . $q . "x</td>";
			
			//the product
			echo "<td><a href=\"index.php?p=product&id=$id\">" . $row['name'] . "</a></td>";
			
			//the price
			echo "<td>" . ($q * $row['price']) . "</td>";
			
			//if we're displaying a simple cart or all the cart info
			if ($extended == true) {
				
				//removal of products
				echo "<td><a href=\"index.php?p=cart&remove&id=$id\">" . "Remove" . "</a></td>";
			}
			
			
		}
		echo "</table>";
		//return @$ret;
	}

	else {
		return "<p>You have no items in your cart.</p>";
	}
}

//unset($_SESSION['cart']);

//if removing product
if (isset($_GET['remove']) && isset($_GET['id'])) {
	
	if (isset($_SESSION['cart'])) {
		
		//prepares a new cart to replace with the older one
		$newcart;
		
		foreach($_SESSION['cart'] as $cart) {
			
			//If the product isn't what's being removed, add it to the new cart
			if($cart['id'] != $_GET['id']) {
				$newcart[] = $cart;
			}
		}
		
		//switches carts
		if(!empty($newcart)) {
			unset($_SESSION['cart']);
			$_SESSION['cart'] = $newcart;
		}
		
		else {
			unset($_SESSION['cart']);
		}
		
		
	}
	
}

//if you came to the cart wanting to add something
else if (isset($_POST['id'])) {
	
	
	//TODO: If adding product multiple times, modify quantity instead of adding duplicates
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
	}

	//else add to cart
	else {
		$_SESSION['cart'][] = array('id' => $id,'q' => $q);
	}
	echo (displayCart(true));
}

//if you didn't want to add something, just display the cart
else {
	echo (displayCart(true));
}

?>
<pre>
<?php


?>
</pre>