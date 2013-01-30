// display the lightbox
function lightbox(insertContent, ajaxContentUrl){

	// add lightbox/shadow <div/>'s if not previously added
	if($('#lightbox').size() == 0){
		var theLightbox = $('<div id="lightbox"/>');
		var theShadow = $('<div id="lightbox-shadow"/>');
		$(theShadow).click(function(e){
			closeLightbox();
		});

		$('body').append(theShadow);
		$('body').append(theLightbox);
	}

	// remove any previously added content
	$('#lightbox').empty();

	// insert HTML content
	if(insertContent != null){
		$('#lightbox').append(insertContent);
	}

	// insert AJAX content
	if(ajaxContentUrl != null){
		// temporarily add a "Loading..." message in the lightbox
		$('#lightbox').append('<p class="loading">Loading...</p>');

		// request AJAX content
		$.ajax({
			type: 'GET',
			url: ajaxContentUrl,
			success:function(data){
				// remove "Loading..." message and append AJAX content
				$('#lightbox').empty();
				$('#lightbox').append(data);
			},
			error:function(){
				alert('AJAX Failure!');
			}
		});
	}

	// move the lightbox to the current window top + 35%
	$('#lightbox').css('top', $(window).scrollTop() + 20 + '%');

	// display the lightbox
	$('#lightbox').show();
	$('#lightbox-shadow').show();

}

// close the lightbox
function closeLightbox(){

	// hide lightbox and shadow <div/>'s
	$('#lightbox').hide();
	$('#lightbox-shadow').hide();

	// remove contents of lightbox in case a video or other content is actively playing
	$('#lightbox').empty();
}

//add playlist
$('.addPlaylist').click(function() {
    lightbox('<div class="lightboxHeader"><h2>Create Playlist:</h2></div><form action="#" method="post"><div class="lightboxBody"><div class="label">Title</div><div class="field"><input type="text" class="title" name="title" value=""></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button blue" type="submit" formaction="private_html/createPlaylist.php" formmethod="post">Create Playlist</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div></form>');
});

//delete playlist
$('.deletePlaylist').click(function() {
 lightbox('<form action="#" method="post"><div class="lightboxHeader"><h2>Delete Playlist:</h2></div><div class="lightboxBody"><div class="message"><p>Are you sure you want to delete this playlist?<p></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button red"  type="submit" formmethod="post" formaction="private_html/deletePlaylist.php" name="deletePlaylist">Delete Playlist</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div></form>');
});








