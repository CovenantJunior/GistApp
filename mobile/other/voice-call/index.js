var global_username = '';

sinchClient = new SinchClient({
	applicationKey: 'a5d826f0-4a0a-48a1-8f82-6e7b5c641d5a',
	capabilities: {calling: true},
});

var clearError = function() {
	$('div.error').text("");
}

var showCall = function() {
    $('form#auth').css('display', 'none');
    $('div#call').show();
    $('span#username').append(global_username);
}

var handleError = function(error) {
	$('button#createUser').attr('disabled', false);
	$('button#loginUser').attr('disabled', false);
	$('div.error').text(error.message);
}

$('button#createUser').on('click', function(event) {
    event.preventDefault();
    $('button#createUser').attr('disabled', true);
    $('button#loginUser').attr('disabled', true);
	clearError();
    
	var username = $('input#username').val();
	var password = $('input#password').val();
    
    var loginObject = {username: username, password: password};
	sinchClient.newUser(loginObject, function(ticket) {
		sinchClient.start(ticket, function() {
			global_username = username;
			showCall();
		}).fail(handleError);
	}).fail(handleError);
});

$('button#loginUser').on('click', function(event) {
    event.preventDefault();
    $('button#createUser').attr('disabled', true);
    $('button#loginUser').attr('disabled', true);
	clearError();
    
	var username = $('input#username').val();
	var password = $('input#password').val();

    var loginObject = {username: username, password: password};
	sinchClient.start(loginObject, function() {
		global_username = username;
		showCall();
	}).fail(handleError);
});

var callListener = {
	onCallProgressing: function(call) {
		$('div#callLog').append("<div>Ringing...</div>");
	},
	onCallEstablished: function(call) {
        $('audio#incoming').attr('src', call.incomingStreamURL);
		$('div#callLog').append("<div>Call answered</div>");
	},
	onCallEnded: function(call) {
        $('audio#incoming').removeAttr('src');
		$('button#call').removeAttr('disabled');
		$('button#answer').removeAttr('disabled');
		$('div#callLog').append("<div>Call ended</div>");
	}
}

var callClient = sinchClient.getCallClient();
var call;

callClient.addEventListener({
  onIncomingCall: function(incomingCall) {
	$('div#callLog').append("<div>Incoming call from " + incomingCall.fromId + "</div>");

    call = incomingCall;
    call.addEventListener(callListener);
  }
});

$('button#answer').click(function(event) {
	event.preventDefault();
	clearError();

	try {
		call.answer();
        $('button#answer').attr('disabled', 'disabled');
        $('button#call').attr('disabled', 'disabled');
	} catch(error) {
		handleError(error);
	}
});

$('button#call').click(function(event) {
	event.preventDefault();
	clearError();

	$('button#call').attr('disabled', 'disabled');
    $('button#answer').attr('disabled', 'disabled');
	$('div#callLog').append("<div>Calling " + $('input#callUsername').val() + "</div>");

	call = callClient.callUser($('input#callUsername').val());
	call.addEventListener(callListener);
});

$('button#hangup').click(function(event) {
	event.preventDefault();
	clearError();
    
	call && call.hangup();
});




