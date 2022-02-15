<?php
	if (isset($_POST['create-chat']) && isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
	    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
		$user = mysqli_fetch_array($query);
		$fname = $user['fname'];
		$lname = $user['lname'];
        $user_image = $user['image'];
	    $user_name = $fname."_".$lname;
		$my_email = $user['email'];
	   	$about = $user['about'];
	   	$user_discussion_list = $fname."_".$lname."_discussion_list";
	   	$get = mysqli_query($conn, "SELECT * FROM users WHERE fname = '".$_POST['fname']."' AND lname = '".$_POST['lname']."'");
		$recipient = mysqli_fetch_array($get);
		$email = $recipient['email'];
		$bond = [];
		$bond[] = md5($email);
		$bond[] = md5($my_email);
		sort($bond);
		$typing_id = [];
		$typing_id[] = $email;
		$typing_id[] = $my_email;
		sort($typing_id);
		$typing_id = implode('|', $typing_id);
		$bond = implode('.', $bond);
		$message = $_POST['message'];
		$sql = "SELECT * FROM users WHERE email = '".$email."'";
		$fetch = mysqli_query($conn, $sql);
		if (mysqli_num_rows($fetch) < 1) {
			echo "Email not yet connected to GistApp";
		}
		else {
			$data = mysqli_fetch_array($fetch);
			if (($data['email']) == $my_email) {
				echo "Sorry, for the mishap. You have used this email\r\nPlease try another email";
			}
			else {
				$find = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$email."'");
				$user =mysqli_fetch_array($find);
				$reciever_discussion_list = $user['fname']."_".$user['lname']."_discussion_list";
				$sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user['fname']."_".$user['lname']."', '".$user_name."', '".$user['user_id']."', '".$user_id."', '".$message."')";
				$sql1 = "INSERT INTO ".$user_name."_friend_list (bond, fname, lname, email, about) VALUES ('".$bond."', '".$user['fname']."', '".$user['lname']."', '".$email."', '".mysqli_real_escape_string($conn, $user['about'])."') ON DUPLICATE KEY UPDATE fname = '".$user['fname']."', lname = '".$user['lname']."', about = '".mysqli_real_escape_string($conn, $user['about'])."'";
				$sql2 = "INSERT INTO ".$user['fname']."_".$user['lname']."_friend_list (bond, fname, lname, email, about) VALUES ('".$bond."', '".$fname."', '".$lname."', '".$my_email."', '".mysqli_real_escape_string($conn, $about)."') ON DUPLICATE KEY UPDATE fname = '".$fname."', lname = '".$lname."', about = '".mysqli_real_escape_string($conn, $about)."'";
				$sql3 = "INSERT INTO ".$user_discussion_list." (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user_name."', '".$user['fname']."_".$user['lname']."', '".$user['user_id']."', '".$user_id."', '".$message."', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$email."', sender = '".$my_email."', recipient_name = '".$user_name."', sender_name = '".$user['fname']."_".$user['lname']."', recipient_id = '".$user['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 1, unseen = 0";
				$sql4 = "INSERT INTO ".$reciever_discussion_list." (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user_name."', '".$user['fname']."_".$user['lname']."', '".$user['user_id']."', '".$user_id."', '".$message."', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$email."', sender = '".$my_email."', recipient_name = '".$user_name."', sender_name = '".$user['fname']."_".$user['lname']."', recipient_id = '".$user['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";
				global $typing_id;
				$sql5 = "CREATE TABLE IF NOT EXISTS `".$typing_id."_typing_message` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` varchar(100) NOT NULL,
						  `image` varchar(40) NOT NULL,
						  `user_name` varchar(70) NOT NULL,
						  `message` varchar(10240) NOT NULL,
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (`id`)
						)";
				$insert = mysqli_query($conn, $sql);
				$insert1 = mysqli_query($conn, $sql1);
				$insert2 = mysqli_query($conn, $sql2);
				$insert3 = mysqli_query($conn, $sql3);
				$insert4 = mysqli_query($conn, $sql4);
				$created = mysqli_query($conn, $sql5);
				if ($insert&&$insert1&&$insert2&&$insert3&&$insert4) {					
					echo "Sent";
				}
				else {
					echo mysqli_error($conn);
				}
			}
		}

	}
