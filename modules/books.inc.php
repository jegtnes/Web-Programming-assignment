<?php # main.inc.php

/* 
 *	This is the main content module.
 *	This page is included by index.php.
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
?>

<h2>Sci-fi books</h2>

<?php
require_once("modules/dbConnect.inc");

$sql = 
"SELECT *
FROM product
INNER JOIN prod_book
WHERE product.prod_type_id =0";

$get_books = mysql_query($sql) or die(mysql_error());
$result = mysql_fetch_array($get_books,MYSQL_ASSOC);
echo "<pre>";
print_r($result);
echo "</pre>";
?>