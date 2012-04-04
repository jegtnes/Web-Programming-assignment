<?php
/*	checkout_details.inc.php
 *	The page where we will get customer details, validate them against basic rules and send to the card clearing REST service
 */
include_once 'modules/dbConnect.inc';
include_once 'modules/misc_funcs.php';
include_once 'modules/cart.inc.php';

$checkout_form = <<<EOT
<h4>Your card details</h4>
<form action="" method="POST" autocomplete="off" >
			<input type="hidden" name="validate" />
			<div>
				<label for="pay_title">Title</label>
				<input type="text" name="title" id="pay_title" />
				<label for="pay_bearer">Cardholder's name</label>
				<input type="text" name="bearer" id="pay_bearer" />
			</div>
			
			<div>
				<label for="pay_number">Card number</label>
				<input type="number" name="number" id="pay_number">
			</div>
			
			<div>
				<label>Start date</label>
				<select name="start_month">
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				<select name="start_year">
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
			</div>
			
			<div>
				<label>Expiry date</label>
				<select name="exp_month">
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				<select name="exp_year">
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
				</select>
			</div>
			
			<div>
				<label for="pay_type">Card type</label>
				<select id="pay_type" name="card_type">
					<option value="visa">Visa</option>
					<option value="mastercard">Mastercard</option>
					<option value="amex">American Express</option>
					<option value="solo">Solo</option>
					<option value="maestro">Maestro</option>
					<option value="jcb">JCB</option>
					<option value="diners">Diners Club</option>
				</select>
			</div>
			<button>Buy!</button>
		</form>
EOT;

?>

<h2>Checkout</h2>
<?php

	//checking for login
	if (!$logged_in) {
		?><p class="error">You need to be logged in to check out. Please <a href="index.php?p=login">log in</a> or <a href="index.php?p=login">register!</a><?php
	}
	
	//if you don't have stuff in your cart
	else if (empty($_SESSION['cart'])) {
		?><p class="error">You have no items in your cart! Go shopping for <a href="index.php?p=films">films</a> or <a href="index.php?p=books">books.</a><?php
	}
	
	//if form has been submitted and will be validated
	else if (isset($_POST['validate'])) {
		
		$title = $_POST['title'];	
		$bearer = $_POST['bearer'];
		$number = $_POST['number'];
		$start = $_POST['start_month'] . $_POST['start_year'];
		$expiry = $_POST['exp_month'] . $_POST['exp_year'];
		$card_type = $_POST['card_type'];
		
		//if payment isn't valid
		if (validatePayment($bearer, $number, $start, $expiry, $card_type) != "") {
			echo "<p class=\"error\">" . validatePayment($bearer, $number, $start, $expiry, $card_type) . "</p>";
			echo $checkout_form;
		}
		
		//if it is, send to payment processor
		else {
			$cart_price = getCartTotalPrice();
			$random_num = rand(1000,9999);
			$number_md5 = md5($number);
			$api_key = "739a720ade31ad2a14b30aa7b3a6b20e";
			
			$url = "http://www.cems.uwe.ac.uk/~pchatter/rest/rest.php?service=cardAuth" .
			"&msg_id="			.	$random_num				. 
			"&num_md5="			.	$number_md5				.
			"&amount="			.	$cart_price				.
			"&currency=GBP"		.	
			"&api_key="			.	$api_key;
			
			$api_xml = simplexml_load_string(acquire_file($url));
			
			//if the API returns an error
			if ($api_xml->error) {
				echo ("<p class=\"error\">Error encountered: " . $api_xml->error . " (code " . $api_xml->error->attributes()->code . "). Please try again.</p>");
				echo $checkout_form;
			}
			
			//if the API doesn't return an error
			else {
				
				//if everything is where it's supposed to be, we've won
				if ($api_xml->attributes()->id == $random_num &&
				$api_xml->num_md5 == $number_md5 &&
				$api_xml->bearer == $title . " " . $bearer &&
				$api_xml->syear == $start &&
				$api_xml->fyear == $expiry &&
				$api_xml->type == $card_type) {
					//sends user to checkout complete page
					$_SESSION['complete_checkout'] = true;
					header("Location: index.php?p=checkout_complete");
				}
				
				//if not, something's gone wrong
				else {
					echo "<p class=\"error\">Looks like there was an unforeseen error there somewhere! Whoops. Please try again.</p>";
					echo $checkout_form;
				}
			}
			
			
		}
	}
	
	else{
		?>
		
		<h4>Confirm/edit your details</h4>
		<p>This order will be sent to:</p>
		<p>
			<?php echo $_SESSION['acc']['first_name'] . " " .  $_SESSION['acc']['surname'] . ","?> </br>
			<?php echo $_SESSION['acc']['address'] ?> <br />
			<?php echo $_SESSION['acc']['postcode'] . ", ". $_SESSION['acc']['city'];?>
		</p>
		<p>(If these details are incorrect, you can change them in <a href="index.php?p=manage">your account settings</a>.)</p>
		
		<h4>You are buying</h4>
		<?php echo displayCart(false,false);?>
		
		
		
		<?php
			echo $checkout_form;
		?>
		
		<?php
	}
	
?>
