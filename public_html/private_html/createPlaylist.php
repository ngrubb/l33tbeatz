<?php
include ('../../private_html/myTeamConnect.php');

$newPlaylist = '';

if (!empty($_POST['title'])) {
	$newPlaylist = mysql_real_escape_string($_POST['title']);


	mysql_query("INSERT INTO Playlist (Playlist_Title, Email_Playlist_FK) 
					VALUES ('".$newPlaylist."' , '".$_SESSION['Email']."')");

}

?>

<meta http-equiv="refresh" content=".5;../playlists.php">
<h1>Playlist Created</h1>