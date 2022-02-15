var source = new EventSource('demo_sse');
	source.onmessage = function messageCount(event) {
		var a = event.data;
		console.log(a);				
	}