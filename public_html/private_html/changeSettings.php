<?php 
include ('../../private_html/myTeamConnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing</title>
<link rel="stylesheet" href="../css/main.css">
</head>

<body>

	<div id="processSettings">
		<h1><span class="lsf">wrench</span> Saving Settings...</h1>
	</div>

<?php
	
	$firstName = mysql_real_escape_string($_POST['firstName']);
	$lastName = mysql_real_escape_string($_POST['lastName']);
	$gender = mysql_real_escape_string($_POST['gender']);

	mysql_query("UPDATE User SET First_Name='$firstName' WHERE Email='{$_SESSION['Email']}' ");			
	mysql_query("UPDATE User SET Last_Name='$lastName' WHERE Email='{$_SESSION['Email']}' ");			
	mysql_query("UPDATE User SET Gender='$gender' WHERE Email='{$_SESSION['Email']}' ");			

	$_SESSION['FirstName'] = $firstName;
	$_SESSION['LastName'] = $lastName;
	$_SESSION['Gender'] = $gender;

	?><meta http-equiv="refresh" content="1;../settings.php"><?php 

?>

</body>
</html>	