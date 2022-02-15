/*Covenant T. Elijah*/

//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("active-mic");
var stopButton = document.getElementById("active-stop");
var textarea = document.getElementById('display');
var emoji =document.getElementById('test');
var send =document.getElementById('active-send');
var attach1 =document.getElementById('active-attach1');
var attach2 =document.getElementById('active-attach2');

//var pauseButton = document.getElementById("pauseButton");

var count = document.getElementById('count');

stopButton.style.display = 'none';
count.style.display = 'none';

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
//pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video: false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.style.display = 'none';
	textarea.style.display = 'none';
	emoji.style.display = 'none';
	//send.style.display = 'none';
	attach1.style.display = 'none';
	attach2.style.display = 'none';
	stopButton.style.display = 'block';
	//pauseButton.disabled = false
	count.style.display = 'block';

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		//document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record();


		console.log("Recording started");

		var recipient = $('#active-friend-status').attr('recipient'); var sender = $('#active-friend-status').attr('sender'); var bond = []; bond = [recipient, sender]; bond.sort(); bond = bond.join('|'); $.ajax({url: 'typing?rec', type: 'POST', data: {'typing': true, 'bond': bond }, success: function(data) {}, error: function(data) {} });
		

		var audio=document.getElementById('audio4');audio.play();
	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.style.display = 'block';
		stopButton.style.display = 'none';
    	//pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		//rec.stop();
		//pauseButton.innerHTML="Resume";
	}else{
		//resume
		//rec.record()
		//pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	recordButton.style.display = 'block';
	textarea.style.display = 'block';
	emoji.style.display = 'block';
	//send.style.display = 'block';
	attach1.style.display = 'block';
	attach2.style.display = 'block';
	stopButton.style.display = 'none';
	//pauseButton.disabled = true;
	count.style.display = 'none';


	//reset button just in case the recording is stopped while paused
	//pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	var audio=document.getElementById('audio5');audio.play();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);

	var user = $('title').html(); var recipient = $('.connect').attr('recipient'); var sender = $('.connect').attr('sender'); var bond = []; bond = [recipient, sender]; bond.sort(); bond = bond.join('|'); $.ajax({url: 'typing', type: 'POST', data: {'typed': true, 'user': user, 'bond': bond }, cache: false, success: function(data) {$('#typing').html('');$("#content").animate({scrollTop: 100000 }, 100); }, error: function(data) {} });

	$("#content").animate({scrollTop: 100000 }, 2000);
}

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var filename = Date.now();
	var au = document.createElement('audio');
	var div = document.createElement('div');
	div.class = blob;
	var link = document.createElement('a');
	var audio = document.getElementById('audio1');
	//name of .wav file to use during upload and download (without extendion)

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	//link.href = url;
	//link.download = filename+".wav"; //download forces the browser to donwload the file using the filename
	//link.innerHTML = "Save to disk";

	//add the new audio element to div
	div.appendChild(au);
	
	//add the filename to the li
	//div.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to div
	//div.appendChild(link);
	
	//upload link
	var upload = document.createElement('a');
	div.id = filename.toString(36);
	upload.innerHTML = "<i class='material-icons'>cloud_upload</i>";
	div.appendChild(document.createTextNode (" "))//add a space in between
	div.appendChild(upload)//add the upload link to div
	//add the li element to the ol
	recordingsList.appendChild(div);
	upload.addEventListener("click", function(event){
		  var xhr=new XMLHttpRequest();
		  xhr.onload=function(e) {
		      if(this.readyState === 4) {
		          if (e.target.responseText != '') {
		          	//recordingsList.innerHTML = '';
		          	$('#recordingsList').children('#'+div.id).remove();
		          	$('#active-message-box').append("<div class='message me zoomInLeft'> <div class='text-main'> <div class='text-group me'> <div class='text me' onmouseup=''> <p id='exec'><audio controls='' src='assets/audio/audioclip-"+filename+".wav'></audio></p> </div> </div> <span><i class='material-icons'>check</i>"+e.target.responseText+"</span> </div> </div>");
		          	audio.play();
		          }
		      }
		  };
		  var fd = new FormData();
		  fd.append("audio_data", blob, filename);
		  var bond = $('#active-friend-status').attr('bond');
		  var recipient = $('.connect').attr('recipient');
		  xhr.open("POST", "cloud-my-voice?baCwz5K8baCwz5K8mFSv0Pxax86eJgAmFSv0Pxax86eJgA="+bond+"&note-to-you="+recipient+"&iso="+filename+"", true);
		  try{
		  	xhr.send(fd);
		  }
		  catch(error){
			sweetAlert("Oops...","Check your internet coonection !!","error");
		  }
		  $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });
		  $('#chat').load('chats?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });
		  /*var bond=$('#active-friend-status').attr('bond'); $.ajax({url: 'new-message?%__242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', type: 'POST', data: {'fetch': true, 'bond': bond}, success: function(data) {if (data=="<svg viewBox='0 0 24 24' fill='#bdbac2' id='dark' style='-webkit-user-select: none;margin: 5% 20%;cursor: pointer; text-align: center; height: 50px; width: 60%!important;'><g><path d='M1.626 17.87c.125 0 .253-.03.37-.098.36-.205.485-.663.28-1.023-.355-.627-.544-1.343-.544-2.07 0-2.218 1.732-4.02 3.913-4.172.018.282.046.564.096.84.067.36.383.614.738.614.045 0 .09-.004.136-.012.407-.074.678-.465.604-.873-.062-.34-.094-.69-.094-1.04 0-3.204 2.606-5.81 5.81-5.81.58 0 1.15.085 1.702.253.394.123.814-.103.937-.498.12-.396-.103-.815-.5-.937-.69-.21-1.41-.318-2.14-.318-3.673 0-6.714 2.727-7.225 6.262-3.04.118-5.475 2.62-5.475 5.69 0 .986.256 1.958.74 2.81.138.243.39.38.653.38zm18.554-6.802c.03-.312.063-.78.063-1.032 0-.59-.07-1.177-.21-1.745-.1-.4-.503-.645-.907-.55-.402.1-.648.506-.55.908.11.45.167.92.167 1.388 0 .203-.03.615-.055.888-2.067.132-3.816 1.567-4.306 3.603-.097.402.15.808.555.904.397.094.808-.15.904-.554.352-1.46 1.647-2.48 3.15-2.48 1.788 0 3.242 1.455 3.242 3.242s-1.454 3.24-3.24 3.24H8.454c-.414 0-.75.336-.75.75s.336.75.75.75H18.99c2.615 0 4.742-2.126 4.742-4.74 0-2.2-1.514-4.038-3.55-4.57zm.878-8.848c-.293-.293-.768-.293-1.06 0l-19 19c-.294.293-.294.768 0 1.06.145.147.337.22.53.22s.383-.072.53-.22l19-19c.293-.293.293-.767 0-1.06z'></path></g></svg>") {document.getElementById('id07').style.display = 'block'; } else{$('#recordingsList').children('div:first-of-type').remove();$('#active-message-box').append(data);var audio = document.getElementById('audio1'); audio.play();}}});*/
		  $("#content").animate({scrollTop: 10000 }, 'slow')
	})
}