<!-- Start sidebar -->
<div id="sidebar">
	<?php
	include_once("modules/cart.inc.php");
		if ($logged_in) {
			//displays user controls if logged in
			echo("<h2>Welcome, " . @$_SESSION['acc']['first_name'] . "!</h2>
				<p><a href=\"index.php?p=manage\">Manage my account</a> | 
				<a href=\"index.php?p=logout\">Log out</a></p>");
		}
		else {
			echo "<h2><a href=\"index.php?p=login\">Log in</a></h2>";
		}
	
	//if a page is set
	if (isset($_GET['p'])) {
	
		//displays cart if not on cart or checkout
		if ($_GET['p'] != "cart" && $_GET['p'] != "checkout_details") {

		?>
		<h2><a href="index.php?p=cart">Your Basket</a></h2>
		<?php 
		print_r(displayCart());
		}	
	}
	
	//if a page isn't set, you're on the home page, so display it regardless
	else echo displayCart();
	
	?>
</div>
<!-- End sidebar -->