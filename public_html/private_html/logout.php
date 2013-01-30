<?php 
include ('../../private_html/myTeamConnect.php');
	$_SESSION = array(); 
	session_destroy(); 
	close_connection();
?>
<meta http-equiv="refresh" content=".5;../login.html">
<h1>Logging out</h1>