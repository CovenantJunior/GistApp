function messageCount1() {var bond = $('#active-friend-status').attr('bond'); if (bond != '') {$.ajax({url: 'messageCount', type: 'POST', data: {'messageCount': true, 'bond': bond }, success: function(data) {var messageCount = parseInt(data); newCount1(messageCount); }, error: function() {} }) } function update(messageCount, newCount) {var bond = $('#active-friend-status').attr('bond'); if (messageCount < newCount) {$('#active-message-box').load('message', {'fetch': true, 'bond': bond }); $('.all-discussions').load('discussions', {'fetch': true });} else if (messageCount > newCount) {var audio = document.getElementById('audio1'); audio.play();$('#active-message-box').load('message', {'fetch': true, 'bond': bond }); $('.all-discussions').load('discussions', {'fetch': true }); } } function newCount1(messageCount) {var m = messageCount; setTimeout(function newCount(m) {var bond = $('#active-friend-status').attr('bond'); if (bond != '') {$.ajax({url: 'messageCount', type: 'POST', data: {'messageCount': true, 'bond': bond }, success: function(data) {var newCount = parseInt(data); update(messageCount, newCount); }, error: function() {} }) } }, 3000); } } (function() {messageCount1(); setTimeout(arguments.callee, 2000); } )()
function messageCount2() {var bond = $('#inactive-friend-status').attr('bond'); if (bond != '') {$.ajax({url: 'messageCount', type: 'POST', data: {'messageCount': true, 'bond': bond }, success: function(data) {var messageCount = parseInt(data); newCount2(messageCount); }, error: function() {} }) } function update(messageCount, newCount) {var bond = $('#inactive-friend-status').attr('bond'); if (messageCount < newCount) {$('#inactive-message-box').load('message', {'fetch': true, 'bond': bond }); $('.all-discussions').load('discussions', {'fetch': true }); } else if (messageCount > newCount) {var audio = document.getElementById('audio1'); audio.play();$('#inactive-message-box').load('message', {'fetch': true, 'bond': bond }); $('.all-discussions').load('discussions', {'fetch': true });} } function newCount2(messageCount) {var m = messageCount; setTimeout(function newCount(m) {var bond = $('#inactive-friend-status').attr('bond'); if (bond != '') {$.ajax({url: 'messageCount', type: 'POST', data: {'messageCount': true, 'bond': bond }, success: function(data) {var newCount = parseInt(data); update(messageCount, newCount); }, error: function() {} }) } }, 3000); } } (function() {messageCount2(); setTimeout(arguments.callee, 2000); } )()
setInterval(function unreadcounts() {var data = 0; $.ajax({url: 'unread-count', type: 'POST', data: {'fetch': true }, success: function(data) {if (data > 0) {if ($('#chat1').hasClass('hide')) {$('.all-discussions').load('discussions', {'fetch': true }); $('.gist').show(); $('.gist > span').html(data); } else if (($('#chat1').hasClass('hide') == false) && ($(window).scrollTop() == $(document).scrollTop())) {delete_notif(); var bond = $('#active').html(); $.ajax({url: 'seen', type: 'POST', data: {'seen': true, 'bond': bond }, success: function(data) {$('.all-discussions').load('discussions', {'fetch': true }); $('.gist').show(); $('.gist > span').html(data); }, error: function(data) {} }) } } else {$('.gist').hide(); $('.gist > span').html(''); } }, error: function(data) {} }) }, 2000);
function fetch() {var recipient = $('.connect').attr('recipient'); var sender = $('.connect').attr('sender'); var bond = []; bond = [recipient, sender]; bond.sort(); bond = bond.join('.'); if (bond.length > 1) {var oldHeight = 0; $('#typing').load('typing', {'bond': bond }); var newHeight = $('#typing').height(); if (newHeight > oldHeight) {$('#typing').show(); $("#content").animate({scrollTop: 1000000 }, 100); } else {$('#typing').hide(); } } }
setInterval(fetch, 2600);