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

if (!empty($_GET['songTitle'])) {
	$artist = $_GET['artist'];
	$album = $_GET['album'];
	$song = $_GET['songTitle'];

	mysql_query("INSERT INTO Song (Song_Name) VALUES ('".$song."') ");

	$songQuery = mysql_query("SELECT * FROM Song WHERE Song_Name = '".$song."' ");
	$songRow = mysql_fetch_array($songQuery);
	$songOID = $songRow['Song_OID'];

	$albumQuery = mysql_query("SELECT * FROM Album WHERE Album_Name = '".$album."' ");
	$albumRow = mysql_fetch_array($albumQuery);
	$albumOID = $albumRow['Album_OID'];

	mysql_query(" INSERT INTO Contains (Album_OID_Contains_FK, Song_OID_Contains_FK) 
						VALUES ('".$albumOID."', '".$songOID."')  ");


	echo "<div id='processSettings'>
		<h1><span class='lsf'>wrench</span> Saving Settings...</h1>
	</div>";
}
?>
<meta http-equiv="refresh" content=".5;../library.php">