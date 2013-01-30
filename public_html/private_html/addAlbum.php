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
$artist = $_POST['artist'];
$albumName = $_POST['albumTitle'];
$releaseDate = $_POST['year'];
$artistQuery = mysql_query("SELECT * FROM Artist WHERE (CONCAT(Artist_First_Name, ' ', Artist_Last_Name) = '".$artist."')
													OR (Artist_First_Name = '".$artist."') 
													OR (Band_Name = '".$artist."')");
$row = mysql_fetch_array($artistQuery);
$artistFKOID = $row['Artist_OID'];

// ALBUM ART UPLOAD
// $allowedExts = array("jpg", "jpeg", "gif", "png");
// $extension = end(explode(".", $_FILES["file"]["name"]));

// if ((($_FILES["file"]["type"] == "image/gif")
// || ($_FILES["file"]["type"] == "image/jpeg")
// || ($_FILES["file"]["type"] == "image/png")
// || ($_FILES["file"]["type"] == "image/pjpeg"))
// && in_array($extension, $allowedExts))
//   {

  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    $fileName = $_FILES["file"]["name"];
    echo "Upload: " . $fileName . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "<h1>Temp file: " . $_FILES["file"]["tmp_name"] . "</h1><br>";

    if (file_exists("/music/" . $fileName))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      	$uploadLocation = "music/" . $fileName;	
      	move_uploaded_file($_FILES["file"]["tmp_name"], $uploadLocation);

      }
    }

// else
//   {
//   echo "Invalid file";
//   }


if (!empty($_POST['albumTitle'])) {

	mysql_query("INSERT INTO Album (Album_Name,  Release_Date, Artist_OID_Album_FK) 
					VALUES ('".$albumName."',  '".$releaseDate."', '".$artistFKOID."')");

// IF UPLOAD WAS FUNCTIONAL.
	// mysql_query("INSERT INTO Album (Album_Name,  Release_Date, Album_Artwork, Artist_OID_Album_FK) 
	// 				VALUES ('".$albumName."',  '".$releaseDate."', '".$uploadLocation."', '".$artistFKOID."')");


	echo "<div id='processSettings'>
		<h1><span class='lsf'>wrench</span> Saving Settings...</h1>
	</div>";
}
?>
<meta http-equiv="refresh" content=".5;../library.php">