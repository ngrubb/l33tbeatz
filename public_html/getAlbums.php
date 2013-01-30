<?php
include ('../private_html/myTeamConnect.php'); 

$artistList = mysql_query("SELECT Artist_First_Name, Artist_Last_Name, Band_Name FROM Artist");

echo '
<form action="" method="post" enctype="multipart/form-data">
<div class="lightboxHeader">
	<h2>Add Album:</h2>
</div>

<div class="lightboxBody">
	<div class="formRow">
		<div class="label">Artist</div>
		<select name="artist">';

while($row = mysql_fetch_array($artistList)) {
    $displayName = "";

    if ($row['Band_Name'] == NULL) {
        $displayName = $row['Artist_First_Name'] . " " . $row['Artist_Last_Name'] ;
    }
    else {
        $displayName = $row['Band_Name'];
    }

	if ($previousName != $displayName) {
		echo '<option value="' . $displayName . '"">' . $displayName . '</option>';
	}
	$previousName = $displayName; 
}

echo '
		</select>
	</div>

	<div class="formRow">
		<div class="label">Album Title</div>
		<div class="field">
			<input type="text" class="title" name="albumTitle" value="">
		</div>
	</div>

	<div class="formRow">
		<div class="label">Release Year</div>
		<div class="field">
			<input type="text" class="year" name="year" value="">
		</div>
	</div>

	<div class="formRow">
		<div class="label">Upload Album Art</div>
		<input type="file" name="file" id="file"/>
	</div>
</div>

<div class="lightboxFooter">
	<div class="lightboxButtons">
		<button class="button" onclick="closeLightbox()">Cancel</button>
		<button class="button blue" type="submit" formaction="private_html/addAlbum.php">Add Album</button>
	</div>
</div>
</form>';

?>		
