<!-- Start sidebar -->
<div id="sidebar">
	<?php
		if ($logged_in) {
			//displays user controls if logged in
			echo("<h2>Welcome, " . $_SESSION['name'] . "!</h2>
				<p><a href=\"index.php?p=manage\">Manage my account</a> | 
				<a href=\"index.php?p=logout\">Log out</a></p>");
		}
		else {
			//displays login form if not
			include_once("modules/login.inc.php");
		}
	?>
	<h2>Basket info</h2>
	<p>Here's where your basket is meant to go.</p>
</div>
<!-- End sidebar -->