<?php
	/*if (isset($_COOKIE['dark'])) {
		header('location: dark://');
	}
	else{
		header('location: light://');
	}*/
?>
<?php
    if (isset($_COOKIE['user_id'])) {
        require 'db.php';
        $last_id = "SELECT LAST_INSERT_ID(frequency) FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
        $id  = mysqli_query($conn, $last_id);
        $get = mysqli_fetch_array($id);
        $frequency = ($get['0'] + 1)."Hz";
        $sql = "UPDATE users SET frequency = '".$frequency."' WHERE user_id = '".$_COOKIE['user_id']."'";
        $update = mysqli_query($conn, $sql);
    }
?>
<?php
	//If user is has a session token or id
	if (isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake'])) {
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
	        if (!isset($_COOKIE['LsMp'])) {
	        	$LsMp = $user['LsMp'];
	        	setcookie("LsMp", $LsMp, time() + 86400*90, "/");
	        }
	        // Starting the session
	        session_start();
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
<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<title>GistApp – The Simplest Chat Platform</title>
		<meta name="description" content="GistApp – The Simplest Chat Platform">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="theme-color" content="#fff">
		<link rel="apple-touch-icon" href="dist/img/apple-touch-icon.png">
		<!--manifest-->
    	<link rel="manifest" href="manifest.json?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyimon" crossOrigin="use-credentials" />
		<!-- Bootstrap core CSS -->
		<link href="dist/css/lib/bootstrap.min.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">
		<!-- On-tap msg react-->
		<link href="dist/css/react.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">
		<?php
			//if (isset($_GET['dark'])) :
		?>
			<!-- GistApp core CSS -->
			<!--<link href="dist/css/dark.min.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">-->
		<?php //else: ?>
			<!-- GistApp core CSS -->
			<link href="dist/css/gist.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">
		<?php //endif; ?>
		<!--Media adjust-->
		<link href="dist/css/@media.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">
		<!--Pop Up-->
		<link href="dist/css/popup.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" type="text/css" rel="stylesheet">
		<!-- Favicon -->
		<link href="dist/img/favicon.png" type="image/png" rel="icon">
		<!--intlTelInput-->
		<link rel="stylesheet" href="intl-tel-input-master/build/css/intlTelInput.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">
  		<link rel="stylesheet" href="intl-tel-input-master/build/css/demo.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">
  		<!--Emoji-->
  		<link href="www.jqueryscript.net/css/jquerysctipttop.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" rel="stylesheet" type="text/css">
    	<link rel="stylesheet" href="emoji_keyboard.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">
    	<!-- Sweetalert -->
		<link rel="stylesheet" type="text/css" href="dist/css/sweetalert.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">
		<!--Animation-->
		<link rel="stylesheet" type="text/css" href="dist/css/animate.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">
    	<!--<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/flatly/bootstrap.min.css?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim">-->
    	<script type="text/javascript">
    		function disableClick(){
	    		document.onmousedown = function (e) {if (e.button == 2) {e.preventDefault();alert('No option');} }
	    	}
    	</script>
		
</head>
	<body onclick="disableClick()">
		<div class="fh5co-loader"></div>
		<div class="fh5co-loader2" style="display: none;"></div>
		<main>
			<div class="layout">
				<!-- Start of Navigation -->
				<div class="navigation">
					<div class="container">
						<div class="inside">
							<div class="nav nav-tab menu">
								<button class="btn"><img class="avatar-xl" src="dist/img/avatars/profile.png" alt="avatar" title=<?php echo "'".$user_name."'";?>></button>
								<a href="#members" data-toggle="tab" title="Friends" onclick="$('#sidebar').removeClass('mini');$('#nav-tabContent').addClass('mini');$('body,html').animate({ scrollTop: 0 }, 100);"><i class="material-icons">account_circle</i></a>
								<a href="#discussions" data-toggle="tab" class="active" title="Gists" onclick="$('#sidebar').removeClass('mini');$('#nav-tabContent').addClass('mini');$('body,html').animate({ scrollTop: 0 }, 100);"><i class="material-icons active">chat_bubble_outline</i><div class='gist hide new bg-yellow'><span></span></div></a>
								<a href="#notifications" data-toggle="tab" class="f-grow1" title="Notifications" onclick="$('#sidebar').removeClass('mini');$('#nav-tabContent').addClass('mini');$('body,html').animate({ scrollTop: 0 }, 100);"><i class="material-icons">notifications_none</i></a>
								<button class="btn mode" title="Dark Mode"><i class="material-icons">brightness_6</i></button>
								<a href="#settings" title="Settings" data-toggle="tab"><i class="material-icons" onclick="$('#sidebar').removeClass('mini');$('#nav-tabContent').addClass('mini');$('body,html').animate({ scrollTop: 0 }, 100);">settings</i></a>
								<button class="btn power" title="Logout"><i class="material-icons" id="quit">power_settings_new</i></button>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Navigation -->
				<!-- Start of Sidebar -->
				<div class="sidebar" id="sidebar">
					<div class="container">
						<div class="col-md-12">
							<div class="tab-content">
								<!-- Start of Contacts -->
								<div class="tab-pane fade" id="members">
									<div class="search">
										<form class="form-inline position-relative">
											<input type="search" class="form-control" id="people" placeholder="Search for people...">
											<button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
										</form>
										<button class="btn create" data-toggle="modal" data-target="#exampleModalCenter"><i class="material-icons">create</i></button>
									</div>
									<div class="list-group sort">
										<button id="all" class="btn filterMembersBtn active show" data-toggle="list" data-filter="all">All</button>
										<button id="online" class="btn filterMembersBtn" data-toggle="list" data-filter="online">Online</button>
										<button id="offline" class="btn filterMembersBtn" data-toggle="list" data-filter="offline">Offline</button>
									</div>						
									<div class="contacts">
										<h1>Friends</h1>
										
										<div class="list-group" id="contacts" role="tablist">
											<!--Users and their status-->
											<div class="all-friends"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
											<div class="online-friends hide"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
											<div class="offline-friends hide"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
										</div>
									</div>
								</div>
								<!-- End of Contacts -->
								<!-- Start of Discussions -->
								<div id="discussions" class="tab-pane fade active show">
									<div class="search">
										<form class="form-inline position-relative">
											<input type="search" class="form-control" id="conversations" placeholder="Search for conversations...">
											<button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
										</form>
										<button class="btn create" data-toggle="modal" data-target="#startnewchat"><i class="material-icons">person_add</i></button>
									</div>
									<div class="list-group sort">
										<button class="btn filterDiscussionsBtn active show" data-toggle="list" data-filter="all" id="all-discussions">All</button>
										<button class="btn filterDiscussionsBtn" data-toggle="list" data-filter="read" id="read">Read</button>
										<button class="btn filterDiscussionsBtn" data-toggle="list" data-filter="unread" id="unread">Unread</button>
									</div>						
									<div class="discussions">
										<h1>Discussions</h1>
										<div class="all-discussions"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
										<div class="read hide"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
										<div class="unread hide"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></div>
									</div>
								</div>
								<!-- End of Discussions -->
								<!-- Start of Notifications -->
								<div id="notifications" class="tab-pane fade">
									<div class="search">
										<form class="form-inline position-relative">
											<input type="search" class="form-control" id="notice" placeholder="Filter notifications...">
											<button type="button" class="btn btn-link loop"><i class="material-icons filter-list">filter_list</i></button>
										</form>
									</div>
									<div class="list-group sort">
										<button class="btn filterNotificationsBtn active show" data-toggle="list" data-filter="all">All</button>
										<button class="btn filterNotificationsBtn" data-toggle="list" data-filter="latest">Latest</button>
										<button class="btn filterNotificationsBtn" data-toggle="list" data-filter="oldest">Oldest</button>
									</div>						
									<div class="notifications">
										<h1>Notifications</h1>
										<div class="list-group" id="alerts" role="tablist">
											<a href="#" class="filterNotifications all latest notification" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/favicon.png" data-toggle="tooltip" data-placement="top" title="GistApp" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<p>I'm sorry, you have no notifications now</p>
													<span>Just now</span>
												</div>
											</a>
										</div>
									</div>
								</div>
								<!-- End of Notifications -->
								<!-- Start of Settings -->
								<div class="tab-pane fade" id="settings">			
									<div class="settings">
										<div class="profile">
											<img class="avatar-xl" src= "dist/img/avatars/profile.png" alt="avatar">
											<h1><a href="#"><?php echo $user_name; ?></a></h1>
											<span><!--Residence/Country--></span>
											<span><!--About--></span>
											<div class="stats">
												<div class="item" id="fellas">
													<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div>
													<h3>Fellas</h3>
												</div>
												<div class="item" id="chat">
													<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div>
													<h3>Chats</h3>
												</div>
												<!--<div class="item">
													<h2>1538</h2>
													<h3>Posts</h3>
												</div>-->
											</div>
										</div>
										<div class="categories" id="accordionSettings">
											<h1>Settings</h1>
											<!-- Start of My Account -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													<i class="material-icons md-30 online">person_outline</i>
													<div class="data">
														<h5>My Account</h5>
														<p>Update your profile details</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionSettings">
													<div class="content">														
														<div class="upload">
															<div class="data">
																<img class="avatar-xl" src="dist/img/avatars/profile.png" alt="image">
																<label>
																	<input type="file" name="image" id="my-img-input" accept="image/x-png,image/jpeg">
																	<span class="btn button">Upload a Picture</span>
																</label>
															</div>
															<p>For best results, use an image at least 256px by 256px in either .jpg or .png format!</p>
														</div>
															<div class="parent">
																<div class="field">
																	<label for="firstName">First name <span>*</span></label>
																	<input type="text" name="fname" class="form-control" id="firstName" placeholder="First name"
																	<?php echo "value='".$fname."'";?> required>
																</div>
																<div class="field">
																	<label for="lastName">Last name <span>*</span></label>
																	<input type="text" name="lname" class="form-control" id="lastName" placeholder="Last name" <?php echo "value='".$lname."'";?> required>
																</div>
															</div>
															<div class="field">
																<label for="email">Email <span>*</span></label>
																<input type="email" name="email" class="form-control" placeholder="Enter your email address"
																<?php echo "value='".$email."'";?> required disabled>
															</div>
															<div class="field">
																<label for="phone">Phone <span>*</span></label>
																<input type="tel" name="phone" class="form-control" id="phoneNo" placeholder="Enter your phone number"
																<?php echo "value='".$phone."'";?> required>
															</div>
															<!--<div class="field">
																<label for="password">Password</label>
																<input type="password" name="password" class="form-control" id="password" placeholder="Enter a new password" value="password" required>
															</div>-->
															<div class="field">
																<label for="about">About</label>
																<textarea type="about" name="about" class="form-control" id="about" placeholder="Write a little about you" required><?php echo $about; ?></textarea>
															</div>

															<!--<div class="field">
																<label for="location">Location</label>
																<input type="text" class="form-control" id="location" placeholder="Enter your location" value="Helena, Montana" required>
															</div>-->
															<button type="submit" id="update" name="update" class="btn button w-100">Apply</button>
															<br>
															<button class="btn btn-link w-100" id="delete-account">Delete Account</button>
													</div>
												</div>
											</div>
											<!-- End of My Account -->
											<!-- Start of Chat History -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
													<i class="material-icons md-30 online">mail_outline</i>
													<div class="data">
														<h5>Chats</h5>
														<p>Check your chat history</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionSettings">
													<div class="content layer">
														<div class="history">
															<p>When you clear your chat history, the messages will be deleted from your own device.</p>
															<p>The messages won't be deleted or cleared on the devices of the people you chatted with.</p>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="same-address">
																<label class="custom-control-label" for="same-address">Hide will remove your chat history from the recent list.</label>
															</div>
															<!--<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="save-info">
																<label class="custom-control-label" for="save-info">Delete will remove your chat history from the device.</label>e
															</div>-->
															<button type="submit" id="clear-history" class="btn button w-100">Clear blah-blah</button>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Chat History -->
											<!-- Start of Notifications Settings -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
													<i class="material-icons md-30 online">notifications_none</i>
													<div class="data">
														<h5>Notifications</h5>
														<p>Turn notifications on or off</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionSettings">
													<div class="content no-layer">
														<!--<div class="set">
															<div class="details">
																<h5>Desktop Notifications</h5>
																<p>You can set up GistApp to receive notifications when you have new messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>-->
														<div class="set">
															<div class="details">
																<h5>Unread Message Badge</h5>
																<p>If enabled shows a yellow badge on the GistApp app icon when you have unread messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<!--<div class="set">
															<div class="details">
																<h5>Taskbar Flashing</h5>
																<p>Flashes the GistApp app on mobile in your taskbar when you have new notifications.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>-->
														<div class="set">
															<div class="details">
																<h5>Notification Sound</h5>
																<p>Set the app to alert you via notification sound when you have unread messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Vibrate</h5>
																<p>Vibrate when receiving new messages (Ensure system vibration is also enabled).</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked="">
																<span class="slider round"></span>
															</label>
														</div>
														<!--<div class="set">
															<div class="details">
																<h5>Turn On Lights</h5>
																<p>When someone send you a text message you will receive alert via notification light.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>-->
													</div>
												</div>
											</div>
											<!-- End of Notifications Settings -->
											<!-- Start of Connections -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
													<i class="material-icons md-30 online">sync</i>
													<div class="data">
														<h5>Connections</h5>
														<p>Sync your social accounts</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionSettings">
													<div class="content">
														<!--<div class="app">
															<img src="dist/img/integrations/slack.svg" alt="app">
															<div class="permissions">
																<h5>Skrill</h5>
																<p>Read, Write, Comment</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="app">
															<img src="dist/img/integrations/dropbox.svg" alt="app">
															<div class="permissions">
																<h5>Dropbox</h5>
																<p>Read, Write, Upload</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>-->
														<div class="app">
															<img src="dist/img/integrations/drive.svg" alt="app">
															<div class="permissions">
																<h5>Google Drive</h5>
																<p>No permissions set</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<!--<div class="app">
															<img src="dist/img/integrations/trello.svg" alt="app">
															<div class="permissions">
																<h5>Trello</h5>
																<p>No permissions set</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>-->
													</div>
												</div>
											</div>
											<!-- End of Connections -->
											<!-- Start of Appearance Settings -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
													<i class="material-icons md-30 online">colorize</i>
													<div class="data">
														<h5>Appearance</h5>
														<p>Customize the look of GistApp</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionSettings">
													<div class="content no-layer">
														<div class="set">
															<div class="details">
																<h5>Turn Off Lights</h5>
																<p>The dark mode is applied to core areas of the app that are normally displayed as light.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round mode" id="dark-mode"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Appearance Settings -->
											<!-- Start of Language -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
													<i class="material-icons md-30 online">language</i>
													<div class="data">
														<h5>Language</h5>
														<p>Select preferred language</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionSettings">
													<div class="content layer">
														<div class="language">
															<label for="country">Language</label>
															<select class="custom-select" id="country" required>
																<option value="">Select an language...</option>
																<option>English, UK</option>
																<option>English, US</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Language -->
											<!-- Start of Privacy & Safety -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
													<i class="material-icons md-30 online">lock_outline</i>
													<div class="data">
														<h5>Privacy & Safety</h5>
														<p>Control your privacy settings</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionSettings">
													<div class="content no-layer">
														<div class="set">
															<div class="details">
																<h5>Keep Me Safe</h5>
																<p>Automatically scan and delete direct messages you receive from everyone that contain explict content.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>My Friends Are Nice</h5>
																<p>If enabled scans direct messages from everyone unless they are listed as your friend.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<!--<div class="set">
															<div class="details">
																<h5>Everyone can add me</h5>
																<p>If enabled anyone in or out your friends of friends list can send you a friend request.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Friends of Friends</h5>
																<p>Only your friends or your mutual friends will be able to send you a friend reuqest.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>-->
														<div class="set">
															<div class="details">
																<h5>Data to Improve</h5>
																<p>This settings allows us to use and process information for analytical purposes.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Data to Customize</h5>
																<p>This settings allows us to use your information to customize GistApp for you.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Privacy & Safety -->
											<!-- Start of Logout -->
											<div class="category">
												<a class="quit title collapsed">
													<i class="material-icons md-30 online" id="quit">power_settings_new</i>
													<div class="data">
														<h5>Power Off</h5>
														<p>Log out of your account</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
											</div>
											<!-- End of Logout -->
										</div>
									</div>
								</div>
								<!-- End of Settings -->
							</div>
						</div>
					</div>
				</div>
				<!-- End of Sidebar -->
				<!-- Start of Add Friends -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="requests">
							<div class="title">
								<h1>Chat up a friend</h1>
								<button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
							</div>
							<div class="content">
									<div class="form-group">
										<label for="user">Gist Name*:</label>
										<input type="text" class="reciever1 form-control" placeholder="Add recipient..." required>
										<div class="user" id="contact">
											<img class="avatar-sm" src="dist/img/avatars/profile.png" alt="avatar">
											<h5><?php echo $user_name; ?></h5>
											<button class="btn"><i class="material-icons">close</i></button>
										</div>
									</div>
									<div class="form-group">
										<label for="welcome">Message*:</label>
										<textarea class="text-control" id="message1" placeholder="Send your welcome message..."></textarea>
									</div>
									<button type="submit" id="create-chat1" class="btn button w-100" data-dismiss="modal">Send Message</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Add Friends -->
				<!-- Start of Create Chat -->
				<div class="modal fade" id="startnewchat" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="requests">
							<div class="title">
								<h1>Start new chat</h1>
								<button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
							</div>
							<div class="content">
								<form>
									<div class="form-group">
										<label for="participant">Recipient Name (Optional):</label>
										<input type="text" class="form-control" id="name" name="recipient" placeholder="Recipient name..." required>
										<div class="user" id="recipient">
											<img class="avatar-sm" src="dist/img/avatars/profile.png" alt="avatar">
											<h5>Name Here</h5>
											<button class="btn"><i class="material-icons">close</i></button>
										</div>
									</div>
									<div class="form-group">
										<label for="topic">Email*:</label>
										<input type="email" name="email" class="reciever2 form-control" required>
									</div>
									<div class="form-group">
										<label for="message">Message*:</label>
										<textarea class="text-control" name="message" id="message2" placeholder="Send your welcome message..."></textarea>
									</div>
									<button type="submit" name="create-chat" id="create-chat2" class="btn button w-100" data-dismiss="modal">Start New Chat</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Create Chat -->
				<div id="active" style="display: none;"></div>
				<div id="active-name" style="display: none;"></div>
				<div class="main">
					<div class="tab-content" id="nav-tabContent">
						<!-- Start of Babble -->
						<div class="babble tab-pane fade active show" id="list-chat" role="tabpanel" aria-labelledby="list-chat-list">
							<!-- Start of Chat -->
							<div class="chat hide" id="chat1">
								<div class="top">
									<div class="container">
										<div class="col-md-12">
											<div class="inside">
												<a><img class="avatar-md connect" recipient sender bond id="active-friend-status" src='dist/img/avatars/profile.png' data-toggle="tooltip" data-placement="top" title='' alt="avatar" data-original-title ></a>
												<div class="status">
													<i class="material-icons">fiber_manual_record</i>
												</div>
												<div id="data" class="data">
													<h5><a id="active-friend-name"></a></h5>
													<span></span>
												</div>
												<button onclick="alert('Feature not yet available');" class="btn connect d-md-block d-none" name="1"><i class="material-icons md-30">phone_in_talk</i></button>
												<button onclick="alert('Feature not yet available');" class="btn connect d-md-block d-none" name="1"><i class="material-icons md-30">videocam</i></button>
												<button onclick="alert('Feature not yet available');" class="btn d-md-block d-none"><i class="material-icons md-30">info</i></button>
												<div class="dropdown">
													<button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
													<div class="dropdown-menu dropdown-menu-right">
														<button onclick="alert('Feature not yet available');" class="dropdown-item connect" name="1"><i class="material-icons">phone_in_talk</i>Voice Call</button>
														<button onclick="alert('Feature not yet available');" class="dropdown-item connect" name="1"><i class="material-icons">videocam</i>Video Call</button>
														<hr>
														<button class="dropdown-item" id="active-clear"><i class="material-icons">clear</i>Clear Conversation</button>
														<button class="dropdown-item" id="active-block"><i class="material-icons">block</i>Block Contact</button>
														<button class="dropdown-item" id="active-delete"><i class="material-icons">delete</i>Delete Contact</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="content" id="content">
									<div class="container">
										<div class="col-md-12 toggle" id="active-message-box">
												<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div>
												<!--<div class="date">
													<hr>
													<span>Yesterday</span>
													<hr>
												</div>-->
										</div>
										<div class="col-md-12 toggle" id="typing"></div>
										<div class="col-md-12 toggle" id="active-unsent"></div>
										<div class="col-md-12 toggle" id="recordingsList"></div>
										<div class="col-md-12 toggle" id="fileList"></div>
									</div>

								</div>
								
								<div class="container">
									<div class="col-md-12 holder" style="padding:0px!important; ">
											<p id="count" style="margin-top: 25px;">
									            <span id="days">00</span><span class="dots">:</span><span id="hours">00</span><span class="dots">:</span><span id="minutes">00</span><span class="dots">:</span><span id="seconds">00</span><span class="dots">:</span><span id="tens">00</span>
									        </p>
										<div class="bottom">
											<div class="position-relative w-100">
												<textarea id="display" class="form-control text" placeholder="Start typing for reply..." rows="1"></textarea>
												<button id="test" class="btn emoticons" title="Emojis"><i class="material-icons">insert_emoticon</i></button>
												<button id="active-send" type="submit" class="btn send"><i class="material-icons">send</i></button>
												<label id="active-attach1" class="clip" title="Attach an image">
													<input type="file" accept="image/x-png,image/gif,image/jpeg" name="image" id="image-active-input" multiple>
													<span class="btn clip-image"><i class="material-icons">image</i></span>
												</label>
												<label id="active-attach2" class="clip" title="Attach a File">
													<input type="file" accept="application/*" name="files[]" id="file-active-input" multiple>
													<span class="btn clip-icon"><i class="material-icons">attach_file</i></span>
												</label>
												<label id="active-mic" class="clip" title="Microphone">
													<span class="btn mic-icon"><i class="material-icons">mic</i></span>
												</label>
												<label id="active-stop" class="clip" title="Stop" style="margin-top: 20px;" >
													<span class="btn mic-icon"><i class="material-icons">stop</i></span>
												</label>
											</div>
											<!--<label>
												<input type="file">
												<span class="btn attach d-sm-block d-none"><i class="material-icons">attach_file</i></span>
											</label> -->
											<audio id="audio1" src="pop.m4a"></audio>
					    					<audio id="audio2" src="alert.m4a"></audio>
					    					<audio id="audio3" src="new.mp3"></audio>
					    					<audio id="audio4" src="voice.mp3"></audio>
					    					<audio id="audio5" src="accomplished.mp3"></audio>
					    					<audio id="audio6" src="typing.ogg"></audio>
										</div>
									</div>
								</div>
							</div>
							<!-- End of Chat -->
							<!-- Start of Call -->
							<div class="call" id="call1">
								<div class="content">
									<div class="container">
										<div class="col-md-12">
											<div class="inside">
												<div class="panel">
													<div class="participant">
														<img class="avatar-xxl" src="dist/img/avatars/profile.png" alt="avatar">
														<span>Connecting</span>
													</div>							
													<div class="options">
														<button class="btn option"><i class="material-icons md-30">mic</i></button>
														<button class="btn option"><i class="material-icons md-30">videocam</i></button>
														<button class="btn option back call-end" name="1"><i class="material-icons md-30">call_end</i></button>
														<button class="btn option"><i class="material-icons md-30">person_add</i></button>
														<button class="btn option"><i class="material-icons md-30">volume_up</i></button>
													</div>
													<button class="btn back" name="1"><i class="material-icons md-24">chat</i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End of Call -->
						</div>
						<!-- End of Babble -->
						 
						</div>
						<!-- End of Babble -->
					</div>
				</div>
			</div> <!-- Layout -->
		</main>
		<!--<a id="backtobottom" class="drag">Gist</a>-->
	</body>
		<!-- Bootstrap/GistApp core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="dist/js/jquery-3.3.1.slim.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="dist/js/vendor/jquery-slim.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"><\/script>')</script>
		<script>
				function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }
				scrollToBottom(document.getElementById('content'));
		</script>
		<script type="text/javascript" src="dist/js/jquery-1.11.3.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/localstorage.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/vendor/popper.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script src="dist/js/bootstrap.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/update-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.php-ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/conversation.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/backtoTop.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/file-upload.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/drag.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/onload.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/preload.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/popup.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script src="intl-tel-input-master/build/js/intlTelInput.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<!--<script src="ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>-->
		<script src="cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script src="emoji_keyboard.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script>
	        const zone = document.getElementById("display");
	        var emojiKeyboard = new EmojiKeyboard;
	        /* you can edit a few attributes:
	            - callback: function called when a user clicks on an emoji, with the emoji and a boolean telling if the window got closed
	            - auto_reconstruction: boolean if we should recreate the keyboard when we cannot find it
	            - default_placeholder: placeholder text in the search bar
	            - resizable: boolean if the window can be resized (left side)
	        */
	        emojiKeyboard.callback = (emoji, closed) => {
	            console.info(emoji, closed)
	            zone.value += emoji.emoji;	            
	        };
	        emojiKeyboard.default_placeholder = "You are the best";
	        emojiKeyboard.instantiate(document.getElementById("test"))	        
    	</script>
    	<script>	        
	        const zone1 = document.getElementById("display1");
	        var emojiKeyboard = new EmojiKeyboard;
	        /* you can edit a few attributes:
	            - callback: function called when a user clicks on an emoji, with the emoji and a boolean telling if the window got closed
	            - auto_reconstruction: boolean if we should recreate the keyboard when we cannot find it
	            - default_placeholder: placeholder text in the search bar
	            - resizable: boolean if the window can be resized (left side)
	        */
	        emojiKeyboard.callback = (emoji, closed) => {
	            console.info(emoji, closed)	            
	            zone1.value += emoji.emoji;
	            
	        };
	        emojiKeyboard.default_placeholder = "You are the best";	        
	        emojiKeyboard.instantiate(document.getElementById("test1"))
    	</script>
    	<script src="recorder/js/recorder.js"></script>
  		<script src="recorder/js/app.js"></script>
  		<script type="text/javascript" src="dist/js/stopwatch.js"></script>
		<script type="text/javascript" src="dist/js/gist.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/onunload.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
		<script type="text/javascript" src="dist/js/sweetalert.min.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
    	<script type="text/javascript" src="dist/js/sweetalert.init.js?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim"></script>
</html>
