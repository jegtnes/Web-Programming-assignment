<?php
include_once 'modules/dbConnect.inc';
include_once 'modules/checkout_lib.inc.php';
include_once 'modules/cart.inc.php';

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
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		$bearer = $_POST['title'] . $_POST['bearer'] ;
		$number = $_POST['number'];
		$start = $_POST['start_month'] . $_POST['start_year'];
		$expiry = $_POST['exp_month'] . $_POST['exp_year'];
		$card_type = $_POST['card_type'];
		
		
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
		
		<h4>Your card details</h4>
		<form action="" method="POST" autocomplete="off" >
			<input type="hidden" name="validate" />
			<div>
				<label for="pay_bearer">Cardholder's name</label>
				<select name="title">
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
					<option value="Miss">Miss</option>
					<option value="Sir">Sir</option>
					<option value="">N/A</option>
				</select>
				<input type="text" name="bearer" id="pay_bearer" value="<?php echo $_SESSION['acc']['first_name'] . " " . $_SESSION['acc']['surname']?>" />
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
		<?php
			
		?>
		
		<?php
	}
	
?>
