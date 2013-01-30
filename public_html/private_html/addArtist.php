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
<?php 
$newArtist = $_GET['newArtist'];

if (!empty($_GET['newArtist']) AND mysql_query("INSERT INTO Artist (Band_Name) VALUES ('".$newArtist."')")) {
	echo "<div id='processSettings'>
		<h1><span class='lsf'>wrench</span> Saving Settings...</h1>
	</div>";
}
?>
<meta http-equiv="refresh" content=".5;../library.php">