$("document").ready(function() {
    sinchClient = new SinchClient({
        applicationKey: "YOUR_APP_KEY",
        capabilities: {calling: true, video: true},
        supportActiveConnection: true,
        onLogMessage: function(message) {
            console.log(message.message);
        },
    });

    var callClient;
    var call;

    $("#login").on("click", function (event) {
        event.preventDefault();
        
        var signUpObj = {};
        signUpObj.username = $("input#username").val();
        signUpObj.password = $("input#password").val();

        sinchClient.start(signUpObj, afterStartSinchClient());          
    });

    $("#signup").on("click", function (event) {
        event.preventDefault();
        
        var signUpObj = {};
        signUpObj.username = $("input#username").val();
        signUpObj.password = $("input#password").val();

        sinchClient.newUser(signUpObj, function(ticket) {
            sinchClient.start(ticket, afterStartSinchClient());
        });
    });

    function afterStartSinchClient() {
        // hide auth form
        $("form#authForm").css("display", "none");
        // show logged-in view
        $("div#sinch").css("display", "inline");
        // start listening for incoming calls
        sinchClient.startActiveConnection();
        // define call client (to handle incoming/outgoing calls)
        callClient = sinchClient.getCallClient();
        //initialize media streams, asks for microphone & video permission
        callClient.initStream();
        //what to do when there is an incoming call
        callClient.addEventListener(incomingCallListener);
    }

    $("#call").on("click", function (event) {
        event.preventDefault();
    	if (!call) {
            usernameToCall = $("input#usernameToCall").val()
            $("div#status").append("<div>Calling " + usernameToCall + "</div>");
        	call = callClient.callUser(usernameToCall);
        	call.addEventListener(callListeners);
    	}   
    });

    $("#answer").click(function(event) {
        event.preventDefault();
        if (call) {
            $("div#status").append("<div>You answered the call</div>");
        	call.answer();
        }
    });

    $("#hangup").click(function(event) {
        event.preventDefault();
        if (call) {
            $("div#status").append("<div>You hung up the call</div>");
        	call.hangup();
        	call = null
        }
    });

    var incomingCallListener = {
        onIncomingCall: function(incomingCall) {
            $("div#status").append("<div>Incoming Call</div>");
            call = incomingCall;
            call.addEventListener(callListeners);
        }
    }

    var callListeners = {
        onCallProgressing: function(call) {
            $("div#status").append("<div>Ringing</div>");
        },
        onCallEstablished: function(call) {
            $("div#status").append("<div>Call established</div>");
            $("video#outgoing").attr("src", call.outgoingStreamURL);
            $("video#incoming").attr("src", call.incomingStreamURL);
        },
        onCallEnded: function(call) {
            $("div#status").append("<div>Call ended</div>");
            $("video#outgoing").attr("src", "");
            $("video#incoming").attr("src", "");
            call = null;
        }
    }        
});