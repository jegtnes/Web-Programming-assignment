<?php 
if ($logged_in) {
	session_unset();
	session_destroy();
	Header("Location: index.php?a=logout");
?>

<h2>Log out</h2>
<p>You've now successfully logged out! Thank you for visiting The Ultimate Sci-Fi Store!</p>
<?php
}
else {
	?>
	<h2>Log out</h2>
	<p>Well, you were never logged in in the first place. But you're most definitely logged out, I can say that much.</p>
<?php
}
?>
