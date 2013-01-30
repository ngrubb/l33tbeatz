<?php 
include ('../private_html/myTeamConnect.php');
include ('../private_html/loginCheck.php');

$pattern = '/[\s.,]*/'; 
$replace = '';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>L33T Beatz Library</title>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/library.css"/> 
    <link rel="stylesheet" href="css/font-awesome.css"/>
    <link href='http://fonts.googleapis.com/css?family=Unica+One|Ubuntu+Condensed|Droid+Sans|Ubuntu|Lato' rel='stylesheet' type='text/css'/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="css/popup.css"/>
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
        <div id="artistPanel">
            <div class="columnHeader">
                    <h4>Artists</h4>
            </div>

            <div class="artistListing">
                <p class="artist showAll lsf">view SHOW ALL</p>
                <?php
                    $artistList = mysql_query("SELECT Artist_First_Name, Artist_Last_Name, Band_Name FROM Library_V");

                    while($row = mysql_fetch_array($artistList)) {
                        $displayName = "";

                        if ($row['Band_Name'] == NULL) {
                            $displayName = $row['Artist_First_Name'] . " " . $row['Artist_Last_Name'] ;
                        }
                        else {
                            $displayName = $row['Band_Name'];
                        }

                        if ($displayName != $previousName) {
                            $sort_list[] = $displayName;
                        }

                        $previousName = $displayName; 
                    }                    

                    sort($sort_list);

                    foreach ($sort_list as $key => $val) {
                        echo "<p class='artist " . preg_replace($pattern, $replace, $val) . "'>" . $val . "</p>";
                    }
                ?>
            </div>
        </div>

        <div id="details">
            <div id="albumPanel">
                <div class="columnHeader">
                    <h4>Albums</h4>
                </div>

                <ul class="albumListing">

                    <?php
                        $albumList = mysql_query("SELECT Album_Name, Album_Artwork, Release_Date, Artist_First_Name, Artist_Last_Name, Band_Name FROM Album_Library_V");

                        while($row = mysql_fetch_array($albumList)) {
                            $displayName = "";


                            if ($row['Band_Name'] == NULL) {
                                $displayName = $row['Artist_First_Name'] . $row['Artist_Last_Name'] ;
                            }
                            else {
                                $displayName = $row['Band_Name'];
                            }

                            $albumName = $row['Album_Name'];

                            if ($albumName != $previousName) {
                                $albumArt = $row['Album_Artwork'];
                                if ($row['Album_Artwork'] == NULL){
                                    $albumArt = "music/album.png";
                                }
                                $releaseDate = $row['Release_Date'];
                                $artistClass = preg_replace( $pattern, $replace, $displayName);
                                $albumClass = preg_replace( $pattern, $replace, $albumName);
 
                                echo "<li class='album " . $artistClass . " " . $albumClass . "'>
                                        <a>
                                            <img src='" . $albumArt . "' width='150px' height='150px'/>
                                            <span><p class='albumName'>" . $albumName . "</p><p>"
                                                . $releaseDate . "</p></span>
                                            <p class='remove lsf'>remove</p>
                                        </a>
                                    </li>";
                            }

                            $previousName = $albumName;
                        }
                    ?>
                </ul>
            </div>

            <div id="songPanel">
                <div class="columnHeader">
                    <h4>Songs</h4>
                </div>

                <div class="songListing">
                    <?php

                        $songList = mysql_query("SELECT Song_Name, File_Path, Album_Name, Album_Artwork, Release_Date, Artist_First_Name, Artist_Last_Name, Band_Name FROM Library_V");

                        while($row = mysql_fetch_array($songList)) {
                            $displayName = "";


                            if ($row['Band_Name'] == NULL) {
                                $displayName = $row['Artist_First_Name'] . $row['Artist_Last_Name'];
                            }
                            else {
                                $displayName = $row['Band_Name'];
                            }

                            $albumName = $row['Album_Name'];
                            $songName = $row['Song_Name'];

                            if ($songName != $previousName) {
                                $filePath = $row['File_Path'];
                                $artistClass = preg_replace( $pattern, $replace, $displayName);
                                $albumClass = preg_replace( $pattern, $replace, $albumName);

                                echo "<div class='song " . $artistClass . " " . $albumClass . "'>
                                        <a class='playMedia lsf'>playmedia</a>
                                        <a>" . $songName . "</a>
                                        <a class='remove lsf'>remove</a>
                                        <a class='pencil lsf'>pencil</a>
                                        <a class='comment lsf'>notify</a>
                                        <a class='add lsf'>add</a>
                                      </div>";
                            }

                            $previousName = $songName;
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="addNew addContent">
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

            <span id="currentTime"></span>
            <span id="songDuration"></span>
    
            <button id="mute" class="lsf" onclick="toggleMute()">volumeup</button>
    
            <input id="volume" min="0" max="1" step="0.1" type="range" onchange="setVolume()">
        </div>

        <audio id="audio" controls>
            <source src=" " type="audio/mpeg" />
            This feature is not included in your browser. 
            Please update your browser or use a different browser to continue using L33T-Beatz.
        </audio>
    </div>
    
    <script type="text/javascript" src="js/lightbox.js"></script>
    <script type="text/javascript" src="js/library.js"></script>
    <script type="text/javascript" src="js/audio.js"></script>
    <script type="text/javascript" src="js/hoverEffects.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
</body>

</html>