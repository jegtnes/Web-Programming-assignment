<?php # main.inc.php

/* 
 *	This is the login page
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
?>

<h2>Log in</h2>
<p>Oh, welcome. This is where you're meant to have logged in.</p>
<?php

?>