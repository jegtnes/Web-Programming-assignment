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
JOIN prod_film ON product.product_id = prod_film.product_id
WHERE product.prod_type_id = 1 AND product.stock_level > 0
LIMIT 0,100";

$get_films = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_object($get_films)) {
	echo "<div class=\"products\">";
	echo	"<img src=\"" . $row->image_url . "\" alt=\"\">";
	echo "<h3><a href=\"index.php?p=product&id=" . $row->product_id . "\">" .
			  $row->name . "</a></h3>\n";
	echo "<h4>" . $row->director . " (" . $row-> release_year . ")</h4>";
	echo "<h4>&pound;" . $row->price . "</h4>";
	echo "</div>";
	
}


?>