?>
<?php
	if (isset($_POST['create-new-chat']) && isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
	    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
		$user = mysqli_fetch_array($query);
		$fname = $user['fname'];
		$lname = $user['lname'];
        $user_image = $user['image'];
	    $user_name = $fname."_".$lname;
		$my_email = $user['email'];
		$my_phone = $user['phone'];
	   	$about = $user['about'];
	   	$user_discussion_list = $fname."_".$lname."_discussion_list";
		$email = $_POST['email'];
		$bond = [];
		$bond[] = md5($email);
		$bond[] = md5($my_email);
		sort($bond);
		$typing_id = [];
		$typing_id[] = $email;
		$typing_id[] = $my_email;
		sort($typing_id);
		$typing_id = implode('|', $typing_id);
		$bond = implode('.', $bond);
		$message = $_POST['message'];
		$sql = "SELECT * FROM users WHERE email = '".$email."'";
		$fetch = mysqli_query($conn, $sql);
		if (mysqli_num_rows($fetch) < 1) {
			echo "Email not yet connected to GistApp";
		}
		else {
			$data = mysqli_fetch_array($fetch);
			if (($data['email']) == $my_email) {
				echo "Sorry, for the mishap. You have used this email.\r\nPlease try another email";
			}
			else {
				$find = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$email."'");
				$user =mysqli_fetch_array($find);
				$reciever_discussion_list = $user['fname']."_".$user['lname']."_discussion_list";
				$sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user['fname']."_".$user['lname']."', '".$user_name."', '".$user['user_id']."', '".$user_id."', '".$message."')";
				$sql1 = "INSERT INTO ".$user_name."_friend_list (bond, fname, lname, email, phone, about) VALUES ('".$bond."', '".$user['fname']."', '".$user['lname']."', '".$email."', '".$user['phone']."', '".mysqli_real_escape_string($conn, $user['about'])."') ON DUPLICATE KEY UPDATE fname = '".$user['fname']."', lname = '".$user['lname']."', email = '".$email."', phone = '".$user['phone']."', about = '".mysqli_real_escape_string($conn, $user['about'])."'";
				$sql2 = "INSERT INTO ".$user['fname']."_".$user['lname']."_friend_list (bond, fname, lname, email, phone, about) VALUES ('".$bond."', '".$fname."', '".$lname."', '".$my_email."', '".$my_phone."', '".mysqli_real_escape_string($conn, $about)."') ON DUPLICATE KEY UPDATE fname = '".$fname."', lname = '".$lname."', email = '".$my_email."', phone = '".$my_phone."', about = '".mysqli_real_escape_string($conn, $about)."'";
				$sql3 = "INSERT INTO ".$user_discussion_list." (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user_name."', '".$user['fname']."_".$user['lname']."', '".$user['user_id']."', '".$user_id."', '".$message."', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$email."', sender = '".$my_email."', recipient_name = '".$user_name."', sender_name = '".$user['fname']."_".$user['lname']."', recipient_id = '".$user['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 1, unseen = 0";
				$sql4 = "INSERT INTO ".$reciever_discussion_list." (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$email."', '".$my_email."', '".$bond."', '".$user_name."', '".$user['fname']."_".$user['lname']."', '".$user['user_id']."', '".$user_id."', '".$message."', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$email."', sender = '".$my_email."', recipient_name = '".$user_name."', sender_name = '".$user['fname']."_".$user['lname']."', recipient_id = '".$user['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";
				global $typing_id;
				$sql5 = "CREATE TABLE IF NOT EXISTS `".$typing_id."_typing_message` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` varchar(100) NOT NULL,
						  `image` varchar(40) NOT NULL,
						  `user_name` varchar(70) NOT NULL,
						  `message` varchar(10240) NOT NULL,
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (`id`)
						)";
				$insert = mysqli_query($conn, $sql);
				$insert1 = mysqli_query($conn, $sql1);
				$insert2 = mysqli_query($conn, $sql2);
				$insert3 = mysqli_query($conn, $sql3);
				$insert4 = mysqli_query($conn, $sql4);
				$created = mysqli_query($conn, $sql5);
				if ($insert&&$insert1&&$insert2&&$insert3&&$insert4) {					
					echo "Sent";
				}
				else {
					echo mysqli_error($conn);
				}
			}
		}

	}
?>