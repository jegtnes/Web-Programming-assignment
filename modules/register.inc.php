<?php 

/*	register.inc.php
 *	The register new account page.
 */

require_once("modules/dbConnect.inc");
?>

<h2>Register</h2>

<?php 
if ($logged_in) echo "<p>You're already logged in! If you wish to register another account, please <a href=\"index.php?p=logout\">log out</a>.</p>";

//if the form has been submitted
if (!empty($_POST)) {

	//initialises empty errors string. If this has something in it by the end of the
	//validation process, we have some errors on our hands.
	$errors = "";
	$success = false;
	
	if (checkLength($_POST['email'], 6, 50) === false) {
		$errors .= "Email needs to be between 6 and 50 characters.\n";
	}
	
	if (checkLength($_POST['password'], 8, 60) === false) {
		$errors .= "Password needs to be between 8 and 60 characters.\n";
	}
	
	if (checkLength($_POST['first_name'], 1, 50) === false) {
		$errors .= "First name needs to be between 1 and 25 characters.\n";
	}
	
	if (checkLength($_POST['surname'], 1, 50) === false) {
		$errors .= "Surname needs to be between 1 and 25 characters.\n";
	}	
	
	if (checkLength($_POST['address'], 5, 100) === false) {
		$errors .= "Address needs to be between 5 and 100 characters.\n";
	}
	
	if (checkLength($_POST['city'], 1, 25) === false) {
		$errors .= "City needs to be between 1 and 25 characters.\n";
	}
	
	if (checkLength($_POST['postcode'], 6, 8) === false) {
		$errors .= "Postcode needs to be between 1 and 25 characters.\n";
	}
	
	//if there are no errors so far
	if ($errors == "") {
		$success = true;
		
		//escapes variables to protect against SQL injections
		$email =		mysql_real_escape_string($_POST['email']);
		$password =		mysql_real_escape_string($_POST['password']);
		$first_name =	mysql_real_escape_string($_POST['first_name']);
		$surname =		mysql_real_escape_string($_POST['surname']);
		$address =		mysql_real_escape_string($_POST['address']);
		$city =			mysql_real_escape_string($_POST['city']);
		$postcode =		mysql_real_escape_string($_POST['postcode']);
		
		//This includes the very secure password hashing library phpass: http://www.openwall.com/phpass/ (don't reinvent the square wheel!)
		require_once("modules/PasswordHash.inc");
		
		$hasher = new PasswordHash(8, false);
		$hashed_password = $hasher->HashPassword($password);
		
		//phpass hashes are always 20 chars or more
		if (strlen($hashed_password) < 20) {
			$errors .= "Failed to hash new password";
			$success = false;
		}
		
		//prepares the SQL query
		$sql = "INSERT INTO customer VALUES(NULL,'$first_name','$surname','$address','$postcode','$city','$email','$hashed_password')";

		//checks whether user already exists in DB
		$duplicatecheck = mysql_query($sql_check = "select email FROM customer WHERE email = '$email'");
		if (mysql_fetch_array($duplicatecheck)) {
			$errors .= "This email is already registered, please try another.";
			$success = false;
		}
		
		else {
			//if not successful
			if (!mysql_query($sql)) {
				$errors .= mysql_error();
				$success = false;
			}
			
			else {
				//if successful, send to login page with a successful register message
			Header("Location: index.php?p=login&a=register");
			}
			
			
		}
		
		
	}
	
	//if there are errors
	if ($success == false) {
		echo "<p class=\"error\">There were some errors, please resolve these and try again: <br />" . nl2br($errors) . "</p>";

?>

<form method="POST">
<label for="reg_email">Email</label>
<input id="reg_email" name="email" maxlength="50" type="email" value="<?php echo $_POST['email']?>" />
<label for="reg_password">Password</label>
<input id="reg_password" name="password" maxlength="50" type="password" value="<?php echo $_POST['password']?>" />
<label for="reg_first_name">First name</label>
<input id="reg_first_name" name="first_name" maxlength="25" type="text" value="<?php echo $_POST['first_name']?>" />
<label for="reg_surname">Surname</label>
<input id="reg_surname" name="surname" maxlength="25" type="text" value="<?php echo $_POST['surname']?>" />
<label for="reg_address">Address</label>
<textarea id="reg_address" name="address"><?php echo $_POST['address']?></textarea>
<label for="reg_city">City</label>
<input id="reg_city" name="city" maxlength="25" type="text" value="<?php echo $_POST['city']?>" />
<label for="reg_postcode">Postcode</label>
<input id="reg_postcode" name="postcode" maxlength="8" type="text" value="<?php echo $_POST['postcode']?>" />
<button>Register</button>
</form>
<?php
	}
}

//if no attempt at registering has happened
if (!$logged_in && !$_POST) {
?>
<form method="POST">
<label for="reg_email">Email</label>
<input id="reg_email" name="email" maxlength="50" type="email" value="" />
<label for="reg_password">Password</label>
<input id="reg_password" name="password" maxlength="60" type="password" value="" />
<label for="reg_first_name">First name</label>
<input id="reg_first_name" name="first_name" maxlength="25" type="text" value="" />
<label for="reg_surname">Surname</label>
<input id="reg_surname" name="surname" maxlength="25" type="text" value="" />
<label for="reg_address">Address</label>
<textarea id="reg_address" name="address"></textarea>
<label for="reg_city">City</label>
<input id="reg_city" name="city" maxlength="25" type="text" value="" />
<label for="reg_postcode">Postcode</label>
<input id="reg_postcode" name="postcode" maxlength="8" type="text" />
<button>Register</button>
</form>
<?php
}
?>
