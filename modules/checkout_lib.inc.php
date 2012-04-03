<?php

/**
 * 
 * @param type $bearer The card holder. Includes title
 * @param type $number The card number, spaces stripped
 * @param type $start Start date, format MMYY
 * @param type $expiry Expiry date, format MMYY
 * @param type $card_type Card type
 */
function validateCard($bearer,$number,$start,$expiry,$card_type) {
	
	$error_msg = "";
	
	//cardholder name section
	if (empty($bearer)) {
		$error_msg .= "Missing cardholder name.";
	}
	
	//card number section
	//strips out anything that isn't a number
	$number = preg_replace("/[^0-9]/", "", $number);
	
	if (empty($number)) {
		$error_msg .= "Missing card number.";
	}
	
	else if (strlen($number) != 16) {
		$error_msg .= "Your card number needs to be 16 characters (no spaces)";
	}
	
	//card info section
	if (empty($start)) {
		$error_msg .= "Missing start date.";
	}
	
	if (empty($expiry)) {
		$error_msg .= "Missing expiry date.";
	}

	if (empty($card_type)) {
		$error_msg .= "Missing card type.";
	}
	
	if (empty($error_msg)) {
		return true;
	}
	
	else return $error_msg;
	
}

?>