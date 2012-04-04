<?php

/*	books.inc.php
 *	This page will output all the books in the database.
 */

require_once("modules/dbConnect.inc");
?>

<h2>Sci-fi Books</h2>

<?php


$sql = 
"SELECT *
FROM product
JOIN prod_book ON product.product_id = prod_book.product_id
WHERE product.prod_type_id = 0 AND product.stock_level > 0
LIMIT 0,100";

$get_books = mysql_query($sql) or die(mysql_error());

//loops through the results and outputs the book information
while ($row = mysql_fetch_object($get_books)) {
	
	echo "<div class=\"products\">";
	echo "<img src=\"" . $row->image_url . "\" alt=\"\">";
	echo "<h3><a href=\"index.php?p=product&id=" . $row->product_id . "\">" .
			  $row->name . "</a></h3>\n";
	echo "<h4>" . $row->author . " (" . $row-> release_year . ")</h4>";
	echo "<h4>&pound;" . $row->price . "</h4>";
	echo "</div>";
	
}
?>