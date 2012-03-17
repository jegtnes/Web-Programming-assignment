<?php

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

?>
