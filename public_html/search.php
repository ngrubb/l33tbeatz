<?php 
include ('../private_html/myTeamConnect.php');
include ('../private_html/loginCheck.php');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>L33T Beatz Playlists</title>
    <link rel="stylesheet" href="css/search.css"> 
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href='http://fonts.googleapis.com/css?family=Unica+One|Ubuntu+Condensed|Droid+Sans' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/audio.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
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

    <?php
    $search = '';
    if (isset($_GET['search'])) {
        $search = mysql_real_escape_string($_GET['search']);  
        $artistQuery = mysql_query("SELECT * FROM Artist WHERE Artist_First_Name LIKE '%$search%'
                                                            OR Artist_Last_Name LIKE '%$search%' ");
        $bandQuery = mysql_query("SELECT * FROM Artist WHERE Band_Name LIKE '%$search%'");
        $albumQuery = mysql_query("SELECT * FROM Library_V WHERE Album_Name LIKE '%$search%'");
        $songQuery = mysql_query("SELECT * FROM Library_V WHERE Song_Name LIKE '%$search%'");
        $playlistQuery = mysql_query("SELECT * FROM Playlist WHERE Playlist_Title LIKE '%$search%'");

    
    ?>

    <div id="window">
       <div id="searchHeader">
            <h4 id="searchIcon" class="lsf">search</h4>
            <h4 id="searchText">S3ARCH RESULTS for "<?php echo "$search"; ?>":</h4>
       </div>

        <div id="searchResults">

        <?php
        //Search for Artist
        if(mysql_num_rows($artistQuery) >= 1) {
            while ($artistResults = mysql_fetch_array($artistQuery)) {
                ?>
                <div class="result">
                <p class="searchLabel artistLabel">[ARTIST]</p>
                <p class="foundElement"><?php echo "$artistResults[Artist_First_Name]" . " $artistResults[Artist_Last_Name]";?></p>
                </div><?php
            }        
        } 
        //Search for Artist
        if(mysql_num_rows($bandQuery) >= 1) {
            while ($bandResults = mysql_fetch_array($bandQuery)) {
                ?>
                <div class="result">
                <p class="searchLabel artistLabel">[ARTIST]</p>
                <p class="foundElement"><?php echo "$bandResults[Band_Name]";?></p>
                </div><?php
            }        
        } 
        //Search for Album
        if(mysql_num_rows($albumQuery) >= 1) {
            while ($albumResults = mysql_fetch_array($albumQuery)){
                ?>
                <div class="result">
                <p class="searchLabel albumLabel">[ALBUM]</p>
                <p class="foundElement"><?php echo "$albumResults[Album_Name]";?></p>
                <p class="artistInfo">by <?php echo "$albumResults[Artist_First_Name]" . " $albumResults[Artist_Last_Name]" . "$albumResults[Band_Name]";?></p>
                </div><?php
            }
        } 
        //Search for Song
         if(mysql_num_rows($songQuery) >= 1) {
            while ($songResults = mysql_fetch_array($songQuery)){
                ?>
                <div class="result">
                <p class="searchLabel songLabel">[SONG]</p>
                <p class="foundElement"><?php echo "$songResults[Song_Name]";?></p>
                <p class="artistInfo">by <?php echo "$songResults[Artist_First_Name]" . " $songResults[Artist_Last_Name]" . "$songResults[Band_Name]";?> from <?php echo "$songResults[Album_Name]";?></p>
                </div><?php
            }
        } 
        //Search for Playlist
         if(mysql_num_rows($playlistQuery) >= 1) {
            while ($playlistResults = mysql_fetch_array($playlistQuery)){
                ?>
                <div class="result">
                <p class="searchLabel albumLabel">[PLAYLIST]</p>
                <p class="foundElement"><?php echo "$playlistResults[Playlist_Title]";?></p>
                </div><?php
            }
        } 

    elseif (mysql_num_rows($playlistQuery) ==0 AND mysql_num_rows($songQuery) ==0 AND mysql_num_rows($albumQuery) ==0 AND mysql_num_rows($artistQuery) == 0 AND mysql_num_rows($bandQuery) == 0) {
        ?>
        <div class="result">
        <p class="foundElement artistLabel">No results found. Please search again.</p>
        </div><?php
        }
    }
        ?>

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
            <source src="mp3/@deathgripz.mp3" type="audio/mpeg" />
            This feature is not included in your browser. 
            Please update your browser or use a different browser to continue using L33T-Beatz.
        </audio>
    </div>
</body>

</html>

