<?php 
include ('../private_html/myTeamConnect.php');

$songName = $_POST['songName'];
$pattern = '/[\']/'; 
$replace = '\'';
$queryName = preg_replace($pattern, $replace, $songName);
$result = mysql_query("SELECT * FROM Library_V WHERE Song_Name = '$queryName'");


if (!$result) {
	exit ('<p> Error performing query: ' .
		mysql_error() . '<p/>');
}
else
	while ($row = mysql_fetch_array($result)){
		echo $row['File_Path'];
	}

?>