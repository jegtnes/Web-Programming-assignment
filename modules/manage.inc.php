<?php 
require_once "modules/dbConnect.inc";
/*
 *	manage.inc.php 
 *	This manage account page shows you your user information and any completed orders
 */

?>

<h2>Manage account</h2>
<?php 
	if ($logged_in) {
		var_dump($_SESSION);
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
$customer_id = $_SESSION['acc']['id'];
$sql = "SELECT DISTINCT		*
FROM order_items
JOIN customer_order ON order_items.cu_order_id = customer_order.order_id
JOIN product ON order_items.cu_product_id = product.product_id
WHERE customer_order.cu_id = $customer_id
LIMIT 0 , 30";

$result = mysql_query($sql);
if (mysql_query($sql)) {
	echo "<h2>Your orders</h2>";
	while ($row = mysql_fetch_object($result)) {
		echo "<li> " . $row->quantity . "x " . $row->name . "</li>";
	}
		
}

	}
	else {
		echo "You need to log in to see this page.";
		$to_manage = true;
		include_once("modules/login.inc.php");
	}
?>