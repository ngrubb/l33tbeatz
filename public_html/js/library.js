

$('.artist').click(function() {
    artist = $(this).text().replace(/[\s.,]/g,'');

    $('.album.'+artist+'').show(500);
    $('.song.'+artist+'').show(500);
    $('.album:not(.'+artist+')').hide(500);
    $('.song:not(.'+artist+')').hide(500);
});

$('.artist.showAll').click(function() {
    $('.artist').show(500);   
    $('.album').show(500);
    $('.song').show(500);
});

$('.album').click(function() {
    album = $(this).children().children().children("p:first").text().replace(/[\s.,]/g,'');

    $('.'+album+'').show(500);
    $('.album:not(.'+album+')').hide(500);
    $('.song:not(.'+album+')').hide(500);

});

//Delete song
$('.song a.remove').click(function() {
    $deleteSongName = $(this).parent().children('a:nth-child(2)').text();
 lightbox('<form action="" method="get"><div class="lightboxHeader"><h2>Delete Content:</h2></div><div class="lightboxBody"><div class="message"><p>Are you sure you want to delete this item?<p></div></div><div class="lightboxFooter"><div class="lightboxButtons"><input type="hidden" name="songName" value="'+$deleteSongName+'"><button class="button red" formaction="private_html/deleteSong.php" formmethod="get">Delete Content</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div></form>');
});

//Delete Album
$('.album p.remove').click(function() {
    $deleteAlbumName = $(this).parent().children('span').children('p.albumName').text();
 lightbox('<form action="" method="get"><div class="lightboxHeader"><h2>Delete Content:</h2></div><div class="lightboxBody"><div class="message"><p>Are you sure you want to delete this album?<p></div></div><div class="lightboxFooter"><div class="lightboxButtons"><input type="hidden" name="albumName" value="'+$deleteAlbumName+'"><button class="button red" formaction="private_html/deleteAlbum.php" formmethod="get">Delete Content</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div></form>');
});


//Edit Song Name
$('.song a.pencil').click(function(){
    $editSongName = $(this).parent().children('a:nth-child(2)').text();
    lightbox('<form action="" method="get"><div class="lightboxHeader"><h2>Edit Content:</h2></div><div class="lightboxBody"><div class="formRow"><div class="label">Song Name</div><div class="field"><input type="hidden" name="songName" value="'+$editSongName+'"><input type="text" class="title" name="editSongName" value="'+$editSongName+'"></div></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button blue" formaction="private_html/editSong.php" formmethod="get">Edit Content</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div></form>');
});

//Add Content
$('.addContent').click(function() {
    lightbox('<div class="lightboxHeader"><h2>Add Content:</h2></div><div class="lightboxBody"><button class="button blue" onclick="addArtist()">Artist</button><button class="button blue" onclick="addAlbum()">Album</button><button class="button blue" onclick="addSong()">Song</button></div></div><div class="lightboxFooter"></div>');
});

function addArtist() {
   lightbox('<form action="" method="get"><div class="lightboxHeader"><h2>Add Artist:</h2></div><div class="lightboxBody"><div class="formRow"><div class="label">Artist Name:</div><div class="field"><input type="text" name="newArtist" value=""></div></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button blue" type="submit" formaction="private_html/addArtist.php" formmethod="get">Add Content</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div>');
}

function addAlbum(){
    $.ajax({
        type: "GET",
        url: "getAlbums.php",
        success: function(data) {
            lightbox(data);
        },
        error: function(data){
            alert("fail");
        }
    });
}

function addSong(){
    $.ajax({
        type: "GET",
        url: "getSongs.php",
        success: function(data) {
            lightbox(data);
        },
        error: function(data){
            alert("fail");
        }
    });
}

// function addSong() {
//     lightbox('<form action="" method="get"><div class="lightboxHeader"><h2>Add Content:</h2></div><div class="lightboxBody"><button class="button blue" onclick="closeLightbox()">Artist</button><button class="button blue" onclick="closeLightbox()">Album</button><button class="button blue" onclick="closeLightbox()">Song</button></div></div><div class="lightboxFooter"></div>');
// }

