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

$artist = $_GET['artist'];
$album = $_GET['album'];
$song = $_GET['song'];





if (mysql_query("INSERT INTO Artist (Band_Name) VALUES ('".$artist."') ")){
	echo $artist;
}

if(mysql_query("INSERT INTO Album (Album_Name) VALUES ('".$album."') ")){
	echo $album;
}

if(mysql_query("INSERT INTO Song (Song_Name) VALUES ('".$song."') ")){
	echo $song;
}


?>
<!--- <meta http-equiv="refresh" content=".5;../public_html/library.php"> -->