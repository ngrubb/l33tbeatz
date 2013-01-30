<?php
include ('../private_html/myTeamConnect.php'); 
$songName = $_GET['songName'];

$result = mysql_query("SELECT * FROM Song_Review_V WHERE Song_Name = '$songName'");

echo '
<div class="lightboxHeader">
	<h2>Reviews:</h2>
	<p class="songName">' .  $songName . '</p>
	<div class="writeReview">
		<p>Write a review</p>
		<p onclick="writeReview()"  class="lsf button blue reviewButton">addstar</p>
	</div>
</div>

<div class="lightboxBody">';



while ($row = mysql_fetch_array($result)) {
	$lastInitial = substr($row['User_Last_Name'], 0);
	echo '
	<div class="reviewRow">
		<div class="reviewHeader">
			<div class="reviewInfo">
				<p class="reviewTitle">' . $row['Review_Title'] . '</p>
				<p class="reviewAuthor">by ' . $row['User_First_Name'] . ' ' . $lastInitial . '</p>
			</div>

			<div class="rating">';
		
			switch ($row['Rating']) {
    			case 0:
        			$stars = 0;
        			$emptyStars = 5;
        			break;
    			case 1:
        			$stars = 1;
        			$emptyStars = 4;
        			break;
    			case 2:
        			$stars = 2;
        			$emptyStars = 3;
        			break;
        		case 3:
        			$stars = 3;
        			$emptyStars = 2;
        			break;
        		case 4:
        			$stars = 4;
        			$emptyStars = 1;
        			break;
        		case 5:
        			$stars = 5;
        			$emptyStars = 0;
        			break;
			}

			for ($i = 0; $i < $stars; $i++) {
				echo '<p class="lsf">star</p>';
			}

			for ($i = 0; $i < $emptyStars; $i++) {
				echo '<p class="lsf">starempty</p>';
			}

			echo '
			</div>
		</div>
		<div class="reviewBody">
			<p class="reviewText">' . $row['Review_Content'] . '</p>
			<p class="reviewDate">' . $row['Submission_Date'] . '</p>
		</div>
	</div>';
}


echo ' 
</div>
<div class="lightboxFooter">
	<div class="lightboxButtons">
		<button class="button" onclick="closeLightbox()">Cancel</button>
	</div>
</div>';

?>