<?php
include ('../../private_html/myTeamConnect.php');

//Delete Playlist from DB
mysql_query("DELETE FROM Playlist WHERE Playlist_Title='{$_SESSION['Playlist']}' ");

?>
<html>
<head>
<meta http-equiv="refresh" content=".0;../playlists.php">
</head>
<body>
<h1>Playlist Deleted</h1>
</body>
</html>
