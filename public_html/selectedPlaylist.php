<?php 
include ('../private_html/myTeamConnect.php');
include ('../private_html/loginCheck.php');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>L33T Beatz Playlists</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/selectedPlaylist.css"> 
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/popup.css">
    <link href='http://fonts.googleapis.com/css?family=Unica+One|Ubuntu+Condensed|Droid+Sans|Ubuntu' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script>
    $(function() {
        $( "#playlistTracks" ).sortable({
            placeholder: "ui-state-highlight"
        });
        $( "#playlistTracks" ).disableSelection();
    });
    </script>
</head>

<body>
        <header>
        <a href="library.php"><h1>L33T-BEATz</h1></a>

        <form method="get" action="search.php" id="search">
            <input name="search" type="text" size="40" placeholder="Search..." />
        </form>

        <div id="dd" class="wrapper-dropdown" tabindex="1"><?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?>
            <ul class="dropdown">
                <li><a href="settings.php"><i class="icon-cog"></i>Settings</a></li>
                <li><a href="private_html/logout.php"><i class="icon-remove"></i>Log out</a></li>
            </ul>
        </div>
    </header>
    
    <div id="sideNav">
        <a href="library.php"><h3>L1BR4RY</h3></a>
        <a href="playlists.php"><h3>PL4YL1STS</h3></a>
    </div>

    <div id="window">

        <div class="removeButton deletePlaylist">
            <a class="button red lsf">remove</a>
        </div>

<?php
    // Set playlist variables from the database
    $playlist = $_GET['playlist'];
    $_SESSION['Playlist'] = $playlist;
    $playlistQuery = mysql_query("SELECT * FROM Playlist_V WHERE Playlist_Title = '".$playlist."' ");
    $songCount = mysql_num_rows($playlistQuery);
?>

        <div id="playlistDetails">   
            <div id="selectedHeader">
                <div class="headerIcon">
                    <img src="img/cassette2.png" height="138" width="215" alt="Playlist" />
                </div>

                <div id="playlistInfo">
                    <div class="playlistTitle">
                        <h4><?php echo $playlist;?></h4>
                    </div>  
                    <div class="songCount">
                        <h6><?php echo $songCount;?> songs</h6>
                    </div>
                </div>
            </div>

            <ul id="playlistTracks">
<?php //Loop to display songs
 while ($playlistResults = mysql_fetch_array($playlistQuery)) {                
            $songName = $playlistResults['Song_Name'];

            if ($playlistResults['Band_Name'] == NULL) {
                $artist = $playlistResults['Artist_First_Name'] . $playlistResults['Artist_Last_Name'] ;
            }
            else {
                $artist = $playlistResults['Band_Name'];
            }
            
            $songLength = $playlistResults['Song_Length'];
            ?>
                <li class="track">
                    <button class="playHidden lsf" hidden>playmedia</button>
                    <div class="trackInfo">
                        <p class="trackTitle"><?php echo $songName; ?></p>
                        <p class="trackArtist">by <?php echo $artist; ?></p>
                    </div>
                    <p class="trackTime"><?php echo $songLength; ?></p>
                </li> 
                <?php } ?>
            </ul>
        </div>

        <div id="playlistLength">
        </div>
    </div>

    <div id="player">
        <div id="controls">
            <button id="restart" class="lsf" onclick="restartAudio();">reload</button>
    
            <button id="playpause" class="lsf" title="play" onclick="togglePlayPause()">play</button>
    
            <canvas id="canvas" width="800" height="20">
                Canvas Not Supported
            </canvas>
    
            <button id="mute" class="lsf" onclick="toggleMute()">volumeup</button>
    
            <input id="volume" min="0" max="1" step="0.1" type="range" onchange="setVolume()">
        </div>

        <audio id="audio" controls>
            <source src="mp3/Only_Heather.mp3" type="audio/mpeg" />
            This feature is not included in your browser. 
            Please update your browser or use a different browser to continue using L33T-Beatz.
        </audio>
    </div>

    <script type="text/javascript" src="js/audio.js"></script>
    <script type="text/javascript" src="js/playlist.js"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
</body>

</html>

