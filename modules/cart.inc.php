<?php
//Tutorial http://v3.thewatchmakerproject.com/journal/276/building-a-simple-php-shopping-cart followed when building this cart

function displayCart() {
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
		return $cart;
	}

	else {
		return "<p>You have no items in your cart.</p>";
	}
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

if (isset($_GET['quantity_select'])) {
	$q = $_GET['quantity_select'];
}

//unset($_SESSION['cart']);

?>
<pre>
<?php
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
	$_SESSION['cart']["$id"] = array('q' => $q);
	print_r($_SESSION['cart']);
}

else {
	$_SESSION['cart']["$id"] = array('q' => $q);
	print_r($_SESSION['cart']);
}

?>
</pre>