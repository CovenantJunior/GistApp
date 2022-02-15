#Turn Your Browser Into a Phone With the Sinch JS SDK

This tutorial will walk you through building a web app to make VoIP calls between browsers. There are many scenarios in which this is useful, including anonymously connecting users on a dating website, securely connecting buyers with sellers in a marketplace and allowing users to make low-cost international calls.

The UI isn't anything to write home about, but the finished web app will looking something like this:

![overview](images/overview.png)

The finished code for this tutorial can be found on [our Github](https://github.com/sinch/js-web-calling).

##Setup
1. If you don’t have a Sinch developer account, sign up and register a new app at 
[www.sinch.com/signup](https://www.sinch.com/signup)
2. Download the SDK from [www.sinch.com/js-sdk](https://www.sinch.com/js-sdk)
3. Create an index.html file with references to jQuery and the Sinch JavaScript SDK:

```
<head>
    <title>Sinch Web Calling</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="sinch.min.js"></script>
</head>
```

##Create the UI

There are two parts to the UI for this app: a login form and a call screen. Users will first see the login screen and after successfully logging in, they will see the call screen:

```
    <form id="auth">
        <input id="username" placeholder="username">
        <input id="password" type="password" placeholder="password">
        <button id="loginUser">Login</button>
        <button id="createUser">Signup</button>
    </form>

    <div id="call" style="display:none;">       
        current user: <span id="username"></span>
        <button id="logout">Logout</button>

        <form>
            <input id="callUsername" placeholder="username"><br>
            <button id="call">Call</button>
            <button id="hangup">Hangup</button>
            <button id="answer">Answer</button>

            <audio id="incoming" autoplay></audio>
            <div id="callLog"></div>
        </form>
    </div>
```
    
Lastly, a div at the bottom of the page to display any errors that might occur:

 ```<div class="error"></div>```
    
##Login and user registration

This section will demonstrate how to log in and register users using the Sinch SDK. For this tutorial, you will use a very basic backend for user management to get started. You should not use this in a production environment. In production, you should use your own user authentication. You can find a [.net sample project here](https://github.com/sinch/net-backend-sample).

First, create an instance of the Sinch client:

```
    sinchClient = new SinchClient({
        applicationKey: 'your-app-key',
        capabilities: {calling: true},
    });
```
    
Then, either create or log in the user and start the Sinch client:

```
    //store the username of the current user
    var global_username = '';

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
    
    //handle errors
    var handleError = function(error) {
	     $('button#createUser').attr('disabled', false);
	     $('button#loginUser').attr('disabled', false);
	     $('div.error').text(error.message);
    }
    
    //clear out old errors
    var clearError = function() {
	    $('div.error').text("");
    }
    
    //show the call screen
    var showCall = function() {
        $('form#auth').css('display', 'none');
        $('div#call').show();
        $('span#username').append(global_username);
    }
```

##Make outgoing calls

Once a user is authenticated, you will use the Sinch call client to make outgoing calls. First, define a custom call listener. This lets you make decisions based on whether a call is ringing, connected or ended:

```
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
```
    
Then, define the Sinch call client and a variable to store the current call:

````  
 var callClient = sinchClient.getCallClient();
    var call;
````
    
When the call button is clicked, disable the call and answer buttons, tell the user who they are calling and initiate the call. Lastly, add a call listener to the current call.
    
```
    $('button#call').click(function(event) {
        event.preventDefault();
        clearError();

        $('button#call').attr('disabled', 'disabled');
        $('button#answer').attr('disabled', 'disabled');
        $('div#callLog').append("<div>Calling " + $('input#callUsername').val() + "</div>");

        call = callClient.callUser($('input#callUsername').val());
        call.addEventListener(callListener);
    });
```
    
To hang up the call:

```
    $('button#hangup').click(function(event) {
        event.preventDefault();
        clearError();
    
        call && call.hangup();
    });
```

##Receive incoming calls

Your app should also listen for incoming calls:

```
    callClient.addEventListener({
        onIncomingCall: function(incomingCall) {
        $('div#callLog').append("<div>Incoming call from " + incomingCall.fromId + "</div>");

        call = incomingCall;
        call.addEventListener(callListener);
        }
    });
```
    
##Test it

To test your app, open two browser windows, log in as two different users and make the call. Some browsers will ask for permission to use the microphone on your computer when you place the call.

Happy coding! If you have any questions, feel free to reach out to us on [Twitter](https://twitter.com/sinchdev) or via our [help page](https://www.sinch.com/support/).
