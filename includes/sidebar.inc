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
	?>
	<h2>Basket info</h2>
	<?php echo displayCart();?>
</div>
<!-- End sidebar -->