//Copyright
//jQuery by TeaChat
$(window).on('beforeunload', function () {	
		$.ajax ({
			url: 'logout.php',
			type: 'GET',
			data: {'inactivity': true},
			success: function (data) {
				console.log('Session destroyed');
			},
			error: function (data) {
				// body...
			}
		})
});