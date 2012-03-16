<?php # main.inc.php

/* 
 *	This is the register page
 *	
 */

// Redirect if this page was accessed directly:
if (!defined('BASE_URL')) {

	// Need the BASE_URL, defined in the config file:
	require_once ('../includes/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL . 'index.php';
	header ("Location: $url");
	exit;
	
} // End of defined() IF.

require_once("includes/dbConnect.inc");

//if the form has been submitted
if (!empty($_POST)) {
	if ($debug == true) {
		
		//echoes the raw input if we're debugging
		echo var_dump($_POST);
	}
	
	
}
?>

<h2>Log in</h2>
<p>Oh, welcome. This is where you're meant to register.</p>
<form method="POST">
<label for="reg_email">Email</label>
<input id="reg_email" name="email" maxlength="50" />
<label for="reg_password">Password</label>
<input id="reg_password" name="password" maxlength="50" />
<label for="reg_first_name">First name</label>
<input id="reg_first_name" name="first_name" maxlength="25" />
<label for="reg_last_name">Surname</label>
<input id="reg_last_name" name="last_name" maxlength="25" />
<label for="reg_address">Address</label>
<textarea id="reg_address" name="address"></textarea>
<label for="reg_city">City</label>
<input id="reg_city" name="city" maxlength="25" />
<label for="reg_postcode">Postcode</label>
<input id="reg_postcode" name="postcode" maxlength="25" />
<button>Register</button>
</form>
<?php

?>