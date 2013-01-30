<?php 
include ('../../private_html/myTeamConnect.php');

//Delete Account
mysql_query("DELETE FROM User WHERE Email='{$_SESSION['Email']}' ");
//Delete Session
$_SESSION = array(); session_destroy(); 

?>
<html>
<head>
<meta http-equiv="refresh" content=".5;../login.html">
</head>
<body>
<h1>Logging out... Deleting account.</h1>
</body>
</html>