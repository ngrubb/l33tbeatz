$(function() {
    $( "#playlistTracks" ).sortable();
    $( "#playlistTracks" ).disableSelection();
});

$('.track').hover(function() {
	$(this).children(":first").switchClass('playHidden', "playMedia", 50);
}, function() {
	$(this).children(":first").switchClass('playMedia', "playHidden", 50);
});

$('.track button').click(function() {
    $songName = $(this).next().children('.trackTitle').text();
	fetchSong($songName);
});

$('.trackTitle').click(function() {
    $songName = $(this).text();
    fetchSong($songName);
});


function fetchSong($songName){
     
    $.ajax({
        type: "POST",
        url: "fetchSongs.php",
        data: { songName: $songName }
    }).done(function(location) {
        $("source").attr('src', location);
        audio.load()
        togglePlayPause();
        return location;
    });
}