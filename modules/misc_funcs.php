<?php

/*	misc_funcs.php
 *	Contains misceanellous useful functions for use around the site. Each are documented individually in more detail.
 */

/**
 * 
 * @param type $bearer The card holder. Includes title
 * @param type $number The card number, spaces stripped
 * @param type $start Start date, format MMYY
 * @param type $expiry Expiry date, format MMYY
 * @param type $card_type Card type
 */
function validatePayment($bearer,$number,$start,$expiry,$card_type) {
	
	$error_msg = "";
	
	//cardholder name section
	if (empty($bearer)) {
		$error_msg .= "Missing cardholder name.\n";
	}
	
	//card number section
	//strips out anything that isn't a number
	$number = preg_replace("/[^0-9]/", "", $number);
	
	if (empty($number)) {
		$error_msg .= "Missing card number.\n";
	}
	
	else if (checkLength($number, 13, 16) == false) {
		$error_msg .= "Your card number needs to be between 13 to 16 characters (no spaces)\n";
	}
	
	//card info section
	if (empty($start)) {
		$error_msg .= "Missing start date.\n";
	}
	
	if (empty($expiry)) {
		$error_msg .= "Missing expiry date.\n";
	}

	if (empty($card_type)) {
		$error_msg .= "Missing card type.\n";
	}
	
	//returns any error messages
	return nl2br($error_msg);
	
}

//a very simple function to check whether a string has the right length required
function checkLength($input, $minchars, $maxchars) {
	
	//check to see whether the inputs will work
	if($minchars <= $maxchars) {
	
		if(strlen((String) $input) >= (int) $minchars && strlen((String) $input) <= (int)$maxchars) {
			return true;
		}
		
		else {
			return false;
		}
	}
}

/*The following two functions are taken from the DSA assignment (written by me) */

/**
 *
 * @return boolean True if you're running off UWE's CEMS server, false if not 
 */
function isInUwe() {
    $currentUri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     
    //If you're currently in UWE
    if(stristr($currentUri,'cems.uwe.ac.uk')) {
        return true;
    }
    else return false;
} 


/**
 *
 * @param type $uri The file to get
 * @return type The file
 */
function acquire_file($uri) {
    if (isInUwe() == true) {
        $context = stream_context_create(
         //TODO: Use cURL
         array('http'=>
              array('proxy'=>'proxysg.uwe.ac.uk:8080',
                      'header'=>'Cache-Control: no-cache'
                     )
          ));  

         $contents = file_get_contents($uri,false,$context);
         return $contents;
    }
    
    else{
         return file_get_contents($uri);
    }
}; 

?>
