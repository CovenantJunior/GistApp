//Append new message
function uns__JKlnU__hjh() {var bond = $('#active-friend-status').attr('bond'); $.ajax({url: 'new-message?%__242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', type: 'POST', data: {'fetch': true, 'bond': bond}, success: function(data) {if (data=="<svg viewBox='0 0 24 24' fill='#bdbac2' id='dark' style='-webkit-user-select: none;margin: 5% 20%;cursor: pointer; text-align: center; height: 50px; width: 60%!important;'><g><path d='M1.626 17.87c.125 0 .253-.03.37-.098.36-.205.485-.663.28-1.023-.355-.627-.544-1.343-.544-2.07 0-2.218 1.732-4.02 3.913-4.172.018.282.046.564.096.84.067.36.383.614.738.614.045 0 .09-.004.136-.012.407-.074.678-.465.604-.873-.062-.34-.094-.69-.094-1.04 0-3.204 2.606-5.81 5.81-5.81.58 0 1.15.085 1.702.253.394.123.814-.103.937-.498.12-.396-.103-.815-.5-.937-.69-.21-1.41-.318-2.14-.318-3.673 0-6.714 2.727-7.225 6.262-3.04.118-5.475 2.62-5.475 5.69 0 .986.256 1.958.74 2.81.138.243.39.38.653.38zm18.554-6.802c.03-.312.063-.78.063-1.032 0-.59-.07-1.177-.21-1.745-.1-.4-.503-.645-.907-.55-.402.1-.648.506-.55.908.11.45.167.92.167 1.388 0 .203-.03.615-.055.888-2.067.132-3.816 1.567-4.306 3.603-.097.402.15.808.555.904.397.094.808-.15.904-.554.352-1.46 1.647-2.48 3.15-2.48 1.788 0 3.242 1.455 3.242 3.242s-1.454 3.24-3.24 3.24H8.454c-.414 0-.75.336-.75.75s.336.75.75.75H18.99c2.615 0 4.742-2.126 4.742-4.74 0-2.2-1.514-4.038-3.55-4.57zm.878-8.848c-.293-.293-.768-.293-1.06 0l-19 19c-.294.293-.294.768 0 1.06.145.147.337.22.53.22s.383-.072.53-.22l19-19c.293-.293.293-.767 0-1.06z'></path></g></svg>") {document.getElementById('id07').style.display = 'block'; } else{$('#active-unsent').children('.message:first-of-type').remove();$('.empty').hide();$('#active-message-box').append(data); } } }) }

