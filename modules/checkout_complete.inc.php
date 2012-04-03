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
		$sql2 = "";
		//this gets the ID generated from the last autoincrement (the first SQL statement)
		$mysql_id = mysql_insert_id();
		foreach ($_SESSION['cart'] as $item) {
			$i_id = $item['id'];
			$quantity = $item['q'];
			$sql2 .= "INSERT INTO order_items VALUES($mysql_id, $i_id, $quantity)";
		}
		
		if(!mysql_query($sql2)) {
			//sadtrombone.mid
		}
		
		else {
			//successkid.jpg
			echo "well we're doing okay aren't we ";
		}
	}
}

//if we've not set the complete checkout session var, return home
else header("Location: index.php");
?>
