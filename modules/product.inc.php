
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

require_once("modules/dbConnect.inc");

$prod_id = $_GET['id'];

//This statement combines the book and film tables with the main product tables
//To avoid getting invalid data, the "AND product.prod_type_id = " in the outer join 
//will not assign the properties to the array if they're not appropriate
$sql = 
"SELECT *
FROM product
LEFT OUTER JOIN prod_film ON product.product_id = prod_film.product_id AND product.prod_type_id = 1
LEFT OUTER JOIN prod_book ON product.product_id = prod_book.product_id AND product.prod_type_id = 0
WHERE product.product_id = $prod_id
LIMIT 0,1";

$result = mysql_query($sql) or die(mysql_error());
$product = mysql_fetch_array($result,MYSQL_ASSOC);

//Outputs common item information
echo "<div class=\"product\">";
echo "<h2> " . $product['name'] . "</h2>";
echo	"<img src=\"" . $product['image_url'] . "\" alt=\"\">";

//Outputs book-specific information
if ($product['prod_type_id'] == 0) {
	echo "<h4>Author: " . $product['author'] . " (" . $product['release_year'] . ")</h4>";
	
	//if page numbers are set (these can be NULL)
	if ($product['page_number'] != 0 || isset($product['page_number'])) {
		echo "<p>Pages: " . $product['page_number'] . "</p>";
	}
	
	//if ISBNs are set (these can be NULL)
	if ($product['isbn_10'] != 0 || isset($product['isbn_10'])) {
		echo "<p>ISBN 10: " . $product['isbn_10'] . "</p>";
	}
	
	if ($product['isbn_13'] != 0 || isset($product['isbn_13'])) {
		echo "<p>ISBN 13: " . $product['isbn_13'] . "</p>";
	}
	
	echo "<p>Publisher: " . $product['publisher'] . "</p>";
}

//Outputs film-specific information
if ($product['prod_type_id'] == 1) {
	echo "<h4>Directed by: " . $product['director'] . " (" . $product['release_year'] . ")</h4>";
	echo "<p>Run time: " . $product['length'] . " minutes.</p>";
	echo "<p>Studio: " . $product['studio'] . "</p>";
}

echo "<p>" . $product['description'] . "</p>";

?>
<form class="purchase" action="index.php?p=cart" method="post">
	<?php echo "<span class=\"price\">&pound;" . $product['price'] . "</span>";?>
	<label for="quantity_select">Quantity:</label>
	<input type="hidden" name="id" value="<?php echo $prod_id?>" />
	<select name="quantity_select">
		<?php
		$count = $product['stock_level'];
		
		//if there's more than 10 products in stock, only allow
		//the purchase of 10 at once
		if ($count > 10) $count = 10;
		
		for ($count; $count > 0; $count--) {
			
			//select 1 by default with selected="selected
			if ($count == 1) {
				echo "<option selected=\"selected\" name\"" . $count . "\">" . $count . "</option>";
			}
			
			else{
				echo "<option name\"" . $count . "\">" . $count . "</option>";
			}
		}
		?>
	</select>
<button>Buy nao</button>
</form>
<?php
echo "</div>";
?>