$('.song a:nth-child(2)').click(function() {
    $songName = $(this).text();
    songLocation = fetchSong($songName);
});

$('.song a.playMedia').click(function() {
    $songName = $(this).next().text();
    songLocation = fetchSong($songName);
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

$('.song a.comment').click(function() {
    $songName = $(this).parent().children('a:nth-child(2)').text();
    readReviews($songName);
});

function writeReview() {
    $songName = $('.songName').text();
    lightbox('<div class="lightboxHeader"><h2>Write Review:</h2><p class="songName">' + $songName + '</p></div><div class="lightboxBody" id="content"><form action=""><div class="label">Title</div><div class="field"><input type="text" class="title" name="title" value=""></div><div class="label">Rating</div><div class="field"><select class="ratingSelect" name="rating"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div><div class="label content">Content</div><div class="field"><textarea name="content" rows="8" cols="30"></textarea></div></form></div><div class="lightboxFooter"><div class="lightboxButtons"><button onclick="writeToDB(title)" class="button blue">Submit Review</button><button class="button" onclick="closeLightbox()">Cancel</button></div></div>');
}

function readReviews($songName){
    $.ajax({
        type: "GET",
        url: "readReviews.php",
        data: { songName: $songName },
        success: function(data) {
            lightbox(data);
        },
        error: function(data){
            alert("fail");
        }
    });
}

function writeToDB(title){
    $content = $('textarea').val();
    $songName = $('.songName').text();
    $rating = $('.ratingSelect').val();
    $title = $('.title').val();

    $successHTML = '<div class="lightboxHeader"><h2>Write Review:</h2></div><div class="lightboxBody"><div class="message"><p class="lsf success">check</p><p>Thank you for your review!<p></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button" onclick="closeLightbox()">Ok</button></div></div>';
    
    $.ajax({
        type: "POST",
        url: "writeReview.php",
        data: { reviewContent: $content,
                reviewRating : $rating,
                reviewTitle: $title,
                reviewSongName: $songName
        },
        success: function(data) {
            lightbox($successHTML);
        },
        error: function(data){
            alert("fail");
        }
    });
}


$('.song a.add').click(function() {
    $songName = $(this).parent().children('a:nth-child(2)').text();
    loadPLs($songName);
});

function loadPLs($songName){
    $.ajax({
        type: "GET",
        url: "loadPlaylists.php",
        data: { songName: $songName },
        success: function(data) {
            lightbox(data);
        },
        error: function(data){
            alert("fail");
        }
    });
}

$('.addToPlaylist').click(function() {
    $songName = $(this).parent().children('a:nth-child(2)').text();
    loadPLs($songName);
});

function addToPlaylist(playlistName) {
    $playlistName = playlistName;
    $songName = $('.songName').text();

    $successHTML = '<div class="lightboxHeader"><h2>Write Review:</h2></div><div class="lightboxBody"><div class="message"><p class="lsf success">check</p><p>Added to "'+$playlistName+'" playlist!<p></div></div><div class="lightboxFooter"><div class="lightboxButtons"><button class="button" onclick="closeLightbox()">Ok</button></div></div>';
    
    $.ajax({
        type: "POST",
        url: "addToPlaylist.php",
        data: { playlistName: $playlistName,
                songName: $songName
            },
        success: function(data) {
            lightbox($successHTML);
        },
        error: function(data){
            alert("fail");
        }
    });
}

// $(document).ready(function() {  
//     $('#nav li a').click(function(){  
//     var toLoad = $(this).attr('href')+' #content';  
//     $('#content').hide('fast',loadContent);  
//     $('#load').remove();  
//     $('#wrapper').append('<span id="load">LOADING...</span>');  
//     $('#load').fadeIn('normal');  
//     function loadContent() {  
//         $('#content').load(toLoad,'',showNewContent())  
//     }  
//     function showNewContent() {  
//         $('#content').show('normal',hideLoader());  
//     }  
//     function hideLoader() {  
//         $('#load').fadeOut('normal');  
//     }  
//     return false;  
//     });  
// });



