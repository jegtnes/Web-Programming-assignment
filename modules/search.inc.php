<?php 
/*	search.inc.php
 *	The search page. Gets search terms via the GET parameter "terms"
 */

require_once('modules/dbConnect.inc');

echo '<h2>Search Results</h2>';

// Display the search results if the form
// has been submitted.
if (isset($_GET['terms']) && ($_GET['terms'] != 'Search...') ) {
$terms = $_GET['terms'];

	$sql = "SELECT DISTINCT *
	FROM product
	LEFT OUTER JOIN prod_book ON product.product_id = prod_book.product_id
	LEFT OUTER JOIN prod_film ON product.product_id = prod_film.product_id
	WHERE name LIKE '%$terms%' 
	OR description LIKE '%$terms%' 
	OR author LIKE '%$terms%' 
	OR director LIKE '%$terms%' 
	OR publisher LIKE '%$terms%' 
	OR studio LIKE '%$terms%'";
	
	$results = mysql_query($sql);
	
	//loops through search results
	while ($search = mysql_fetch_object($results)) {
		echo "<h4><a href=\"index.php?p=product&amp;id=" . $search->product_id ."\">" . $search->name . "</a></h4>";
		
		//if the description is a bit too long, truncate it
		if (strlen($search->description) > 250) {
			echo "<p>" . substr($search->description,0,250) . "...</p>";
		}
		
		else echo "<p>" . $search->description . "</p>";
		
		//if it's a book (which has product type 0) display book-only info
		if ($search->prod_type_id == 0) {
			echo "<p>" . $search->author . " | " . $search->publisher . "</p>";
		}
		
		//if it's a film (which has product type 1) display film-only info
		else if ($search->prod_type_id == 1) {
			echo "<p>" . $search->director . " | " . $search->studio . "</p>";
		}
	}

} else { // Tell them to use the search form.
	echo '<p class="error">Please use the search form at the top of the window to search this site.</p>';
}
?>
