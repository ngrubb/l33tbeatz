<?php 
include ('../../private_html/myTeamConnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process</title>
<link rel="stylesheet" href="../css/main.css">
</head>

<body>

<div id="processSettings">
<?php

$password = "";
$password1 = "";
$password2 = "";

if (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])) {
	//Set password variables securely
	$password = sha1(mysql_real_escape_string($_POST['password']));
	$password1 = mysql_real_escape_string($_POST['password1']);
	$password2 = mysql_real_escape_string($_POST['password2']);
	$hash = sha1($password1);
	$checklogin = mysql_query("SELECT * FROM User WHERE Password = '".$password."'");

    if(mysql_num_rows($checklogin) == 1) {
		//check to see if passwords are the same
		if ($password1 == $password2) {
			//check to see if passwords are atleast 6 characters
			if (strlen($password1) >= 6) {
				//change password in database
				 mysql_query("UPDATE User SET Password='$hash' WHERE Email='{$_SESSION['Email']}' ");			
				?> 
				<h1>Password Changed</h1>
				<h3>Please login again...</h3>
				<?php $_SESSION = array(); session_destroy(); ?>
				<meta http-equiv="refresh" content="1;../login.html"> 
				<?php
			} else {
			echo "<h1>Password must be atleast 6 characters</h1>";
			}
		} else {
		echo "<h1>Passwords need to match. Please re-enter your information.</h1>";
		}
	}	
} else {
	echo "<h1>Missing field. Please re-enter your information.</h1>";
}

?>
</div>
</body>
</html>	