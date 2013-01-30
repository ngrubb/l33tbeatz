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
    <link rel="stylesheet" href="css/playlists.css"> 
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/popup.css">
    <link href='http://fonts.googleapis.com/css?family=Unica+One|Ubuntu+Condensed|Droid+Sans|Ubuntu' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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
        <div id="playlistHeader">
            <h4>PL4YL1STS:</h4>
        </div>

<?php
    $playlistQuery = mysql_query("SELECT * FROM Playlist");

    if(mysql_num_rows($playlistQuery) >= 1) {
        while ($playlistResults = mysql_fetch_array($playlistQuery)) {                
            $playlistTitle = $playlistResults['Playlist_Title'];
            $playlistURL = "selectedPlaylist.php?playlist=$playlistTitle";
            ?>

            <a href="<?php echo $playlistURL; ?>">
            <div class="playlist">
                <div class="playlistIcon">
                    <img src="img/cassette2.png" height="138" width="215" alt="Playlist" />
                </div>

                <div class="playlistInfo">
                    <h5><?php echo $playlistTitle; ?></h5>
                </div>
            </div>
            </a>
            <?php
        }
    }
    ?>
        <div class="addNew addPlaylist">
            <a class="button lsf">addnew</a>
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
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
</body>

</html>

