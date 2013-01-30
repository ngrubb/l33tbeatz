<?php 
if ($_SESSION['LoggedIn'] != 1){    
?>

<html>
<head>
<link rel="stylesheet" href="../public_html/css/main.css">
<meta http-equiv="refresh" content=".8; http://camelot.cs.messiah.edu/~l33tbeatz/login.html">
</head>
<body>
<h1>Please Login..</h1>
</body>
</html>

<?php
exit;
}
?>