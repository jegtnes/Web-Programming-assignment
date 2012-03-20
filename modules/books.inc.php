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
NATURAL JOIN prod_book
WHERE product.prod_type_id =0

LIMIT 0,30";

$get_books = mysql_query($sql) or die(mysql_error());

echo "<pre>";
while ($row = mysql_fetch_object($get_books)) {
	print_r($row);
}
echo "</pre>";
?>