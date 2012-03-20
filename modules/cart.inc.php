<?php 
//Tutorial http://v3.thewatchmakerproject.com/journal/276/building-a-simple-php-shopping-cart followed when building this cart

function displayCart() {
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
		return "<p>You have some items in your cart. \o/</p>";
	}

	else {
		return "<p>You have no items in your cart.</p>";
	}
}

?>