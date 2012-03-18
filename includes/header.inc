<?php # header.inc (includes navigation & sidebar)

// This page begins the HTML header for the site.

// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'Default Page Title';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $page_title; ?></title>
<link href="./styles/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<div id="header">
	  <h1>The Ultimate Sci-fi Parlour</h1>
	  <p>Purveyors of fine Sci-fi films and books since 1688.</p>
	  	<form name="form1" id="form1" method="get" action="index.php">
	  	<input type="text" name="terms" value="Search..." />
	  	<input type="hidden" name="p" value="search" />
	  	<input class=" button" type="submit" name="Submit" value="GO" />
	  </form>
	</div>
	
	<?php include ('navigation.inc'); ?>

	
	


	<!-- End of header. -->
