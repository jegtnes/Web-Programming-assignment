<?php 

/*	login.inc.php
 *	The login page. Self-explanatory.
 */

require_once("modules/dbConnect.inc");

//includes a more secure password hashing library, PHPass
//ensuring that no square wheels are reinvented
require_once("modules/PasswordHash.inc");
?>

<h2>Log in</h2>
<?php 

$showloginform = true;

if ($logged_in) {
	$showloginform = false;
	echo "<p>You're already logged in!</p>";
}

else if (!empty($_POST)) {

	//new PasswordHash instance
	$hasher = new PasswordHash(8, false);
	
	$email = $_POST['email'];
	//the unhashed password
	$password = $_POST['password'];
	
	$login = mysql_query("select * FROM `customer` WHERE `email`='$email';") or die(mysql_error());
	
	//stores the customer 
	$result = mysql_fetch_array($login);
	
	//the hashed password
	$hashed_password = $result['password'];
	
	//if successfully logged in
	if ($hasher->CheckPassword($password, $hashed_password)) {
		$_SESSION['acc'] = $result;
		
		//if we've logged in from the manage account page whilst logged out
		if (isset($to_manage)) {
			Header("Location: index.php?p=manage");
		}
		
		else {
			Header("Location: index.php?a=login");
		}
		
	}
	
	//if login failed
	else {
		echo "<p class=\"error\">Invalid username or password. Please try again.</p>";
		$showloginform = true;
	}
}
if ($showloginform) {
?>
<form method="POST">
<label for="reg_email">Email</label>
<input id="login_email" name="email" maxlength="50" type="email" value="" />
<label for="login_password">Password</label>
<input id="login_password" name="password" maxlength="60" type="password" value="" />
<button>Log in</button>
</form>
<?php
}
?>