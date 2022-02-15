<?php if (isset($_POST['clear-chat']) && ($_POST['clear-chat'] == true)) : ?>
<?php
	if (isset($_COOKIE['user_id'])&&isset($_COOKIE['handshake'])) {
	    require 'db.php';                                
		$user_id = $_COOKIE['user_id'];
	    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
	    $user = mysqli_fetch_array($query);
	    $fname = $user['fname'];
	    $lname = $user['lname'];
	    $phone = $user['phone'];
	    $user_discussion_list = $fname."_".$lname."_discussion_list";
	    $sql1 = "DELETE FROM ".$user_discussion_list." WHERE recipient = '".$phone."' OR sender = '".$phone."'";	    
	    $delete1 = mysqli_query($conn, $sql1);
	    if ($delete1) {
	    	echo "Cleared";
	    }
	    else {
	    	echo "Not cleared";
	    }
	}
	else {
		header('location: sign-in');
	}
?>
<?php else: header('location: sign-in'); ?>
<?php endif; ?>