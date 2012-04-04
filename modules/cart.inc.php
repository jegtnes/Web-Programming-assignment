<?php

/*	cart.inc.php
 *	This file contains some cart functions that can be used outside of the cart page
 *	as well as displaying the cart itself
 */


include_once 'modules/dbConnect.inc';

/**
 *
 * @return type The total cart price
 */
function getCartTotalPrice() {
	$price = 0;
	if (isset($_SESSION['cart'])) {
		foreach($_SESSION['cart'] as $prod) {
			$id = $prod['id'];
			$q = $prod['q'];

			//This statement combines the book and film tables with the main product tables
			$sql = 
			"SELECT product.name, product.price
			FROM product
			WHERE product.product_id = $id
			";

			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$price = $price + ($row['price']) * $q;
		}
	}
	return $price;
}

/**
 *
 * @param type $extended Set whether the cart should display the remove option
 * @return string Returns the cart if it's not empty, if it is, returns string saying it is
 */
function displayCart($extended = false, $checkout_btn = true) {
	
	//if the cart is existent, output the cart
	if (isset($_SESSION['cart'])) {
		echo "<table>";
		foreach($_SESSION['cart'] as $prod) {
			$id = $prod['id'];
			$q = $prod['q'];
			
			//This statement combines the book and film tables with the main product tables
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
			echo "<td>&pound;" . $q * $row['price'] . "</td>";
					
			//if we're displaying a simple cart or all the cart info
			if ($extended == true) {
				//display removal of products
				echo "<td><a href=\"index.php?p=cart&remove&id=$id\">" . "Remove" . "</a></td>";
			}
		}
		
		echo "<tr><td></td><td>Total</td><td>&pound;" . getCartTotalPrice() . "</td></tr>";
		echo "</table>";
		if ($checkout_btn == true) echo "<form method=\"POST\" action=\"index.php?p=checkout_details\"><button>Checkout!</button>";
	}

	else {
		return "<p>You have no items in your cart.</p>";
	}
}

/**
 *
 * @param type $id The item ID to add to cart - mandatory
 * @param type $quantity The quantity of items to add to cart, can be left empty (thus defaulting to one)
 * @return boolean Returns false if the ID isn't valid, true if it is
 */
function addToCart($id,$quantity) {
	
	//casts the values to ensure they're ints
	$id = intval($id);
	$quantity = intval($quantity);
	
	//you're going to need the ID to add the product in the first place
	if (!isset($id)) return false;
	
	else {
		
		//if quantity isn't set, for some reason, default to 1
		if (!isset($quantity)) $quantity = 1;
		
		//if there's no cart already set, initialise
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
			$_SESSION['cart'][] = array('id' => $id,'q' => $quantity);
		}

		//if session exists, add to cart
		else {
			
			//whether you should add the product or not;
			$add = true;
			
			//loops through cart to check whether item has been added already
			//adding a & in front of &cartitem allows you to modify it directly
			//instead of working off a reference
			foreach($_SESSION['cart'] as &$cartitem) {
				
				//if item is in cart already
				if ($cartitem['id'] == $id) {
					
					//updates the quantity and doesn't add it afterwards
					$newQ = $quantity + $cartitem['q'];
					$cartitem['q'] = $newQ;
					$add = false;
				}
			}
			
			//if product should be added
			if ($add == true) {
				$_SESSION['cart'][] = array('id' => $id,'q' => $quantity);
			}
		}
	}
}

/**
 *
 * @param type $id The item ID to remove from the cart
 */
function removeFromCart($id) {
	if (isset($_SESSION['cart'])) {
		
		//prepares a new cart to replace with the older one
		$newcart;
		
		foreach($_SESSION['cart'] as $cart) {
			
			//If the product isn't what's being removed, add it to the new cart
			if($cart['id'] != $id) {
				$newcart[] = $cart;
			}
		}
		
		//switches carts if there's something in the new cart
		if(!empty($newcart)) {
			unset($_SESSION['cart']);
			$_SESSION['cart'] = $newcart;
		}
		
		//if not, just unset the entire thing. Sorted!
		else {
			unset($_SESSION['cart']);
		}
	}
}

//if removing product
if (isset($_GET['remove']) && isset($_GET['id'])) {
	
	removeFromCart($_GET['id']);
	echo (displayCart(true));
}

//if you came to the cart wanting to add something
else if (isset($_POST['id']) && (isset($_POST['add']))) {
	
	addToCart($_POST['id'], $_POST['quantity_select']);

	echo (displayCart(true));
}

//if you didn't want to add something (and you are on the cart page, not
//on an included version, just display the cart
else if (isset($_GET['p']) && $_GET['p'] == 'cart')	echo (displayCart(true));

?>