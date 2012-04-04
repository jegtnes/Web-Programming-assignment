<?php 
require_once "modules/dbConnect.inc";
/* 
 *	This is the manage account page
 */

?>

<h2>Manage account</h2>
<?php 
	if ($logged_in) {
	?>
<h2>Your details</h2>
<label for="reg_email">Email</label>
<input disabled="disabled" id="reg_email" name="email" maxlength="50" type="email" value="<?php echo $_SESSION['acc']['email']?>" />
<label for="reg_password">Password</label>
<input disabled="disabled" id="reg_password" name="password" maxlength="50" type="password" value="" />
<label for="reg_first_name">First name</label>
<input disabled="disabled" id="reg_first_name" name="first_name" maxlength="25" type="text" value="<?php echo $_SESSION['acc']['first_name']?>" />
<label for="reg_surname">Surname</label>
<input disabled="disabled" id="reg_surname" name="surname" maxlength="25" type="text" value="<?php echo $_SESSION['acc']['surname']?>" />
<label for="reg_address">Address</label>
<textarea disabled="disabled" id="reg_address" name="address"><?php echo $_SESSION['acc']['address']?></textarea>
<label for="reg_city">City</label>
<input disabled="disabled" id="reg_city" name="city" maxlength="25" type="text" value="<?php echo $_SESSION['acc']['city']?>" />
<label for="reg_postcode">Postcode</label>
<input disabled="disabled" id="reg_postcode" name="postcode" maxlength="8" type="text" value="<?php echo $_SESSION['acc']['postcode']?>" />

<?php
$sql = "SELECT *
FROM customer_order, customer
WHERE customer.id =3
LIMIT 0 , 30";

$result = mysql_query($sql);
if (mysql_query($sql)) {
	
	//an array to keep the total order IDs
	//I'm sure there's a much more elegant solution to this
	$totalOrders;
	while ($row = mysql_fetch_object($result)) {
		$totalOrders[] = $row->order_id;
	}
	
	//if the customer has any orders
	if (!empty($totalOrders)) {
		
		foreach($totalOrders as $order) {		
			$order_sql = "SELECT *
			FROM order_items, product
			JOIN customer_order ON customer_order.order_id = $order
			WHERE product.product_id = order_items.cu_product_id";
			
			$orderQ = mysql_query($order_sql);
			if ($orderQ) {
				//var_dump(mysql_fetch_row($orderQ));
			}
		}
		
	}
	
}

	}
	else {
		echo "You need to log in to see this page.";
		$to_manage = true;
		include_once("modules/login.inc.php");
	}
?>