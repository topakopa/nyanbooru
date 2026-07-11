var player;
function pauseButton() {
  button = document.getElementById("play");
  if (player.togglePause()) button.innerHTML = "Пауза";
  else button.innerHTML = "Играть";
}

function setMetadata(filename) {
  var metadata = player.metadata();
  if (metadata["title"] != "") {
    document.getElementById("audio-title").innerHTML = metadata["title"];
  } else {
    document.getElementById("audio-title").innerHTML = filename;
  }
  if (metadata["message"] != "") {
    document.getElementById("modmessage").parentElement.style.display = "";
    document.getElementById("modmessage").innerHTML = metadata["message"];
  }

  updateDuration();

  var stack = stackSave();
  document.getElementById("library-version").innerHTML =
    "Library version: libopenmpt " +
    UTF8ToString(
      libopenmpt._openmpt_get_string(asciiToStack("library_version")),
    ) +
    " (" +
    UTF8ToString(libopenmpt._openmpt_get_string(asciiToStack("build"))) +
    ")";
  stackRestore(stack);
}

function updateDuration() {
  var sec_num = player.duration();
  var minutes = Math.floor(sec_num / 60);
  var seconds = Math.floor(sec_num % 60);
  if (seconds < 10) {
    seconds = "0" + seconds;
  }
  document.getElementById("audio-duration").innerHTML = minutes + ":" + seconds;
  document.getElementById("audio-seekbar").max = sec_num;
}

if (typeof ChiptuneAudioContext == "undefined") {
  document.getElementById("play").innerHTML =
    "The player requires a recent web browser with HTML5 audio context support.";
}
function initPlayer() {
  libopenmpt.onRuntimeInitialized = (_) => {
    player = new ChiptuneJsPlayer(new ChiptuneJsConfig(-1));

    path = document.getElementById("audio-download").href;
    player.load(path, function (buffer) {
      if (player.play(buffer)) {
        document.getElementById("play").innerHTML = "Пауза";
      } else {
        document.getElementById("play").innerHTML = "Играть";
      }
      setMetadata(document.getElementById("modfilename").innerHTML);
      setInterval(progress, 500);
    });
    console.log("Плеер запустился :3");
  };
}

function progress() {
  document.getElementById("audio-seekbar").value = player.getPosition();
}