/*function _uns__JKlnU__hjhcjjwqewqwwnnn___() {var bond = $('#inactive-friend-status').attr('bond'); $.ajax({url: 'new-message?%__242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', type: 'POST', data: {'fetch': true, 'bond': bond}, success: function(data) {if (data=="<svg viewBox='0 0 24 24' fill='#bdbac2' id='dark' style='-webkit-user-select: none;margin: 5% 20%;cursor: pointer; text-align: center; height: 50px; width: 60%!important;'><g><path d='M1.626 17.87c.125 0 .253-.03.37-.098.36-.205.485-.663.28-1.023-.355-.627-.544-1.343-.544-2.07 0-2.218 1.732-4.02 3.913-4.172.018.282.046.564.096.84.067.36.383.614.738.614.045 0 .09-.004.136-.012.407-.074.678-.465.604-.873-.062-.34-.094-.69-.094-1.04 0-3.204 2.606-5.81 5.81-5.81.58 0 1.15.085 1.702.253.394.123.814-.103.937-.498.12-.396-.103-.815-.5-.937-.69-.21-1.41-.318-2.14-.318-3.673 0-6.714 2.727-7.225 6.262-3.04.118-5.475 2.62-5.475 5.69 0 .986.256 1.958.74 2.81.138.243.39.38.653.38zm18.554-6.802c.03-.312.063-.78.063-1.032 0-.59-.07-1.177-.21-1.745-.1-.4-.503-.645-.907-.55-.402.1-.648.506-.55.908.11.45.167.92.167 1.388 0 .203-.03.615-.055.888-2.067.132-3.816 1.567-4.306 3.603-.097.402.15.808.555.904.397.094.808-.15.904-.554.352-1.46 1.647-2.48 3.15-2.48 1.788 0 3.242 1.455 3.242 3.242s-1.454 3.24-3.24 3.24H8.454c-.414 0-.75.336-.75.75s.336.75.75.75H18.99c2.615 0 4.742-2.126 4.742-4.74 0-2.2-1.514-4.038-3.55-4.57zm.878-8.848c-.293-.293-.768-.293-1.06 0l-19 19c-.294.293-.294.768 0 1.06.145.147.337.22.53.22s.383-.072.53-.22l19-19c.293-.293.293-.767 0-1.06z'></path></g></svg>") {document.getElementById('id07').style.display = 'block'; } else{$('#inactive-message-box').append(data); $('#inactive-unsent').children('.message:first-of-type').remove(); } } }) }*/
//function U__wjbb_WoXomqg0gWenL0tC6_flf() {var data = 0; $.ajax({url: 'unread-count', type: 'POST', data: {'fetch': true }, success: function(data) {if (data > 0) {if ($('#chat1').hasClass('hide')) {$('.gist').show(); $('.gist > span').html(data); } else if (($('#chat1').hasClass('hide') == false) && ($(window).scrollTop() == $(document).scrollTop())) {leD___aRafrgtt_jbb_WXomqjjg0gWenL0tC6__(); var bond = $('#active').html(); $.ajax({url: 'seen', type: 'POST', data: {'seen': true, 'bond': bond }, success: function(data) {$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true }); $('.gist').show(); $('.gist > span').html(data); }, error: function(data) {} }) } } else {$('.gist').hide(); $('.gist > span').html(''); } }, error: function(data) {} }) }

//Update Unread Messages Count
function U__wjbb_WoXomqg0gWenL0tC6_flf() {const i = 0; $.ajax({url: 'unread-count', type: 'POST', data: {'fetch': true }, success: function(data) {data = parseInt(data); if (data > i) {$('.gist > span').html(data);$('.gist').removeClass('hide'); } else{$('.gist').addClass('hide');}}})}

//Get 'typing' trigger
function ___Att_jbb_WoXomqg0gWenL0tC6____() {var recipient = $('.connect').attr('recipient'); var sender = $('.connect').attr('sender'); var bond = []; bond = [recipient, sender]; bond.sort(); bond = bond.join('|'); if (bond.length > 1) {$('#typing').load('typing?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'bond': bond }); $('#typing').show();$("#content").animate({scrollTop: 10000}, 100);}}

//Remove 'typing' animation
function ___aRafrgtt_jbb_WXomqg0gWenL0tC6____() {$('#typing').html('');}

//Fetch notification
function leD___aRafrgtt_jbb_WXomqjjg0gWenL0tC6__() {var sender = $('#active-name').html(); $.ajax({url: 'notification', type: 'POST', data: {'delete': true, 'sender': sender }, success: function(data) {} }) }

//Checks new message
function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1() {
	var bond = $('#active-friend-status').attr('bond');
	if (bond != '') {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						//setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1, 2000);return;
					}					
					if (json.status !== true) {
						ajax.abort();setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1, 2000);return;
					}
					else {
						var audio=document.getElementById('audio1');audio.play();$("#content").animate({scrollTop: 10000}, 2000);uns__JKlnU__hjh();___Att_jbb_WoXomqg0gWenL0tC6____();ajax.abort();setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1, 2000);return;
					}
					
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();
				} else {
					setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1, 2000);return;
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();
				}
			}
			/*else if (this.readyState === 4 && this.status === 504) {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();
			}
			else {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();
			}*/

		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA='+bond+'', true);
		ajax.send();
	}
	else {
		//setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1, 20000);
	}
}
/*function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2() {
	var bond = $('#inactive-friend-status').attr('bond');
	if (bond != '') {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2();return;
					}
					if (json.status !== true) {
						
					}
					else {
						var audio=document.getElementById('audio1');audio.play();_uns__JKlnU__hjhcjjwqewqwwnnn___();$('#chat').load('chats?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });___Att_jbb_WoXomqg0gWenL0tC6____();$("#inactive-content").animate({scrollTop: 10000 }, 2000);
					}
					__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2();
				} else {
					__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2();
				}
			}
		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA='+bond+'', true);
		ajax.send();
	}
	else {
		setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2, 20000);
	}
}*/

