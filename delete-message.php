<?php if (isset($_POST['delete']) && ($_POST['delete'] == true) && isset($_POST['message_id']) && isset($_POST['sender_id']) && isset($_COOKIE['user_id'])) : ?>
<?php
	//For both users
	if (isset($_COOKIE['user_id'])) {
		$message_id = $_POST['message_id'];
		$user_id = $_POST['sender_id'];
	    #$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    #$query = mysqli_query($conn, $sql);
	    #$fname = $user['fname'];
	    #$lname = $user['lname'];
	    #$user_friend_list = $fname."_".$lname."friend_list";
	    #$user_discussion_list = $fname."_".$lname."_discussion_list";
	    $sql1 = "DELETE FROM conversation_log WHERE id = ".$message_id." AND sender_id = '".$user_id."'";
	    #$sql2 = "DELETE FROM ".$user_discussion_list." WHERE id =   ".$message_id." AND sender_id = '".$user_id."'";
	    #$sql3 = "DELETE FROM ".$reciever_discussion_list." WHERE id = ".$message_id." AND sender_id = '".$user_id."'";
	    require 'db.php';                                
	    $delete = mysqli_query($conn, $sql1);
	    if ($delete == true) {
	        echo "Message ".$message_id." by sender ".$user_id." deleted!";
	    }
	    else {
	    	echo mysqli_error($conn);
	    }
	}
	else {
		header('location: sign-in');
	}
?>
<?php else: header('location: 404'); ?>
<?php endif; ?>