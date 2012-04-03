<?php
include_once 'modules/dbConnect.inc';
include_once 'modules/checkout_lib.inc.php';
include_once 'modules/cart.inc.php';

if (!empty($_SESSION['complete_checkout'])) {
	
	$timestamp = time();
	$price = getCartTotalPrice();
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	
	$sql = "INSERT INTO customer_order VALUES(NULL, " . $_SESSION['acc']['id'] . ", $timestamp)";
	
	//if the query didn't execute
	if (!mysql_query($sql)) {
		echo "Something went wrong. Sorry. Please return home.";
	}
	
	//if the query executed, start inserting order items
	else {
		
		//amount of items in cart, this is needed to 
		//make the SQL query to determine whether you put 
		//a comma or a semicolon at the end of the query
		$cartnum = count($_SESSION['cart']);
		
		$sql2 = "INSERT INTO order_items VALUES";
		//this gets the ID generated from the last autoincrement (the first SQL statement)
		$mysql_id = mysql_insert_id();
		
		foreach ($_SESSION['cart'] as $item) {
			$cartnum--;
			$i_id = $item['id'];
			$quantity = $item['q'];
			$sql2 .= "($mysql_id, $i_id, $quantity)";
			
			//adds either a comma or a semicolon
			if ($cartnum == 0) {
				$sql2 .= ";";
			}
			
			else {
				$sql2 .= ",";
			}
		}
		
		if(!mysql_query($sql2)) {
			//sadtrombone.mid
			echo "<p class\"error\">Error: " . mysql_error() . ".</p>";
		}
		
		else {
			//successkid.jpg
			?>
			<h2>Checkout complete!</h2>
			<p>Thank you for your purchase! You can view this order later from your <a href="index.php?p=manage">account</a> settings.</p>
		<?php
		}
	}
}

//if we've not set the complete checkout session var, return home
else header("Location: index.php");
?>
