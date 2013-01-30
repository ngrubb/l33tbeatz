<?php
include ('../private_html/myTeamConnect.php'); 
include ('../private_html/loginCheck.php');

$title = $_POST['reviewTitle'];
$rating = $_POST['reviewRating'];
$content = $_POST['reviewContent'];
$songName = $_POST['reviewSongName'];

$result = mysql_query("SELECT * FROM Song WHERE Song_Name = '$songName'");
$row = mysql_fetch_array($result);
$songOID = $row['Song_OID'];
$email = $_SESSION['Email'];

mysql_query("INSERT INTO Review (Review_Title, Rating, Review_Content, Song_OID_Review_FK, Email_Review_FK, Album_OID_Review_FK) 
VALUES ('$title', '$rating', '$content', '$songOID', '$email', NULL)");



?>