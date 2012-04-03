<?php
session_start();
if (!@$_SESSION['acc']['id']) {
	$logged_in = false;
}

else {
	$logged_in = true;
}

/* 
 *	This is the main page.
 *	This page includes the configuration file, 
 *	the templates, and any content-specific modules.
 */

// Require the configuration file before any PHP code:
require_once ('./modules/config.inc.php');

//Requires misc. funcs
require_once("./modules/misc_funcs.php");

// Validate what page to show:
if (isset($_GET['p'])) {
	$p = $_GET['p'];
} elseif (isset($_POST['p'])) { // Forms
	$p = $_POST['p'];
} else {
	$p = NULL;
}

// Determine what page to display:
switch ($p) {
	
	case 'login':
		$page = 'login.inc.php';
		$page_title = 'Log in';
		break;
	
	case 'register':
		$page = 'register.inc.php';
		$page_title = 'Register';
		break;
	
	case 'logout':
		$page = 'logout.inc.php';
		$page_title = 'Logout';
		break;
	
	case 'manage':
		$page = 'manage.inc.php';
		$page_title = 'Manage your account';
		break;
	
	case 'books':
		$page = 'books.inc.php';
		$page_title = 'Our Books';
		break;
	
	case 'films':
		$page = 'films.inc.php';
		$page_title = 'Our Films';
		break;
	
	case 'product':
		$page = 'product.inc.php';
		$page_title = "Individual product";
		break;
	
	case 'cart':
		$page = 'cart.inc.php';
		$page_title = "Your Cart";
		break;
	
	case 'checkout_details':
		$page = 'checkout_details.inc.php';
		$page_title = "Checkout";
		break;
	
	case 'checkout_complete':
		$page = 'checkout_complete.inc.php';
		$page_title = "Checkout";
		break;
	
	case 'search':
		$page = 'search.inc.php';
		$page_title = 'Search Results';
		break;
	
	// Default is to include the main page.
	default:
		$page = 'main.inc.php';
		$page_title = 'Site Home Page';
		break;
		
} // End of main switch.

// Make sure the file exists:
if (!file_exists('./modules/' . $page)) {
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
}

// Include the header file:
include_once ('./includes/header.inc');

echo "<div id=\"content\">";

//the GET variable 'a' indicates that an action has been performed.
if (isset($_GET['a'])) {
	$a = $_GET['a'];
	
	//the message to be returned
	$m = "";
	switch($a) {
		case 'login':
			$m = "You've successfully logged in!";
			break;
		case 'logout':
			$m = "You've successfully logged out.";
			break;
		case 'register':
			$m = "You've successfully registered! Please log in below:";
		default:
			break;
	}
	
	echo "<p class=\"action\">$m</p>";
	
}
// Include the content-specific module:
// $page is determined from the above switch.
include ('./modules/' . $page);


echo "</div>";
include ('./includes/sidebar.inc');
// Include the footer file to complete the template:
include_once ('./includes/footer.inc');

?>
