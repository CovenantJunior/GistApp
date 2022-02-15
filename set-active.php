<?php
	if ((isset($_POST['set-active']) && $_POST['set-active']==true) && isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
	    if ($query) {
		    $user = mysqli_fetch_array($query);
		    $fname = $user['fname'];
		    $lname = $user['lname'];
			$sql1 = "UPDATE users SET status = 'Online' WHERE user_id = '".$user_id."'";
			$sql2 = "UPDATE ".$fname."_".$lname." SET status = 'Online' WHERE user_id = '".$user_id."'";
			$insert1 = mysqli_query($conn, $sql1);
			$insert2 = mysqli_query($conn, $sql2);
			if ($insert1&&$insert2) {
				echo "You are Online.";
			}
		}
	}
?>