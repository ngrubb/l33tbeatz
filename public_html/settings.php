<?php 
include ('../private_html/myTeamConnect.php');
include ('../private_html/loginCheck.php');
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>L33T Beatz | Settings</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/settings.css"> 
  <link rel="stylesheet" href="css/font-awesome.css">
  <link href='http://fonts.googleapis.com/css?family=Unica+One|Ubuntu+Condensed|Droid+Sans' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="js/dropdown.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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

	<div id="window">
		<h2>Settings</h2>
		<p>This is where you can change your basic user information.</p>
			<div class="formSection">
				<h3>Change Password</h3>
				<form id="form" name="passwordForm" method="post" action="private_html/changePassword.php">
					<div class="formItem">
						<label>Current Password
							<span class="small">Type in your current password</span>
						</label>
						<input type="password" name="password" class="password" />
					</div>

					<div class="formItem">
						<label>New Password
							<span class="small">Min. size 6 chars</span>
						</label>
						<input type="password" name="password1" class="password" />
					</div>

					<div class="formItem">
						<label>Retype Password
							<span class="small">Same as the one above</span>
						</label>
						<input type="password" name="password2" class="password" />
						<input type="submit" name="submit" value="Change Password" />
					</div>
				</form>
			</div><!-- end formSection -->

			<div class="formSection">
				<h3>User Settings</h3>
				<form id="form" name="userForm" method="post" action="private_html/changeSettings.php">
				<div class="formItem">
					<label>First Name
						<span class="small">We go by a first name basis here</span>
					</label>
					<input type="text" name="firstName" id="firstName" value="<?php echo $_SESSION['FirstName']; ?>"/>
				</div>
				
				<div class="formItem">
					<label>Last Name
						<span class="small">Just for future reference</span>
					</label>
					<input type="text" name="lastName" id="lastName" value="<?php echo $_SESSION['LastName']; ?>"/>
				</div>

				<div class="formItem">
					<label for="gender">Gender</label>
		        	<a id="maleIcon" class="lsf">male</a>
		        	<input type="radio" name="gender" id="gender" value="m"> 
		        	<a id="femaleIcon" class="lsf">female</a>
		        	<input type="radio" name="gender" id="gender" value="f"> 
					<input type="submit" name="submit" value="Save Settings" />		        	
				</div>
			</div><!--end formSection -->	
			<div id="clear"></div>
		</form> <!-- end settings -->


	<div class="formSection deleteAccount">
		<form method="post" action="private_html/delete.php">
			<h3>Delete Account</h3>
			<p>Warning: This will delete all account information and playlists for this user.</p>
			<input type="submit" name="delete" value="Delete Account" />
		</form>
	</div>
</div><!-- end window -->

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
</body>

</html>