//Fetch for unread message count
function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3() {
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200 && this.status < 400) {
			if (this.status === 200) {
				try {
					var json = JSON.parse(this.responseText);
				} catch {
					//setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3, 2000);return;
				}
				if (json.status !== true) {
					setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3, 2000);return;
				}
				else {
					U__wjbb_WoXomqg0gWenL0tC6_flf();$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3, 2000);return;
				}
				//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3();
			} else {
				setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3, 2000);return;
			}
		}
		/*else if (this.readyState === 4 && this.status === 504) {
			__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3();
		}
		else {
			__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3();
		}*/
	}
	ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?u-al-lg', true);
	ajax.send();
}

//Fetch typing signal
function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4() {
	var recipient = $('#active-friend-status').attr('recipient'); var sender = $('#active-friend-status').attr('sender'); var bond = []; bond = [recipient, sender]; bond.sort(); bond = bond.join('|');
	if (bond.length>1) {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						//setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4, 2000);return;
					}
					if (json.status !== true) {
						setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4, 2000);return;
					}
					else {
						___Att_jbb_WoXomqg0gWenL0tC6____();setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4, 2000);return;
					}
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4();
				} else {
					setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4, 2000);return;
				}
			}
			/*else if (this.readyState === 4 && this.status === 504) {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4();
			}
			else {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4();
			}*/
		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?kaun-typing-hai='+bond+'', true);
		ajax.send();
	}
	else {
		setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4, 2000);return;
	}
}

//Fecth for new unread message
function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5() {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5, 2000);return;
					}
					if (json.status !== true) {
						setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5, 2000);return;
					}
					else {
						U__wjbb_WoXomqg0gWenL0tC6_flf();
					}
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5();
				} else {
					setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5, 2000);return;
				}
			}
			/*else if (this.readyState === 4 && this.status === 504) {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5();
			}
			else {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5();
			}*/
		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?c-f-u-c', true);
		ajax.send();
}

//Get new messages
function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6() {
	var bond = $('img#active-friend-status').attr('sender')
	//var bond = $('#active-friend-status').attr('bond');
	if (bond != '') {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						//setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6, 2000);return;
					}					
					if (json.status !== true) {
						setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6, 2000);return;
					}
					else {
						/*uns__JKlnU__hjh();*/$('#chat').load('chats?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6, 2000);return;
					}
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();
				} else {
					//__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();
					setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6, 2000);return;
				}
			}
			/*else if (this.readyState === 4 && this.status === 504) {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();
			}
			else {
				__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();
			}*/
		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?__ALNI_Mb_lf-baC-v0Pxa-wz5K8mFSv0Pxax86eJgA='+bond+'', true);
		ajax.send();
	}
	else {
		//(function(){
			 //__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();
			 //setTimeout(arguments.callee, 20000);
			 setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6, 10000);
		//})();
	}
}
/*function __G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7() {
	var bond = $('#inactive-friend-status').attr('bond');
	if (bond != '') {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200 && this.status < 400) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7();return;
					}					
					if (json.status !== true) {
						
					}
					else {
						_uns__JKlnU__hjhcjjwqewqwwnnn___();$('#chat').load('chats?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true });
					}
					__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7();
				} else {
					__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7();
				}
			}
		}
		ajax.open('GET', 'u-lg-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA?__ALNI_Mb_lf-baC-v0Pxa-wz5K8mFSv0Pxax86eJgA='+bond+'', true);
		ajax.send();
	}
	else {
		setTimeout(__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7, 20000);
	}
}*/
$(document).ready(function(){/*__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();*//*__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__2();*/__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__3();__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__4();__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__5();__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__6();/*__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__7();*/U__wjbb_WoXomqg0gWenL0tC6_flf();});