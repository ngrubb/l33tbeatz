// Grab a handle to the video
var audio = document.getElementById("audio");
// Turn off the default controls
audio.controls = false;
audio.addEventListener("timeupdate", updateProgress, false);


var durationDisplay = document.getElementById("songDuration");
// var duration = audio.duration;
// var dMinutes = Math.floor(duration / 60);   
// var dSeconds = duration % 60;
// durationDisplay.innerHTML = dMinutes + ":" + dSeconds;




//set up mouse click to control position of audio
canvas.addEventListener("click", function(e) {
   //this might seem redundant, but this these are needed later - make global to remove these
   var canvas = document.getElementById('canvas');            

   if (!e) {
      e = window.event;
   } 
   //get the latest windows event if it isn't set

   try {
      //calculate the current time based on position of mouse cursor in canvas box
      audio.currentTime = audio.duration * (e.offsetX / canvas.clientWidth);
    }
   catch (err) {
      // Fail silently but show in F12 developer tools console
      if (window.console && console.error("Error:" + err));
   }
}, true);
  

function togglePlayPause() {
   var playpause = document.getElementById("playpause");

   if (audio.paused || audio.ended) {
      playpause.title = "pause";
      playpause.innerHTML = "pause";
      audio.play();
   }
   else {
      playpause.title = "play";
      playpause.innerHTML = "play";
      audio.pause();
   }
}


function setVolume() {
var volume = document.getElementById("volume");
audio.volume = volume.value;

   if (audio.volume == 0) {
      document.getElementById("mute").innerHTML = "volumeoff";
   }
   else if (audio.volume <= .5){
      document.getElementById("mute").innerHTML = "volumedown";
   }
   else if (audio.volume > .5){
      document.getElementById("mute").innerHTML = "volumeup";
   }
}

function toggleMute() {
   audio.muted = !audio.muted;
   var mute = document.getElementById("mute");

   if (audio.muted){
      mute.innerHTML = "volumeoff";
      volume.value = 0;
   }
   if (!audio.muted) {
      mute.innerHTML = "volumeup";
      volume.value = audio.volume;
   }
}

function updateProgress() {
   //get current time in seconds
   var elapsedTime = Math.round(audio.currentTime);

   //update the progress bar
   if (canvas.getContext) {
      var ctx = canvas.getContext("2d");
      //clear canvas before painting
      ctx.clearRect(0, 0, canvas.clientWidth, canvas.clientHeight);
      ctx.fillStyle = "rgb(0,163,238)";
      var fWidth = (elapsedTime / audio.duration) * (canvas.clientWidth);
      if (fWidth > 0) {
         ctx.fillRect(0, 0, fWidth, canvas.clientHeight);
      }
  }
}

function reloadAudio() {
   audio.load();
}
//Restart the audio file to the beginning.
function restartAudio() {
   try {
      audio.currentTime = 0;
   }
   catch (e) {
   // Fail silently but show in F12 developer tools console
   if (window.console && console.error("Error:" + e));
   }
}

var timer = document.getElementById("currentTime");

audio.addEventListener("loadedmetadata", function() {
  durationDisplay.innerHTML = "/ " + formatTime(audio.duration);
}, false);
 
// Update the current time
audio.addEventListener("timeupdate", function() {
  timer.innerHTML = formatTime(audio.currentTime);
}, false);
 
function formatTime(time) {
  var 
    minutes = Math.floor(time / 60) % 60,
    seconds = Math.floor(time % 60);
 
  return   (minutes < 10 ? '0' + minutes : minutes) + ':' +
           (seconds < 10 ? '0' + seconds : seconds);
}
