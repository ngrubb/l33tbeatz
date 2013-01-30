 <?php
include ('../private_html/myTeamConnect.php'); 
$songName = $_GET['songName'];

$result = mysql_query("SELECT * FROM Playlist");

echo '
<div class="lightboxHeader">
	<h2>Add to Playlist:</h2>
	<p class="songName">' .  $songName . '</p>
</div>

<div class="lightboxBody">
	<div class="playlistSelect">
		<ul class="playlists">';

while ($row = mysql_fetch_array($result)) {
	$displayName = $row['Playlist_Title'];
	if ($previousName != $displayName) {
	echo '	<li>
				<p class="button lsf addToPlaylist" onclick="addToPlaylist(\''.$displayName.'\')">add</p>
				<p class="playlistName">' . $displayName . '</p>
			</li>';
	}
	$previousName = $displayName; 
}

echo '
		</ul>
	</div>
</div>

<div class="lightboxFooter">
	<div class="lightboxButtons">
		<button class="button" onclick="closeLightbox()">Cancel</button>
	</div>
</div>';

?>