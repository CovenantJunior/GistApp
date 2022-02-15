<?php
	if ((isset($_POST['log']) && $_POST['log']==true) && isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
	    if ($query) {
	    	$time = new DateTime();
	    	$time = $time->getTimestamp();
		    $user = mysqli_fetch_array($query);
		    $fname = $user['fname'];
		    $lname = $user['lname'];
			$sql1 = "UPDATE users SET last_log = $time WHERE user_id = '".$user_id."'";
			$insert1 = mysqli_query($conn, $sql1);
			if ($insert1) {
				echo "<script>console.info('Synchronizing Chats... (".$time.")')</script>";
			}
		}
	}
?>