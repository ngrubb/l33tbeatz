// $('#songPanel').hide();
// $('.album').click(function() {
//     $('#albumPanel').animate({width: '55%'}, 1200, "linear");
//     $('#songPanel').delay(400).show(1500);
// });

$('.artist').click(function() {
    artist = $(this).text().replace(/[\s.,]/g,'');

    $('.album.'+artist+'').show(500);
    $('.song.'+artist+'').show(500);
    $('.album:not(.'+artist+')').hide(500);
    $('.song:not(.'+artist+')').hide(500);
});

$('.album').click(function() {
    album = $(this).children().children("p:first").text().replace(/[\s.,]/g,'');

    $('.'+album+'').show(500);
    $('.album:not(.'+album+')').hide(500);
    $('.song:not(.'+album+')').hide(500);

});

$('.song a:nth-child(2)').click(function() {
    $songName = $(this).text();
    songLocation = fetchSong($songName);
});

$('.song a:first-child').click(function() {
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









    // // Let's first create our request object:
    // var xmlhttp;
     
    // if (window.XMLHttpRequest){
    //     xmlhttp=new XMLHttpRequest();
    // }else{
    //     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    // }
     

    // // This code will be executed each time the readyState changes
    // xmlhttp.onreadystatechange = function(){
    //     if(ajaxRequest.readyState == 4){
            
    //     }
    // }
    // We'll send any data to the server through our request object
    // $.get("fetchSong.php", {songName:song} );
    // xmlhttp.open("GET","fetchSong.php?songName=s",true);
    // xmlhttp.send();
// document.getElementById("myData").innerHTML = xmlhttp.responseText;
