<?php if (isset($_COOKIE['user_id'])) {
	require 'db.php';
	$user_id = $_COOKIE['user_id'];
	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	$query = mysqli_query($conn, $sql);
	$user = mysqli_fetch_array($query);
	$fname = $user['fname'];
	$lname = $user['lname'];
	$user_discussion_list = $fname."_".$lname."_discussion_list";
	$sql = "SELECT COUNT(unseen) FROM ".$user_discussion_list." WHERE unseen >= 1";
	$select = mysqli_query($conn, $sql);
	$count = mysqli_fetch_array($select);
	echo $unread_count = $count['0'];
} ?>