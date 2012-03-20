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

<h2>Sci-fi Films</h2>

<?php
require_once("modules/dbConnect.inc");

$sql = 
"SELECT *
FROM product
NATURAL JOIN prod_film
WHERE product.prod_type_id = 1

LIMIT 0,30";

$get_films = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_object($get_films)) {
	echo "<div class=\"product\">";
	echo "<h2>" . $row[''];
	echo "</div>";
	
}

echo "<pre>";
print_r($row);
echo "</pre>";
?>