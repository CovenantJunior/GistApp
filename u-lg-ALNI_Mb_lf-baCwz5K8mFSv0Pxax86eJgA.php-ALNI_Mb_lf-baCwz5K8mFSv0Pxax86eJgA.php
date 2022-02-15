<?php
session_write_close();
ignore_user_abort(false);
set_time_limit(120);

//Fetch new message in thread
if (isset($_COOKIE['user_id'])&&isset($_COOKIE['GID'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['PHPSESSID'])&&isset($_GET['ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA'])) {
	try {
		// LsMp cookie saves the file update time which was sent to the browser
		if (!isset($_COOKIE['LsMp'])) {
			setcookie('LsMp', 0);
			$_COOKIE['LsMp'] = 0;
		}
		while (true) {
			require 'db.php';
			$bond = $_GET['ALNI_Mb_lf-baCwz5K8mFSv0Pxax86eJgA'];
			$recipient_id = $_COOKIE['user_id'];
			$LsMp = $_COOKIE['LsMp'];
			$sql = "SELECT * FROM conversation_log WHERE bond = '".$bond."' AND recipient_id = '".$recipient_id."' AND ROUND(UNIX_TIMESTAMP(created_at), 0) >= ".intval($LsMp)."";
			$check = mysqli_query($conn, $sql);
			// if the last modification time of the file is greater than the last update sent to the user... 
			if (mysqli_num_rows($check) >= 1) {
				$date = new DateTime();
				$date = $date->getTimestamp();
				$stamp_db = "UPDATE users SET LsMp = ".$date." WHERE user_id = '".$recipient_id."'";
				$update = mysqli_query($conn, $stamp_db);
				setcookie("LsMp", $date, time() + 86400*90, "/");
				// get contents
				exit(json_encode([
					'status' => true
				]));
				exit();
			}
			else {
				mysqli_close($conn);
			}
			// to clear cache
			clearstatcache();
			// to sleep
			sleep(3);
		}
	} catch (Exception $e) {
		/*
		exit(
			json_encode(
				array (
					'status' => false,
					'error' => $e -> getMessage()
				)
			)
		);
		*/
	}
}

//Check for general new message
if (isset($_COOKIE['user_id'])&&isset($_COOKIE['GID'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['PHPSESSID'])&&isset($_GET['__ALNI_Mb_lf-baC-v0Pxa-wz5K8mFSv0Pxax86eJgA'])) {
	try {
		// __McNt cookie saves the file update time which was sent to the browser
		if (!isset($_COOKIE['__McNt'])) {
			require 'db.php';
			//$bond = $_GET['__ALNI_Mb_lf-baC-v0Pxa-wz5K8mFSv0Pxax86eJgA'];
			$bond = $_COOKIE['handshake'];
			$initiate = "SELECT * FROM conversation_log WHERE bond LIKE '%".$bond."%'";
			$run = mysqli_query($conn, $initiate);
			$count = mysqli_num_rows($run);
			echo $count;
			setcookie('__McNt', $count);
		}
		while (true) {
			require 'db.php';
			$bond = $_GET['__ALNI_Mb_lf-baC-v0Pxa-wz5K8mFSv0Pxax86eJgA'];
			$recipient_id = $_COOKIE['user_id'];
			$__McNt = $_COOKIE['__McNt'];
			$sql = "SELECT * FROM conversation_log WHERE bond LIKE '%".$bond."%'";
			$check = mysqli_query($conn, $sql);
			// if the last modification time of the file is greater than the last update sent to the user... 
			if (mysqli_num_rows($check) > intval($__McNt)) {
				setcookie('__McNt', mysqli_num_rows($check));
				// get contents
				exit(json_encode([
					'status' => true
				]));
			}
			else {
				mysqli_close($conn);
			}
			// to clear cache
			clearstatcache();
			// to sleep
			sleep(3);
		}
	} catch (Exception $e) {
		exit(
			json_encode(
				array (
					'status' => false,
					'error' => $e -> getMessage()
				)
			)
		);
	}
}
if (isset($_COOKIE['user_id'])&&isset($_COOKIE['GID'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['PHPSESSID'])&&isset($_GET['u-al-lg'])) {
	try {
		// ALsMp cookie saves the file update time which was sent to the browser
		if (!isset($_COOKIE['ALsMp'])) {
			setcookie('ALsMp', 0);
			$_COOKIE['ALsMp'] = 0;
		}
		while (true) {
			require 'db.php';
			$recipient_id = $_COOKIE['user_id'];
			$ALsMp = $_COOKIE['ALsMp'];
			$sql = "SELECT * FROM conversation_log WHERE recipient_id = '".$recipient_id."' AND ROUND(UNIX_TIMESTAMP(created_at), 0) >= ".intval($ALsMp)."";
			$check = mysqli_query($conn, $sql);
			// if the last modification time of the file is greater than the last update sent to the user... 
			if (mysqli_num_rows($check) >= 1) {
				$date = new DateTime();
				$date = $date->getTimestamp();
				setcookie('ALsMp', $date);
				// get contents
				exit(json_encode([
					'status' => true
				]));
			}
			else {
				mysqli_close($conn);
			}
			// to clear cache
			clearstatcache();
			// to sleep
			sleep(3);
		}
	} catch (Exception $e) {
		/*
		exit(
			json_encode(
				array (
					'status' => false,
					'error' => $e -> getMessage()
				)
			)
		);
		*/
	}
}
if (isset($_COOKIE['user_id'])&&isset($_COOKIE['GID'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['PHPSESSID'])&&isset($_GET['kaun-typing-hai'])) {
	try {
		if (!isset($_COOKIE['w_I_ty'])) {
			setcookie("w_I_ty", 0);
			$_COOKIE["w_I_ty"] = 0;
		}
		while (true) {
			require 'db.php';
			$recipient_id = $_COOKIE['user_id'];
			$bond = $_GET['kaun-typing-hai'];
			$w_I_ty = $_COOKIE['w_I_ty'];
			$sql = "SELECT * FROM `".$bond."_typing_message` WHERE user_id != '".$recipient_id."' AND ROUND(UNIX_TIMESTAMP(created_at), 0) >= ".intval($w_I_ty)."";
			$check = mysqli_query($conn, $sql);
			// if the last modification time of the file is greater than the last update sent to the user... 
			if (mysqli_num_rows($check) >= 1) {
				$date = new DateTime();
				$date = $date->getTimestamp();
				setcookie('w_I_ty', $date);
				// get contents
				exit(json_encode([
					'status' => true
				]));
			}
			else {
				echo mysqli_error($conn);
			}
			// to clear cache
			clearstatcache();
			// to sleep
			sleep(3);
		}
	} catch (Exception $e) {
		/*
		exit(
			json_encode(
				array (
					'status' => false,
					'error' => $e -> getMessage()
				)
			)
		);
		*/
	}
}

//Check for new unread message
if (isset($_COOKIE['user_id'])&&isset($_COOKIE['GID'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['PHPSESSID'])&&isset($_GET['c-f-u-c'])) {
	try {
		if (!isset($_COOKIE['UcsMp'])) {
			setcookie('UcsMp', 0);
			$_COOKIE['UcsMp'] = 0;
		}
		while (true) {
			require 'db.php';
			$UcsMp = $_COOKIE['UcsMp'];
			$recipient_id = $_COOKIE['user_id'];
			$sql = "SELECT * FROM users WHERE user_id = '".$recipient_id."'";
			$query = mysqli_query($conn, $sql);
			$user = mysqli_fetch_array($query);
	        $fname = $user['fname'];
	        $lname = $user['lname'];	        
	        $user_discussion_list = $fname."_".$lname."_discussion_list";
	        $sql1 = "SELECT * FROM ".$user_discussion_list." WHERE recipient_id = '".$recipient_id."' AND seen = 0 AND ROUND(UNIX_TIMESTAMP(created_at), 0) > ".intval($UcsMp)."";
			$check = mysqli_query($conn, $sql1);
			// if the last modification time of the file is greater than the last update sent to the user... 
			if (mysqli_num_rows($check) >= 1) {
		        $date = new DateTime();
				$date = $date->getTimestamp();
		        setcookie('UcsMp', $date);
				// get contents
				exit(json_encode([
					'status' => true
				]));
				exit();
			}
			else {
				mysqli_close($conn);
			}
			// to clear cache
			clearstatcache();
			// to sleep
			sleep(3);
		}
	} catch (Exception $e) {
		exit(
			json_encode(
				array (
					'status' => false,
					'error' => $e -> getMessage()
				)
			)
		);
	}
}
?>