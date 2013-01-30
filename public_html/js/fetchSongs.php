<?php 
include ('../../private_html/myTeamConnect.php');

$songName = $_POST['songName'];

$result = mysql_query("SELECT * FROM Library_V WHERE Song_Name = '$songName'");

if (!$result) {
	exit ('<p> Error performing query: ' .
		mysql_error() . '<p/>');
}
else
	return $result;

?>