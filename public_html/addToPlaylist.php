<?php
include ('../private_html/myTeamConnect.php'); 
include ('../private_html/loginCheck.php');

$playlistName = $_POST['playlistName'];
$songName = $_POST['songName'];


$result = mysql_query("SELECT * FROM Song WHERE Song_Name = '$songName'");
$row = mysql_fetch_array($result);
$songOID = $row['Song_OID'];

$query = mysql_query("SELECT * FROM Playlist WHERE Playlist_Title = '$playlistName'");
$rows = mysql_fetch_array($query);
$playlistOID = $rows['Playlist_OID'];

echo $songOID . " " . $playlistOID;

mysql_query("INSERT INTO Made_Up_Of (Playlist_OID_Made_FK, Song_OID_Made_FK) 
VALUES ('$playlistOID', '$songOID')");

?>