<?php
	if (isset($_COOKIE['user_id']) && isset($_COOKIE['handshake']) && isset($_POST['seen']) && ($_POST['seen'] == true) && isset($_POST['bond']) && (strlen($_POST['bond'])!=0)) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
			$bond = $_POST['bond'];
	        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	        $select = mysqli_query($conn, $sql);
	        if ($select) {
		        $user = mysqli_fetch_array($select);
		        $fname = $user['fname'];
		        $lname = $user['lname'];
		        $user_name = $fname." ".$lname;	        
		        $user_discussion_list = $fname."_".$lname."_discussion_list";
		        $sql1 = "UPDATE ".$user_discussion_list." SET seen = 1, unseen = 0 WHERE bond = '".$bond."'";
		        $update = mysqli_query($conn, $sql1);
		        if ($update) {
		        	# code...
		        }
		        else {
		        	echo mysqli_error($conn);
		        }
	        }
	        else {
	        	echo mysqli_error($conn);
	        }
	}
?>