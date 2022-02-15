<?php 
	if (isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake']) && isset($_POST['fetch']) && ($_POST['fetch']==true)) {
        require 'db.php';
	        $user_id = $_COOKIE['user_id'];
	        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	        $query = mysqli_query($conn, $sql);
	        if ($query) {
	        $user = mysqli_fetch_array($query);
	        $user_image = $user['image'];
	        if ($user_image == ''){
	        	$user_image = "profile.png";
	        }
	        $fname = $user['fname'];
	        $lname = $user['lname'];
	        $user_name = $fname." ".$lname;
	        $user_friend_list = $fname."_".$lname."friend_list";
	        $user_discussion_list = $fname."_".$lname."_discussion_list";
	        $email = $user['email'];
	        $phone = $user['phone'];
	        $about = $user['about'];
	        // Starting the session
	        // Storing the value in session
	        $_SESSION['user_name'] = $user_name;
	        session_write_close();
        }
        else {
            echo "Error".mysqli_error($conn);

        }
    }
    else {
    	header('location: sign-in');
    }
?>									
										<?php
											require 'db.php';
											$get_discussions = "SELECT * FROM ".$user_discussion_list." ORDER BY `created_at` DESC";
											$get = mysqli_query($conn, $get_discussions);
											if ($get):
												$discussions = mysqli_fetch_all($get);
										?>
										<div class="list-group" id="chats" role="tablist">
										<?php
											foreach ($discussions as $discussion) {
												if ($discussion['1'] == $email) {
													$recipient = $discussion['2'];
													$sender = $discussion['1'];
												}
												else {
													$recipient = $discussion['1'];
													$sender = $discussion['2'];
												}
												if ($discussion['4'] == ($user['fname']."_".$user['lname'])) {
													$name = implode(' ', explode('_', $discussion['5']));
													$name1 = $discussion['5'];
												}
												else {
													$name = implode(' ', explode('_', $discussion['4']));
													$name1 = $discussion['4'];
												}
												$sql = "SELECT status FROM users WHERE email = '".$recipient."'";
												$sql1 = "SELECT image FROM users WHERE email = '".$recipient."'";
												$select = mysqli_query($conn, $sql);
												$select1 = mysqli_query($conn, $sql1);
												$result = mysqli_fetch_array($select);
												$result1 = mysqli_fetch_array($select1);
												$status = $result['0'];
												if ($status=='Online') {
													$status1 = 'active';
													$status2 = 'Active Now';
													$chat = "chat";
													$bubble = "online";
												}
												else {
													$status1 = 'inactive';
													$status2 = 'Inactive Now';
													$chat = "empty";
													$bubble = "offline";
												}
												if ($result1['0'] == '') {
													$image = 'profile.png';
												}
												else {
													$image = $result1['0'];
												}
										        $bond = [];
										        $bond[] = md5($sender);
										        $bond[] = md5($recipient);
										        sort($bond);
										        $bond = implode('.', $bond);
										        $read_counts = $discussion['9'];
										        $unread_counts = $discussion['10'];
										        if ($read_counts > 0) {
							                    	$badge = '';
										         	$counts = '';
							                    }
							                    else {
										         	$badge = 'new bg-yellow';
										         	$counts = $unread_counts;
							                    }
										        if ($discussion['9'] == 1) {
										        	$seen = 'read';
										        }
										        else{
										        	$seen = 'unread';
										        }
										        if (strlen($discussion['8'])>30) {
										       		$discussion['8'] = substr_replace($discussion['8'], '...', 37);
										        }
										        else {
										        	$discussion['8'] = $discussion['8'];
										        }
										        if ($discussion['11'] == 1) {
										        	$blocked = "<i class=\'material-icons\'>block</i>Unblock Contact";
										        }
										        else {
										        	$blocked = "<i class=\'material-icons\'>block</i>Block Contact";
										        }
												echo "
													<!--Available Chat-->
													<a href='#list-".$chat."' class='filterDiscussions all ".$seen." ".$status." single' id='list-chat-list' data-toggle='list' role='tab'onclick=\"$('#sidebar').addClass('mini');$('#nav-tabContent').addClass('mini');$('#active-message-box').load('message', {'fetch' : true, 'bond' : '".$bond."'});$('.material-icons').addClass('".$bubble."');$('#active-friend-name').html('".$name."');$('#active-friend-status').attr('src', 'dist/img/avatars/".$image."');$('.avatar-xxl').attr('src', 'dist/img/avatars/".$image."');$('div#data > span').html('".$status2."');$('#active-friend-status').attr('title', '".$name."');$('#chat1').removeClass('hide');$('#active-friend-status').attr('recipient', '".$recipient."');$('#active-friend-status').attr('sender', '".$sender."');$('#active-friend-status').attr('bond', '".$bond."');$('#active').html('".$bond."');$('#active-name').html('".$name."');$('#content').animate({ scrollTop: 10000000 },1500);$('#inactive-content').animate({ scrollTop: 10000000 },1500);$('body,html').animate({ scrollTop: $(document).height() }, 600);$.ajax ({url: 'seen', type: 'POST', data: {'seen': true, 'bond': '".$bond."'}, success: function (data){}, error: function (data) {} });$('#active-block').html('".$blocked."');$('.all-discussions').load('discussions', {'fetch' : true});U__wjbb_WoXomqg0gWenL0tC6_flf();__G__QeRWeD2_O5waqT2F2FliVDlb3a__o5NJBNb97pj52He__1();$('#nav-tabContent').removeClass('mini');\">
													<!--Empty Chat-->
													<!--<a href='#list-empty' class='entertainment filterDiscussions all unread single' id='list-empty-list' data-toggle='list' role='tab'>-->

														<img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".$name."' alt='avatar'>
														<div class='status'>

															<!--Online-->
															<i class='material-icons ".$bubble."'>fiber_manual_record</i>

															<!--Offline-->
															<!--<i class='material-icons offline'>fiber_manual_record</i>-->
														</div>


														<!--New Message-->
														<div class='".$badge."'>
															<span>".$counts."</span>
														</div>

														<div class='data'>
															<h5>".$name."</h5>
															<span>".date('h:i A', strtotime($discussion['12']))."</span>
															<p id='".$bond."'>".$discussion['8']."</p>
														</div>
													</a>";
													
												}
											?>
											<?php else: ?>
											<?php echo mysqli_error($conn); ?>
										<?php endif; ?>
										</div>