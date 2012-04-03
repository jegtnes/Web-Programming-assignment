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
